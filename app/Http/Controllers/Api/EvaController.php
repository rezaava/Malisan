<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Session;
use Illuminate\Http\Request;

use App\Course;
use App\Discussion;
use App\Exercise;
use App\ExerciseAnswer;
use App\Question;
use App\Score;
use App\Scoring;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class EvaController extends Controller
{
    //
    public function list(Request $request)
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

//            disc
            $discs_c = Discussion::whereIn('session_id', $sessions)
                ->whereNull('status')
                ->get();
            $discs_not = Discussion::whereIn('session_id', $sessions)
                ->whereNotNull('status')->get();

//                ->where(function ($query) {
//                    $query->whereNotNull('status')->orWhere('status', -1);
//                })->get();

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
                    $query->Where('status', -1);
                })->get();
            foreach ($questions_ret as $key => $question) {
                $session = Session::findOrFail($question->session_id);
                $question['session'] = $session;

                $nazars = Score::withTrashed()->where('sub_id', $question->id)->where('type', '1')->orderBy('id', 'desc')->take(1)->get();
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
                    $query->Where('status', -1);
                })->get();
            foreach ($discs_ret as $key => $disc) {
                $session = Session::findOrFail($disc->session_id);
                $disc['session'] = $session;

                $nazars = Score::withTrashed()->where('sub_id', $disc->id)->where('type', '2')->orderBy('id', 'desc')->take(1)->get();
                $disc['nazar'] = $nazars;
            }

//question
            $q_bad = count($questions_bad);
            $q_not = count($questions_not);
            $q_ok = count($questions_ok);
            $q_ret = count($questions_ret);
//            $questions_ok = $questions_ok->take(10);
//            $questions_bad = $questions_bad->take(10);
//            $questions_ret = $questions_ret->take(10);
//            $questions_not = $questions_not->take(10);
            foreach ($questions_ok as $key => $question) {
                $session = Session::findOrFail($question->session_id);
                $question['session'] = $session;
            }
            foreach ($questions_bad as $key => $question) {
                $session = Session::findOrFail($question->session_id);
                $question['session'] = $session;
            }
//            disc
            $d_bad = count($discs_bad);
            $d_not = count($discs_not);
            $d_ok = count($discs_ok);
            $d_ret = count($discs_ret);
//            $discs_ok = $discs_ok->take(10);
//            $discs_bad = $discs_bad->take(10);
//            $discs_ret = $discs_ret->take(10);
//            $discs_not = $discs_not->take(10);
            foreach ($discs_ok as $key => $disc) {
                $session = Session::findOrFail($disc->session_id);
                $disc['session'] = $session;
            }
            foreach ($discs_bad as $key => $disc) {
                $session = Session::findOrFail($disc->session_id);
                $disc['session'] = $session;
            }
        }


//        questions
        foreach ($questions_not as $key => $question) {
            $session = Session::findOrFail($question->session_id);
            $question['session'] = $session;


            $nazars = Score::where('sub_id', $question->id)->where('type', '1')->get();

            if (count($nazars) < 5 && $user->hasRole('teacher'))
                unset($questions_not[$key]);
            else {
                if ($user->hasRole('student')) {
                    $nazars = Score::withTrashed()->where('sub_id', $question->id)->where('type', '1')->orderBy('id', 'desc')->take(1)->get();
                }
                if ($user->hasRole('teacher')) {
                    foreach ($nazars as $nazar) {
                        $us = User::where('id', $nazar->user_id)->first();
                        $nazar['user'] = $us->name . ' ' . $us->family;
                    }
                }
                $question['nazar'] = $nazars;
            }


        }
//        return $questions_ret;
        $q_not = count($questions_not);
        $questions_not = $questions_not;


        foreach ($questions_c as $key => $question) {
            $session = Session::findOrFail($question->session_id);
            $question['session'] = $session;

            $nazars = Score::where('sub_id', $question->id)->where('type', '1')->get();

            if ($user->hasRole('student')) {
                $nazars = Score::withTrashed()->where('sub_id', $question->id)->where('type', '1')->orderBy('id', 'desc')->take(1)->get();
            }
            if ($user->hasRole('teacher')) {
                foreach ($nazars as $nazar) {
                    $us = User::where('id', $nazar->user_id)->first();
                    $nazar['user'] = $us->name . ' ' . $us->family;
                }
            }
            $question['nazar'] = $nazars;
        }

        $questions = $questions_c;

//        discs
        foreach ($discs_not as $key => $disc) {
            $session = Session::findOrFail($disc->session_id);
            $disc['session'] = $session;


            $nazars = Score::where('sub_id', $disc->id)->where('type', '1')->get();

            if (count($nazars) < 3 && $user->hasRole('teacher'))
                unset($discs_not[$key]);
            else {
                if ($user->hasRole('student')) {
                    $nazars = Score::withTrashed()->where('sub_id', $disc->id)->where('type', '1')->orderBy('id', 'desc')->take(1)->get();
                }
                if ($user->hasRole('teacher')) {
                    foreach ($nazars as $nazar) {
                        $us = User::where('id', $nazar->user_id)->first();
                        $nazar['user'] = $us->name . ' ' . $us->family;
                    }
                }
                $disc['nazar'] = $nazars;
            }


        }
        $d_not = count($discs_not);
        $discs_not = $discs_not;


        foreach ($discs_c as $key => $disc) {
            $session = Session::findOrFail($disc->session_id);
            $disc['session'] = $session;

            $nazars = Score::where('sub_id', $disc->id)->where('type', '1')->get();

            if ($user->hasRole('student')) {
                $nazars = Score::withTrashed()->where('sub_id', $disc->id)->where('type', '1')->orderBy('id', 'desc')->take(1)->get();
            }
            if ($user->hasRole('teacher')) {
                foreach ($nazars as $nazar) {
                    $us = User::where('id', $nazar->user_id)->first();
                    $nazar['user'] = $us->name . ' ' . $us->family;
                }
            }
            $disc['nazar'] = $nazars;
        }

        $discs = $discs_c;



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

        $e_not = count($ex_answers);


        return response()->json([
            'status' => 'ok',
            'message' => 'لیست فعالیت های من',
            'scoring' => $scoring,
            'course' => $course,
            'questions' => $questions,
            'ex_answers' => $ex_answers,
//            'questions_not' => $questions_not,
//            'questions_ok' => $questions_ok,
//            'questions_bad' => $questions_bad,
//            'questions_ret' => $questions_ret,
//            'discs_not' => $discs_not,
            'discs' => $discs,
//            'discs_ok' => $discs_ok,
//            'discs_bad' => $discs_bad,
//            'discs_ret' => $discs_ret,

        ], 200,
            array('Content-Type' => 'application/json; charset=utf-8'),
            JSON_UNESCAPED_UNICODE);
    }


    public function refereeList(Request $request)
    {
        $course = Course::findOrFail($request->course_id);

        $user = Auth::user();
        $sessions = $course->sessions()->pluck('id');
        $nazars = Score::where('user_id', $user->id)->where('type','1')->pluck('sub_id');


//      question
        $all_q = Question::all();

        $questions_not = Question::whereIn('session_id', $sessions)->where('user_id', '!=', $user->id)->whereNotIn('id', $nazars)->whereNull('status')->take(10)->get();


        foreach ($questions_not as $key => $question) {
            $session = Session::findOrFail($question->session_id);
            $question['session'] = $session;
            $question['scores'] = Score::where('type', 1)->where('sub_id', $question->id)->count();


            $nazars = Score::where('sub_id', $question->id)->where('type', '1')->get();
            if (count($nazars) >= 5)
                unset($questions_not[$key]);

            $question['nazar'] = $nazars;

        }
//        $q_not = count($questions_not);

//disc
        $all_d = Discussion::all();
        $nazars_disc = Score::where('user_id', $user->id)->where('type','2')->pluck('sub_id');

        $discs_not = Discussion::whereIn('session_id', $sessions)->where('user_id', '!=', $user->id)->whereNotIn('id', $nazars_disc)->whereNull('status')->take(10)->get();

        foreach ($discs_not as $key => $disc) {
            $session = Session::findOrFail($disc->session_id);
            $disc['session'] = $session;
            $disc['scores'] = Score::where('type', 1)->where('sub_id', $disc->id)->count();

            $nazars = Score::where('sub_id', $disc->id)->where('type', '2')->get();
            if (count($nazars) >= 5)
                unset($discs_not[$key]);

            $disc['nazar'] = $nazars;

        }
//        $d_not = count($discs_not);

        return response()->json([
            'status' => 'ok',
            'message' => 'لیست سوالات داوری',
            'course' => $course,
            'questions' => $questions_not,
            'discs' => $discs_not,

        ], 200,
            array('Content-Type' => 'application/json; charset=utf-8'),
            JSON_UNESCAPED_UNICODE);
    }


    public function qscoring(Request $request)
    {
        $user = Auth::user();
        $question = Question::findOrFail($request->question_id);

        if ($user->hasRole('student')) {
            $score = new Score();
            $score->user_id = $user->id;
            $score->type = '1';
            $score->score = $request->score;
            $score->sub_id = $question->id;
            $score->comment = $request->comment;


            DB::beginTransaction();
            try {


//                if ($request->score == '1' || $request->score == '2'|| $request->score == '4')
                $score->save();
                $scores = Score::where('type', '1')->where('sub_id', $question->id)->get();


                if (($request->score == '1' || $request->score == '2') && $question->counter < 3) {
                    $question->counter = $question->counter + 1;
                    foreach ($scores as $item)
                        $item->delete();
                    $question->status = -1;
                } elseif (($request->score == '1' || $request->score == '2') && $question->counter >= 3) {
                    $question->counter = $question->counter + 1;
                    $question->status = 4;
                    $question->comment = "از طرف داوران این سوال رد شد";
                } elseif (($request->score == '4' || $request->score == '3') && count($scores) >= 5) {
                    $c3 = $c4 = 0;
                    foreach ($scores as $item) {
                        if ($item->score == 3)
                            $c3++;
                        elseif ($item->score == 4)
                            $c4++;
                    }
                    if ($c3 == 5) {
                        $question->status = 1;
                        $question->comment = "از طرف داوران این سوال عالی در نظر گرفته شد";
                    } elseif ($c3 == 4) {
                        $question->status = 2;
                        $question->comment = "از طرف داوران این سوال خوب در نظر گرفته شد";
                    } elseif ($c3 == 3) {
                        $question->status = 3;
                        $question->comment = "از طرف داوران این سوال متوسط در نظر گرفته شد";
                    } elseif ($c3 == 1 || $c3 == 2) {
                        $question->status = 4;
                        $question->comment = "از طرف داوران این سوال ضعیف در نظر گرفته شد";
                    }
//                    return $question;
                }


                $question->save();

                DB::commit();
                return redirect()->back()->with('tab', 'q');
            } catch
            (\Exception $exception) {

                DB::rollBack();
                return $exception;
                return back()->with('error', 'خطایی در سرور رخ داده است');
            }
        }

        $question->status = $request->score;
        $question->comment = $request->comment;

        DB::beginTransaction();
        try {
            $question->save();
            DB::commit();
            return response()->json([
                'status' => 'ok',
                'message' => 'ثبت شد',

            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);
        } catch
        (\Exception $exception) {

            DB::rollBack();
            return response()->json([
                'status' => 'ok',
                'message' => 'خطا رخ داد',

            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);
        }
    }


    public function dscoring(Request $request)
    {
        $user = Auth::user();
//        $question = Discussion::findOrFail($request->question_id);
        $question = Discussion::findOrFail($request->disc_id);
        if ($user->hasRole('student')) {
            $score = new Score();
            $score->user_id = $user->id;
            $score->type = '2';
            $score->score = $request->score;
            $score->sub_id = $question->id;
            $score->comment = $request->comment;


            DB::beginTransaction();
            try {


//                if ($request->score == '1' || $request->score == '2'|| $request->score == '4')
                $score->save();
                $scores = Score::where('type', '2')->where('sub_id', $question->id)->get();

                if (($request->score == '1' || $request->score == '2') && $question->counter < 3) {
                    $question->counter = $question->counter + 1;
                    foreach ($scores as $item)
                        $item->delete();
                    $question->status = -1;
                } elseif (($request->score == '1' || $request->score == '2') && $question->counter >= 3) {
                    $question->counter = $question->counter + 1;
                    $question->status = 4;
                    $question->comment = "از طرف داوران این گزارش رد شد";
                } elseif (($request->score == '4' || $request->score == '3') && count($scores) >= 5) {
                    $c3 = $c4 = 0;
                    foreach ($scores as $item) {
                        if ($item->score == 3)
                            $c3++;
                        elseif ($item->score == 4)
                            $c4++;
                    }
                    if ($c3 == 5) {
                        $question->status = 1;
                        $question->comment = "از طرف داوران این گزارش عالی در نظر گرفته شد";
                    } elseif ($c3 == 4) {
                        $question->status = 2;
                        $question->comment = "از طرف داوران این گزارش خوب در نظر گرفته شد";
                    } elseif ($c3 == 3) {
                        $question->status = 3;
                        $question->comment = "از طرف داوران این گزارش متوسط در نظر گرفته شد";
                    } elseif ($c3 == 1 || $c3 == 2) {
                        $question->status = 4;
                        $question->comment = "از طرف داوران این گزارش ضعیف در نظر گرفته شد";
                    }
                }


                $question->save();

                DB::commit();
                return redirect()->back()->with('tab','d');
            }
            catch
            (\Exception $exception) {

                DB::rollBack();
                return $exception;
                return back()->with('error', 'خطایی در سرور رخ داده است');
            }
        }

        $question->status = $request->score;
        $question->comment = $request->comment;

        DB::beginTransaction();
        try
        {
            $question->save();
            DB::commit();
            return response()->json([
                'status' => 'ok',
                'message' => 'ثبت شد',

            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);
        }

        catch(\Exception $exception) {

            DB::rollBack();
            return response()->json([
                'status' => 'ok',
                'message' => 'خطا رخ داد',

            ], 200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE);
        }
    }
    public function renderJudment()
    {
        $model = $this->handleInstance([
            resolve(Question::class),
            resolve(Discussion::class)
        ]);
        $objectRendered =  $model->inRandomOrder()->limit(1)
        ->where('status' , null)
        ->first();
        if(is_null($objectRendered))
        {
            if($model instanceof Question){
                $objectRendered =  Discussion::inRandomOrder()->limit(1)
                ->where('status' , null)
                ->first();
            }
            else{
                $objectRendered =  Question::inRandomOrder()->limit(1)
                    ->where('status' , null)
                    ->first();
            }
            if(is_null($objectRendered)){
                return response()->json([
                    'status' => 0,
                    'messages' => 'متاسفانه در حال حاضر قادر به انجام این کار نیستید' ,
                    'entity' => null
                ]);
            }
        }
        if(isset($objectRendered) && $objectRendered->counter == 3)
        {
            if($objectRendered->level == 2)
            {
                 $this->updateEntity($objectRendered, ['status' => 0]);
            }
            else
            {
                 $this->updateEntity($objectRendered, ['level' => 2, 'score' => 0, 'counter' => 0]);
            }
        }
        // $pageDescription = $objectRendered->level == '1' ? 'نگارش محتوا' : 'محتوای';
        $data = (object)[
            'content'    => $objectRendered instanceof Question ? $objectRendered->question : $objectRendered->text ,
            'type'       => $objectRendered instanceof Question ? Question::class : Discussion::class,
            'answers'    => $objectRendered instanceof Question ? $objectRendered->only(['answer1', 'answer2', 'answer3', 'answer4']) : null ,
            'bestAnswer' => $objectRendered instanceof Question ? 'answer' . $objectRendered->answer : null ,
            'id'         => $objectRendered->id
        ];
        return response()->json([
            'status' => 'ok',
            'messages' => 'درخواست شما موفقیت آمیز بود' ,
            'entity' => $data
        ]);
    }

    public function postJudment(Request $request, $ID)
    {
        return $this->gateAnswer($request, $ID);
    }
    private function hasJudment(string $type, int $ID)
    {
        $object = $this->getInstanceWithWhere($type, [
            'where' => 'id' ,
            'where_type' => $ID
        ]);
        return $object->score < 3;
    }
    private function handleInstance(array $model=[])
    {
        $choice = array_rand($model);
        return $model[$choice];
    }
    private function gateAnswer(object $params, int $ID)
    {
        $method = $this->renderMethodName($params);
        return $this->$method($params->type, $ID);
    }
    private function renderMethodName(object $params): string
    {
        return "handle".ucfirst($params->answer);
    }
    private function handleIncorrect(string $type, int $ID)
    {
        $find = $this->getInstanceWithWhere($type, [
            'where' => 'id' ,
            'where_type' => $ID
        ]);
        try{
            if($this->canEditFor($find)){
                $this->updateEntity($find, ['status' => 0, 'counter' => 0, 'is_edit' => 1]);
            }else{
                $this->hasBeenFor($find);
            }
            return response()->json([
                'status' => 'ok',
                'messages' => 'عملیات با موفقیت انجام شد' ,
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'messages' => 'درهنگام انجام عملیات با مشکل مواجه شدیم' ,
            ]);
        }
    }
    private function hasBeenFor(object $find)
    {
        if($find->level === "2") {
            $this->updateEntity($find, ['counter' => $find->counter+1]);
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
        }
        else
        $this->updateEntity($find, ['status' => 4]);
    }
    private function canEditFor(object $find)
    {
        return $find->is_edit == 0 && $find->level != 2;
    }
    private function handleTrue(string $type, int $ID)
    {
        $find = $this->getInstanceWithWhere($type, [
            'where' => 'id' ,
            'where_type' => $ID
        ]);
        try{
            $this->updateEntity($find, ['counter' => $find->counter + 1, 'score' => $find->score + 1]);
            if($find->counter>=3)
            {
                if($find->level==1)
                    $this->updateEntity($find, ['level' => 2, 'score' => 0 ,'counter'=>0]);
                else
                {
                    if($find->score==3)
                        $this->updateEntity($find, ['status'=>1]);
                    elseif($find->score==2)
                        $this->updateEntity($find, ['status'=>2]);
                    elseif($find->score==1)
                        $this->updateEntity($find, ['status'=>3]);
                    elseif($find->score==0)
                        $this->updateEntity($find, ['status'=>4]);

                }

            }
            return response()->json([
                'status' => 'ok' ,
                'messages' => 'عملیات با موفقیت انجام شد' ,
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed' ,
                'messages' => 'درهنگام انجام عملیات با مشکل مواجه شدیم' ,
            ]);
        }
    }
    private function getInstanceWithWhere(string $model, array $where = []): object
    {
        $find =  resolve($model);
        $find = $find->where($where['where'], $where['where_type'])->first();
        return $find;
    }
    private function getInstance(string $model): object
    {
        $find =  resolve($model);
        return $find;
    }
    private function updateEntity(object $find, array $params)
    {
         return $find->update($params);
    }
}
