<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Touruser;
use App\Models\Coworker;


class UserController extends Controller
{
    //
    public function profile(Request $request)
    {
        $user = Auth::user();
        // return $user;
        $mosabeghat = Touruser::where('user_id', $user->id)->count();
        if ($user->hasRole('student')) {
            $user2 = User::where('national', $user->national)->where('role', 2)->first();
        } elseif ('teacher') {
            $user2 = User::where('national', $user->national)->where('role', 3)->first();
        }
        $content = Coworker::where('user_id', $user->id)->first();

        // return $user;
        $edit = '5';
        return view(
            '/melisan/dashbord/user/profile1',
            compact('user', 'edit', 'mosabeghat', 'user2', 'content'),
            ['show_nav' => false]
        );
    }

    public function editprofile(Request $request)
    {
        $user = Auth::user();
        $mosabeghat = Touruser::where('user_id', $user->id)->count();
        if ($user->hasRole('student')) {
            $user2 = User::where('national', $user->national)->where('role', 2)->first();
        } elseif ('teacher') {
            $user2 = User::where('national', $user->national)->where('role', 3)->first();
        }
        $content = Coworker::where('user_id', $user->id)->first();

        // return $user;
        $edit = '5';
        return view(
            '/melisan/dashbord/user/user',
            compact('user', 'edit', 'mosabeghat', 'user2', 'content'),
            ['show_nav' => false]
        );
    }
    // return view('/melisan/dashbord/user/user', compact('user'))->with('success', 'ب موفقیت ویرایش شد');

    //////////////////////////////////////////////////////////////
    public function edit(Request $request, $id)
    {
        // $data = $request->all();
        // $rule = [
        //     'national' => 'required|max:10|unique:users,national,' . $id,
        // ];
        //  $valid = Validator::make($data, $rule);
        //    return $valid;

        $user = User::findOrFail($id);

        if (!(Auth::user()->id == $user->id || (Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('teacher'))))
            abort(401);

        $user->family = $request->family;
        $user->name = $request->name;
        $user->tel = $request->tel;
        $user->gender = $request->gender;
            $user->email=$request->email;
        // $user->national = $request->national;
        $user->shenasname = $request->shenasname;
        $user->personal = $request->personal;
        $user->birthdate = $request->birthdate;
        $user->city_birth = $request->city_birth;
        $user->city = $request->city;
        $user->postal = $request->postal;
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
        if (isset($request->password))
            $user->password = bcrypt($request->password);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $id . "_" . $request->name . "_" . time() . "." . $image->getClientOriginalExtension();
            $destination_path = 'files/user';
            $image->move($destination_path, $image_name);
            $user->image =   $destination_path. '/' . $image_name;
        }


        $user->save();
        // return response()->json([
        //     'status' => 'ok',
        //     'message' => 'عمل با موفقیت انجام شد',
        // ], 200,
        //     array('Content-Type' => 'application/json; charset=utf-8'),
        //     JSON_UNESCAPED_UNICODE);

        return view('/melisan/dashbord/user/profile1', compact('user'))->with('success', 'ب موفقیت ویرایش شد');
    }

}
