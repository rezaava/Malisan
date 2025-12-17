<?php

namespace App\Http\Controllers\site;

use Illuminate\Support\Facades\Http;


use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Touruser;
use Auth;
use Validator;
use DB;
use App\Models\Course;
use App\Exports\QuestionsExport;
use App\Models\Score;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Excel;


class QuestionController extends Controller
{
    //
    public function show(Request $request, Excel $excel)
    {

        $my = Auth::user();
        $user = $my;
        $mosabeghat = Touruser::where('user_id', $user->id)->count();
        if ($user->hasRole('student')) {
            $user2 = User::where('national', $user->national)->where('role', 2)->first();
        } elseif ('teacher') {
            $user2 = User::where('national', $user->national)->where('role', 3)->first();
        }
        if (\Route::current()->getName() == 'bank') {
            $filter['1'] = $filter['2'] = $filter['3'] = $filter['4'] = $filter['5'] = $filter['6'] = 0;
            if (!isset($request->non) && !isset($request->ex) && !isset($request->go) && !isset($request->med) && !isset($request->ba) && !isset($request->os)) {
                $filter['1'] = $filter['2'] = $filter['3'] = $filter['4'] = $filter['5'] = $filter['6'] = 1;
            } else {
                if (isset($request->non)) {
                    $filter['6'] = 1;
                }
                if (isset($request->ex)) {
                    $filter['1'] = 1;
                }

                if (isset($request->go)) {
                    $filter['2'] = 1;
                }

                if (isset($request->med)) {
                    $filter['3'] = 1;
                }

                if (isset($request->ba)) {
                    $filter['4'] = 1;
                }

                if (isset($request->os)) {
                    $filter['5'] = 1;
                }

            }
            $course = Course::findOrFail($request->course_id);
            $meetings = $course->sessions()->pluck('id');
            $questions = Question::whereIn('session_id', $meetings)->get();
            //            $questions = Question::whereIn('session_id', $meetings)->whereNotNull('status')->where('status', '>', '0')->get();

            foreach ($questions as $key => $question) {
                if ($filter['1'] == '0') {
                    if ($question->status == '1') {
                        unset($questions[$key]);
                    }
                }

                if ($filter['2'] == '0') {
                    if ($question->status == '2') {
                        unset($questions[$key]);
                    }
                }

                if ($filter['3'] == '0') {
                    if ($question->status == '3') {
                        unset($questions[$key]);
                    }
                }

                if ($filter['4'] == '0') {
                    if ($question->status == '4') {
                        unset($questions[$key]);
                    }
                }

                if ($filter['5'] == '0') {
                    if ($question->user_id == Auth::user()->id) {
                        unset($questions[$key]);
                    }

                }
                if ($filter['6'] == '0') {
                    if ($question->user_id == null) {
                        unset($questions[$key]);
                    }

                }

                $designer = User::findOrFail($question->user_id);
                if ($designer->hasRole('teacher')) {
                    $question['user'] = 'استاد';
                } else {
                    $question['user'] = $designer->name . ' ' . $designer->family;
                }

                if ($question->status == '1') {
                    $question['level'] = 'عالی';
                } elseif ($question->status == '2') {
                    $question['level'] = 'خوب';
                } elseif ($question->status == '3') {
                    $question['level'] = 'متوسط';
                } elseif ($question->status == '4') {
                    $question['level'] = 'بد';
                } else {
                    $question['level'] = 'نامشخص';
                }

                //                    $question['level'] =$question->status ;

                $nazars = Score::where('sub_id', $question->id)->where('type', '1')->orderBy('id', 'desc')->get();
                foreach ($nazars as $nazar) {
                    $us = User::where('id', $nazar->user_id)->first();
                    $nazar['user'] = $us->name . ' ' . $us->family;
                }

                $question['nazar'] = $nazars;

            }

            if ($request->input('action') == 'excel') {
                session()->put("questions", $questions);
                return $excel->download(new QuestionsExport, "malisan_bank" . $course->name . ".xlsx");
            }
            return view('management.questions.create', compact('course', 'questions', 'filter', 'user', 'mosabeghat', 'user2'))->with([
                'pageTitle' => 'صفحه طرح سوال',
                'pageName' => 'طرح سوال',
                // 'pageDescription' => $setting->tarahi_soal_desc,
                // 'pageDescription' => 'دوست من ! توی فرم زیر برای این جلسه سوال طرح کن فقط حواست باشه روند تعریف سوال محدوده !',
            ]);

        } else {
            $meeting = Session::findOrFail($request->session_id);
            $course = $meeting->course()->first();
            $setting = $course->setting()->first();

            if ($my->hasRole('teacher')) {
                $questions = $meeting->questions()->get();
            } else {
                $questions = $meeting->questions()->where('user_id', $my->id)->get();
            }

            foreach ($questions as $question) {
                $designer = User::findOrFail($question->user_id);
                if ($designer->hasRole('teacher')) {
                    $question['user'] = 'استاد';
                } else {
                    $question['user'] = $designer->name . ' ' . $designer->family;
                }

                if ($question->status == '1') {
                    $question['level'] = 'عالی';
                } elseif ($question->status == '2') {
                    $question['level'] = 'خوب';
                } elseif ($question->status == '3') {
                    $question['level'] = 'متوسط';
                } elseif ($question->status == '4') {
                    $question['level'] = 'بد';
                } else {
                    $question['level'] = 'نامشخص';
                }

            }
            $limit = 0;
            if ($my->hasRole('student')) {
                if (count($questions) >= $setting->max_soal) {
                    $limit = 1;
                }
            }

            return view('management.questions.create', compact('meeting', 'course', 'questions', 'limit', 'user', 'mosabeghat', 'user2'))->with([
                'pageTitle' => 'صفحه طرح سوال',
                'pageName' => 'طرح سوال',
                'pageDescription' => $setting->tarahi_soal_desc,
                //                'pageDescription' => 'دوست من ! توی فرم زیر برای این جلسه سوال طرح کن فقط حواست باشه روند تعریف سوال محدوده !',
            ]);
        }
    }


    ////////////////////
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

        return response()->json(
            [
                'status' => 'ok',
                'questions' => $questions,
                'limit' => $limit,
                'help' => $setting->tarahi_soal_desc
            ],
            200,
            array('Content-Type' => 'application/json; charset=utf-8'),
            JSON_UNESCAPED_UNICODE
        );


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
            return response()->json(
                [
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
            return response()->json(
                [
                    'status' => 'ok',
                    'message' => 'عمل با موفقیت انجام شد',
                ],
                200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE
            );
        } catch (\Exception $exception) {

            DB::rollBack();
            return response()->json(
                [
                    'status' => 'fail',
                    'message' => 'خطایی در سرور رخ داده است',
                    'error' => $exception,
                ],
                200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function create2(Request $request)
    {
        $valid = Validator::make(
            $request->all(),
            [
                'question' => 'required|unique:questions',
                'answer' => 'required',
                'answer1' => 'required',
                'answer2' => 'required',
                'answer3' => 'required',
                'answer4' => 'required',
            ],
            [
                'question.unique' => 'سوال مطرح شده شما با سوالات خودتان یا دانشجوی دیگر مشابه هست'
            ]
        );
        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        DB::beginTransaction();

        $session = Session::findOrFail($request->session_id);
        $user = Auth::user();

        $last = Question::orderBy('id', 'desc')->first();
        $question = new Question();
        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->answer1 = $request->answer1;
        $question->answer2 = $request->answer2;
        $question->answer3 = $request->answer3;
        $question->answer4 = $request->answer4;
        $question->user_id = $user->id;
        $question->session_id = $request->session_id;

        $last = $last->id + 1;
        if ($user->hasRole('teacher')) {
            $question->status = '1';
            $result = $this->anetoTrans($user, 10000, 5, 'طراحی سوال ' . $session->name . $last);

        } else {
            $result = $this->anetoTrans($user, 1000, 5, 'طراحی سوال ' . $session->name . $last);

        }

        try {
            $question->save();
            DB::commit();


            return redirect()->back()->with('success', 'با موفقیت اضافه شد');
        } catch (\Exception $exception) {

            DB::rollBack();
            // return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function scoring(Request $request)
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
                    foreach ($scores as $item) {
                        $item->delete();
                    }

                    $question->status = -1;
                } elseif (($request->score == '1' || $request->score == '2') && $question->counter >= 3) {
                    $question->counter = $question->counter + 1;
                    $question->status = 4;
                    $question->comment = "از طرف داوران این سوال رد شد";
                } elseif (($request->score == '4' || $request->score == '3') && count($scores) >= 5) {
                    $c3 = $c4 = 0;
                    foreach ($scores as $item) {
                        if ($item->score == 3) {
                            $c3++;
                        } elseif ($item->score == 4) {
                            $c4++;
                        }

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
            } catch (\Exception $exception) {

                DB::rollBack();
                // return $exception;
                return back()->with('error', 'خطایی در سرور رخ داده است');
            }
        }

        $question->status = $request->score;
        $question->comment = $request->comment;

        DB::beginTransaction();
        try {
            $question->save();
            DB::commit();
            return redirect()->back()->with('tab', 'q');
        } catch (\Exception $exception) {

            DB::rollBack();
            // return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod("get")) {
            $edit = Question::findOrFail($id);
            //            $question['score']=Score::where('type','1')->where('sub_id',$question->id)->get();

            $session = Session::find($edit->session_id);
            $meeting = $session;
            $course = Course::find($session->course_id);
            //        return $session;

            //        $course = Course::findOrFail($request->course_id);
            $meetings = $course->sessions()->pluck('id');
            $questions = Question::whereIn('session_id', $meetings)->get();
            foreach ($questions as $question) {

                $designer = User::findOrFail($question->user_id);
                if ($designer->hasRole('teacher')) {
                    $question['user'] = 'استاد';
                } else {
                    $question['user'] = $designer->name . ' ' . $designer->family;
                }

                if ($question->status == '1') {
                    $question['level'] = 'عالی';
                } elseif ($question->status == '2') {
                    $question['level'] = 'خوب';
                } elseif ($question->status == '3') {
                    $question['level'] = 'متوسط';
                } elseif ($question->status == '4') {
                    $question['level'] = 'بد';
                } else {
                    $question['level'] = 'نامشخص';
                }

            }
            $old = URL::previous();
            return view('management.questions.create', compact('course', 'edit', 'meeting', 'questions', 'old'));
        } elseif ($request->isMethod("post")) {

            $valid = Validator::make($request->all(), [
                //                'question' => 'required',
                'question' => 'required|unique:questions,question,' . $request->question_id,
                'answer' => 'required',
                'answer1' => 'required',
                'answer2' => 'required',
                'answer3' => 'required',
                'answer4' => 'required',
            ]);
            if ($valid->fails()) {
                return back()->withErrors($valid);
            }

            DB::beginTransaction();
            $question = Question::find($request->question_id);
            $session = Session::find($question->session_id);
            $course = Course::find($session->course_id);

            $question->question = $request->question;
            $question->answer = $request->answer;
            $question->answer1 = $request->answer1;
            $question->answer2 = $request->answer2;
            $question->answer3 = $request->answer3;
            $question->answer4 = $request->answer4;

            $user = Auth::user();
            if (!$user->hasRole('teacher')) {
                $question->status = null;
            }

            try {
                $question->save();
                $scores = Score::where('type', 1)->where('sub_id', $question->id)->get();
                foreach ($scores as $item) {
                    $item->delete();
                }
                DB::commit();

                if (isset($request->old_route)) {
                    return redirect($request->old_route)->with('success', 'با موفقیت ویرایش شد');
                }
                return redirect()->back()->with('success', 'با موفقیت ویرایش شد');
                //                return redirect("/dashboard/evaluation?course_id=" . $course->id)->with('success', 'با موفقیت ویرایش شد');
            } catch (\Exception $exception) {

                DB::rollBack();
                // return $exception;
                return back()->with('error', 'خطایی در سرور رخ داده است');
            }
        } else {
            abort(404);
        }

    }

    public function delete($id = null, Request $request)
    {
        $qu = Question::findOrFail($request->question_id);
        $qu->delete();
        return redirect()->back()->with('success', 'با موفقیت حذف شد');

    }

    public function star($id = null, Request $request)
    {

        $qu = Question::findOrFail($request->question_id);

        if ($qu->star == 0) {
            $qu->star = 1;
        } else {
            $qu->star = 0;
        }

        $qu->save();
        return redirect()->back()->with('success', 'با موفقیت ویرایش شد');

    }
}
