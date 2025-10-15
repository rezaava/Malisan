<?php

namespace App\Http\Controllers\Api;

use App\CourseUser;
use App\Http\Controllers\Controller;
use App\Option;
use App\OptionUser;
use App\Role;
use App\Survey;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {

//        return "Sasss";
        $data = $request->all();
        $rule = [
            'national' => 'required',
            'password' => 'required'
        ];
        $valid = Validator::make($data, $rule);
        if ($valid->fails())
            return response()->json([
                'status' => '0',
                'message' => $valid->errors()->first(),
            ],
                422,
                array('Content-Type' => 'application/json;charset:utf-8;'),
                JSON_UNESCAPED_UNICODE
            );
        if (Auth::attempt(['national' => $request->national, 'password' => $request->password])) {
            $role='2';
//            teacher
            if (Auth::user()->roles()->first()->name == "student") {
                $role='1';
//                student
            }
                $token = Auth::user()->createToken('malisan')->accessToken;
                return response()->json([
                    'status' => '1',
                    'message' => 'وارد شدید...',
                    'token' => $token,
                    'user' => Auth::user(),
                    'role' => $role,
                ], 200,
                    array('Content-Type' => 'application/json; charset=utf-8'),
                    JSON_UNESCAPED_UNICODE);
//            }
        }
        return response()->json([
            'status' => '0',
            'message' => 'کاربر وجود ندارد!',
        ],
            200,
            array('Content-Type' => 'application/json;charset:utf-8;'),
            JSON_UNESCAPED_UNICODE
        );


    }

    public function register(Request $request)
    {
//        return response()->json([
//            'status' => 'aaaaaaaaaa',
//        ],
//            200,
//            array('Content-Type' => 'application/json;charset:utf-8;'),
//            JSON_UNESCAPED_UNICODE
//        );
        $valid = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'family' => 'required|max:255',
            'national' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);
        if ($valid->fails()) {
            return response()->json([
                'status' => '0',
                'message' => $valid->errors()->first(),
            ],
//                422,
            200,
                array('Content-Type' => 'application/json;charset:utf-8;'),
                JSON_UNESCAPED_UNICODE
            );
        }
        $user = new User();
        $user->name = $request->name;
        $user->family = $request->family;
        $user->national = $request->national;
        if(isset($request->tour))
            $user->tour = $request->tour;
        if(isset($request->mobile))
            $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        DB::beginTransaction();
        try {
            $user->save();


            $role = Role::where('name', $request->role)->first();
            $user->roles()->attach($role);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return response()->json([
                'status' => '0',
                'message' => "خطایی در سرور رخ داده است!",
            ],
                200,
//                500,
                array('Content-Type' => 'application/json;charset:utf-8;'),
                JSON_UNESCAPED_UNICODE
            );
        }
        $token = $user->createToken('malisan')->accessToken;
        return response()->json([
            'status' => '1',
            'message' => 'ثبت نام با موفقیت انجام شد!',
            'token' => $token,
            'user' => $user,
        ], 200,
            array('Content-Type' => 'application/json; charset=utf-8'),
            JSON_UNESCAPED_UNICODE);
    }

    public function survey()
    {

        $random['options'] = null;

        $user=Auth::user();
        if ($user->hasRole('student')) {
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

                return response()->json([
                    'status' => 'ok',
                    'message' => 'نظر سنجی',
                    'empty' => '0',
                    'survey' => $random,
                ], 200,
                    array('Content-Type' => 'application/json; charset=utf-8'),
                    JSON_UNESCAPED_UNICODE);
            }
        }
        return response()->json([
            'status' => 'ok',
            'message' => 'نظرسنجی وجود ندارد',
            'empty' => '1',
        ], 200,
            array('Content-Type' => 'application/json; charset=utf-8'),
            JSON_UNESCAPED_UNICODE);
    }
    public function surveySave(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'answer' => 'required',
        ]);
        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        $user=Auth::user();



        if($request->type=='3') {
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
        }else {
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
        return response()->json([
            'status' => 'ok',
            'message' => 'نظر سنجی ثبت شد',
        ], 200,
            array('Content-Type' => 'application/json; charset=utf-8'),
            JSON_UNESCAPED_UNICODE);

    }

}
