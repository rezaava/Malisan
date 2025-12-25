<?php

namespace App\Http\Controllers\site;

use App\Models\Course;
use App\Models\Fcm;
use App\Models\CourseUser;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OptionUser;
use App\Models\Role;
use App\Models\Survey;
use App\Models\User;
use App\Models\Coworker;
use App\Models\Touruser;
use DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('melisan.auth.login');
    }
    public function loginpost(Request $request)
    {
        $user = User::where('national', $request->national)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $content = Coworker::where('user_id', $user->id)->first();
            $mosabeghat = Touruser::where('user_id', $user->id)->count();
            if ($user->hasRole('teacher')) {
                // agar moaleme          
                $user2 = User::where('national', $user->national)->where('role', 3)->first();
                return redirect()->route('dashboard');
            } elseif ($user->hasRole('student')) {
                // agar studente
                $courses = $user->courses()->pluck('course_id');
                $teacherCourses = CourseUser::where('role_id', '2')->whereIn('course_id', $courses)->pluck('user_id');
                $user2 = User::where('national', $user->national)->where('role', 2)->first();
                foreach ($teacherCourses as $item) {
                    $item = -$item;
                }
                $answers = OptionUser::where('user_id', $user->id)->pluck('survey_id');
                $surveys = Survey::where(function ($query) use ($courses, $teacherCourses) {
                    $query->whereIn('group', $courses)->orWhere('group', '0')->orWhereIn('user_id', $teacherCourses);
                })->whereNotIn('id', $answers)->where('active', '1')->get();
                if (count($surveys)) {
                    // agar nazar sanji hast
                    $random = $surveys->random();
                    if ($random->type != '1') {
                        $options = Option::where('survey_id', $random->id)->get();
                        $random['options'] = $options;
                    }
                    return view('melisan.management.courses.students.survays', compact('random', 'user'))
                        ->with([
                            'pageTitle' => 'صفحه نظرسنجی',
                            'pageName' => 'نظرسنجی',
                            'pageDescription' => 'دوست من ! این یه فرم نظرسنجی هست لطفا با دقت جواب بده',
                        ]);
                } else {
                    // agar nazarsanji nist
                    return redirect('/dashboard/courses/list');
                }
            }
        } else {
            //    agar user pass eshtebahe
            return back()->with('error', 'نام کاربری یا کلمه عبور صحیح نمی باشد');
        }
    }
    public function reg()
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->hasRole('student')) {
                $user->role = 3;
                $user->save();
            } elseif ($user->hasRole('teacher')) {
                $user->role = 2;
                $user->save();
            }
        }
        return view('melisan.auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $rule = [
            'name' => 'required|max:255',
            'family' => 'required|max:255',
            'national' => 'required|max:255',
            'password' => 'required',
            'mobile' => 'required|max:11',
            'type' => 'required',
        ];
        $message = [
            "national.unique" => "کد ملی تکراری است",
        ];
        $valid = Validator::make($data, $rule, $message);
        if ($valid->fails()) {
            dd($valid);
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $user = User::where('mobile', $request->mobile)->orWhere('national', $request->national)->first();
        if ($user) {
            if ($user->mobile != $request->mobile || $user->national != $request->national) {
                return redirect()->back()->with('danger', 'اطلاعات غلط است');
            }
            if ($request->type == '2') {
                if ($user->role == 2) {
                    return redirect()->back()->with('danger', 'تکراری است');
                }
            }
            if ($request->type == '3') {
                if ($user->role == 3)
                    return redirect()->back()->with('danger', 'تکراری است');
            }
        }

        $user = new User();
        $user->name = $request->name;
        $user->family = $request->family;
        $user->national = $request->national;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($request->type == '2') {
            $user->role = 2;
            $user->save();
            // $role = Role::where('name', 'teacher')->first();
            // $user->roles()->attach($role);
            $user->hasRole('teacher');
        } else {
            $user->role = 3;
            $user->save();
            // $role = Role::where('name', 'student')->first();
            // $user->roles()->attach($role);
            $user->hasRole('student');
        }
        Auth::login($user);

        $user = Auth::user();
        $content = Coworker::where('user_id', $user->id)->first();
        $mosabeghat = Touruser::where('user_id', $user->id)->count();

        if ($user->hasRole('teacher')) {
            $user2 = User::where('national', $user->national)->where('role', 3)->first();
        } elseif ($user->hasRole('student')) {
            $user2 = User::where('national', $user->national)->where('role', 2)->first();
        }
        return redirect('/dashboard/courses/list');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
    public function change(Request $request)
    {
        $user = Auth::user();
        $user2 = User::where('national', $user->national)->where('role', '!=', $user->role)->first();

        if ($user2) {
            Auth::logout();
            if ($user2->hasRole('teacher')) {
                Auth::login($user2);
                return redirect()->route('dashboard');
            } elseif ($user->hasRole('student')) {
                Auth::login($user2);
                $courses = $user->courses()->pluck('course_id');
                $teacherCourses = CourseUser::where('role_id', '3')->whereIn('course_id', $courses)->pluck('user_id');
                foreach ($teacherCourses as $item) {
                    $item = -$item;
                }
                $answers = OptionUser::where('user_id', $user->id)->pluck('survey_id');
                $surveys = Survey::query()->where(function ($query) use ($courses, $teacherCourses) {
                        $query->whereIn('group', $courses)
                            ->orWhere('group', '0')
                            ->orWhereIn('user_id', $teacherCourses);
                    })
                    ->whereNotIn('id', $answers)
                    ->where('active', true) // استفاده از boolean به جای string
                    ->get();
                if (count($surveys)) {
                    $random = $surveys->random();
                    if ($random->type != '1') {
                        $random['options'] = Option::where('survey_id', $random->id)->get();
                    }
                    $user = $user2;
                    return view('melisan.management.courses.students.survays', compact('random', 'user'))
                        ->with([
                            'pageTitle' => 'صفحه نظرسنجی',
                            'pageName' => 'نظرسنجی',
                            'pageDescription' => 'دوست من ! این یه فرم نظرسنجیه لطفا با دقت جواب بده',
                        ]);
                } else {
                    //                        Auth::login($user);
                    return redirect('/dashboard/courses/list');
                }
            }
        }
    }
    public function survey(Request $req)
    {

        // $user = User::where('id', $req->user_id)->first();

        // $random['options'] = null;
        // // if ($user->hasRole('student')) {
        // $courses = $user->courses()->pluck('course_id');
        // $teacherCourses = CourseUser::where('role_id', '3')
        // ->whereIn('course_id', $courses)->pluck('user_id');
        // foreach ($teacherCourses as $item) {
        //     $item = -$item;  }
        // $answers = OptionUser::where('user_id', $user->id)->pluck('survey_id');
        // $surveys = Survey::where(function ($query) use ($courses, $teacherCourses) {
        //     $query->whereIn('group', $courses)->orWhere('group', '0')->orWhereIn('user_id', $teacherCourses);
        // })->whereNotIn('id', $answers)->where('active', '1')->get();
        // if (count($surveys)) {
        //     $random = $surveys->random();
        //     if ($random->type != '1') {
        //         $options = Option::where('survey_id', $random->id)->get();
        //         $random['options'] = $options;
        //     }
        // }

        return redirect('/dashboard/courses/list');

    }

    // }
}
