<?php

namespace App\Http\Controllers\Auth;
 
use App\Models\Fcm;
use App\Models\CourseUser;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OptionUser;
use App\Models\Role;
use App\Models\Survey;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
         public function login()
    {
    
            return view('management.auth.login');
            
        }
        public function loginpost(Request $request)
    {
    
//            teacher
            $user = User::where('national', $request->national)->where('role', 1)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('dashboard');
            }
//            student
            $user = User::where('national', $request->national)->where('role', 2)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $courses = $user->courses()->pluck('course_id');
                $teacherCourses = CourseUser::where('role_id', '2')->whereIn('course_id', $courses)->pluck('user_id');
                foreach ($teacherCourses as $item) {
                    $item = -$item;
                }
                $answers = OptionUser::where('user_id', $user->id)->pluck('survey_id');
                $surveys = Survey::where(function ($query) use ($courses, $teacherCourses) {
                    $query->whereIn('group', $courses)->orWhere('group', '0')->orWhereIn('user_id', $teacherCourses);
                })->whereNotIn('id', $answers)->where('active', '1')->get();
                if (count($surveys)) {
                    $random = $surveys->random();
                    if ($random->type != '1') {
                        $options = Option::where('survey_id', $random->id)->get();
                        $random['options'] = $options;
                    }
                    return view('management.users.students.servays.survays', compact('random', 'user'))
                        ->with([
                            'pageTitle' => 'صفحه نظرسنجی',
                            'pageName' => 'نظرسنجی',
                            'pageDescription' => 'دوست من ! این یه فرم نظرسنجیه لطفا با دقت جواب بده',
                        ]);
                } else {
                    Auth::login($user);
                    return redirect('/dashboard/courses/list');
                }
            }
            $user = User::where('national', $request->national)->first();
            if ($user && Hash::check($request->password, $user->password)) {

                Auth::login($user);
                return redirect()->route('dashboard');
            }
            return back()->with('error', 'نام کاربری یا کلمه عبور صحیح نمی باشد');


//            $user = User::where('national', $request->national)->first();
//
//            if ($user && Hash::check($request->password, $user->password)) {
//                Auth::login($user);
//
//                if ($user->hasRole('student')) {
//                    $courses = $user->courses()->pluck('course_id');
//                    $teacherCourses = CourseUser::where('role_id', '2')->whereIn('course_id', $courses)->pluck('user_id');
//                    foreach ($teacherCourses as $item) {
//                        $item = -$item;
//                    }
//                    $answers = OptionUser::where('user_id', $user->id)->pluck('survey_id');
//                    $surveys = Survey::where(function ($query) use ($courses, $teacherCourses) {
//                        $query->whereIn('group', $courses)->orWhere('group', '0')->orWhereIn('user_id', $teacherCourses);
//                    })->whereNotIn('id', $answers)->where('active', '1')->get();
//                    if (count($surveys)) {
//                        $random = $surveys->random();
//                        if ($random->type != '1') {
//                            $options = Option::where('survey_id', $random->id)->get();
//                            $random['options'] = $options;
//                        }
//                        return view('management.users.students.servays.survays', compact('random', 'user'))
//                            ->with([
//                                'pageTitle' => 'صفحه نظرسنجی',
//                                'pageName' => 'نظرسنجی',
//                                'pageDescription' => 'دوست من ! این یه فرم نظرسنجیه لطفا با دقت جواب بده',
//                            ]);
//                    } else {
////                        Auth::login($user);
//                        return redirect('/dashboard/courses/list');
//                    }
//                }
//                Auth::login($user);
//                return redirect()->route('dashboard');
////                return redirect('/dashboard/courses/list');
//            } else {
//                return back()->with('error', 'نام کاربری یا کلمه عبور صحیح نمی باشد');
//            }


        // } else {
        //     return abort('404');
        // }
    }




    public function sms($msg, $rec)
    {
        $client = new \GuzzleHttp\Client();
        $token = $msg;
        $reciever = $rec;
        $url = 'https://api.kavenegar.com/v1/4D68334756567946623268746B364C747430764D78426D437935475A34594A3146492B4B5949684E61546F3D/verify/lookup.json?receptor=' . $reciever . '&token=' . $token . '&template=active';
        $request = $client->get($url);
        $response = $request->getBody();
        return $response;

    }

    public function sendTokenToServer(Request $request)
    {
        return response()->json(['status' => '1']);

        $user = Auth::user();
        return response()->json(['status' => '2']);

        $fcm1 = FCM::where('token', $request->token)->first();
//        $fcm = FCM::where('user_id',$user->id)->where('token',$request->token)->first();
        if (!$fcm1) {
            $status = 0;
        } else {
            $fcm = FCM::where('token', $request->token)->where('user_id', $user->id)->first();
            if (!$fcm) {
                $status = 1;
            } else {
                $status = 2;
            }

        }
        if ($status == 0) {
            $fcm = new FCM;
            $fcm->user_id = $user->id;
            $fcm->token = $request->token;
            if ($fcm->save()) {
                return response()->json(['status' => 'success']);
            }

        } elseif ($status == 1) {
            $fcm1->user_id = $user->id;
            $fcm1->save();
            return response()->json(['status' => 'changed']);
        } else {
            return response()->json(['status' => 'ok']);
        }

    }

    public function change(Request $request)
    {
        $user = Auth::user();
        $user2 = User::where('national', $user->national)->where('role', '!=', $user->role)->first();
        if ($user2) {
            Auth::logout();
            if ($user2->role == 1) {
                Auth::login($user2);
                return redirect()->route('dashboard');
            } else {
                Auth::login($user2);
                $courses = $user->courses()->pluck('course_id');
                $teacherCourses = CourseUser::where('role_id', '2')->whereIn('course_id', $courses)->pluck('user_id');
                foreach ($teacherCourses as $item) {
                    $item = -$item;
                }
                $answers = OptionUser::where('user_id', $user->id)->pluck('survey_id');
                $surveys = Survey::where(function ($query) use ($courses, $teacherCourses) {
                    $query->whereIn('group', $courses)->orWhere('group', '0')->orWhereIn('user_id', $teacherCourses);
                })->whereNotIn('id', $answers)->where('active', '1')->get();
                if (count($surveys)) {
                    $random = $surveys->random();
                    if ($random->type != '1') {
                        $options = Option::where('survey_id', $random->id)->get();
                        $random['options'] = $options;
                    }
                    $user = $user2;
                    return view('management.users.students.servays.survays', compact('random', 'user'))
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

   
    public function survey(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'answer' => 'required',
        ]);
        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        $user = User::findOrFail($request->user_id);

        if ($request->type == '3') {
            foreach ($request->answer as $item) {
                $answer = new OptionUser();
                $answer->user_id = $user->id;
                $answer->survey_id = $request->random_id;
                $answer->answer = $item;

                try {
                    $answer->save();
                    DB::commit();
                } catch (\Exception $exception) {
                    DB::rollBack();
                    return back()->with('error', 'خطایی در سرور رخ داده است');
                }
            }
        } else {
            $answer = new OptionUser();
            $answer->user_id = $user->id;
            $answer->survey_id = $request->random_id;
            $answer->answer = $request->answer;

            try {
                $answer->save();
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return back()->with('error', 'خطایی در سرور رخ داده است');
            }
        }
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'نظر ثبت شد');

    }

    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect('login');
    // }

    public function reg()
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->hasRole('student')) {
                $user->role = 2;
                $user->save();
            } elseif ($user->hasRole('teacher')) {
                $user->role = 1;
                $user->save();
            }
        }
        return view('management.auth.register');
    }

    public function register(Request $request)
    {

        $data = $request->all();

        $rule = [
            'name' => 'required|max:255',
            'family' => 'required|max:255',
            'national' => 'required|max:255',
            'password' => 'required',
            'mobile' => 'required',
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
            if($user->mobile !=$request->mobile || $user->national!=$request->national)
            {
                return redirect()->back()->with('danger', 'اطلاعات غلط است');

            }
                if ($request->type == '1') {
                if ($user->role == 1){
                    return redirect()->back()->with('danger', 'تکراری است');
}
            }
            if ($request->type == '2') {
                if ($user->role == 2)
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

        if ($request->type == '1') {
            $user->role = 1;
            $user->save();
            $role = Role::where('name', 'teacher')->first();
            $user->roles()->attach($role);
        } else {
            $user->role = 2;
            $user->save();
            $role = Role::where('name', 'student')->first();
            $user->roles()->attach($role);
        }

        Auth::login($user);
        return redirect('/dashboard/courses/list');

    }

}