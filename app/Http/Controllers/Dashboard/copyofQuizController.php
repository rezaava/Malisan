<?php

namespace App\Http\Controllers\Dashboard;

use App\Angizesh;
use App\Answer;
use App\Azmon;
use App\Course;
use App\Http\Controllers\Controller;
use App\Question;
use App\Quiz;
use App\Session;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class QuizController extends Controller
{
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
            $end = Carbon::now()->addMinute((int)$azmon->time)->format('H:i');
            if ($azmon->sath == 1) {
                $question = Question::whereIn('session_id', $sessions)->whereIn('status', [1])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereIn('status', [1])->count();
            }
            if ($azmon->sath == 2) {
                $question = Question::whereIn('session_id', $sessions)->whereIn('status', [2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereIn('status', [2])->count();
            }
            if ($azmon->sath == 3) {
                $question = Question::whereIn('session_id', $sessions)->whereIn('status', [1, 2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereIn('status', [1, 2])->count();
            }
            if ($azmon->sath == 4) {
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
            if ($setting->sath_khod == 2) {
                $question = Question::whereIn('session_id', $sessions)->whereIn('status', [1, 2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereIn('status', [1, 2])->count();
            }
            if ($setting->sath_khod == 1) {
                $question = Question::whereIn('session_id', $sessions)->where('status', 1)->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->where('status', 1)->count();
            }
            if ($setting->sath_khod == 3) {
                $question = Question::whereIn('session_id', $sessions)->where('status', 2)->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->where('status', 2)->count();
            }
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
            $num = '1';
            if ($question_count > $setting->q_num)
                $question_count = $setting->q_num;
            $user = Auth::user();
            return view('management.assesment.form', compact('question', 'answer', 'end', 'question_count', 'num', 'user'))
                ->with([
                    'pageTitle' => 'یه خودآزمایی خفن بریم باهم',
                    'pageName' => 'خودآزمایی',
                    'pageDescription' => 'دوست من ! چندتا سوال آماده کردم با دقت بهش جواب بده',
                ]);
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function question(Request $request)
    {
        $user=Auth::user();
        $answer = Answer::findOrFail($request->answer_id);

        $quiz = Quiz::findOrFail($answer->quiz_id);
        $course = Course::findOrFail($quiz->course_id);
        $setting = Setting::where('course_id', $course->id)->first();

        $end = '0';
        if ($quiz->azmon_id) {
            $azmon = Azmon::findOrFail($quiz->azmon_id);
            $end = Carbon::now()->addMinute((int)$azmon->time);

            if (Carbon::now() > $end) {
                return redirect('dashboard/courses/list')->with('success', 'زمان پاسخ دهی شما تمام شد.');
            }
        }
        if ($request->answer) {
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
            $end = Carbon::now()->addMinute((int)$azmon->time)->format('H:i');

            if ($azmon->sath == 1) {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1])->count();
            }
            if ($azmon->sath == 2) {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [2])->count();
            }
            if ($azmon->sath == 3) {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1, 2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1, 2])->count();
            }
            if ($azmon->sath == 4) {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('star', [1])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('star', [1])->count();
            }
            if ($azmon->sath == 5) {
                $teacher = $course->users()->where('role_id', '2')->first();
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('user_id', $teacher->id)->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('user_id', $teacher->id)->count();
            }
        } else {
            if ($setting->sath_khod == 2) {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1, 2])->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1, 2])->count();
            }
            if ($setting->sath_khod == 1) {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('status', 1)->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('status', 1)->count();
            }
            if ($setting->sath_khod == 3) {
                $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('status', 2)->inRandomOrder()->first();
                $question_count = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('status', 2)->count();
            }
        }
        //        if ($setting->sath_khod == 2)
        //            $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->whereIn('status', [1, 2])->inRandomOrder()->first();
        //        elseif ($setting->sath_khod == 1)
        //            $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('status', 1)->inRandomOrder()->first();
        //        elseif ($setting->sath_khod == 3)
        //            $question = Question::whereIn('session_id', $sessions)->whereNotIn('id', $old_questions)->where('status', 2)->inRandomOrder()->first();
        if ($quiz->azmon_id)
            $max_q = $azmon->num;
        else
            $max_q = $setting->q_num;

        if ($question_count > $max_q)
            $question_count = $max_q;
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

                $angizesh_score=($score*20)/($old_questions->count());
                if($angizesh_score==20)
                    $ang=Angizesh::where('level',1)->inRandomOrder()->first();
                elseif ($angizesh_score>=18)
                    $ang=Angizesh::where('level',2)->inRandomOrder()->first();
                elseif ($angizesh_score>=16)
                    $ang=Angizesh::where('level',3)->inRandomOrder()->first();
                elseif ($angizesh_score>=13)
                    $ang=Angizesh::where('level',4)->inRandomOrder()->first();
                elseif ($angizesh_score>=10)
                    $ang=Angizesh::where('level',5)->inRandomOrder()->first();
                else
                    $ang=Angizesh::where('level',6)->inRandomOrder()->first();


                $result=$this->anetoTrans($user,1000,5,'انجام ازمون '.$course->name);
    $quiz->score=$score*20/ $old_questions->count();
    $quiz->save();
                return redirect('dashboard/courses/list')->with('success', 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید '
                    ."\n".$ang->text
                );
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

                $angizesh_score=($score*20)/($old_questions->count());
                if($angizesh_score==20)
                    $ang=Angizesh::where('level',1)->inRandomOrder()->first();
                elseif ($angizesh_score>=18)
                    $ang=Angizesh::where('level',2)->inRandomOrder()->first();
                elseif ($angizesh_score>=16)
                    $ang=Angizesh::where('level',3)->inRandomOrder()->first();
                elseif ($angizesh_score>=13)
                    $ang=Angizesh::where('level',4)->inRandomOrder()->first();
                elseif ($angizesh_score>=10)
                    $ang=Angizesh::where('level',5)->inRandomOrder()->first();
                else
                    $ang=Angizesh::where('level',6)->inRandomOrder()->first();

                if ($setting->show_quiz == '1')
                                $result=$this->anetoTrans($user,1000,5,'انجام ازمون '.$course->name);

    $quiz->score=$score*20/ $old_questions->count();
    $quiz->save();
                    return redirect('dashboard/quiz/view?quiz_id=' . $quiz->id)->with('success', 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید '
                        ."\n".$ang->text
                    );
                                    $result=$this->anetoTrans($user,1000,5,'انجام ازمون '.$course->name);
    $quiz->score=$score*20/ $old_questions->count();
    $quiz->save();
                return redirect('dashboard/courses/list')->with('success', 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید '
                    ."\n".$ang->text
                );
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
                $angizesh_score=($score*20)/($old_questions->count());
                if($angizesh_score==20)
                    $ang=Angizesh::where('level',1)->inRandomOrder()->first();
                elseif ($angizesh_score>=18)
                    $ang=Angizesh::where('level',2)->inRandomOrder()->first();
                elseif ($angizesh_score>=16)
                    $ang=Angizesh::where('level',3)->inRandomOrder()->first();
                elseif ($angizesh_score>=13)
                    $ang=Angizesh::where('level',4)->inRandomOrder()->first();
                elseif ($angizesh_score>=10)
                    $ang=Angizesh::where('level',5)->inRandomOrder()->first();
                else
                    $ang=Angizesh::where('level',6)->inRandomOrder()->first();

                $result=$this->anetoTrans($user,1000,5,'انجام ازمون '.$course->name);

                return redirect('dashboard/courses/list')->with('success', 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید '
                    ."\n".$ang->text
                );
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
                $angizesh_score=($score*20)/($old_questions->count());
                if($angizesh_score==20)
                    $ang=Angizesh::where('level',1)->inRandomOrder()->first();
                elseif ($angizesh_score>=18)
                    $ang=Angizesh::where('level',2)->inRandomOrder()->first();
                elseif ($angizesh_score>=16)
                    $ang=Angizesh::where('level',3)->inRandomOrder()->first();
                elseif ($angizesh_score>=13)
                    $ang=Angizesh::where('level',4)->inRandomOrder()->first();
                elseif ($angizesh_score>=10)
                    $ang=Angizesh::where('level',5)->inRandomOrder()->first();
                else
                    $ang=Angizesh::where('level',6)->inRandomOrder()->first();

                if ($setting->show_quiz == '1')
                                $result=$this->anetoTrans($user,1000,5,'انجام ازمون '.$course->name);

                    return redirect('dashboard/quiz/views?quiz_id=' . $quiz->id)->with('success', 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید '
                        ."\n".$ang->text

                    );
                                    $result=$this->anetoTrans($user,1000,5,'انجام ازمون '.$course->name);

                return redirect('dashboard/courses/list')->with('success', 'از ' . $old_questions->count() . 'سوال آزمون درس ' . $course->name . '  به  ' . $score . 'سوال پاسخ صحیح دادید '
                    ."\n".$ang->text

                );
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
            $num = $old_questions->count() + 1;
            return view('management.assesment.form', compact('question', 'answer', 'end', 'question_count', 'num'))
                ->with([
                    'pageTitle' => 'یه خودآزمایی خفن بریم باهم',
                    'pageName' => 'خودآزمایی',
                    'pageDescription' => 'دوست من ! چندتا سوال آماده کردم با دقت بهش جواب بده',
                ]);
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function list(Request $request)
    {
        if ($request->user)
            $user = User::findOrFail($request->user);
        else
            $user = Auth::user();
        $course = Course::findOrFail($request->course_id);
        $setting = Setting::where('course_id', $course->id)->first();
        $quizzes = Quiz::where('course_id', $course->id)->where('user_id', $user->id)->get();
        foreach ($quizzes as $quiz) {
            $questions = Answer::where('quiz_id', $quiz->id)->count();
            $quiz['count'] = $questions;

            $one_quiz_score = $setting->quiz_mid_nomre / $setting->quiz_mid_desc;
            $one_q_score = $one_quiz_score / $setting->q_num;
            $score = 0;
            $old_answers = Answer::where('quiz_id', $quiz->id)->get();
            foreach ($old_answers as $old_answer) {
                $q = Question::where('id', $old_answer->question_id)->first();
                if ($q)
                    if ($q->answer == $old_answer->answer) {
                        $score = $score + $one_q_score;
                    }
            }
            $all_score = $questions * $one_q_score;

            $quiz['score'] = $score . ' از ' . $all_score;
        }
        return view('dashboard2.quiz.list', compact('quizzes', 'course', 'user'));
    }

    public function view(Request $request)
    {
        $q_ids = Answer::where('quiz_id', $request->quiz_id)->pluck('question_id');
        $questions = Question::whereIn('id', $q_ids)->get();

        foreach ($questions as $question) {
            $answer = Answer::where('quiz_id', $request->quiz_id)->where('question_id', $question->id)->first();
            $question['user_answer'] = $answer;
        }
        $quiz = Quiz::find($request->quiz_id);

        $session = Session::find($question->session_id);
        $course = Course::find($session->course_id);
        $user = User::find($quiz->user_id);

        return view('management.assesment.answers', compact('questions', 'course', 'user'))
            ->with([
                'pageTitle' => 'خسته نباشی ! آزمونت رو تصحیح کردم نتیجه رو ببین',
                'pageName' => 'خودآزمایی',
                'pageDescription' => 'دوست من ! نتیجه آزمونتو ببین',
            ]);
    }
}
