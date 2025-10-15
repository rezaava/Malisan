<?php

namespace App\Http\Controllers\Dashboard;

use App\Azmon;
use App\Course;
use App\Http\Controllers\Controller;
use App\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;

class AzmonController extends Controller
{
    //

    public function list(Request $request)
    {
        $course = Course::findOrFail($request->id);
        $user = Auth::user();      
        $azmon = Azmon::where('course_id', $course->id)->first();
        if(!$azmon)
            return redirect('/dashboard/azmon/create?id='.$request->id);

        $azmons = Azmon::where('course_id', $course->id)->get();
        foreach ($azmons as $azmon) {
            if (Carbon::now() > $azmon->start)
                $azmon['expire'] = '1';
            else
                $azmon['expire'] = '0';

        }
        return view('dashboard2.azmon.list', compact('course', 'azmons'));
    }

    public function create(Request $request)
    {


        $course = Course::findOrFail($request->id);

        $sessions = $course->sessions()->get();

        $code = Str::random(5);
        $uniq = Azmon::where('code', $code)->first();
        while ($uniq) {
            $code = Str::random(5);
            $uniq = Course::where('code', $code)->first();
        }
        return view('management.azmon.create', compact('course', 'code', 'sessions'));
    }

    public function createPost(Request $request)
    {
//        return $request;

        $date = explode(" ", $request->start);
        $day = $date[0];
        $day = explode("/", $day);
        $time = $date[1];
        $time = explode(":", $time);
        $start = (new Jalalian($this->convert($day[0]), $this->convert($day[1]), $this->convert($day[2]), $this->convert($time[0]), $this->convert($time[1]), 0))->toCarbon()->toDateTimeString();

        $date = explode(" ", $request->end);
        $day = $date[0];
        $day = explode("/", $day);
        $time = $date[1];
        $time = explode(":", $time);
        $end = (new Jalalian($this->convert($day[0]), $this->convert($day[1]), $this->convert($day[2]), $this->convert($time[0]), $this->convert($time[1]), 0))->toCarbon()->toDateTimeString();

        $azmon = new Azmon();
        $azmon->course_id = $request->id;
        $azmon->title = $request->title;
        $azmon->description = $request->description;
        $azmon->sath = $request->sath;
        $azmon->code = $request->code;
        $azmon->start = $start;
        $azmon->end = $end;
        $azmon->time = $request->time;

        $sessions = null;
        foreach ($request->sessions as $session)
            $sessions = $sessions . ',' . $session;
        $azmon->sessions = $sessions;

        $azmon->num = $request->num;

        if ($request->show_nomre)
            $azmon->show_nomre = 1;
        if ($request->show_ans)
            $azmon->show_ans = 1;
        if ($request->show_state)
            $azmon->show_state = 1;
        if ($request->show_remain)
            $azmon->show_remain = 1;
        if ($request->changeable)
            $azmon->changeable = 1;

        $azmon->save();


        return redirect('dashboard/azmon?id=' . $request->id);
    }


    public function edit(Request $request)
    {


        $azmon = Azmon::findOrFail($request->id);

        $course = Course::findOrFail($azmon->course_id);

        $sessions = $course->sessions()->get();

        $ses = explode(",", $azmon->sessions);

        foreach ($ses as $se) {
            $ss[$se] = $se;
        }
//        return $ss;
        $start = $azmon->start;
        $end = Carbon::parse($azmon->end)->format('Y/m/d H:i:s');

//return $end;
        return view('dashboard2.azmon.create', compact('course', 'azmon', 'ss', 'sessions', 'end'));


    }

    public function editPost(Request $request, $id)
    {

        $date = explode(" ", $request->start);
        $day = $date[0];
        $day = explode("/", $day);
        $time = $date[1];
        $time = explode(":", $time);
        $start = (new Jalalian($this->convert($day[0]), $this->convert($day[1]), $this->convert($day[2]), $this->convert($time[0]), $this->convert($time[1]), 0))->toCarbon()->toDateTimeString();

        $date = explode(" ", $request->end);
        $day = $date[0];
        $day = explode("/", $day);
        $time = $date[1];
        $time = explode(":", $time);
        $end = (new Jalalian($this->convert($day[0]), $this->convert($day[1]), $this->convert($day[2]), $this->convert($time[0]), $this->convert($time[1]), 0))->toCarbon()->toDateTimeString();

        $azmon = Azmon::findOrFail($id);
        $azmon->course_id = $request->id;
        $azmon->title = $request->title;
        $azmon->description = $request->description;
        $azmon->sath = $request->sath;

        $sessions = null;
        foreach ($request->sessions as $session)
            $sessions = $sessions . ',' . $session;
        $azmon->sessions = $sessions;

        $azmon->num = $request->num;

        if ($request->show_nomre)
            $azmon->show_nomre = 1;
        else
            $azmon->show_nomre = 0;

        if ($request->show_ans)
            $azmon->show_ans = 1;
        else
            $azmon->show_ans = 0;

        if ($request->show_state)
            $azmon->show_state = 1;
        else
            $azmon->show_state = 0;

        if ($request->show_remain)
            $azmon->show_remain = 1;
        else
            $azmon->show_remain = 0;

        if ($request->changeable)
            $azmon->changeable = 1;
        else
            $azmon->changeable = 0;

        $azmon->start = $start;
        $azmon->end = $end;
        $azmon->time = $request->time;

        $azmon->save();


        return redirect('dashboard/azmon?id=' . $request->id);
    }


    public function azmon(Request $request)
    {
        $azmoon = Azmon::where('code', $request->cd)->where('course_id', $request->course_id)->first();
        if ($azmoon) {
            if ((Carbon::now() < $azmoon->start))
                return back()->with('error', ' آزمون هنوز شروع نشده است!');
            if ((Carbon::now() > $azmoon->end))
                return back()->with('error', ' آزمون تمام شده است!');

            $user = Auth::user();
            $quiz = Quiz::where('user_id', $user->id)->where('azmon_id', $azmoon->id)->first();
            if ($quiz)
                return back()->with('error', ' شما قبلا این آزمون را داده اید!');


            return redirect('dashboard/quiz?az=' . $azmoon->id . '&course_id=' . $azmoon->course_id);
        } else
            return back()->with('error', ' کد صحیح نیست یا متعلق به این درس نمی باشد!');


    }


    function convert($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }


    public function delete(Request $request,$id)
    {

        $azmon = Azmon::findOrFail($id);
        $azmon->delete();

        return redirect('/')->with('success', ' آزمون با موفقیت حذف شد');
    }
}
