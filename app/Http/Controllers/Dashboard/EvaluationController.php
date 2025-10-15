<?php

namespace App\Http\Controllers\Dashboard;

use App\Course;
use App\Discussion;
use App\Exercise;
use App\ExerciseAnswer;
use App\Http\Controllers\Controller;
use App\Question;
use App\Score;
use App\Scoring;
use App\CourseUser;
use App\Session;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class EvaluationController extends Controller
{
    //
    function list(Request $request)
    {
        $q_ret = null;
        $q_bad = null;
        $q_ok = null;
        $questions_ok = null;
        $questions_bad = null;
        $questions_ret = null;
        $questions_not = null;

        $d_ret = null;
        $d_bad = null;
        $d_ok = null;
        $discs_ok = null;
        $discs_bad = null;
        $discs_ret = null;
        $discs_not = null;

        $course = Course::findOrFail($request->course_id);
        $scoring = Scoring::where('course_id', $course->id)->first();
        if (!$scoring) {
            $scoring = new Scoring();
            $scoring->course_id = $course->id;
            $scoring->save();
        }
        $scoring = Scoring::where('course_id', $course->id)->first();

        $user = Auth::user();
        $sessions = $course->sessions()->pluck('id');

        if ($user->hasRole('teacher')) {
            //question



            $questions_c = Question::whereIn('session_id', $sessions)
                ->whereNull('status')
                ->get();
            $questions_not = Question::whereIn('session_id', $sessions)
                ->where(function ($query) {
                    $query->whereNull('status')->orWhere('status', -1);
                })->get();


            $questions_bad = Question::whereIn('session_id', $sessions)
                ->where(function ($query) {
                    $query->Where('status', 3)->orWhere('status', 4);
                })->get();

            $questions_ok = Question::whereIn('session_id', $sessions)
                ->where(function ($query) {
                    $query->Where('status', 1)->orWhere('status', 2);
                })->get();

            //            disc
            $discs_c = Discussion::whereIn('session_id', $sessions)
                ->whereNull('status')
                ->get();
            $discs_not = Discussion::whereIn('session_id', $sessions)
                ->whereNull('status')->get();

            //                ->where(function ($query) {
            //                    $query->whereNotNull('status')->orWhere('status', -1);
            //                })->get();
            $discs_bad = Discussion::whereIn('session_id', $sessions)
                ->where(function ($query) {
                    $query->Where('status', 3)->orWhere('status', 4);
                })->get();

            $discs_ok = Discussion::whereIn('session_id', $sessions)
                ->where(function ($query) {
                    $query->Where('status', 1)->orWhere('status', 2);
                })->get();


        }
        elseif ($user->hasRole('student')) {
            //question
            $questions_c = Question::whereIn('session_id', $sessions)->where('user_id', $user->id)->get();
            $questions_not = Question::whereIn('session_id', $sessions)->where('user_id', $user->id)
                ->where(function ($query) {
                    $query->whereNull('status')->orWhere('status', -1);
                })->get();

            $questions_bad = Question::whereIn('session_id', $sessions)->where('user_id', $user->id)
                ->where(function ($query) {
                    $query->Where('status', 3)->orWhere('status', 4);
                })->get();

            $questions_ok = Question::whereIn('session_id', $sessions)->where('user_id', $user->id)
                ->where(function ($query) {
                    $query->Where('status', 1)->orWhere('status', 2);
                })->get();

            $questions_ret = Question::whereIn('session_id', $sessions)->where('user_id', $user->id)
                ->where(function ($query) {
                    $query->Where('status', 0);
                })->get();
            foreach ($questions_ret as $key => $question) {
                $session = Session::findOrFail($question->session_id);
                $question['session'] = $session;

                $nazars = Score::withTrashed()->where('sub_id', $question->id)->where('type', '1')->orderBy('id', 'desc')->get();
                $question['nazar'] = $nazars;
            }

            //            disc
            $discs_c = Discussion::whereIn('session_id', $sessions)->where('user_id', $user->id)->get();
            $discs_not = Discussion::whereIn('session_id', $sessions)->where('user_id', $user->id)
                ->where(function ($query) {
                    $query->whereNull('status')->orWhere('status', -1);
                })->get();

            $discs_bad = Discussion::whereIn('session_id', $sessions)->where('user_id', $user->id)
                ->where(function ($query) {
                    $query->Where('status', 3)->orWhere('status', 4);
                })->get();

            $discs_ok = Discussion::whereIn('session_id', $sessions)->where('user_id', $user->id)
                ->where(function ($query) {
                    $query->Where('status', 1)->orWhere('status', 2);
                })->get();

            $discs_ret = Discussion::whereIn('session_id', $sessions)->where('user_id', $user->id)
                ->where(function ($query) {
                    $query->Where('status', 0);
                })->get();
            foreach ($discs_ret as $key => $disc) {
                $session = Session::findOrFail($disc->session_id);
                $disc['session'] = $session;

                $nazars = Score::withTrashed()->where('sub_id', $disc->id)->where('type', '2')->orderBy('id', 'desc')->get();
                $disc['nazar'] = $nazars;
            }

            //question
            $q_bad = count($questions_bad);
            $q_not = count($questions_not);
            $q_ok = count($questions_ok);
            $q_ret = count($questions_ret);
            $questions_ok = $questions_ok->take(10);
            $questions_bad = $questions_bad->take(10);
            $questions_ret = $questions_ret->take(10);
//            $questions_not = $questions_not->take(10);

            //            disc

            $d_bad = count($discs_bad);
            $d_not = count($discs_not);
            $d_ok = count($discs_ok);
            $d_ret = count($discs_ret);
            $discs_ok = $discs_ok->take(10);
            $discs_bad = $discs_bad->take(10);
            $discs_ret = $discs_ret->take(10);
            $discs_not = $discs_not->take(10);

        }

        foreach ($discs_ok as $key => $disc) {
            $session = Session::findOrFail($disc->session_id);
            $disc['session'] = $session;
        }
        foreach ($discs_bad as $key => $disc) {
            $session = Session::findOrFail($disc->session_id);
            $disc['session'] = $session;
        }
        //        questions

        foreach ($questions_ok as $key => $question) {
            $session = Session::findOrFail($question->session_id);
            $question['session'] = $session;

            $session = Session::findOrFail($question->session_id);
            $question['session'] = $session;

            $nazars = Score::withTrashed()->where('sub_id', $question->id)->where('type', '1')->orderBy('id', 'desc')->get();

            if ($user->hasRole('student')) {
//                $nazars = Score::withTrashed()->where('sub_id', $question->id)->where('type', '1')->orderBy('id', 'desc')->take(1)->get();
            }
            if ($user->hasRole('teacher')) {
//                $nazars = Score::where('sub_id', $question->id)->where('type', '1')->get();

                foreach ($nazars as $nazar) {
                    $us = User::where('id', $nazar->user_id)->first();
                    $nazar['user'] = $us->name . ' ' . $us->family;
                }
            }
            $question['nazar'] = $nazars;
        }

        foreach ($questions_bad as $key => $question) {
            $session = Session::findOrFail($question->session_id);
            $question['session'] = $session;
            $nazars = Score::withTrashed()->where('sub_id', $question->id)->where('type', '1')->orderBy('id', 'desc')->get();

            if ($user->hasRole('student')) {
//                $nazars = Score::withTrashed()->where('sub_id', $question->id)->where('type', '1')->orderBy('id', 'desc')->take(1)->get();
            }
            if ($user->hasRole('teacher')) {
                foreach ($nazars as $nazar) {
                    $us = User::where('id', $nazar->user_id)->first();
                    $nazar['user'] = $us->name . ' ' . $us->family;
                }
            }
            $question['nazar'] = $nazars;
        }
        foreach ($questions_not as $key => $question) {
            $session = Session::findOrFail($question->session_id);
            $question['session'] = $session;

            $nazars = Score::where('sub_id', $question->id)->where('type', '1')->get();

//            if (count($nazars) < 5 && $user->hasRole('teacher')) {
//                unset($questions_not[$key]);
//            } else {
                if ($user->hasRole('student')) {
                    $nazars = Score::withTrashed()->where('sub_id', $question->id)->where('type', '1')->orderBy('id', 'desc')->get();
                }
//                if ($user->hasRole('teacher')) {
//                    foreach ($nazars as $nazar) {
//                        $us = User::where('id', $nazar->user_id)->first();
//                        $nazar['user'] = $us->name . ' ' . $us->family;
//                    }
//                }
                $question['nazar'] = $nazars;
//            }
        }

        //        return $questions_ret;
        $q_not = count($questions_not);
        $q_bad = count($questions_bad);
        $q_ok = count($questions_ok);
        $questions_not = $questions_not->take(10);

        foreach ($questions_c as $key => $question) {
            $session = Session::findOrFail($question->session_id);
            $question['session'] = $session;

            $nazars = Score::where('sub_id', $question->id)->where('type', '1')->get();

            if ($user->hasRole('student')) {
                $nazars = Score::withTrashed()->where('sub_id', $question->id)->where('type', '1')->orderBy('id', 'desc')->get();
            }
            if ($user->hasRole('teacher')) {
                foreach ($nazars as $nazar) {
                    $us = User::where('id', $nazar->user_id)->first();
                    $nazar['user'] = $us->name . ' ' . $us->family;
                }
            }
            $question['nazar'] = $nazars;
        }

        $questions = $questions_c->take(10);

        //        discs
        foreach ($discs_not as $key => $disc) {
            $session = Session::findOrFail($disc->session_id);
            $disc['session'] = $session;

            $nazars = Score::where('sub_id', $disc->id)->where('type', '2')->get();

            if (count($nazars) < 3 && $user->hasRole('teacher')) {
                unset($discs_not[$key]);
            } else {
                if ($user->hasRole('student')) {
                    $nazars = Score::withTrashed()->where('sub_id', $disc->id)->where('type', '1')->orderBy('id', 'desc')->get();
                }
                if ($user->hasRole('teacher')) {
                    foreach ($nazars as $nazar) {
                        $us = User::where('id', $nazar->user_id)->first();
                        if($us)
                            $nazar['user'] = $us->name . ' ' . $us->family;
                        else
                            $nazar['user'] ="ناشناس";
                    }
                }
                $disc['nazar'] = $nazars;
            }
        }
        $d_not = count($discs_not);
        $d_bad = count($discs_bad);
        $d_ok = count($discs_ok);
        $discs_not = $discs_not->take(10);

        foreach ($discs_c as $key => $disc) {
            $session = Session::findOrFail($disc->session_id);
            $disc['session'] = $session;

            $nazars = Score::where('sub_id', $disc->id)->where('type', '1')->get();

            if ($user->hasRole('student')) {
                $nazars = Score::withTrashed()->where('sub_id', $disc->id)->where('type', '1')->orderBy('id', 'desc')->get();
            }
            if ($user->hasRole('teacher')) {
                foreach ($nazars as $nazar) {
                    $us = User::where('id', $nazar->user_id)->first();
                    if($us)
                        $nazar['user'] = $us->name . ' ' . $us->family;
                    else
                        $nazar['user'] ="ناشناس";
                }
            }
            $disc['nazar'] = $nazars;
        }

        $discs = $discs_c->take(10);

        $exercises = Exercise::whereIn('session_id', $sessions)->pluck('id');

        if ($user->hasRole('teacher')) {
            $ex_answers = ExerciseAnswer::whereIn('exercise_id', $exercises)->whereNull('status')->get();
        } elseif ($user->hasRole('student')) {
            $ex_answers = ExerciseAnswer::whereIn('exercise_id', $exercises)->where('user_id', $user->id)->get();
        }
        foreach ($ex_answers as $ans) {
            $exercise = Exercise::findOrFail($ans->exercise_id);
            $session = Session::findOrFail($exercise->session_id);

            $ans['exercise'] = $exercise;
            $ans['session'] = $session;
        }


        //        if ($user->hasRole('teacher')) {
        //            $disscussions = Discussion::whereIn('session_id', $sessions)->whereNull('status')->take(10)->get();
        //            $disscussions_c = Discussion::whereIn('session_id', $sessions)->whereNull('status')->get();
        //        } elseif ($user->hasRole('student')) {
        //            $disscussions = Discussion::whereIn('session_id', $sessions)->where('user_id', $user->id)->take(10)->get();
        //            $disscussions_c = Discussion::whereIn('session_id', $sessions)->where('user_id', $user->id)->get();
        //        }
        //        foreach ($disscussions as $disc) {
        //            $session = Session::findOrFail($disc->session_id);
        //            $disc['session'] = $session;
        //
        //
        //            $nazars = Score::where('sub_id', $disc->id)->where('type', '2')->get();
        //            foreach ($nazars as $nazar) {
        //                $us = User::where('id', $nazar->user_id)->first();
        //                $nazar['user'] = $us->name . $us->family;
        //            }
        //            $disc['nazar'] = $nazars;
        //        }

        $e_not = count($ex_answers);
        //        $d_not = count($disscussions_c);
        $page = $request->query('page');
        $page = !is_null($page) ? $page : 'questions';

// return $questions_bad;
// $questions_not=$questions_not->toArray();
        return view(
            'management.evaluation.' . $page,
            compact(
                'scoring',
                'course',
                'questions',
                'ex_answers',
                'questions_not',
                'questions_ok',
                'questions_bad',
                'questions_ret',
                'q_not',
                'q_ret',
                'q_bad',
                'q_ok',
                'discs_not',
                'discs',
                'discs_ok',
                'discs_bad',
                'discs_ret',
                'd_not',
                'd_ret',
                'd_bad',
                'd_ok',
                'e_not'
            )
        )->with([
            'pageTitle' => 'صفحه مشاهده آمار عملکرد',
            'pageName' => 'مشاهده آمار عملکرد',
            'pageDescription' => 'پایش و ارزیابی فعالیت ها',
        ]);
    }

    public function edit(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'q_1' => 'required',
            'd_1' => 'required',
            'e_1' => 'required',
            's_1' => 'required',
            'q_2' => 'required',
            'd_2' => 'required',
            'e_2' => 'required',
            's_2' => 'required',
            'q_3' => 'required',
            'd_3' => 'required',
            'e_3' => 'required',
            's_3' => 'required',
            'q_4' => 'required',
            'd_4' => 'required',
            'e_4' => 'required',
            's_4' => 'required',
        ]);
        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        $score = Scoring::where('course_id', $request->course_id)->first();
        $score->q_1 = $request->q_1;
        $score->q_2 = $request->q_2;
        $score->q_3 = $request->q_3;
        $score->q_4 = $request->q_4;
        $score->d_1 = $request->d_1;
        $score->d_2 = $request->d_2;
        $score->d_3 = $request->d_3;
        $score->d_4 = $request->d_4;
        $score->e_1 = $request->e_1;
        $score->e_2 = $request->e_2;
        $score->e_3 = $request->e_3;
        $score->e_4 = $request->e_4;
        $score->s_1 = $request->s_1;
        $score->s_2 = $request->s_2;
        $score->s_3 = $request->s_3;
        $score->s_4 = $request->s_4;
        $score->save();
        return redirect()->back();
    }

    public function refereeList(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $user = Auth::user();
        $sessions = $course->sessions()->pluck('id');
        $nazars = Score::where('user_id', $user->id)->where('type', '1')->pluck('sub_id');

        //      question
        $all_q = Question::all();

        $questions_not = Question::whereIn('session_id', $sessions)->where('user_id', '!=', $user->id)->whereNotIn('id', $nazars)->whereNull('status')->take(10)->get();

        foreach ($questions_not as $key => $question) {
            $session = Session::findOrFail($question->session_id);
            $question['session'] = $session;
            $question['scores'] = Score::where('type', 1)->where('sub_id', $question->id)->count();

            $nazars = Score::where('sub_id', $question->id)->where('type', '1')->get();
            if (count($nazars) >= 5) {
                unset($questions_not[$key]);
            }

            //            foreach ($nazars as $nazar)
            //            {
            //                $us=User::where('id',$nazar->user_id)->first();
            //                $nazar['user']=$us->name.' '.$us->family;
            //            }
            //

            $question['nazar'] = $nazars;
        }
        $q_not = count($questions_not);

        //        $disscussions = Discussion::whereIn('session_id', $sessions)->where('user_id', '!=', $user->id)->whereNotIn('id', $nazars)->take(10)->get();
        //
        //        foreach ($disscussions as $disc) {
        //            $session = Session::findOrFail($disc->session_id);
        //            $disc['session'] = $session;
        //            $disc['scores'] = Score::where('type', 2)->where('sub_id', $disc->id)->count();
        //
        //        }
        //        $d_not = count(Discussion::whereIn('session_id', $sessions)->whereNotIn('id', $nazars)->where('user_id', '!=', $user->id)->get());

        //disc
        $all_d = Discussion::all();
        $nazars_disc = Score::where('user_id', $user->id)->where('type', '2')->pluck('sub_id');

        //        $discs_not = Discussion::whereIn('session_id', $sessions)->where('user_id', '!=', $user->id)->whereNotIn('id', $nazars_disc)->whereNull('status')->take(10)->get();
        $discs_not = Discussion::whereIn('session_id', $sessions)->where('user_id', '!=', $user->id)->whereNotIn('id', $nazars_disc)->whereNull('status')->take(10)->get();

        foreach ($discs_not as $key => $disc) {
            $session = Session::findOrFail($disc->session_id);
            $disc['session'] = $session;
            $disc['scores'] = Score::where('type', 1)->where('sub_id', $disc->id)->count();

            $nazars = Score::where('sub_id', $disc->id)->where('type', '2')->get();
            //            return $nazars;
            if (count($nazars) >= 5) {
                unset($discs_not[$key]);
            }

            $disc['nazar'] = $nazars;
        }
        $d_not = count($discs_not);

        //        return $questions_not;
        return view('management.Judgment.index', compact('course', 'questions_not', 'discs_not', 'q_not', 'd_not'))
            ->with([
                'pageTitle' => 'صفحه داوری دروس',
                'pageName' => 'داوری درس',
                'pageDescription' => 'دوست من ! لیست درس هاتو برات نمایش دادم',
            ]);
    }


    public function renderJudment(Request $request)
    {
        $model = $this->handleInstance([
            resolve(Question::class),
            resolve(Discussion::class)
        ]);

        $objectRendered=null;
        $seesions = Session::where('course_id', $request->course_id)->pluck('id');
        // $objectRendered = $model->whereIn('session_id', $seesions)->inRandomOrder()->limit(1)
        // ->where('status', null)
        // ->first();


        $course=Course::find($request->course_id);
        $user=Auth::user();

        $students=CourseUser::where('course_id',$course->id)->count();
if($students>6){
        $oldq=Score::where('type',1)->where('user_id',$user->id)->pluck('sub_id');
        $oldd=Score::where('type',2)->where('user_id',$user->id)->pluck('sub_id');
}
else{
     $oldq=[];
        $oldd=[];
}
        // if ($objectRendered instanceof Discussion) strip_tags($objectRendered);
        // if ($objectRendered instanceof Question) strip_tags($objectRendered);

        if (is_null($objectRendered)) {
            if ($model instanceof Discussion) {
                $objectRendered = Discussion::where('user_id','!=',$user->id)->whereIn('session_id', $seesions)
                    ->whereNotIn('id',$oldd)
                    ->where('status', null)->inRandomOrder()->limit(1)

                    ->first();
            } else {
                $objectRendered = Question::where('user_id','!=',$user->id) ->whereIn('session_id', $seesions)
                    ->whereNotIn('id',$oldq)
                    ->where('status', null)->inRandomOrder()->limit(1)

                    ->first();
            }
            // dd($oldq,$model,$objectRendered);
            if (is_null($objectRendered)) {
                        return redirect()->route('course.list')->with(['error' => 'در حال حاضر محتوایی جهت داوری وجود ندارد.لطفا در وقت دیگری مجدد تلاش کنید']);
            }
        }
        if (isset($objectRendered) && $objectRendered->counter == 3) {
            if ($objectRendered->level == 2) {
                $this->updateEntity($objectRendered, ['status' => 0]);
            } else {
                $this->updateEntity($objectRendered, ['level' => 2, 'score' => 0, 'counter' => 0]);
            }
        }
        $pageDescription = $objectRendered->level == '1' ? 'نگارش محتوا' : 'محتوای';
        $pageData = (object)[
            'content' => $objectRendered instanceof Question ? $objectRendered->question : $objectRendered->text,
            'type' => $objectRendered instanceof Question ? Question::class : Discussion::class,
            'answers' => $objectRendered instanceof Question ? $objectRendered->only(['answer1', 'answer2', 'answer3', 'answer4']) : null,
            'bestAnswer' => $objectRendered instanceof Question ? 'answer' . $objectRendered->answer : null,
            'id' => $objectRendered->id
        ];
        return view('management.Judgment.index', compact('pageData','objectRendered'))
            ->with([
                'pageTitle' => 'صفحه داوری دروس',
                'pageName' => 'داوری درس',
                'pageDescription' => 'دوست من ! نطرت در مورد ' . $pageDescription . ' زیر چیه؟ دوست دارم نظرتو بدونم لطفا جواب بده',
            ]);
    }

    public function postJudment(Request $request, $ID)
    {
        return $this->gateAnswer($request, $ID);
    }

    private function hasJudment(string $type, int $ID)
    {
        $object = $this->getInstanceWithWhere($type, [
            'where' => 'id',
            'where_type' => $ID
        ]);

        return $object->score < 3;
    }

    private function handleInstance(array $model = [])
    {
        $choice = array_rand($model);
        return $model[$choice];
    }

    private function gateAnswer(object $params, int $ID)
    {
        $user=Auth::user();
        $score = new Score();
        $score->user_id = Auth::user()->id;
        $score->sub_id = $ID;
        if ($params->type == "App\Question")
            $score->type = 1;
        else
            $score->type = 2;
        if ($params->answer1 == "true")
            $score->score1 = 1;
        else
            $score->score1 = 0;

        if ($params->answer2 == "true")
            $score->score2 = 1;
        else
            $score->score2 = 0;

        if ($params->answer3 == "true")
            $score->score3 = 1;
        else
            $score->score3 = 0;
        $score->comment1 = $params->description1;
        $score->comment2 = $params->description2;
        $score->comment3 = $params->description3;


        $score->save();
          if($params->description)
                        $result=$this->anetoTrans($user,1000,5,'داوری '.$score->id);
        else
                        $result=$this->anetoTrans($user,500,5,'داوری'.$score->id);


        $find = $this->getInstanceWithWhere($params->type, [
            'where' => 'id',
            'where_type' => $ID
        ]);
        $session = Session::where('id', $find->session_id)->first();
        $course = Course::where('id', $session->course_id)->first();

        try {
            $nomre=0;
            if($params->answer1=='true')
                $nomre+=4;

            if($params->answer2=='true')
                $nomre+=3;

            if($params->answer3=='true')
                $nomre+=3;
            $this->updateEntity($find, ['counter' => $find->counter + 1, 'score' => $find->score + $nomre]);

//            dd($find->counter);
            if ($find->counter >= 3) {
//                if ($find->level == 1)
//                    $this->updateEntity($find, ['level' => 2, 'score' => 0, 'counter' => 0]);
//                else {
                if ($find->score >= 25)
                    $this->updateEntity($find, ['status' => 1]);
                elseif ($find->score >= 15)
                    $this->updateEntity($find, ['status' => 2]);
                elseif ($find->score >= 8)
                    $this->updateEntity($find, ['status' => 3]);
                elseif ($find->score >= 0)
                    $this->updateEntity($find, ['status' => 4]);
//                }
            }
            return redirect("/dashboard/referee/foo/?course_id=" . $course->id);
        } catch (Exception $e) {
            dd($e);
            throw new Exception("Error Processing Request", 1);
        }



        $method = $this->renderMethodName($params);
        return $this->$method($params, $ID);

    }

    private function renderMethodName(object $params): string
    {
        return "handle" . ucfirst($params->answer);
    }

    private function handleIncorrect(object $params, int $ID)
    {

        $find = $this->getInstanceWithWhere($params->type, [
            'where' => 'id',
            'where_type' => $ID
        ]);
        try {
            $this->updateEntity($find, ['description' => $params->description]);

//            if ($this->canEditFor($find)) {
//                $this->updateEntity($find, ['status' => 0, 'counter' => 0, 'score' => 0, 'is_edit' => 1]);
//            } else {
//                $this->hasBeenFor($find);
//            }
            $session = Session::where('id', $find->session_id)->first();
            $course = Course::where('id', $session->course_id)->first();

            return redirect("/dashboard/referee/foo/?course_id=" . $course->id);
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
    }

    private function hasBeenFor(object $find)
    {
        if ($find->level === "2") {
            $this->updateEntity($find, ['counter' => $find->counter + 1]);
            if ($find->counter >= 3) {

                if ($find->score == 3)
                    $this->updateEntity($find, ['status' => 1]);
                elseif ($find->score == 2)
                    $this->updateEntity($find, ['status' => 2]);
                elseif ($find->score == 1)
                    $this->updateEntity($find, ['status' => 3]);
                elseif ($find->score == 0)
                    $this->updateEntity($find, ['status' => 4]);
            }
        } else
            $this->updateEntity($find, ['status' => 4]);
    }

    private function canEditFor(object $find)
    {
        return $find->is_edit == 0 && $find->level != 2;
    }

    private function handleTrue(object $params, int $ID)
    {
        $find = $this->getInstanceWithWhere($params->type, [
            'where' => 'id',
            'where_type' => $ID
        ]);
        $session = Session::where('id', $find->session_id)->first();
        $course = Course::where('id', $session->course_id)->first();
        try {
            $this->updateEntity($find, ['counter' => $find->counter + 1, 'score' => $find->score + 1]);

//            dd($find->counter);
            if ($find->counter >= 3) {
//                if ($find->level == 1)
//                    $this->updateEntity($find, ['level' => 2, 'score' => 0, 'counter' => 0]);
//                else {

                        $this->updateEntity($find, ['status' => $find->score]);
                    // if ($find->score == 3)
                    //     $this->updateEntity($find, ['status' => 1]);
                    // elseif ($find->score == 2)
                    //     $this->updateEntity($find, ['status' => 2]);
                    // elseif ($find->score == 1)
                    //     $this->updateEntity($find, ['status' => 3]);
                    // elseif ($find->score == 0)
                    //     $this->updateEntity($find, ['status' => 4]);
//                }
            }
            return redirect("/dashboard/referee/foo/?course_id=" . $course->id);
        } catch (Exception $e) {
            dd($e);
            throw new Exception("Error Processing Request", 1);
        }
    }

    private function getInstanceWithWhere(string $model, array $where = []): object
    {
        $find = resolve($model);
        $find = $find->where($where['where'], $where['where_type'])->first();
        return $find;
    }

    private function getInstance(string $model): object
    {
        $find = resolve($model);
        return $find;
    }

    private function updateEntity(object $find, array $params)
    {
        return $find->update($params);
    }
}
