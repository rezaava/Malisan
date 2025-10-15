<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Exercise;
use App\ExerciseAnswer;
use App\Http\Controllers\Controller;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;

class ExerciseController extends Controller
{
    //

    public function create(Request $request)
    {
        $data = $request->all();
        $rule = [
            'exercise' => 'required|unique:exercises,text',
        ];
        $valid = Validator::make($data, $rule);
        if ($valid->fails())
            return response()->json([
                'status' => 'failed',
                'message' => $valid->errors()->first(),
            ],
                422,
                array('Content-Type' => 'application/json;charset:utf-8;'),
                JSON_UNESCAPED_UNICODE
            );


        DB::beginTransaction();

        $user = Auth::user();

        $question = new Exercise();
        $question->text = $request->exercise;
        $question->user_id = $user->id;
        $question->session_id = $request->session_id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = $question->id . "_" . time() . "." . $file->getClientOriginalExtension();
            $destination_path = 'files/exer';
            $file->move($destination_path, $file_name);
            $question->file = '/' . $file_name;
        }
        try {
            $question->save();
            DB::commit();
            return response()->json([
                'status' => 'ok',
                'message' => 'با موفقیت انجام شد',
            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);        } catch (\Exception $exception) {

            DB::rollBack();
            return response()->json([
                'status' => 'fail',
                'message' => 'خطایی در سرور رخ داده است',
            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);
        }
    }


    public function show(Request $request)
    {

        $user = Auth::user();
        $meeting = Session::findOrFail($request->session_id);
        $course=Course::find($meeting->course_id);
        $questions = Exercise::where('session_id', $meeting->id)->get();
        foreach ($questions as $question) {
            $answer = ExerciseAnswer::where('exercise_id', $question->id)->where('user_id', $user->id)->first();
            $question['answer'] = $answer;
        }
        return response()->json([
            'status' => 'ok',
            'message' => 'لیست تکالیف',
            'exercises' => $questions,
        ], 200,
            array('Content-Type' => 'application/json; charset=utf-8'),
            JSON_UNESCAPED_UNICODE);
    }


    public function answer(Request $request)
    {
        $user = Auth::user();

        $answer = ExerciseAnswer::where('exercise_id', $request->exercise_id)->where('user_id',$user->id)->first();
        if (!$answer)
            $answer = new ExerciseAnswer();

        $answer->user_id = $user->id;
        $answer->exercise_id = $request->exercise_id;
        $answer->answer = $request->text;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = $request->exercise_id . "_" . time() . "." . $file->getClientOriginalExtension();
            $destination_path = 'files/answer';
            $file->move($destination_path, $file_name);
            $answer->file = '/' . $file_name;
        }

        DB::beginTransaction();
        try {
            $answer->save();
            DB::commit();
            return response()->json([
                'status' => 'ok',
                'message' => 'پاسخ ثبت شد',
            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);
        } catch (\Exception $exception) {

            DB::rollBack();
            return response()->json([
                'status' => 'fail',
                'message' => 'خطایی در سرور رخ داده است',
            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);
        }
    }

}
