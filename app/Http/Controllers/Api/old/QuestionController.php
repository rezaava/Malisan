<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Question;
use App\Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class QuestionController extends Controller
{
    //
    public function list(Request $request)
    {
        $my = Auth::user();
        $meeting = Session::findOrFail($request->session_id);
        $course = $meeting->course()->first();
        $setting = $course->setting()->first();

        $questions = $meeting->questions()->where('user_id', $my->id)->get();
        foreach ($questions as $question)
            $question['user'] = User::findOrFail($question->user_id);

        $limit = 0;
        if ($my->hasRole('student'))
            if (count($questions) >= $setting->max_soal)
                $limit = 1;

        return response()->json([
            'status' => 'ok',
            'questions' => $questions,
            'limit' => $limit,
            'help' => $setting->tarahi_soal_desc
        ], 200,
            array('Content-Type' => 'application/json; charset=utf-8'),
            JSON_UNESCAPED_UNICODE);


    }

    public function create(Request $request)
    {
        $data = $request->all();
        if (!$request->question_id)
            $rule = [
                'question' => 'required|unique:questions',
                'answer' => 'required',
                'answer1' => 'required',
                'answer2' => 'required',
                'answer3' => 'required',
                'answer4' => 'required',
            ];
        else
            $rule = [
                'question' => 'required|unique:questions,question,' . $request->question_id,
                'answer' => 'required',
                'answer1' => 'required',
                'answer2' => 'required',
                'answer3' => 'required',
                'answer4' => 'required',
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

        $session = Session::findOrFail($request->session_id);
        $user = Auth::user();

        if ($request->question_id)
            $question = Question::findOrFail($request->question_id);
        else
            $question = new Question();
        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->answer1 = $request->answer1;
        $question->answer2 = $request->answer2;
        $question->answer3 = $request->answer3;
        $question->answer4 = $request->answer4;
        if (!$request->question_id) {
            $question->user_id = $user->id;
            $question->session_id = $request->session_id;
        }
        if ($user->hasRole('teacher'))
            $question->status = '1';

        try {
            $question->save();
            DB::commit();
            return response()->json([
                'status' => 'ok',
                'message' => 'عمل با موفقیت انجام شد',
            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);
        } catch (\Exception $exception) {

            DB::rollBack();
            return response()->json([
                'status' => 'fail',
                'message' => 'خطایی در سرور رخ داده است',
                'error' => $exception,
            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);
        }
    }
}
