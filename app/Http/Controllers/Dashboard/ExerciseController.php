<?php

namespace App\Http\Controllers\Dashboard;

use App\Course;
use App\Exercise;
use App\ExerciseAnswer;
use App\Http\Controllers\Controller;
use App\Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ExerciseController extends Controller
{
    //
    public function show(Request $request, $ID)
    {
        $user = Auth::user();
        $meeting = Session::findOrFail($ID);
        $course = Course::find($meeting->course_id);
        $questions = Exercise::where('session_id', $meeting->id)->get();
        foreach ($questions as $question) {
            $answer = ExerciseAnswer::where('exercise_id', $question->id)->where('user_id', $user->id)->first();
            $question['answer'] = $answer;
        }
        return view('management.exercise.create', compact('meeting', 'course', 'questions'))->with([
            'pageTitle' => 'صفحه لیست دروس',
            'pageName' => 'دروس',
            'pageDescription' => 'دوست من ! لیست درس هاتو برات نمایش دادم',
        ]);
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $rule = [
            'exercise' => 'required',
        ];
        $message = [
            "exercise.required" => "متن تکلیف خالی است",
        ];
        $valid = Validator::make($data, $rule, $message);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        DB::beginTransaction();

//        $session = Session::findOrFail($request->session_id);
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
            return redirect()->back()->with('success', 'با موفقیت اضافه شد');
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function answer(Request $request)
    {
        $user = Auth::user();

        $answer = ExerciseAnswer::where('exercise_id', $request->exercise_id)->where('user_id', $user->id)->first();
        if (!$answer) {
            $answer = new ExerciseAnswer();
        }

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
            return back()->with('success', 'پاسخ ثبت شد');
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function scoring(Request $request)
    {
        $ans = ExerciseAnswer::findOrFail($request->answer_id);
        $ans->status = $request->score;
        $ans->comment = $request->comment;

        DB::beginTransaction();
        try {
            $ans->save();
            DB::commit();
            return redirect()->back()->with('tab', 'e');
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function edit(Request $request)
    {

        $exer = Exercise::findOrFail($request->ex);
//        return $exer;
        $meeting = Session::find($exer->session_id);
        $course = Course::find($meeting->course_id);
        return view('dashboard2.exercise.edit', compact('exer', 'course', 'meeting'));
    }

    public function reedit(Request $request)
    {
        $data = $request->all();

        $rule = [
            'exercise' => 'required',
        ];
        $message = [
            "exercise.required" => "متن تکلیف خالی است",
        ];
        $valid = Validator::make($data, $rule, $message);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $question = Exercise::findOrFail($request->exer);
//        return $request;

        $question->text = $request->exercise;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = $question->id . "_" . time() . "." . $file->getClientOriginalExtension();
            $destination_path = 'files/exer';
            $file->move($destination_path, $file_name);
            $question->file = '/' . $file_name;
        } else {
            $question->file = null;
        }

        try {
            $question->save();
            DB::commit();
            return redirect()->back()->with('success', 'با موفقیت ویرایش شد');
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function delete(Request $request)
    {
        $exer = Exercise::findOrFail($request->ex);
        $exer->delete();
        return redirect()->back()->with('success', 'با موفقیت حذف شد');
    }
}
