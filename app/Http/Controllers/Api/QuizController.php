<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Azmon;
use App\Course;
use App\Http\Controllers\Controller;
use App\Question;
use App\Quiz;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
use Illuminate\Support\Facades\Log;


class QuizController extends Controller
{
    //
    public function quiz(Request $request)
    {

        $end = '0';
        $course = Course::findOrFail($request->course_id);

        if ($request->az) {
            $azmon = Azmon::where('id', $request->az)->first();
            $ses = explode(",", $azmon->sessions);
            foreach ($ses as $se) {
                $ss[$se] = $se;
            }
        }

        $setting = Setting::where('course_id', $course->id)->first();
        if ($request->az)
            $sessions = $ses;
        else
            $sessions = $course->sessions()->pluck('id');

        $user = Auth::user();
        $quiz = new Quiz();
        $quiz->course_id = $request->course_id;
        $quiz->user_id = $user->id;

        if ($request->az)
            $quiz->azmon_id = $azmon->id;


        if ($request->az) {
            $quiz->start = Carbon::now();

            $end = Carbon::now()->addDay((int)$azmon->time)->format('H:m');
            if ($azmon->sath == 1){
                $question = Question::whereIn('session_id', $sessions)->whereIn('status', [1])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereIn('status', [1])->count();

            }
            if ($azmon->sath == 2)
            {
                $question = Question::whereIn('session_id', $sessions)->whereIn('status', [2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereIn('status', [2])->count();
            }
            if ($azmon->sath == 3){
                $question = Question::whereIn('session_id', $sessions)->whereIn('status', [1, 2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereIn('status', [1, 2])->count();
            }
            if ($azmon->sath == 4){
                $question = Question::whereIn('session_id', $sessions)->whereIn('star', [1])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereIn('star', [1])->count();
            }
            if ($azmon->sath == 5) {
                $teacher = $course->users()->where('role_id', '2')->first();
                $question = Question::whereIn('session_id', $sessions)->where('user_id', $teacher->id)->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->where('user_id', $teacher->id)->count();
            }
            if (!$question) {
                return back()->with('error', ' هنوز سوالی برای این آزمون طرح نشده است...');
            }
        } else {
            if ($setting->sath_khod == 2){
                $question = Question::whereIn('session_id', $sessions)->whereIn('status', [1, 2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereIn('status', [1, 2])->count();
            }
            if ($setting->sath_khod == 1)
            {
                $question = Question::whereIn('session_id', $sessions)->where('status', 1)->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->where('status', 1)->count();

            }
            if ($setting->sath_khod == 3)
            {
                $question = Question::whereIn('session_id', $sessions)->where('status', 2)->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->where('status', 2)->count();

            }

        }

        if($question_count==0)
        {
            return response()->json([
                'status' => 'not found',
                'message' => 'سوالی وجود ندارد',

            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);

        }
        $quiz->save();

        $designer = User::where('id', $question->user_id)->first();
        $question['designer'] = $designer;
        $answer = new Answer();
        $answer->quiz_id = $quiz->id;
        $answer->question_id = $question->id;


        DB::beginTransaction();
        try {
            $answer->save();
            DB::commit();
            $num='1';
            if($question_count>$setting->q_num)
                $question_count=$setting->q_num;

            return response()->json([
                'status' => 'ok',
                'question' => $question,
                'question_count' => $question_count,
                'end' => $end,
                'quiz' => $quiz->id,
                'answer_id' => $answer->id,

            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);

//            return view('dashboard2.quiz.quiz', compact('question', 'answer', 'end','question_count','num'));
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function question(Request $request)
    {
                Log::info($request);

        $answer = Answer::findOrFail($request->answer_id);

        $quiz = Quiz::findOrFail($answer->quiz_id);
        $course = Course::findOrFail($quiz->course_id);
        $setting = Setting::where('course_id', $course->id)->first();

        $end = '0';
        if ($quiz->azmon_id) {
            $azmon = Azmon::findOrFail($quiz->azmon_id);
            $end = Carbon::now()->addDay((int)$azmon->time)->format('H:m');

            if(Carbon::now()>$end)
            {
                return redirect('dashboard/courses/list')->with('success','زمان پاسخ دهی شما تمام شد.');
            }
        }
        if ($request->answer) {
                        Log::info("answer dade");

            $answer->answer = $request->answer;
            $answer->save();
        }

        if ($quiz->azmon_id) {
            $azmon = Azmon::findOrFail($quiz->azmon_id);
            $ses = explode(",", $azmon->sessions);
            foreach ($ses as $se) {
                $ss[$se] = $se;
            }
        }
        if ($quiz->azmon_id) {
            $sessions = $ses;
        } else
            $sessions = $course->sessions()->pluck('id');

        $old_questions = Answer::where('quiz_id', $answer->quiz_id)->pluck('question_id');


        if ($quiz->azmon_id) {
            $end = Carbon::now()->addDay((int)$azmon->time)->format('H:m');

            if ($azmon->sath == 1)
            {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1])->count();

            }
            if ($azmon->sath == 2)
            {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [2])->count();

            }
            if ($azmon->sath == 3)
            {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1, 2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1, 2])->count();
            }
            if ($azmon->sath == 4)
            {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('star', [1])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('star', [1])->count();
            }
            if ($azmon->sath == 5) {
                $teacher = $course->users()->where('role_id', '2')->first();
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('user_id', $teacher->id)->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('user_id', $teacher->id)->count();
            }

        } else {
            if ($setting->sath_khod == 2)
            {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1, 2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1, 2])->count();
            }
            if ($setting->sath_khod == 1)
            {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('status', 1)->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('status', 1)->count();
            }
            if ($setting->sath_khod == 3)
            {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('status', 2)->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('status', 2)->count();
            }

        }
        if ($quiz->azmon_id)
            $max_q = $azmon->num;
        else
            $max_q = $setting->q_num;

        if($question_count>$max_q)
            $question_count=$max_q;
        if ($old_questions->count() >= $max_q) {
            if ($quiz->azmon_id) {
                $score = 0;
                $old_answers = Answer::where('quiz_id', $answer->quiz_id)->get();
                foreach ($old_answers as $old_answer) {
                    $q = Question::where('id', $old_answer->question_id)->first();
                    if ($q->answer == $old_answer->answer) {
                        $score++;
//                        $score = $score + $one_q_score;
                    }
                }
                return response()->json([
                    'status' => 'ok',
                    'end' =>'1',
                    'message' =>  'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید ',

                ], 200,
                    array('Content-Type' => 'application/json; charset=utf-8'),
                    JSON_UNESCAPED_UNICODE);


            } else {
                $one_quiz_score = $setting->quiz_mid_nomre / $setting->quiz_mid_desc;
                $one_q_score = $one_quiz_score / $setting->q_num;
                $score = 0;
                $old_answers = Answer::where('quiz_id', $answer->quiz_id)->get();
                foreach ($old_answers as $old_answer) {
                    $q = Question::where('id', $old_answer->question_id)->first();
                    if ($q->answer == $old_answer->answer) {
                        $score++;
//                        $score = $score + $one_q_score;
                    }
                }
                $all_score = $old_questions->count() * $one_q_score;
//                return redirect('dashboard/courses/list')->with('success', 'از '. $all_score . 'امتیاز آزمون موفق به کسب '. $score . 'شدید ');

                return response()->json([
                    'status' => 'ok',
                    'end' =>'1',
                    'message' => 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید ',

                ], 200,
                    array('Content-Type' => 'application/json; charset=utf-8'),
                    JSON_UNESCAPED_UNICODE);

//                if ($setting->show_quiz == '1')
//                    return redirect('dashboard/quiz/view?quiz_id=' . $quiz->id)->with('success', 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید ');
//                return redirect('dashboard/courses/list')->with('success', 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید ');

            }
//            }
        } elseif (!$question) {
            if ($quiz->azmon_id) {
                $score = 0;
                $old_answers = Answer::where('quiz_id', $answer->quiz_id)->get();
                foreach ($old_answers as $old_answer) {
                    $q = Question::where('id', $old_answer->question_id)->first();
                    if ($q->answer == $old_answer->answer) {
                        $score++;

                    }
                }

                return redirect('dashboard/courses/list')->with('success', 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید ');

            } else {
                $one_quiz_score = $setting->quiz_mid_nomre / $setting->quiz_mid_desc;
                $one_q_score = $one_quiz_score / $old_questions->count();
                $score = 0;
                $old_answers = Answer::where('quiz_id', $answer->quiz_id)->get();
                foreach ($old_answers as $old_answer) {
                    $q = Question::where('id', $old_answer->question_id)->first();
                    if ($q->answer == $old_answer->answer) {
                        $score++;

                    }
                }
                $all_score = $old_questions->count() * $one_q_score;
                if ($setting->show_quiz == '1')

                    return response()->json([
                        'status' => 'ok',
                        'end' =>'1',
                        'message' =>'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید ',

                    ], 200,
                        array('Content-Type' => 'application/json; charset=utf-8'),
                        JSON_UNESCAPED_UNICODE);

//                return redirect('dashboard/quiz/view?quiz_id=' . $quiz->id)->with('success', 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید ');

                return response()->json([
                    'status' => 'ok',
                    'end' =>'1',
                    'message' =>'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید ',

                ], 200,
                    array('Content-Type' => 'application/json; charset=utf-8'),
                    JSON_UNESCAPED_UNICODE);


//                return redirect('dashboard/courses/list')->with('success', 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید ');
//            }
            }

        }

        $designer = User::where('id', $question->user_id)->first();
        $question['designer'] = $designer;

        $answer = new Answer();
        $answer->quiz_id = $quiz->id;

        $answer->question_id = $question->id;

        DB::beginTransaction();
        try {
            $answer->save();
            DB::commit();
            $num=$old_questions->count()+1;
            return response()->json([
                'status' => 'ok',
                'end' =>'0',
                'question' =>$question,
                'num' =>$num,
                'question_count' =>$question_count,
                'answer_id' =>$answer->id,

            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);

            return view('dashboard2.quiz.quiz', compact('question', 'answer', 'end','question_count','num'));
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

}
