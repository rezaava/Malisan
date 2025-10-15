<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Question;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;
use Validator;
use DB;

class UserController extends Controller
{
    //
    public function list()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user['questions_new']=Question::where('created_at', '>=', Carbon::now()->subDays(3))->where('user_id',$user->id)->count();

            if ($user->hasRole('teacher'))
                $user['role'] = 'استاد';
            elseif ($user->hasRole('student'))
                $user['role'] = 'دانشجو';
            $courses = $user->courses()->count();
            $user['courses'] = $courses;
        }
        return view('dashboard2.user.list', compact('users'));
    }

    public function profile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->hasRole('teacher'))
            $role = 'teacher';
        elseif ($user->hasRole('student'))
            $role = 'student';
        $edit = '0';
        if (Auth::user()->id == $user->id || (Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('teacher')))
            $edit = '1';
        else
            abort(401);
        return view('management.users.profile', compact('user', 'edit', 'role'));
    }

      public function edit(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            // 'national' => 'required|max:255|unique:users,national,' . $id,
            // 'mobile' => 'required|max:255|unique:users,mobile,' . $id,
            // 'national' => 'required|max:255|unique:users,national,' . $id,
            // 'mobile' => 'required|max:255|unique:users,mobile,' . $id,
            'image' => 'mimes:jpeg,png,jpg|max:2048',

        ]);
        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        $user = User::findOrFail($id);

        if (!(Auth::user()->id == $user->id || (Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('teacher'))))
            abort(401);





        $user->family = $request->family;
        $user->name = $request->name;
        $user->tel = $request->tel;
        $user->gender = $request->gender;
        $user->email = $request->email;
        if (!(Auth::user()->hasRole('student')))
            $user->national = $request->national;
        $user->shenasname = $request->shenasname;
        $user->personal = $request->personal;
        $user->city_birth = $request->city_birth;
        $user->city = $request->city;
        $user->postal = $request->postal;
                if($request->mobile != $user->mobile)
            $user->active=0;

        $user->mobile = $request->mobile;
        $user->tel_work = $request->tel_work;
        $user->uni_email = $request->uni_email;
        $user->scholar = $request->scholar;
        $user->web = $request->web;
        $user->degree = $request->degree;
        $user->social = $request->social;
        $user->field = $request->field;
        $user->trend_en = $request->trend_en;
        $user->trend = $request->trend;
        $user->research = $request->research;
        $user->shaba = $request->shaba;
        $user->turn = $request->turn;
        $user->address = $request->address;
        if (isset($request->password))
            $user->password = bcrypt($request->password);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $id . "_" . $request->name . "_" . time() . "." . $image->getClientOriginalExtension();
            $destination_path = 'files/user';
            $image->move($destination_path, $image_name);
            $user->image = '/' . $image_name;
        }

        $user->save();
        return redirect('/dashboard/courses/list' )->with('success', 'با موفقیت ویرایش شد');
        //        return view('dashboard.user.user',compact('user'))->with('success','ب موفقیت ویرایش شد');
    }


    public function remove($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'با موفقیت حذف شد');

    }

    function convert($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }
}
