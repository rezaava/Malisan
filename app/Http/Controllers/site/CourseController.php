<?php

namespace App\Http\Controllers\site;

use App\Models\Coworker;
use App\Models\Touradmin;
use App\Models\Touruser;
use App\Models\User;
use App\Models\Amali;
use App\Models\Answer;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Discussion;
use App\Models\Exercise;
use App\Models\ExerciseAnswer;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Role;
use App\Models\Score;
use App\Models\Scoring;
use App\Models\Session;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Facade\FlareClient\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session as DefulSession;

class CourseController extends Controller
{
    //
    public function list()
    {

        $user = Auth::user();
        $content = Coworker::where('user_id', $user->id)->first();
        // $courses = $user->courses()->get();
        if ($user->hasRole('teacher')) {
            $user2 = User::where('national', $user->national)->where('role', 3)->first();
            $courses = $user->courses()->get();
            foreach ($courses as $course) {
                $teacher = $course->users()->where('role_id', '2')->pluck('user_id');
                $course['teacher'] = User::findOrFail($teacher)->first();
            }
        } elseif ($user->hasRole('student')) {
            $user2 = User::where('national', $user->national)->where('role', 2)->first();
            // active درس های فعال
            $courses = $user->courses()->where('active', '1')->get();
            foreach ($courses as $course) {
                $students = $course->users()->where('role_id', '3')->count();
                $course['students'] = $students;
            }
        }
        $mosabeghat = Touruser::where('user_id', $user->id)->count();
        // return $user2;
        return view(
            'melisan.management.courses.index'
            ,
            compact('courses', 'user', 'mosabeghat', 'user2', 'content')
        );
    }
    public function active($id)
    {
        $course = Course::findOrFail($id);
        if ($course->active == 1) {
            $course->active = 0;
        } else {
            $course->active = 1;
        }
        $course->save();
        return redirect()->back()->with('success', ' با موفقیت انجام شد.');
    }
    function arch(Request $request)
    {
        $user = Auth::user();
        $content = Coworker::where('user_id', $user->id)->first();
        $mosabeghat = Touruser::where('user_id', $user->id)->count();

        if ($user->hasRole('teacher')) {
            $user2 = User::where('national', $user->national)->where('role', 3)->first();
        } elseif ($user->hasRole('student')) {
            $user2 = User::where('national', $user->national)->where('role', 2)->first();
        }
        $courses = $user->courses()->where('archieve', 1)->get();


        foreach ($courses as $course) {
            if (!$course->header) {
                $course->header = rand(1, 33);
                $course->save();
            }
            $course['sessions'] = $course->sessions()->count();
            // $course['sessions'] = $sessions;

            // $student_role = Role::where("name", "student")->first();
//    $users = $course->users()->where('role_id', $student_role->id)->count();
// $course['count'] = $users;
// student_role
            $course['count'] = $course->users()->where('role',3)->count();
            // $teacher_role = Role::where("name", "teacher")->pluck('id');
            // teacher_role
            $teacher = $course->users()->where('role',2)->pluck('user_id');
            $course['user'] = User::findOrFail($teacher)->first();
            //  $students = $course->users()->where('role_id', $student_role->id)->orderBy('image', 'desc')->take('5')->get();
            //  $course['students'] = $students;
        }
        //        return $courses;


        if ($user->hasRole('teacher') && $user->hasRole('admin')) {
            return view('melisan.management.courses.index', compact('courses', 'user', 'mosabeghat', 'content', 'user2'))
                ->with([
                    'pageTitle' => 'صفحه لیست دروس',
                    'pageName' => 'دروس',
                    'pageDescription' => 'مدرس عزیز ! لیست دروس شما به شرح زیر میباشد ',
                ]);
        }
        return view('melisan.management.courses.index', compact('courses', 'user', 'mosabeghat', 'content', 'user2'))
            ->with([
                'pageTitle' => 'صفحه لیست دروس',
                'pageName' => 'دروس',
                'pageDescription' => 'دوست من ! لیست درس هاتو برات نمایش دادم',
            ]);

        //        return view('dashboard.course.list', compact('courses'));

    }
    public function archPost($id)
    {
        $course = Course::findOrFail($id);
        if ($course->archieve == 1) {
            $course->archieve = 0;
        } else {
            $course->archieve = 1;
        }
        $course->save();
        return redirect()->back()->with('success', ' با موفقیت انجام شد.');

    }
    public function private($id)
    {
        $course = Course::findOrFail($id);
        if ($course->private == 1) {
            $course->private = 0;
        } else {
            $course->private = 1;
        }
        $course->save();
        return redirect()->back()->with('success', ' با موفقیت انجام شد.');
    }
    public function status($id)
    {
        $course = Course::findOrFail($id);
        if ($course->status == 1) {
            $course->status = 0;
        } else {
            $course->status = 1;
        }
        $course->save();
        return redirect()->back()->with('success', ' با موفقیت انجام شد.');
    }
    public function davari($id)
    {
        $course = Course::findOrFail($id);
        if ($course->davari == 1) {
            $course->davari = 0;
        } else {
            $course->davari = 1;
        }

        $course->save();
        return redirect()->back()->with('success', ' با موفقیت انجام شد.');

    }
    public function quiz($id)
    {
        $course = Course::findOrFail($id);
        if ($course->quiz == 1) {
            $course->quiz = 0;
        } else {
            $course->quiz = 1;
        }
        $course->save();
        return redirect()->back()->with('success', ' با موفقیت انجام شد.');

    }
    public function faaliat($id)
    {
        $course = Course::findOrFail($id);
        if ($course->faaliat == 1) {
            $course->faaliat = 0;
        } else {
            $course->faaliat = 1;
        }
        $course->save();
        return redirect()->back()->with('success', ' با موفقیت انجام شد.');

    }
    public function pishraft($id)
    {
        $course = Course::findOrFail($id);
        if ($course->pishraft == 1) {
            $course->pishraft = 0;
        } else {
            $course->pishraft = 1;
        }
        $course->save();
        return redirect()->back()->with('success', ' با موفقیت انجام شد.');

    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function progress(Request $request)
    {
        // $course = Course::findOrFail($request->course_id);
        $course = Course::findOrFail($request->course_id);
        $setting = Setting::where('course_id', $course->id)->first();
        $scorring = Scoring::where('course_id', $course->id)->first();

        $user = User::findOrFail($request->user);

        $sessions = Session::where('course_id', $course->id)->pluck('id');
        //        $questions=Question::where('user_id',$request->user)->whereIn('session_id',$sessions)->get();
//        return $questions;
        $questions_1 = Question::where('user_id', $request->user)->whereIn('session_id', $sessions)->where('status', '1')->count();
        $questions_2 = Question::where('user_id', $request->user)->whereIn('session_id', $sessions)->where('status', '2')->count();
        $questions_3 = Question::where('user_id', $request->user)->whereIn('session_id', $sessions)->where('status', '3')->count();
        $questions_4 = Question::where('user_id', $request->user)->whereIn('session_id', $sessions)->where('status', '4')->count();
        $questions_all = Question::where('user_id', $request->user)->whereIn('session_id', $sessions)->count();
        $questions['1'] = $questions_1;
        $questions['2'] = $questions_2;
        $questions['3'] = $questions_3;
        $questions['4'] = $questions_4;
        $questions['all'] = $questions_all;
        $q_nomre = (($scorring->q_1 * $questions_1) + ($scorring->q_2 * $questions_2) + ($scorring->q_3 * $questions_3) + ($scorring->q_4 * $questions_4));
        //        $base_q = $setting->tarahi_soal_nomre / ($course->max_session * $setting->min_soal);
//        $q_nomre = $base_q * (($scorring->q_1 * $questions_1) + ($scorring->q_2 * $questions_2) + ($scorring->q_3 * $questions_3) + ($scorring->q_4 * $questions_4));
        $q_nomre = round($q_nomre, 2);
        if ($q_nomre > $setting->tarahi_soal_nomre)
            $q_nomre = $setting->tarahi_soal_nomre;
        $nomre['q'] = $q_nomre;

        $disc_1 = Discussion::where('user_id', $request->user)->whereIn('session_id', $sessions)->where('status', '1')->count();
        $disc_2 = Discussion::where('user_id', $request->user)->whereIn('session_id', $sessions)->where('status', '2')->count();
        $disc_3 = Discussion::where('user_id', $request->user)->whereIn('session_id', $sessions)->where('status', '3')->count();
        $disc_4 = Discussion::where('user_id', $request->user)->whereIn('session_id', $sessions)->where('status', '4')->count();
        $disc_all = Discussion::where('user_id', $request->user)->whereIn('session_id', $sessions)->count();
        $discs['1'] = $disc_1;
        $discs['2'] = $disc_2;
        $discs['3'] = $disc_3;
        $discs['4'] = $disc_4;
        $discs['all'] = $disc_all;

        if ($course->status == 1)
            $max_session = $course->max_session;
        else {
            $max_session = count($sessions);
        }


        $base_d = $setting->ersal_gozaresh_nomre / ($max_session);
        $d_nomre = $base_d * ($scorring->d_1 * $disc_1) + $base_d * ($scorring->d_2 * $disc_2) + $base_d * ($scorring->d_3 * $disc_3) + $base_d * ($scorring->d_4 * $disc_4);
        if ($d_nomre > $setting->ersal_gozaresh_nomre)
            $d_nomre = $setting->ersal_gozaresh_nomre;
        $d_nomre = round($d_nomre, 2);

        $nomre['d'] = $d_nomre;


        $exercises = Exercise::whereIn('session_id', $sessions)->pluck('id');
        $exer_1 = ExerciseAnswer::where('user_id', $request->user)->whereIn('exercise_id', $exercises)->where('status', '1')->count();
        $exer_2 = ExerciseAnswer::where('user_id', $request->user)->whereIn('exercise_id', $exercises)->where('status', '2')->count();
        $exer_3 = ExerciseAnswer::where('user_id', $request->user)->whereIn('exercise_id', $exercises)->where('status', '3')->count();
        $exer_4 = ExerciseAnswer::where('user_id', $request->user)->whereIn('exercise_id', $exercises)->where('status', '4')->count();
        $exer = ExerciseAnswer::where('user_id', $request->user)->whereIn('exercise_id', $exercises)->count();
        $exers['1'] = $exer_1;
        $exers['2'] = $exer_2;
        $exers['3'] = $exer_3;
        $exers['4'] = $exer_4;
        $exers['all'] = $exer;

        //        $base_e = $setting->taklif_seminar_nomre / ($course->max_session);
//        $e_nomre = $base_e * (($scorring->e_1 * $exer_1) + ($scorring->e_2 * $exer_2) + ($scorring->e_3 * $exer_3) + ($scorring->e_4 * $exer_4));
        $e_nomre = (($scorring->e_1 * $exer_1) + ($scorring->e_2 * $exer_2) + ($scorring->e_3 * $exer_3) + ($scorring->e_4 * $exer_4));
        if ($e_nomre > $setting->taklif_seminar_nomre)
            $e_nomre = $setting->taklif_seminar_nomre;
        $e_nomre = round($e_nomre, 2);

        $nomre['e'] = $e_nomre;


        $num_azmoon = Quiz::where('course_id', $course->id)->where('user_id', $request->user)->pluck('id');
        $count_azmoon = count($num_azmoon);
        //        return $count_azmoon;
        $num_q = Answer::whereIn('quiz_id', $num_azmoon)->get();
        $correct = 0;
        foreach ($num_q as $item) {
            $qu = Question::where('id', $item->question_id)->first();
            if ($qu)
                if ($qu->answer == $item->answer)
                    $correct++;
        }
        if ((count($num_q) * $setting->min_w_khod * $max_session) == 0)
            $a = 0;
        else
            $a = ($correct * count($num_azmoon)) / (count($num_q) * $setting->min_w_khod * $max_session);
        if ($a > 1)
            $a = 1;
        //        return "sahih".$correct ."azmonha" .count($num_azmoon)."soalat". count($num_q) . "hadeaghal".$setting->min_w_khod."jalasat".$course->max_session
//            ."kol".$a;
        if ($setting->tarahi_soal_nomre == 0)
            $q = 0;
        else
            $q = $q_nomre / $setting->tarahi_soal_nomre;
        if ($q > 1)
            $q = 1;
        if ($setting->ersal_gozaresh_nomre == 0)
            $r = 0;
        else
            $r = $d_nomre / $setting->ersal_gozaresh_nomre;
        if ($r > 1)
            $r = 1;
        $s = 0;
        if ($setting->taklif_seminar_nomre == 0)
            $h = 0;
        else
            $h = $e_nomre / $setting->taklif_seminar_nomre;
        $c = ($q + $r + $h + $a) / 4;
        if ($c > 1)
            $c = 1;


        $pishraft = ($setting->pishraft_nomre * $c * count($sessions)) / $max_session;
        //        $pishraft = 0;
        $pishraft = round($pishraft, 2);
        if ($pishraft > $setting->pishraft_nomre)
            $pishraft = $setting->pishraft_nomre;
        $nomre['pish'] = $pishraft;


        $at = count($num_azmoon) / ($setting->min_w_khod * $max_session);
        if ($at > 1)
            $at = 1;
        $qt = $questions['all'] / ($setting->min_soal * $max_session);
        if ($qt > 1)
            $qt = 1;

        $rt = $discs['all'] / $max_session;
        if ($rt > 1)
            $rt = 1;
        if ($setting->max_taklif == 0)
            $st = 0;
        else {
            $st = $exers['all'] / $setting->max_taklif;
            if ($st > 1)
                $st = 1;
        }
        $all_q = Question::whereIn('session_id', $sessions)->pluck('id');
        $davari = Score::withTrashed()->whereIn('sub_id', $all_q)->where('type', 1)->where('user_id', $request->user)->get();
        //        return count($davari);
        $dt = count($davari) / ($setting->min_davari * $max_session);
        if ($dt > 1)
            $dt = 1;
        $ct = ($at + $qt + $rt + $st + $dt) / 5;
        $nomre['talash'] = ($setting->talash_nomre * $ct * count($sessions)) / $max_session;

        $nomre['total'] = $pishraft + $d_nomre + $q_nomre + $e_nomre + $nomre['talash'];

        //        return    $pishraft .' '.$d_nomre .' '.$q_nomre .' '.$e_nomre .' '.$nomre['talash'];
//        rotbe




        $final = Amali::where('course_id', $course->id)->where('user_id', $user->id)->where('type', 1)->first();
        if ($final)
            $nomre['final'] = $final->nomre;
        else
            $nomre['final'] = null;

        $all_d = Discussion::whereIn('session_id', $sessions)->pluck('id');

        $davari_gozaresh = Score::withTrashed()->whereIn('sub_id', $all_d)->where('type', 2)->where('user_id', $request->user)->get();



        $davarii['gozaresh'] = $davari_gozaresh->count();
        $davarii['q'] = $davari->count();
        //return $count_azmoon;
//        return $nomre['final'];
        return response()->json(
            [
                'status' => 'ok',
                'message' => 'پیشرفت درسی',
                'course' => $course,
                'questions' => $questions,
                'discs' => $discs,
                'exers' => $exers,
                'setting' => $setting,
                'nomre' => $nomre,
                'count_azmoon' => $count_azmoon,
                'davarii' => $davarii

            ],
            200,
            array('Content-Type' => 'application/json; charset=utf-8'),
            JSON_UNESCAPED_UNICODE
        );

    }

    public function students(Request $request)
    {

        $course = Course::findOrFail($request->course_id);
        $role = Role::where("name", "student")->first();
        $users = $course->users()->where('role_id', $role->id)->orderBy('family', 'asc')->get();

        $setting = Setting::where('course_id', $course->id)->first();

        foreach ($users as $user) {
            $nomre = Amali::where('course_id', $course->id)->where('user_id', $user->id)->where('type', 2)->first();
            if ($nomre)
                $user->nomre = $nomre->nomre;
            else
                $user->nomre = 0;


            $final = Amali::where('course_id', $course->id)->where('user_id', $user->id)->where('type', 1)->first();
            if ($final)
                $user->final = $final->nomre;
            else
                $user->final = 0;
        }
        return response()->json(
            [
                'status' => 'ok',
                'message' => 'لیست دانشجویان',
                'students' => $users,
            ],
            200,
            array('Content-Type' => 'application/json; charset=utf-8'),
            JSON_UNESCAPED_UNICODE
        );

    }

    public function destroyUser(Request $request)
    {

        $user = User::findOrFail($request->u);
        //        return $user;
        $deleted = CourseUser::where('user_id', $request->u)->where('course_id', $request->c)->first();
        $deleted->delete();
        //        $user->courses()->where('course_id',$request->c)->detach();
        // return response()->json(
        //     [
        //         'status' => 'ok',
        //         'message' => 'دانشجو با موفقیت اخراج شد',
        //     ],
        //     200,
        //     array('Content-Type' => 'application/json; charset=utf-8'),
        //     JSON_UNESCAPED_UNICODE
        // );
    }



    public function course(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $teacher_role = Role::where("name", "teacher")->pluck('id');
        $student_role = Role::where("name", "student")->pluck('id');
        $teacher = $course->users()->where('role_id', $teacher_role)->pluck('user_id');
        $course['teacher'] = User::findOrFail($teacher)->first();
        $students = $course->users()->where('role_id', $student_role)->count();
        $course['students'] = $students;

        $sessions = $course->sessions()->get();

        $setting = Setting::where('course_id', $course->id)->first();

        foreach ($sessions as $session) {
            $ex = Exercise::where('session_id', $session->id)->get();
            $session['ex_count'] = count($ex);

        }

        // return response()->json(
        //     [
        //         'status' => 'ok',
        //         'message' => 'درس',
        //         'course' => $course,
        //         'sessions' => $sessions,
        //         'setting' => $setting,
        //     ],
        //     200,
        //     array('Content-Type' => 'application/json; charset=utf-8'),
        //     JSON_UNESCAPED_UNICODE
        // );
        //            }
    }

    public function join($id)
    {

        DB::beginTransaction();
        $user = Auth::user();
        $role = Role::where("name", "student")->first();

        //        $course = Course::find($request->code);
        $course = Course::where('id', $id)->first();
        if ($course) {
            $repeat = $user->courses()->where('course_id', $course->id)->first();

            if ($repeat)
                return redirect()->back()->with('success', 'کلاس تکراری است');
            try {
                $course->users()->attach($user, ['role_id' => $role->id]);
                DB::commit();
                return redirect()->back()->with('success', 'با موفقیت وارد کلاس شدید');

            } catch (\Exception $exception) {
                DB::rollBack();
                return redirect()->back()->with('success', 'خطایی در سرور رخ داده است', );

            }
        }
    }

    public function create(Request $request)
    {
        return $request;
        $data = $request->all();
        $rule = [
            'name' => 'required',
            'max_session' => 'required',
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
        $user = Auth::user();
        $role = Role::where("name", "teacher")->first();
        $code = Str::random(5);
        $uniq = Course::where('code', $code)->first();
        while ($uniq) {
            $code = Str::random(5);
            $uniq = Course::where('code', $code)->first();
        }
        $course = new Course();
        $course->name = $request->name;
        $course->max_session = $request->max_session;
        $course->code = $code;
        try {
            $course->save();
            $setting = new Setting();
            $setting->course_id = $course->id;
            $setting->save();

            $score = new Scoring();
            $score->course_id = $course->id;
            $score->save();

            $course->users()->attach($user, ['role_id' => $role->id]);
            DB::commit();
            return response()->json(
                [
                    'status' => 'ok',
                    'message' => 'با موفقیت ایجاد شد',
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
                    'message' => $exception,
                ],
                200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function sessionCreate(Request $request)
    {
        $data = $request->all();
        $rule = [
            'number' => 'required',
            'name' => 'required',
            "file" => "mimes:pdf"

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
        $course = Course::findOrFail($request->course_id);
        if ($request->session_id)
            $meeting = Session::findOrFail($request->session_id);
        else
            $meeting = new Session();
        $meeting->name = $request->name;
        $meeting->text = $request->text;
        $meeting->majazi = $request->majazi;
        $meeting->link = $request->link;
        $meeting->number = $request->number;
        if (!$request->session_id)
            $meeting->course_id = $course->id;
        if ($request->active)
            $meeting->active = '1';
        else
            $meeting->active = '0';


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = $request->course_id . "_" . time() . "." . $file->getClientOriginalExtension();
            $destination_path = 'files/session';
            $file->move($destination_path, $file_name);
            $meeting->file = '/' . $file_name;
        }

        try {
            $meeting->save();
            DB::commit();
            return response()->json(
                [
                    'status' => 'ok',
                    'message' => 'عمل با موفقیت انجام شد',
                    'session' => $meeting,

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
                    'message' => 'خطایی رخ داده است',
                    'error' => $exception,
                ],
                200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE
            );
        }
    }

    public function showDisc($id)
    {
        $session = Session::findOrFail($id);
        $course = Course::find($session->course_id);
        $discussion = $session->descussions()->where('user_id', Auth::user()->id)->first();

        $setting = Setting::where('course_id', $course->id)->first();
        return response()->json(
            [
                'status' => 'ok',
                'message' => 'جلسه ',
                'disc' => $discussion,
                'help' => $setting->ersal_gozaresh_desc,
            ],
            200,
            array('Content-Type' => 'application/json; charset=utf-8'),
            JSON_UNESCAPED_UNICODE
        );
    }

    public function createDisc(Request $request)
    {
        $data = $request->all();
        $rule = [
            'text' => 'required',

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

        $discussion = $session->descussions()->where('user_id', $user->id)->first();
        if (!$discussion) {
            $discussion = new Discussion();
        }
        $discussion->text = $request->text;
        $discussion->user_id = $user->id;
        $discussion->session_id = $request->session_id;


        try {
            $discussion->save();
            DB::commit();
            return response()->json(
                [
                    'status' => 'ok',
                    'message' => 'با موفقیت درج شد ',
                ],
                200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE
            );
        } catch (\Exception $exception) {

            DB::rollBack();
            return response()->json(
                [
                    'status' => 'ok',
                    'message' => 'خطایی در سرور رخ داده است. ',
                    'error' => $exception,
                ],
                200,
                array('Content-Type' => 'application/json; charset=utf-8'),
                JSON_UNESCAPED_UNICODE
            );
        }
    }
    public function publics(Request $request)
    {
        $user = Auth::user();
        $content = Coworker::where('user_id', $user->id)->first();
        // $courses = $user->courses()->get();
        $mosabeghat = Touruser::where('user_id', $user->id)->count();

        if ($user->hasRole('admin')) {

            $courses = Course::where('private', '1')->get();
        } elseif ($user->hasRole('teacher')) {
            $user2 = User::where('national', $user->national)->where('role', 3)->first();
            $courses = $user->courses()->where('private', '1')->get();
        } elseif ($user->hasRole('student')) {
            $user2 = User::where('national', $user->national)->where('role', 2)->first();
            // $courses = $user->courses()->where('active', '1')->where('private','1')->get();
            $courses = Course::where('active', '1')->where('private', '1')->get();
        }
        $teacher_role = Role::where("name", "teacher")->pluck('id');

        foreach ($courses as $course) {

            $sessions = $course->sessions()->count();
            $course['sessions'] = $sessions;

            $student_role = Role::where("name", "student")->first();
            $users = $course->users()->where('role_id', $student_role->id)->count();
            $course['count'] = $users;

            $teacher = $course->users()->where('role_id', $teacher_role)->pluck('user_id');
            $course['user'] = User::findOrFail($teacher)->first();

            if ($course->type == 1)
                $course['type_name'] = "آموزش زبان";
            elseif ($course->type == 2)
                $course['type_name'] = "مهارت آموزی";
            elseif ($course->type == 3)
                $course['type_name'] = "آزمون های بسندگی";
            elseif ($course->type == 4)
                $course['type_name'] = "هنرآموزی";
            elseif ($course->type == 5)
                $course['type_name'] = "اموزش های عمومی";
            else
                $course['type_name'] = "نامشخص";


            $cu = CourseUser::where('course_id', $course->id)->where('user_id', $user->id)->first();
            if ($cu) {
                $now = Carbon::now();
                $time = $cu->created_at;
                $time = Carbon::parse($time);
                $diff = $time->diffInDays($now);
                $count = $course->sessions()->where('active', '1')->orderBy('number', 'desc')->count();
                $activated = floor($diff / $course->period) - 1;
                // $course['activated']=floor(( $activated / $count ) * 100);   
                if ($course['activated'] > 100)
                    $course['activated'] = 1;
            } else
                $course['activated'] = 0;

        }
        //        return $courses;
        return view('melisan.management.courses.students.publics', compact('courses', 'user', 'mosabeghat', 'user2', 'content'))
            ->with([
                'pageTitle' => 'صفحه لیست دروس',
                'pageName' => 'دروس',
                'pageDescription' => 'دوست من ! لیست درس هاتو برات نمایش دادم',
            ]);
    }


}
