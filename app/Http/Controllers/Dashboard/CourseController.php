<?php

namespace App\Http\Controllers\Dashboard;

use App\Amali;
use App\Answer;
use App\Course;
use App\CourseUser;
use App\Discussion;
use App\Exercise;
use Carbon\Carbon;

use App\ExerciseAnswer;
use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Question;
use App\Quiz;
use App\Role;
use App\Score;
use App\Scoring;
use App\Session;
use App\Setting;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;
use SebastianBergmann\CodeCoverage\TestFixture\C;
use Validator;

class CourseController extends Controller
{
    //

    public function allProgress(Request $request)
    {
        $my=Auth::user();
        $course=Course::find($request->course_id);
        $sessions=Session::where('course_id',$course->id)->pluck('id');
        $role = Role::where("name", "student")->first();
        $users = $course->users()->where('role_id', $role->id)->orderBy('family', 'asc')->get();
        foreach ($users as $user) {
            $user['disc']=Discussion::where('user_id',$user->id)->whereIn('session_id',$sessions)->count();
            $user['disc_new']=Discussion::where('created_at', '>=', Carbon::now()->subDays(3))->where('user_id',$user->id)->whereIn('session_id',$sessions)->count();
            $exers=Exercise::whereIn('session_id',$sessions)->pluck('id');
            $user['exer']=ExerciseAnswer::where('user_id',$user->id)->whereIn('exercise_id',$exers)->count();
            $user['exer_new']=ExerciseAnswer::where('created_at', '>=', Carbon::now()->subDays(3))->where('user_id',$user->id)->whereIn('exercise_id',$exers)->count();
            $user['questions']=Question::where('user_id',$user->id)->whereIn('session_id',$sessions)->count();
            $user['questions_new']=Question::where('created_at', '>=', Carbon::now()->subDays(3))->where('user_id',$user->id)->whereIn('session_id',$sessions)->count();

            $all_d = Discussion::whereIn('session_id', $sessions)->pluck('id');
            $davari_gozaresh = Score::withTrashed()->whereIn('sub_id', $all_d)->where('type', 2)->where('user_id', $user->id)->get();
            $davari_gozaresh_new = Score::where('created_at', '>=', Carbon::now()->subDays(3))->withTrashed()->whereIn('sub_id', $all_d)->where('type', 2)->where('user_id', $user->id)->get();
            $all_q = Question::whereIn('session_id', $sessions)->pluck('id');
            $davari = Score::withTrashed()->whereIn('sub_id', $all_q)->where('type', 1)->where('user_id', $user->id)->get();
            $davari_new = Score::where('created_at', '>=', Carbon::now()->subDays(3))->withTrashed()->whereIn('sub_id', $all_q)->where('type', 1)->where('user_id', $user->id)->get();
            $user['davari']=$davari_gozaresh->count()+ $davari->count();
            $user['davari_new']=$davari_gozaresh_new->count()+ $davari_new->count();



            $user['khod_new']=Quiz::where('course_id',$course->id)->where('user_id',$user->id)->where('created_at', '>=', Carbon::now()->subDays(3))->count();

            if ($user->isOnline()) {
                $user->online = 1;
            } else {
                $user->online = 0;
            }


        }
        return view('management.courses.teachers.allprogress', compact('users','course'))
            ->with([
                'pageTitle' => 'صفحه دانشجویان',
                'pageName' => 'دانشجویان',
                'pageDescription' => 'لیست....',
            ]);

    }

    public function publics(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {

            $courses = Course::where('private','1')->get();
        } elseif ($user->hasRole('teacher')) {

            $courses = $user->courses()->where('private','1')->get();
        } elseif ($user->hasRole('student')) {

            // $courses = $user->courses()->where('active', '1')->where('private','1')->get();
            $courses = Course::where('active', '1')->where('private','1')->get();
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

            if($course->type==1)
                $course['type_name']="آموزش زبان";
            elseif($course->type==2)
                $course['type_name']="مهارت آموزی";
            elseif($course->type==3)
                $course['type_name']="آزمون های بسندگی";
            elseif($course->type==4)
                $course['type_name']="هنرآموزی";
            elseif($course->type==5)
                $course['type_name']="اموزش های عمومی";
            else
                $course['type_name']="نامشخص";


            $cu = CourseUser::where('course_id', $course->id)->where('user_id', $user->id)->first();
            if($cu) {
                $now = Carbon::now();
                $time = $cu->created_at;
                $time = Carbon::parse($time);
                $diff = $time->diffInDays($now);
                $count = $course->sessions()->where('active', '1')->orderBy('number', 'desc')->count();
                $activated = floor($diff / $course->period) - 1;
                $course['activated']=floor(($activated/$count)*100);
                if($course['activated']>100)
                    $course['activated']=1;
            }else
                $course['activated']=0;



        }
//        return $courses;
        return view('management.courses.students.publics', compact('courses'))
            ->with([
                'pageTitle' => 'صفحه لیست دروس',
                'pageName' => 'دروس',
                'pageDescription' => 'دوست من ! لیست درس هاتو برات نمایش دادم',
            ]);
    }

    public function nomreha(Request $request, Excel $excel)
    {

        $course = Course::findOrFail($request->crs);
        $role = Role::where("name", "student")->first();
        $users = $course->users()->where('role_id', $role->id)->orderBy('family', 'asc')->get();
        $setting = Setting::where('course_id', $course->id)->first();
        $scorring = Scoring::where('course_id', $course->id)->first();
        $sessions = Session::where('course_id', $course->id)->pluck('id');

        //nomre
        foreach ($users as $user) {
            $questions_1 = Question::where('user_id', $user->id)->whereIn('session_id', $sessions)->where('status', '1')->count();
            $questions_2 = Question::where('user_id', $user->id)->whereIn('session_id', $sessions)->where('status', '2')->count();
            $questions_3 = Question::where('user_id', $user->id)->whereIn('session_id', $sessions)->where('status', '3')->count();
            $questions_4 = Question::where('user_id', $user->id)->whereIn('session_id', $sessions)->where('status', '4')->count();
            $questions_all = Question::where('user_id', $user->id)->whereIn('session_id', $sessions)->count();
            $questions['1'] = $questions_1;
            $questions['2'] = $questions_2;
            $questions['3'] = $questions_3;
            $questions['4'] = $questions_4;
            $questions['all'] = $questions_all;
            $q_nomre = (($scorring->q_1 * $questions_1) + ($scorring->q_2 * $questions_2) + ($scorring->q_3 * $questions_3) + ($scorring->q_4 * $questions_4));
            $q_nomre = round($q_nomre, 2);
            if ($q_nomre > $setting->tarahi_soal_nomre) {
                $q_nomre = $setting->tarahi_soal_nomre;
            }

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

            if ($course->status == 1) {
                $max_session = $course->max_session;
            } else {
                $max_session = count($sessions);
            }

            $base_d = $setting->ersal_gozaresh_nomre / ($max_session);
            $d_nomre = $base_d * ($scorring->d_1 * $disc_1) + $base_d * ($scorring->d_2 * $disc_2) + $base_d * ($scorring->d_3 * $disc_3) + $base_d * ($scorring->d_4 * $disc_4);
            if ($d_nomre > $setting->ersal_gozaresh_nomre) {
                $d_nomre = $setting->ersal_gozaresh_nomre;
            }

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

            $e_nomre = (($scorring->e_1 * $exer_1) + ($scorring->e_2 * $exer_2) + ($scorring->e_3 * $exer_3) + ($scorring->e_4 * $exer_4));
            if ($e_nomre > $setting->taklif_seminar_nomre) {
                $e_nomre = $setting->taklif_seminar_nomre;
            }

            $e_nomre = round($e_nomre, 2);

            $nomre['e'] = $e_nomre;

            $num_azmoon = Quiz::where('course_id', $course->id)->where('user_id', $request->user)->pluck('id');
            $count_azmoon = count($num_azmoon);
//        return $count_azmoon;
            $num_q = Answer::whereIn('quiz_id', $num_azmoon)->get();
            $correct = 0;
            foreach ($num_q as $item) {
                $qu = Question::where('id', $item->question_id)->first();
                if ($qu) {
                    if ($qu->answer == $item->answer) {
                        $correct++;
                    }
                }

            }
            if ((count($num_q) * $setting->min_w_khod * $max_session) == 0) {
                $a = 0;
            } else {
                $a = ($correct * count($num_azmoon)) / (count($num_q) * $setting->min_w_khod * $max_session);
            }

            if ($a > 1) {
                $a = 1;
            }

//        return "sahih".$correct ."azmonha" .count($num_azmoon)."soalat". count($num_q) . "hadeaghal".$setting->min_w_khod."jalasat".$course->max_session
            //            ."kol".$a;
            if ($setting->tarahi_soal_nomre == 0) {
                $q = o;
            } else {
                $q = $q_nomre / $setting->tarahi_soal_nomre;
            }

            if ($q > 1) {
                $q = 1;
            }

            if ($setting->ersal_gozaresh_nomre == 0) {
                $r = 0;
            } else {
                $r = $d_nomre / $setting->ersal_gozaresh_nomre;
            }

            if ($r > 1) {
                $r = 1;
            }

            $s = 0;
            if ($setting->taklif_seminar_nomre == 0) {
                $h = 0;
            } else {
                $h = $e_nomre / $setting->taklif_seminar_nomre;
            }

            $c = ($q + $r + $h + $a) / 4;
            if ($c > 1) {
                $c = 1;
            }

            $pishraft = ($setting->pishraft_nomre * $c * count($sessions)) / $max_session;
//        $pishraft = 0;
            $pishraft = round($pishraft, 2);
            if ($pishraft > $setting->pishraft_nomre) {
                $pishraft = $setting->pishraft_nomre;
            }

            $nomre['pish'] = $pishraft;

            $at = count($num_azmoon) / ($setting->min_w_khod * $max_session);
            if ($at > 1) {
                $at = 1;
            }

            $qt = $questions['all'] / ($setting->min_soal * $max_session);
            if ($qt > 1) {
                $qt = 1;
            }

            $rt = $discs['all'] / $max_session;
            if ($rt > 1) {
                $rt = 1;
            }

            if ($setting->max_taklif == 0) {
                $st = 0;
            } else {
                $st = $exers['all'] / $setting->max_taklif;
                if ($st > 1) {
                    $st = 1;
                }

            }
            $all_q = Question::whereIn('session_id', $sessions)->pluck('id');
            $davari = Score::withTrashed()->whereIn('sub_id', $all_q)->where('type', 1)->where('user_id', $request->user)->get();
//        return count($davari);
            $dt = count($davari) / ($setting->min_davari * $max_session);
            if ($dt > 1) {
                $dt = 1;
            }

            $ct = ($at + $qt + $rt + $st + $dt) / 5;
            $nomre['talash'] = ($setting->talash_nomre * $ct * count($sessions)) / $max_session;

            $nomre['total'] = $pishraft + $d_nomre + $q_nomre + $e_nomre + $nomre['talash'];

//        rotbe

            $final = Amali::where('course_id', $course->id)->where('user_id', $user->id)->where('type', 1)->first();
            if ($final) {
                $nomre['final'] = $final->nomre;
            } else {
                $nomre['final'] = null;
            }

            $all_d = Discussion::whereIn('session_id', $sessions)->pluck('id');

            $davari_gozaresh = Score::withTrashed()->whereIn('sub_id', $all_d)->where('type', 2)->where('user_id', $request->user)->get();

            $davarii['gozaresh'] = $davari_gozaresh->count();
            $davarii['q'] = $davari->count();

            $user['q_1'] = $questions_1;
            $user['q_2'] = $questions_2;
            $user['q_3'] = $questions_3;
            $user['q_4'] = $questions_4;
            $user['q_all'] = $questions_all;
            $user['q_nomre'] = $q_nomre;

            $user['disc_1'] = $disc_1;
            $user['disc_2'] = $disc_2;
            $user['disc_3'] = $disc_3;
            $user['disc_4'] = $disc_4;
            $user['disc_all'] = $disc_all;
            $user['disc_nomre'] = $d_nomre;

            $user['exers_all'] = $exer;
            $user['exers_1'] = $exer_1;
            $user['exers_2'] = $exer_2;
            $user['exers_3'] = $exer_3;
            $user['exers_4'] = $exer_4;
            $user['exers_nomre'] = $e_nomre;

            $user['pish_nomre'] = $nomre['pish'];

            $user['count_azmoon'] = $count_azmoon;

            $user['talash_nomre'] = round(($nomre['talash']), 2);
            $user['davari_q'] = $davarii['q'];
            $user['davari_d'] = $davarii['gozaresh'];

            $user['mostamar'] = round((($nomre['total'] / 5) + $setting->erfagh_nomre), 2);
            $user['tashvighi'] = $setting->erfagh_nomre;
            $user['final'] = round(($nomre['total'] / 5) + $setting->erfagh_nomre + (($setting->final_nomre * $nomre['final'] / 20) / 5), 2);

        }

//

        session()->put("crs", $request->crs);
        return $excel->download(new StudentsExport, "نمرات.xlsx");

        session()->forget("crs");
        return "DONE";
    }

    public function test(Request $request)
    {
        return $this->sms("ok", "09133934677");
    }

    public function sms($msg, $rec)
    {

        $client = new \GuzzleHttp\Client();
        $token = $msg;
        $reciever = $rec;
        $url = 'https://api.kavenegar.com/v1/4D68334756567946623268746B364C747430764D78426D437935475A34594A3146492B4B5949684E61546F3D/verify/lookup.json?receptor=' . $reciever . '&token=' . $token . '&template=active';
        $request = $client->get($url);
        $response = $request->getBody();
        return $response;

    }

    function arch(Request $request)
    {
        $user = Auth::user();

//        if($user->hasRole('student')) {
        //            $newChat = Chat::where('student_id', $user->id)->where('seen', 0)->get();
        //        }else
        //        {
        //            $courses = $user->courses()->pluck('course_id');
        //            $newChat=Chat::whereIn('course_id',$courses)->where('seen', 0)->get();
        //        }
        //
        //        return count($newChat);

        // if ($user->hasRole('admin')) {

        //     $courses = Course::all();
        // } elseif ($user->hasRole('teacher')) {
            $courses = $user->courses()->where('archieve',1)->get();
        // } elseif ($user->hasRole('student')) {
            // if ($request->code) {
            //     if ($request->code == $user->sms) {
            //         $user->active = 1;
            //         $user->save();
            //     }
            // }
            // if ($user->active == 0 || !$user->mobile) {
            //     if ($user->mobile) {

            //         $user->sms = rand(1111, 9999);
            //         $user->save();
            //         $this->sms($user->sms, $user->mobile);
            //     }

            //     return view('management.courses.students.index', compact('user'))
            //         ->with([
            //             'pageTitle' => 'صفحه لیست دروس',
            //             'pageName' => 'دروس',
            //             'pageDescription' => 'دوست من ! لطفا حسابتو تکمیل و فعال کن',
            //         ]);
            // }
        //     $courses = $user->courses()->where('active', '1')->get();
        // }
        $teacher_role = Role::where("name", "teacher")->pluck('id');

        foreach ($courses as $course) {
 if(!$course->header){
                $course->header=rand(1,33);
                $course->save();
            }
            $sessions = $course->sessions()->count();
            $course['sessions'] = $sessions;

            $student_role = Role::where("name", "student")->first();
            $users = $course->users()->where('role_id', $student_role->id)->count();
            $course['count'] = $users;

            $teacher = $course->users()->where('role_id', $teacher_role)->pluck('user_id');
            $course['user'] = User::findOrFail($teacher)->first();


//            $students = $course->users()->where('role_id', $student_role->id)->orderBy('image', 'desc')->take('5')->get();

//            $course['students'] = $students;

        }
//        return $courses;


        if ($user->hasRole('teacher') && $user->hasRole('admin')) {
            return view('management.courses.teachers.index', compact('courses'))
                ->with([
                    'pageTitle' => 'صفحه لیست دروس',
                    'pageName' => 'دروس',
                    'pageDescription' => 'مدرس عزیز ! لیست دروس شما به شرح زیر میباشد ',
                ]);
        }
        return view('management.courses.students.index', compact('courses'))
            ->with([
                'pageTitle' => 'صفحه لیست دروس',
                'pageName' => 'دروس',
                'pageDescription' => 'دوست من ! لیست درس هاتو برات نمایش دادم',
            ]);

//        return view('dashboard.course.list', compact('courses'));

    }

     function list(Request $request)
    {
        $user = Auth::user();

//        if($user->hasRole('student')) {
        //            $newChat = Chat::where('student_id', $user->id)->where('seen', 0)->get();
        //        }else
        //        {
        //            $courses = $user->courses()->pluck('course_id');
        //            $newChat=Chat::whereIn('course_id',$courses)->where('seen', 0)->get();
        //        }
        //
        //        return count($newChat);

        if ($user->hasRole('admin')) {

            $courses = Course::all();
        } elseif ($user->hasRole('teacher')) {
            $courses = $user->courses()->where('archieve',0)->get();
        } elseif ($user->hasRole('student')) {
            // if ($request->code) {
            //     if ($request->code == $user->sms) {
            //         $user->active = 1;
            //         $user->save();
            //     }
            // }
            // if ($user->active == 0 || !$user->mobile) {
            //     if ($user->mobile) {

            //         $user->sms = rand(1111, 9999);
            //         $user->save();
            //         $this->sms($user->sms, $user->mobile);
            //     }

            //     return view('management.courses.students.index', compact('user'))
            //         ->with([
            //             'pageTitle' => 'صفحه لیست دروس',
            //             'pageName' => 'دروس',
            //             'pageDescription' => 'دوست من ! لطفا حسابتو تکمیل و فعال کن',
            //         ]);
            // }
            $courses = $user->courses()->where('active', '1')->get();
        }
        $teacher_role = Role::where("name", "teacher")->pluck('id');

        foreach ($courses as $course) {
 if(!$course->header){
                $course->header=rand(1,33);
                $course->save();
            }
            $sessions = $course->sessions()->count();
            $course['sessions'] = $sessions;

            $student_role = Role::where("name", "student")->first();
            $users = $course->users()->where('role_id', $student_role->id)->count();
            $course['count'] = $users;

            $teacher = $course->users()->where('role_id', $teacher_role)->pluck('user_id');
            $course['user'] = User::findOrFail($teacher)->first();


//            $students = $course->users()->where('role_id', $student_role->id)->orderBy('image', 'desc')->take('5')->get();

//            $course['students'] = $students;

        }
//        return $courses;


        if ($user->hasRole('teacher') && $user->hasRole('admin')) {
            return view('management.courses.teachers.index', compact('courses'))
                ->with([
                    'pageTitle' => 'صفحه لیست دروس',
                    'pageName' => 'دروس',
                    'pageDescription' => 'مدرس عزیز ! لیست دروس شما به شرح زیر میباشد ',
                ]);
        }
        return view('management.courses.students.index', compact('courses'))
            ->with([
                'pageTitle' => 'صفحه لیست دروس',
                'pageName' => 'دروس',
                'pageDescription' => 'دوست من ! لیست درس هاتو برات نمایش دادم',
            ]);

//        return view('dashboard.course.list', compact('courses'));

    }

    public function edit(Request $request)
    {
        if ($request->isMethod("get")) {
            $course = Course::findOrFail($request->id);
            $user = Auth::user();
            $teacher = CourseUser::where('user_id', $user->id)->where('course_id', $course->id)->where('role_id', '2')->first();
            if (!$teacher) {
                return back()->with('error', 'شما مجاز نیستید');
            }

            return view('management.courses.teachers.edit', compact('course'))
                ->with([
                    'pageTitle' => 'صفحه ویرایش درس',
                    'pageName' => 'ویرایش درس',
                    'pageDescription' => 'مدرس گرامی ! برای ویرایش درس خود فرم زیر را تکمیل نمایید',
                ]);;
        } elseif ($request->isMethod("post")) {
            $valid = Validator::make($request->all(), [
                'name' => 'required',
//                'max_session' => 'required',
                //                'code'=>'required|unique:courses',
            ]);
            if ($valid->fails()) {
                return back()->withErrors($valid);
            }
            DB::beginTransaction();
            $user = Auth::user();
            $role = Role::where("name", "teacher")->first();
            $course = Course::findOrFail($request->id);
            $course->name = $request->name;
            $link = str_replace('http://', '', $request->majazi);
            $link = str_replace('https://', '', $link);
//            return $link;
            $course->majazi = $link;
//            $course->max_session = $request->max_session;
            try {
                $course->save();
                DB::commit();
                return redirect("/dashboard/courses/sessions?course_id=$course->id")->with('success', ' درس با موفقیت ویرایش شد');
            } catch (\Exception $exception) {

                DB::rollBack();
                return $exception;
                return back()->with('error', 'خطایی در سرور رخ داده است');
            }
        }
    }

    public function create(Request $request)
    {
        if ($request->isMethod("get")) {
            $old = null;
            if ($request->copy) {
                $old = Course::find($request->copy);
            }
            return view('management.courses.teachers.create', compact('old'))->with([
                'pageTitle' => 'صفحه ایجاد دروس',
                'pageName' => 'ایجاد درس',
                'pageDescription' => 'مدرس گرامی! برای ایجاد درس جدید لطفا فرم زیرا را تکمیل نمایید',
            ]);
        } elseif ($request->isMethod("post")) {

            $valid = Validator::make($request->all(), [
                'name' => 'required',
//                'max_session' => 'required',
                //                'code'=>'required|unique:courses',
            ]);
            if ($valid->fails()) {
                return back()->withErrors($valid);
            }
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
            $link = str_replace('http://', '', $request->majazi);
            $link = str_replace('https://', '', $link);
//            return $link;
            $course->majazi = $link;
            $course->max_session = 16;
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

//                copy
                if ($request->copy) {
                    $old = Course::find($request->copy);
                    $sessions = Session::where('course_id', $old->id)->orderBy('id', 'asc')->get();
                    $i = 0;
                    foreach ($sessions as $session) {
                        $ss = new Session();

                        $ss->course_id = $course->id;
                        $ss->text = $session->text;
                        $ss->file = $session->file;
                        $ss->link = $session->link;
                        $ss->majazi = $session->majazi;
                        if ($i == 0)
                            $ss->active = 1;
                        else
                            $ss->active = 0;
                        $i++;
                        $ss->number = $session->number;
                        $ss->name = $session->name;
                        $ss->save();
                    }
                }
//                endcopy
                DB::commit();
                // return "sa";
                $result=$this->anetoTrans($user,50000,5,'ایجاد درس '.$course->name);
                // return $result;
                $msg = "دانشجوی عزیز، برای دسترسی به درس " . $course->name . " ابتدا از طریق سایت WWW.MALISAN.IR در سامانه آموزشی ملیسان با هویت واقعی ثبت نام کنید، سپس با استفاده از شناسه " . $course->code . " در درس ذکر شده عضو شوید.";
                return redirect('/dashboard/courses/list')->with('success', $msg);
//                return redirect('/dashboard/courses/list')->with('success', ' درس ' . $request->name . ' با شناسه' . $request->code)->with('crete', "ok");
            } catch (\Exception $exception) {

                DB::rollBack();
                return $exception;
                return back()->with('error', 'خطایی در سرور رخ داده است');
            }
        }
    }

    public function update(Request $request, $id)
    {

        $course = Course::findOrFail($id);
//            dd($course);
        if (isset($request->name)) {
            $valid = Validator::make($request->all(), [
                'name' => 'required',
//                'code' => 'required|unique:courses,code,'.$course->id,
            ]);
            if ($valid->fails()) {
                return back()->withErrors($valid);
            }
            $course->name = $request->name;

        } else {
            $valid = Validator::make($request->all(), [
                'code' => 'required|unique:courses,code,' . $course->id,
            ]);
            if ($valid->fails()) {
                return back()->withErrors($valid);
            }
            $course->code = $request->code;
        }

//            $course->code=$request->code;

        try {
            $course->save();
            return redirect('dashboard/courses/list')->with('success', 'با موفقیت بروزرسانی شد');
        } catch (\Exception $exception) {

            DB::rollBack();
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }

    }

    public function join(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('management.courses.students.create')
                ->with([
                    'pageTitle' => 'عضویت در کلاس',
                    'pageName' => 'عضویت در کلاس',
                    'pageDescription' => 'دوست من ! لیست درس هاتو برات نمایش دادم',
                ]);
        }
        $valid = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        DB::beginTransaction();
        $user = Auth::user();
        $role = Role::where("name", "student")->first();

//        $course = Course::find($request->code);
        $course = Course::where('code', $request->code)->first();
        if ($course) {
            $repeat = $user->courses()->where('course_id', $course->id)->first();

            if ($repeat) {
                return back()->with('error', 'کلاس تکراری است');
            }

            try {
                $course->users()->attach($user, ['role_id' => $role->id]);
                DB::commit();
                $result=$this->anetoTrans($user,2000,5,'ورود درس '.$course->name);

                return redirect('/dashboard/courses/list')->with('success', 'با موفقیت اضافه شد');
            } catch (\Exception $exception) {

                DB::rollBack();
                return back()->with('error', 'خطایی در سرور رخ داده است');
            }
        }
        return redirect('/dashboard')->with('error', 'شناسه درس وارد شده نا معتبر است');

    }

    public function students(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $role = Role::where("name", "student")->first();
        $users = $course->users()->where('role_id', $role->id)->orderBy('family', 'asc')->get();

        $setting = Setting::where('course_id', $course->id)->first();

        foreach ($users as $user) {
            $nomre = Amali::where('course_id', $course->id)->where('user_id', $user->id)->where('type', 2)->first();
            if ($nomre) {
                $user->nomre = $nomre->nomre;
            } else {
                $user->nomre = 0;
            }

            $final = Amali::where('course_id', $course->id)->where('user_id', $user->id)->where('type', 1)->first();
            if ($final) {
                $user->final = $final->nomre;
            } else {
                $user->final = 0;
            }

            if ($user->isOnline()) {
                $user->online = 1;
            } else {
                $user->online = 0;
            }

        }
        return view('management.courses.teachers.students', compact('users', 'course', 'setting'))->with([
            'pageTitle' => 'صفحه دانشجویان دروس',
            'pageName' => 'دانشجویان درس',
            'pageDescription' => 'مدرس گرامی ! لیست دانشجو های شما به شرح زیر می باشد',
        ]);
//        return view('dashboard.course.students', compact('users', 'course'));
    }

    public function destroyUser(Request $request)
    {

        $user = User::findOrFail($request->u);
//        return $user;
        $deleted = CourseUser::where('user_id', $request->u)->where('course_id', $request->c)->first();
        $deleted->delete();
//        $user->courses()->where('course_id',$request->c)->detach();
        return back()->with('success', 'دانشجو با موفقیت اخراج شد');

    }

    public function delete(Request $request, $id)
    {
        $course = Course::findOrfail($id);
        $course->delete();
        return redirect()->route('course.list')->with('success', 'حذف با موفقیت انجام شد.');

    }

    public function period(Request $request, $id)
    {
        $course = Course::findOrfail($id);
        $course->period = $request->days;
        $course->type = $request->type;
        $course->desc = $request->desc;
        $course->price = $request->price;
        $course->length = $request->length;
        $course->sessions_length = $request->sessions;
        $course->save();
        return back()->with('success', ' با موفقیت ویرایش شد');

    }

    public function setting(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $setting = $course->setting()->first();
        if (!$setting) {
            $setting = new Setting();
            $setting->course_id = $course->id;
            $setting->save();
        }
        $setting = $course->setting()->first();

        $scoring = Scoring::where('course_id', $course->id)->first();
        if (!$scoring) {
            $scoring = new Scoring();
            $scoring->course_id = $course->id;
            $scoring->save();
        }
        $scoring = Scoring::where('course_id', $course->id)->first();

        return view('management.settings.index', compact('course', 'setting', 'scoring'))->with([
            'pageTitle' => 'صفحه تنظیمات',
            'pageName' => 'تنظیمات',
            'pageDescription' => 'مدرس گرامی ! صفحه تنظیمات در اختیار شماست',
        ]);
    }

    public function editSetting(Request $request)
    {
        if ($request->course_id == 99999) {
            $scores = Scoring::all();
            foreach ($scores as $score) {
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

                $settings = Setting::all();
                foreach ($settings as $setting) {
                    $setting->taklif_seminar_desc = $request->taklif_seminar_desc;
                    $setting->taklif_seminar_type = $request->taklif_seminar_type;
                    $setting->quiz_mid_nomre = $request->quiz_mid_nomre;
                    $setting->quiz_mid_desc = $request->quiz_mid_desc;
                    $setting->quiz_mid_type = $request->quiz_mid_type;
                    $setting->pishraft_nomre = $request->pishraft_nomre;
                    $setting->pishraft_desc = $request->pishraft_desc;
                    $setting->talash_nomre = $request->talash_nomre;
                    $setting->talash_desc = $request->talash_desc;
                    $setting->hozor_nomre = $request->hozor_nomre;
                    $setting->hozor_desc = $request->hozor_desc;
                    $setting->amali_nomre = $request->amali_nomre;
                    $setting->amali_desc = $request->amali_desc;
                    $setting->final_nomre = $request->final_nomre;
                    $setting->final_desc = $request->final_desc;
                    $setting->erfagh_nomre = $request->erfagh_nomre;
                    $setting->erfagh_desc = $request->erfagh_desc;
                    $setting->min_davari = $request->min_davari;

                    $setting->save();
                }

            }
            return back()->with('success', 'با موفقیت ویرایش شد');
        }


        $course = Course::findOrFail($request->course_id);

        //score
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

        //setting
        $setting = $course->setting()->first();
//        return $request;
        $setting->tarahi_soal_nomre = $request->tarahi_soal_nomre;
        $setting->tarahi_soal_desc = $request->tarahi_soal_desc;
        $setting->mostamar_nomre = $request->mostamar_nomre;
        $setting->jalasat = $request->jalasat;

        $setting->ersal_gozaresh_desc = $request->ersal_gozaresh_desc;
        $setting->azmon_nomre = $request->azmon_nomre;
        $setting->taklif_seminar_nomre = $request->taklif_seminar_nomre;
        $setting->ersal_gozaresh_nomre = $request->ersal_gozaresh_nomre;
//        $setting->taklif_seminar_desc = $request->taklif_seminar_desc;
//        $setting->taklif_seminar_type = $request->taklif_seminar_type;
//        $setting->quiz_mid_nomre = $request->quiz_mid_nomre;
//        $setting->quiz_mid_desc = $request->quiz_mid_desc;
//        $setting->quiz_mid_type = $request->quiz_mid_type;
//        $setting->pishraft_nomre = $request->pishraft_nomre;
//        $setting->pishraft_desc = $request->pishraft_desc;
//        $setting->talash_nomre = $request->talash_nomre;
//        $setting->talash_desc = $request->talash_desc;
//        $setting->hozor_nomre = $request->hozor_nomre;
//        $setting->hozor_desc = $request->hozor_desc;
//        $setting->amali_nomre = $request->amali_nomre;
//        $setting->amali_desc = $request->amali_desc;
//        $setting->final_nomre = $request->final_nomre;
//        $setting->final_desc = $request->final_desc;
//        $setting->erfagh_nomre = $request->erfagh_nomre;
//        $setting->erfagh_desc = $request->erfagh_desc;


        if ($request->soal_last) {
            $setting->soal_last = '1';
        } else {
            $setting->soal_last = '0';
        }

        if ($request->gozaresh_last) {
            $setting->gozaresh_last = '1';
        } else {
            $setting->gozaresh_last = '0';
        }

        if ($request->taklif_last) {
            $setting->taklif_last = '1';
        } else {
            $setting->taklif_last = '0';
        }

        $setting->max_soal = $request->max_soal;
//        $setting->min_soal = $request->min_soal;
        $setting->max_taklif = $request->max_taklif;
        $setting->max_seminar = $request->max_seminar;
//        $setting->max_gozaresh = $request->max_gozaresh;
//        $setting->max_gheibat = $request->max_gheibat;
//        $setting->min_davari = $request->min_davari;

        $setting->min_w_khod = $request->min_w_khod;
        $setting->q_num = $request->q_num;
        $setting->sath_khod = $request->sath_khod;
        if ($request->show_khod) {
            $setting->show_khod = 1;
        } else {
            $setting->show_khod = 0;
        }

        $setting->quiz_num = $request->quiz_num;
        $setting->sath_quiz = $request->sath_quiz;
        if ($request->natije) {
            $setting->natije = 1;
        } else {
            $setting->natije = 0;
        }

        if ($request->show_quiz) {
            $setting->show_quiz = 1;
        } else {
            $setting->show_quiz = 0;
        }

        $setting->save();
        return back()->with('success', 'با موفقیت ویرایش شد');
    }

    public function progress(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        $setting = Setting::where('course_id', $course->id)->first();
        $scorring = Scoring::where('course_id', $course->id)->first();

        $user = User::findOrFail($request->user);
        if ((Auth::user()->hasRole('student') && ($user != Auth::user()))) {
            return redirect()->back()->with('success', 'شما مجاز نیستید.....');
        }

        $sessions = Session::where('course_id', $course->id)->pluck('id');
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
        $q_scores=0;
        foreach(Question::where('user_id', $request->user)->whereIn('session_id', $sessions)->get() as $qq){
            $q_scores+=$qq->score;
        }
        if($questions_all!=0)
        $q_scores=$q_scores/($questions_all*(20/25));
        else
        $q_scores=0;
        $q_nomre = (($scorring->q_1 * $questions_1) + ($scorring->q_2 * $questions_2) + ($scorring->q_3 * $questions_3) + ($scorring->q_4 * $questions_4));
//        $base_q = $setting->tarahi_soal_nomre / ($course->max_session * $setting->min_soal);
        //        $q_nomre = $base_q * (($scorring->q_1 * $questions_1) + ($scorring->q_2 * $questions_2) + ($scorring->q_3 * $questions_3) + ($scorring->q_4 * $questions_4));
        $q_nomre = round($q_nomre, 2);
        $nomre_har_soal=$setting->tarahi_soal_nomre / ($setting->jalasat * ($setting->max_soal-1));
        $q_nomre*=$nomre_har_soal;
        if ($q_nomre > $setting->tarahi_soal_nomre) {
            $q_nomre = $setting->tarahi_soal_nomre;
        }

        $nomre['q'] = round($q_nomre,2);

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
        $d_scores=0;
        foreach(Discussion::where('user_id', $request->user)->whereIn('session_id', $sessions)->get() as $dd){
            $d_scores+=$dd->score;
        }
        if($disc_all!=0)
        $d_scores=$d_scores/($disc_all*(20/25));
        else
        $d_scores=0;

        if ($course->status == 1) {
            $max_session = $course->max_session;
        } else {
            $max_session = count($sessions);
        }

        // $base_d = $setting->ersal_gozaresh_nomre / ($max_session);
        $d_nomre = ($scorring->d_1 * $disc_1) +   ($scorring->d_2 * $disc_2) + ($scorring->d_3 * $disc_3) + ($scorring->d_4 * $disc_4);
        if ($d_nomre > $setting->ersal_gozaresh_nomre) {
            $d_nomre = $setting->ersal_gozaresh_nomre;
        }

        $d_nomre = round($d_nomre, 2);

        $nomre_har_gozaresh=$setting->ersal_gozaresh_nomre / ($setting->jalasat );
        $d_nomre*=$nomre_har_gozaresh;

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
        if ($e_nomre > $setting->taklif_seminar_nomre) {
            $e_nomre = $setting->taklif_seminar_nomre;
        }

        $e_nomre = round($e_nomre, 2);

        $nomre['e'] = $e_nomre;

        $num_azmoon = Quiz::where('course_id', $course->id)->where('user_id', $request->user)->pluck('id');
        $count_azmoon = count($num_azmoon);
        $qu_scores=0;
        foreach(Quiz::where('course_id', $course->id)->where('user_id', $request->user)->get() as $qq){
            $qu_scores+=$qq->score;
        }
        if($count_azmoon!=0)
        $qu_scores=$qu_scores/($questions_all );
        else
        $qu_scores=0;
//        return $count_azmoon;
        $num_q = Answer::whereIn('quiz_id', $num_azmoon)->get();
        $correct = 0;
        foreach ($num_q as $item) {
            $qu = Question::where('id', $item->question_id)->first();
            if ($qu) {
                if ($qu->answer == $item->answer) {
                    $correct++;
                }
            }

        }
        if ((count($num_q) * $setting->min_w_khod * $max_session) == 0) {
            $a = 0;
        } else {
            $a = ($correct * count($num_azmoon)) / (count($num_q) * $setting->min_w_khod * $max_session);
        }

        if ($a > 1) {
            $a = 1;
        }

//        return "sahih".$correct ."azmonha" .count($num_azmoon)."soalat". count($num_q) . "hadeaghal".$setting->min_w_khod."jalasat".$course->max_session
        //            ."kol".$a;
        if ($setting->tarahi_soal_nomre == 0) {
            $q = 0;
        } else {
            $q = $q_nomre / $setting->tarahi_soal_nomre;
        }

        if ($q > 1) {
            $q = 1;
        }

        if ($setting->ersal_gozaresh_nomre == 0) {
            $r = 0;
        } else {
            $r = $d_nomre / $setting->ersal_gozaresh_nomre;
        }

        if ($r > 1) {
            $r = 1;
        }

        $s = 0;
        if ($setting->taklif_seminar_nomre == 0) {
            $h = 0;
        } else {
            $h = $e_nomre / $setting->taklif_seminar_nomre;
        }

        $c = ($q + $r + $h + $a) / 4;
        if ($c > 1) {
            $c = 1;
        }

//        $pishraft = ($setting->pishraft_nomre * $c * count($sessions)) / $max_session;
//        $pishraft = round($pishraft, 2);
//        if ($pishraft > $setting->pishraft_nomre) {
//            $pishraft = $setting->pishraft_nomre;
//        }
//
//        $nomre['pish'] = $pishraft;

        $pishraft_har = $setting->pishraft_nomre /3;
        $pishraft_soal=$pishraft_har*($questions_2+$questions_1)/($setting->jalasat*($setting->max_soal-1));
        if($pishraft_soal>$pishraft_har)
            $pishraft_soal=$pishraft_har;
        $pishraft_gozaresh=$pishraft_har*($disc_1+$disc_2)/($setting->jalasat);
        if($pishraft_gozaresh>$pishraft_har)
            $pishraft_gozaresh=$pishraft_har;
        $pishraft_khod=$pishraft_har*($count_azmoon)/($setting->jalasat*(7*5));
        if($pishraft_khod>$pishraft_har)
            $pishraft_khod=$pishraft_har;
        $nomre['pish'] =round( $pishraft_gozaresh+$pishraft_soal+$pishraft_khod,2);
        $pishraft = round($nomre['pish'], 2);



        $at = count($num_azmoon) / ($setting->min_w_khod * $max_session);
        if ($at > 1) {
            $at = 1;
        }

        $qt = $questions['all'] / ($setting->min_soal * $max_session);
        if ($qt > 1) {
            $qt = 1;
        }

        $rt = $discs['all'] / $max_session;
        if ($rt > 1) {
            $rt = 1;
        }

        if ($setting->max_taklif == 0) {
            $st = 0;
        } else {
            $st = $exers['all'] / $setting->max_taklif;
            if ($st > 1) {
                $st = 1;
            }

        }
        $all_q = Question::whereIn('session_id', $sessions)->pluck('id');
        $davari = Score::withTrashed()->whereIn('sub_id', $all_q)->where('type', 1)->where('user_id', $request->user)->get();
//        return count($davari);
//        $dt = count($davari) / ($setting->min_davari * $max_session);
//        if ($dt > 1) {
//            $dt = 1;
//        }
//
//        $ct = ($at + $qt + $rt + $st + $dt) / 5;
//        $nomre['talash'] = ($setting->talash_nomre * $ct * count($sessions)) / $max_session;


        $all_d = Discussion::whereIn('session_id', $sessions)->pluck('id');

        $davari_gozaresh = Score::withTrashed()->whereIn('sub_id', $all_d)->where('type', 2)->where('user_id', $request->user)->get();

        $davarii['gozaresh'] = $davari_gozaresh->count();
        $davarii['q'] = $davari->count();


        //talash
        $nomre_har_talash=5;
        $talash_soal=$nomre_har_talash*($questions_all)/($setting->jalasat*($setting->max_soal-1));
        if($talash_soal>$nomre_har_talash)
            $talash_soal=$nomre_har_talash;
        $talash_gozaresh=$nomre_har_talash*($disc_all)/($setting->jalasat);
        if($talash_gozaresh>$nomre_har_talash)
            $talash_gozaresh=$nomre_har_talash;
        $talash_davari_soal=$nomre_har_talash*($davarii['q'])/($setting->jalasat*2*6);
        if($talash_davari_soal>$nomre_har_talash)
            $talash_davari_soal=$nomre_har_talash;
        $talash_davari_gozaresh=$nomre_har_talash*($davarii['gozaresh'])/($setting->jalasat*6);
        if($talash_davari_gozaresh>$nomre_har_talash)
            $talash_davari_gozaresh=$nomre_har_talash;
        $talash_khod=$nomre_har_talash*($count_azmoon)/($setting->jalasat*(7*5));
        if($talash_khod>$nomre_har_talash)
            $talash_khod=$nomre_har_talash;



        $nomre['talash']=round($talash_davari_soal+$talash_davari_gozaresh+$talash_soal+$talash_gozaresh+$talash_khod,2);



        $nomre['total'] = $pishraft + $d_nomre + $q_nomre + $e_nomre + $nomre['talash'];

//        return    $pishraft .' '.$d_nomre .' '.$q_nomre .' '.$e_nomre .' '.$nomre['talash'];
        //        rotbe

        $final = Amali::where('course_id', $course->id)->where('user_id', $user->id)->where('type', 1)->first();
        if ($final) {
            $nomre['final'] = $final->nomre;
        } else {
            $nomre['final'] = null;
        }





//return $count_azmoon;
        //        return $nomre['final'];
        return view('management.courses.students.progress',
            compact('course', 'user', 'questions', 'discs', 'exers', 'setting', 'nomre', 'count_azmoon', 'davarii','max_session','q_scores','qu_scores','d_scores'))->with([
            'pageTitle' => 'صفحه پیشرفت درسی',
            'pageName' => ' پیشرفت درسی',
            'pageDescription' => 'دوست من ! نقاط قوت و ضعف خود را اینجا بررسی کن و برای عملکرد بهتر برنامه ریزی کن',
        ]);
    }

    public function status(Request $request, $id)
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

    public function active(Request $request, $id)
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

    public function archPost(Request $request, $id)
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

    public function quiz(Request $request, $id)
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

    public function davari(Request $request, $id)
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

    public function private(Request $request, $id)
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

    public function pishraft(Request $request, $id)
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

    public function faaliat(Request $request, $id)
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

    public function amali(Request $request, $id)
    {
//        return $request->amali[12];
        $setting = Setting::where('course_id', $id)->first();
        foreach ($request->ind as $item) {
            if ($setting->amali_nomre > 0) {
                $nomre = Amali::where('course_id', $id)->where('user_id', $item)->where('type', 2)->first();
                if (!$nomre) {
                    $nomre = new Amali();
                }

                $nomre->course_id = $id;
                $nomre->user_id = $item;
                $nomre->type = 2;
                $nomre->nomre = $request->amali[$item];
                $nomre->save();
            }

            if ($setting->final_nomre > 0) {
                $nomre = Amali::where('course_id', $id)->where('user_id', $item)->where('type', 1)->first();
                if (!$nomre) {
                    $nomre = new Amali();
                }

                $nomre->course_id = $id;
                $nomre->user_id = $item;
                $nomre->type = 1;
                $nomre->nomre = $request->final[$item];
                $nomre->save();
            }
        }
        return redirect()->back()->with('success', ' با موفقیت انجام شد.');
    }

    public function rotbe(Request $request)
    {
        $nomre = $request->nomre;
        $course = Course::find($request->course);

        $scorring = Scoring::where('course_id', $course->id)->first();
        $setting = Setting::where('course_id', $course->id)->first();
        $sessions = Session::where('course_id', $course->id)->pluck('id');

        if ($course->status == 1) {
            $max_session = $course->max_session;
        } else {
            $max_session = count($sessions);
        }

        $rotbe = 1;
        $students = CourseUser::where('course_id', $course->id)->pluck('user_id');
        foreach ($students as $student) {
            $questions_1 = Question::where('user_id', $student)->whereIn('session_id', $sessions)->where('status', '1')->count();
            $questions_2 = Question::where('user_id', $student)->whereIn('session_id', $sessions)->where('status', '2')->count();
            $questions_3 = Question::where('user_id', $student)->whereIn('session_id', $sessions)->where('status', '3')->count();
            $questions_4 = Question::where('user_id', $student)->whereIn('session_id', $sessions)->where('status', '4')->count();
            $questions_all = Question::where('user_id', $student)->whereIn('session_id', $sessions)->count();
            $q_nomre = (($scorring->q_1 * $questions_1) + ($scorring->q_2 * $questions_2) + ($scorring->q_3 * $questions_3) + ($scorring->q_4 * $questions_4));
            $num_azmoon = Quiz::where('course_id', $course->id)->where('user_id', $student)->pluck('id');

            $q_nomre = round($q_nomre, 2);
            if ($q_nomre > $setting->tarahi_soal_nomre) {
                $q_nomre = $setting->tarahi_soal_nomre;
            }

            $disc_1 = Discussion::where('user_id', $student)->whereIn('session_id', $sessions)->where('status', '1')->count();
            $disc_2 = Discussion::where('user_id', $student)->whereIn('session_id', $sessions)->where('status', '2')->count();
            $disc_3 = Discussion::where('user_id', $student)->whereIn('session_id', $sessions)->where('status', '3')->count();
            $disc_4 = Discussion::where('user_id', $student)->whereIn('session_id', $sessions)->where('status', '4')->count();
            $disc_all = Discussion::where('user_id', $student)->whereIn('session_id', $sessions)->count();

            $base_d = $setting->ersal_gozaresh_nomre / ($max_session);
            $d_nomre = $base_d * ($scorring->d_1 * $disc_1) + $base_d * ($scorring->d_2 * $disc_2) + $base_d * ($scorring->d_3 * $disc_3) + $base_d * ($scorring->d_4 * $disc_4);
            if ($d_nomre > $setting->ersal_gozaresh_nomre) {
                $d_nomre = $setting->ersal_gozaresh_nomre;
            }

            $d_nomre = round($d_nomre, 2);

            $exercises = Exercise::whereIn('session_id', $sessions)->pluck('id');
            $exer_1 = ExerciseAnswer::where('user_id', $student)->whereIn('exercise_id', $exercises)->where('status', '1')->count();
            $exer_2 = ExerciseAnswer::where('user_id', $student)->whereIn('exercise_id', $exercises)->where('status', '2')->count();
            $exer_3 = ExerciseAnswer::where('user_id', $student)->whereIn('exercise_id', $exercises)->where('status', '3')->count();
            $exer_4 = ExerciseAnswer::where('user_id', $student)->whereIn('exercise_id', $exercises)->where('status', '4')->count();
            $exer = ExerciseAnswer::where('user_id', $student)->whereIn('exercise_id', $exercises)->count();

            $e_nomre = (($scorring->e_1 * $exer_1) + ($scorring->e_2 * $exer_2) + ($scorring->e_3 * $exer_3) + ($scorring->e_4 * $exer_4));
            if ($e_nomre > $setting->taklif_seminar_nomre) {
                $e_nomre = $setting->taklif_seminar_nomre;
            }

            $e_nomre = round($e_nomre, 2);

            $num_q = Answer::whereIn('quiz_id', $num_azmoon)->get();
            $correct = 0;
            foreach ($num_q as $item) {
                $qu = Question::where('id', $item->question_id)->first();
                if ($qu) {
                    if ($qu->answer == $item->answer) {
                        $correct++;
                    }
                }

            }
            if (count($num_q) == 0) {
                $a = 0;
            } else {
                $a = ($correct * count($num_azmoon)) / (count($num_q) * $setting->min_w_khod * $max_session);
            }

            if ($a > 1) {
                $a = 1;
            }

//        return "sahih".$correct ."azmonha" .count($num_azmoon)."soalat". count($num_q) . "hadeaghal".$setting->min_w_khod."jalasat".$course->max_session
            //            ."kol".$a;
            if ($setting->tarahi_soal_nomre == 0) {
                $q = o;
            } else {
                $q = $q_nomre / $setting->tarahi_soal_nomre;
            }

            if ($q > 1) {
                $q = 1;
            }

            if ($setting->ersal_gozaresh_nomre == 0) {
                $r = 0;
            } else {
                $r = $d_nomre / $setting->ersal_gozaresh_nomre;
            }

            if ($r > 1) {
                $r = 1;
            }

            $s = 0;
            if ($setting->taklif_seminar_nomre == 0) {
                $h = 0;
            } else {
                $h = $e_nomre / $setting->taklif_seminar_nomre;
            }

            $c = ($q + $r + $h + $a) / 4;
            if ($c > 1) {
                $c = 1;
            }

            $pishraft = ($setting->pishraft_nomre * $c * count($sessions)) / $max_session;
//        $pishraft = 0;
            $pishraft = round($pishraft, 2);
            if ($pishraft > $setting->pishraft_nomre) {
                $pishraft = $setting->pishraft_nomre;
            }

            $at = count($num_azmoon) / ($setting->min_w_khod * $max_session);
            if ($at > 1) {
                $at = 1;
            }

            $qt = $questions_all / ($setting->min_soal * $max_session);
            if ($qt > 1) {
                $qt = 1;
            }

            $rt = $disc_all / $max_session;
            if ($rt > 1) {
                $rt = 1;
            }

            if ($setting->max_taklif == 0) {
                $st = 0;
            } else {
                $st = $exer / $setting->max_taklif;
                if ($st > 1) {
                    $st = 1;
                }

            }
            $all_q = Question::whereIn('session_id', $sessions)->pluck('id');
            $davari = Score::withTrashed()->whereIn('sub_id', $all_q)->where('type', 1)->where('user_id', $student)->get();

            $dt = count($davari) / ($setting->min_davari * $max_session);
            if ($dt > 1) {
                $dt = 1;
            }

            $ct = ($at + $qt + $rt + $st + $dt) / 5;
            $nomre_talash = ($setting->talash_nomre * $ct * count($sessions)) / $max_session;

            $nomre_total = $pishraft + $d_nomre + $q_nomre + $e_nomre + $nomre_talash;
//            $student['nomre'] = $nomre_total;
            if ($nomre_total > $nomre) {
                $rotbe++;
            }

        }
        return $rotbe;

    }

    public function kholaseha(Request $request)
    {
        $sessions=Session::where('course_id',$request->course_id)->pluck('id');
        $kholaseha=Discussion::whereIn('session_id',$sessions)->get();

        foreach ($kholaseha as $item) {
            $item['user']=User::find($item->user_id);
            $item['session']=Session::find($item->session_id);
        }
        return view('management.discussion.list',compact('kholaseha'));
    }


}
