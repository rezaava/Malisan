<?php

namespace App\Http\Controllers\site;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Discussion;
use App\Models\Exercise;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\ExerciseAnswer;
use App\Models\Role;
use App\Models\Session;
use App\Models\Setting;
use App\Models\Coworker;
use App\Models\Touruser;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    //
    function list(Request $request)
    {

        $user = Auth::user();
        $member = 0;
        $mosabeghat = Touruser::where('user_id', $user->id)->count();
        $content = Coworker::where('user_id', $user->id)->first();
        $isJudment = true;
        $seesions = Session::where('course_id', $request->course_id)->pluck('id');
        $questionCount = Question::whereNull('status')->whereIn('session_id', $seesions)->count();

        $discussionCount = Discussion::whereNull('status')->whereIn('session_id', $seesions)->count();

        if ($discussionCount == 0 && $questionCount == 0) {
            $isJudment = false;
        }

        $course = Course::where('id', $request->course_id)->first();

        $Course_user = CourseUser::where('course_id', $course->id)->where('user_id', $user->id)->first();

        // $paid = 0;
        // if ($course->price == 0)
        //     $paid = 1;

        // if ($Course_user) {
        //     if ($course->price > 0 && $Course_user->paid == 1)
        //         $paid = 1;
        //     $member = 1;
        // } else {
        //     $member = 0;
        // }

        /////چک

        $setting = Setting::where('course_id', $course->id)->first();
        if ($user->hasRole('student')) {
            $user2 = User::where('national', $user->national)->where('role', 2)->first();

            $sessions = $course->sessions()->where('active', '1')->orderBy('number', 'desc')->get();
            $count = $course->sessions()->where('active', '1')->orderBy('number', 'desc')->count();

            if ($Course_user) {
                $member = 1;
                if ($course->private == 1) {
                    $now_time = Carbon::now();

                    $time = $Course_user->created_at;
                    $time = Carbon::parse($time);
                    $diff = $time->diffInDays($now_time);

                    $diff = $count - floor($diff / $course->period) - 1;
                    //                   $diff قبلی: تعداد روزهای گذشته از ثبت‌نام
                    // $course->period: دوره زمانی (مثلاً تعداد روزهای هر ترم/جلسه)
                    // floor($diff / $course->period): تعداد دوره‌های کامل گذشته
                    // $count: تعداد کل دوره‌ها/جلسات
                    // $count - ... - 1: محاسبه تعداد دوره‌های باقی‌مانده

                    foreach ($sessions as $key => $session) {
                        if ($key < $diff)
                            unset($sessions[$key]);
                    }
                }
            } else {
                $member = 0;
            }


            foreach ($sessions as $key => $session) {
                if ($member == 0) {
                    if ($session->number > 1)
                        unset($sessions[$key]);
                } elseif ($member == 1)
                    ///  } elseif ($piad == 1)
                    if ($session->number > 4)
                        unset($sessions[$key]);
            }

        } else {
            $user2 = User::where('national', $user->national)->where('role', 3)->first();
            $sessions = $course->sessions()->orderBy('number', 'desc')->get();
        }
        /////چک


        //tedad soalat khod azmaii
        $max_q = $setting->q_num;
        $sess = $sessions->pluck('id');
        if ($setting->sath_khod == 2) {
            $question_count = Question::whereIn('session_id', $sess)->whereIn('status', [1, 2])->count();
        }
        if ($setting->sath_khod == 1) {
            $question_count = Question::whereIn('session_id', $sess)->where('status', 1)->count();
        }
        if ($setting->sath_khod == 3) {
            $question_count = Question::whereIn('session_id', $sess)->where('status', 2)->count();
        }

        if ($question_count < $max_q) {
            $khodazmaii = 0;
        } else {
            $khodazmaii = 1;
        }

        //
        foreach ($sessions as $key => $session) {

            $ex = Exercise::where('session_id', $session->id)->get();
            $session['ex_count'] = count($ex);
            $session['taklif_last'] = 1;
            $session['gozaresh_last'] = 1;
            $session['soal_last'] = 1;

            if ($key != 0) {
                if ($setting->taklif_last == 1) {
                    $session['taklif_last'] = 0;
                }

                if ($setting->gozaresh_last == 1) {
                    $session['gozaresh_last'] = 0;
                }

                if ($user->hasRole('student')) {
                    if ($setting->soal_last == 1) {
                        $session['soal_last'] = 0;
                    }
                }


            }

        }

        //        if (sizeof($sessions)>0)
        //            $discussion = $meeting->descussions()->where('user_id', Auth::user()->id)->first();
        //        else
        //            $discussion = null;
        //        if (!$meeting)
        //            $meeting=null;

        $sessions_count = $course->sessions()->count();
        $course['sessions'] = $sessions_count;

        $teacher_role = Role::where("name", "teacher")->first();
        $student_role = Role::where("name", "student")->first();
        $users = $course->users()->where('role_id', $student_role->id)->count();
        $course['count'] = $users;

        $teacher = $course->users()->where('role_id', $teacher_role)->pluck('user_id');
        $course['user'] = User::findOrFail($teacher)->first();

        $students = $course->users()->where('role_id', $student_role->id)->take('5')->get();
        $course['students'] = $students;

        $student = 0;
        if (Auth::user()->hasRole('student')) {
            $student = 1;
        }
    
        return view('melisan.sessions.index', compact('setting', 'content', 'user2', 'mosabeghat', 'khodazmaii', 'sessions', 'course', 'student', 'isJudment', 'member', 'user'))
            ->with([
                'pageTitle' => 'صفحه مدیریت درس',
                'pageName' => 'درس',
                'pageDescription' => Auth::user()->hasRole('student') ? "دوست من ! اینجا صفحه مدیریت کلاس درسته" : "مدرس گرامی ! داشبورد مدیریت درس در اختیار شماست",
            ]);

    }

    public function create(Request $request)
    {
        if ($request->isMethod("get")) {
            $course = Course::findOrFail($request->course_id);
            $sessions = Session::where('course_id', $course->id)->count();
            $session = $sessions + 1;
            return view('management.sessions.create', compact('course', 'session'))->with([
                'pageTitle' => 'صفحه افزودن جلسه',
                'pageName' => 'افزودن جلسه',
                'pageDescription' => 'مدرس گرامی! برای ایجاد جلسه جدید لطفا فرم زیر را تکمیل نمایید .',
            ]);
        } elseif ($request->isMethod("post")) {
            $data = $request->all();

            $rule = [
                'number' => 'required',
                'name' => 'required',
                // "file" => "mimes:pdf",
            ];
            $message = [
                "file" => "فرمت فایل اشتباه است",
            ];
            $valid = Validator::make($data, $rule, $message);
            if ($valid->fails()) {
                return redirect()->back()->withErrors($valid)->withInput();
            }

            DB::beginTransaction();
            $course = Course::findOrFail($request->course_id);
            $meeting = new Session();
            $meeting->name = $request->name;
            $meeting->text = $request->text;
            $link = str_replace('http://', '', $request->majazi);
            $link = str_replace('https://', '', $link);
            //            return $link;
            $meeting->majazi = $link;

            $l_link = str_replace('http://', '', $request->link);
            $l_link = str_replace('https://', '', $l_link);
            $meeting->link = $l_link;
            $meeting->number = $request->number;
            $meeting->aparat = $request->aparat;
            $meeting->course_id = $course->id;
            if ($request->active) {
                $meeting->active = '1';
            } else {
                $meeting->active = '0';
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file_name = $request->course_id . "_" . time() . "." . $file->getClientOriginalExtension();
                $destination_path = 'files/session';
                $file->move($destination_path, $file_name);
                $meeting->file = '/' . $file_name;
            }
            $user = Auth::user();

            try {
                $meeting->save();
                DB::commit();
                $result = $this->anetoTrans($user, 25000, 5, 'ایجاد جلسه ' . $course->name);

                return redirect('/dashboard/courses/sessions?course_id=' . $course->id)->with('success', 'محتوای درس جدید با موفقیت بارگذاری شد');
            } catch (\Exception $exception) {

                DB::rollBack();
                return $exception;
                return back()->with('error', 'خطایی در سرور رخ داده است');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $meeting = Session::findOrFail($id);
            $course = Course::find($meeting->course_id);
            return view('management.sessions.edit', compact('meeting', 'course'));
        } else {

            $data = $request->all();
            $rule = [
                'number' => 'required',
                'name' => 'required',
            ];
            $message = [
                "file" => "فرمت فایل اشتباه است",
            ];
            $valid = Validator::make($data, $rule, $message);
            if ($valid->fails()) {
                return redirect()->back()->withErrors($valid)->withInput();
            }

            DB::beginTransaction();

            $meeting = Session::findOrFail($id);
            if (strlen($request->text) > 0)
                $meeting->text = $request->text;
            $meeting->number = $request->number;
            $link = str_replace('http://', '', $request->majazi);
            $link = str_replace('https://', '', $link);
            //            return $link;
            $meeting->aparat = $request->aparat;

            $meeting->majazi = $link;

            $l_link = str_replace('http://', '', $request->link);
            $l_link = str_replace('https://', '', $l_link);
            $meeting->link = $l_link;

            $meeting->name = $request->name;
            //            $meeting->course_id = $meeting->course_id;
            if ($request->active) {
                $meeting->active = '1';
            } else {
                $meeting->active = '0';
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file_name = $meeting->course_id . "_" . time() . "." . $file->getClientOriginalExtension();
                $destination_path = 'files/session';
                $file->move($destination_path, $file_name);
                $meeting->file = '/' . $file_name;
            }

            try {
                $meeting->save();
                DB::commit();
                return redirect('/dashboard/courses/sessions?course_id=' . $meeting->course_id)->with('success', 'با موفقیت بروزرسانی شد');
            } catch (\Exception $exception) {

                DB::rollBack();
                return $exception;
                return back()->with('error', 'خطایی در سرور رخ داده است');
            }
        }
    }

    public function delete($id)
    {
        $session = Session::findOrFail($id);

        $file = 'files/session/' . $session->file;
        if ($session->delete()) {
            if (isset($session->file)) {
                unlink($file);
            }
        }
        return back()->with('success', 'با موفقیت حذف شد');
    }

    public function active($id)
    {

        $session = Session::findOrFail($id);

        if ($session->active == 1) {
            $session->active = 0;
        } else {
            $session->active = 1;
        }

        $session->save();

        return back()->with('success', 'با موفقیت انجام شد');
    }
    public function deleteItem(Request $request)
    {

        $session = Session::findOrFail($request->session_id);

        $session->file = null;
        $session->save();

        return back()->with('success', 'با موفقیت انجام شد');
    }
    public function profEx(Request $request, $id)
    {
        $session = Session::find($id);
        $tamrinha = Exercise::where('session_id', $id)->get();
        foreach ($tamrinha as $item) {
            $answers = ExerciseAnswer::where('exercise_id', $item->id)->get();
            foreach ($answers as $answer) {
                $answer['user'] = User::find($answer->user_id);
            }
            $item['answers'] = $answers;
        }
        return view('management.exercise.list', compact('tamrinha'));
    }

}
