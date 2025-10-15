<?php

namespace App\Http\Controllers\Dashboard;

use App\Course;
use App\Discussion;
use App\Http\Controllers\Controller;
use App\Score;
use App\Session;
use App\Setting;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class DiscussionController extends Controller
{
    //
    public function show($id)
    {
        $session = Session::findOrFail($id);
        $course = Course::find($session->course_id);
        $discussion = $session->descussions()->where('user_id', Auth::user()->id)->first();

        $setting = Setting::where('course_id', $course->id)->first();
        return view('management.discussion.create', compact('course', 'session', 'discussion', 'setting'))
            ->with([
                'pageTitle' => 'صفحه ثبت گزارش',
                'pageName' => 'ثبت گزارش درس',
                'pageDescription' => $setting->ersal_gozaresh_desc,
//                'pageDescription' => 'دوست من ! ادیتور زیر برای درج خلاصه درس میباشد',
            ]);
    }

    public function create(Request $request)
    {
//        return $request;
        $valid = Validator::make($request->all(), [
            'text' => 'required',
        ]);
        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        DB::beginTransaction();
        $session = Session::findOrFail($request->session_id);
        $user = Auth::user();

        $discussion = $session->descussions()->where('user_id', $user->id)->first();
        if (!$discussion) {
            $discussion = new Discussion();
        }
        $discussion->text = $request->text;
        $discussion->user_id = $user->id;
        $discussion->session_id = $request->session_id;
        $discussion->status = null;

$last=Discussion::orderBy('id','desc')->first();
$last=$last->id+1;;
          $result=$this->anetoTrans($user,1500,5,'طراحی گزارش '.$session->name.$last);

        try {
            $discussion->save();
            DB::commit();
            return redirect()->back()->with('success', 'با موفقیت اضافه شد');
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function edit(Request $request, $id)
    {
        $meeting = Session::findOrFail($id);
        dd($meeting->id);
//        $valid = Validator::make($request->all(), [
        //            'number' => 'required',
        //        ]);
        //        if ($valid->fails()) {
        //            return back()->withErrors($valid);
        //        }
        //
        //        $discussion = new ();
        //        $discussion->text = $request->text;
        //        $discussion->user_id = $user->id;
        //        $discussion->session_id = $request->session_id;
        //
        //
        //        try {
        //            $meeting->save();
        //            return  back()->with('success','با موفقیت بروزرسانی شد');
        //        }catch (\Exception $exception)
        //        {
        //            DB::rollBack();
        //
        //            return back()->with('error', 'خطایی در سرور رخ داده است');
        //        }
    }

    public function scoringold(Request $request)
    {
        $disc = Discussion::findOrFail($request->discussion_id);

        $user = Auth::user();
        if ($user->hasRole('student')) {
            $score = new Score();
            $score->user_id = $user->id;
            $score->type = '2';
            $score->score = $request->score;
            $score->sub_id = $disc->id;
            $score->comment = $request->comment;

            DB::beginTransaction();
            try {
                $score->save();
                DB::commit();
                return redirect()->back();
            } catch (\Exception $exception) {

                DB::rollBack();
                return $exception;
                return back()->with('error', 'خطایی در سرور رخ داده است');
            }
        }
        $disc->status = $request->score;
        $disc->comment = $request->comment;

        DB::beginTransaction();
        try {
            $disc->save();
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function scoring(Request $request)
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
                    foreach ($scores as $item) {
                        $item->delete();
                    }

                    $question->status = -1;
                } elseif (($request->score == '1' || $request->score == '2') && $question->counter >= 3) {
                    $question->counter = $question->counter + 1;
                    $question->status = 4;
                    $question->comment = "از طرف داوران این گزارش رد شد";
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
                return redirect()->back()->with('tab', 'd');
            } catch (\Exception $exception) {

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
            return redirect()->back();
        } catch (\Exception $exception) {

            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

}
