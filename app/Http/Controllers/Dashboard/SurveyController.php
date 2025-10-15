<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Course;
use App\Exports\TeacherVoTesExport;
use App\Exports\TeacherVoteStudentExport;
use App\Exports\VotesExport;
use App\Fcm;
use App\Http\Controllers\Controller;
use App\Option;
use App\OptionUser;
use App\Role;
use App\Survey;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Maatwebsite\Excel\Excel;

class SurveyController extends Controller
{
    //
    public function catlist()
    {
        $user=Auth::user();
       
        $cats=Category::all();
        $courses=null;
        if($user->hasRole('teacher'))
        {
            $courses = $user->courses()->get();
        }
        return view('management.servays.index', compact('cats','courses', 'user'))->with([
            'pageTitle' => 'صفحه لیست دروس برای نظرسنجی',
            'pageName' => 'نظرسنجی',
            'pageDescription' => 'مدرس گرامی! برای نظرسنجی درس موردنظر را انتخای نمایید',
        ]);;
    }

    public function createCat(Request $request)
    {
        $cat=new Category();
        $cat->name=$request->name;
        $cat->Save();
        return redirect()->back()->with('success', ' با موفقیت انجام شد.');
    }
    public function  deleteCat(Request $request)
    {
        $cat=Category::findOrFail($request->cat_id);

        $cat->Delete();
        return redirect()->back()->with('success', '  حذف با موفقیت انجام شد.');
    }

    public function exportStudent(Request $req,Excel $excel)
{
        // $cat_id = session()->get('cat_id');
        // session()->forget('cat_id');
        // $cat_id=$req->cat_id;
        
        //  $texts = Survey::where('cat_id', $cat_id) ->pluck('id');
        // $users=OptionUser::whereIn('survey_id',$texts)->pluck('user_id');

        // $all_users=User::select('id','name','family')->whereIn('id',$users)->get();
        
        // $texts = Survey::where('cat_id', $cat_id) ->get();

        // foreach ($texts as $text){
        //     $anss=[];
        //     foreach ($all_users as $user){
        //         $ans=OptionUser::where('user_id',$user->id)->where('survey_id',$text->id)->first();
        //         if($ans){
        //             if($text->type != 1)
        //                 {
        //                     $pasokh=Option::find($ans->answer);
        //                     // $user['answer']=$pasokh->option;
        //                     array_push($anss,$pasokh->option)    ;
        //                 }
        //             else
        //             // $user['answer']=$ans->answer;
        //             array_push($anss,$ans->answer);
                    
        //         }
        //         else
        //             // $user['answer']='----';
        //             array_push($anss,'---');

                
        //     }
        //     $text['anss']=$anss;

            
        // }
        
        // return $texts;
                session()->put('cat_id', $req->cat_id);

                return $excel->download(new TeacherVoteStudentExport, "malisan_report.xlsx");

}

    public function exportTeacher(Excel $excel)
    {
        $auth_user = Auth::user();
        $texts = Survey::where('user_id', $auth_user->id)->get();
        $texts_id = $texts->pluck('id');

        $users_id = OptionUser::whereIn('survey_id', $texts_id)->distinct()->pluck('user_id');
        $users = User::whereIn('id', $users_id)->get();
        foreach ($users as $user) {

            if ($user->gender == '1')
                $user['gender_name'] = 'مرد';
            elseif ($user->gender == '0')
                $user['gender_name'] = 'زن';
            else
                $user['gender_name'] = '';


            foreach ($texts as $key => $text) {
                $a[$key] = null;

                if ($text->type == 3) {
                    $answer = OptionUser::where('user_id', $user->id)->where('survey_id', $text->id)->orderBy('survey_id')->first();
                    if ($answer)
                        $a[$key] = $answer;
                } elseif ($text->type == 2) {
                    $answer = OptionUser::where('user_id', $user->id)->where('survey_id', $text->id)->orderBy('survey_id')->first();
                    if ($answer) {
                        $ans = Option::where('survey_id', $answer->survey_id)->where('id', $answer->answer)->pluck('option');
                        $a[$key] = $ans;
                    }
                } elseif ($text->type == 1) {
                    $answer = OptionUser::where('user_id', $user->id)->where('survey_id', $text->id)->orderBy('survey_id')->get();
                    if (count($answer) > 0) {
                        $a[$key] = null;
                        foreach ($answer as $an) {
                            $ans = Option::where('survey_id', $an->survey_id)->where('id', $an->answer)->pluck('option');
                            if (count($ans) > 0)
                                $a[$key] = $a[$key] . ',' . $ans;
                        }
                    }
                }
            }
            $user['user_answers'] = $a;
        }
//        return $user->user_answers[0];
        return $excel->download(new TeacherVoTesExport, "malisan_report.xlsx");
    }


    public function export(Excel $excel)
    {
        $auth_user = Auth::user();

        $user = Auth::user();
        $texts = Survey::where('user_id', $auth_user->id)->where('type', '1')->get();
        $texts_id = $texts->pluck('id');

//        return $texts;
//        $users = DB::table('option_users')->whereIn('survey_id', $texts_id)->distinct()->get();
        $users = User::whereIn('id', $texts_id)->distinct()->get();

        foreach ($users as $user) {
            if ($user->gender == '1')
                $user['gender_name'] = 'مرد';
            elseif ($user->gender == '0')
                $user['gender_name'] = 'زن';
            else
                $user['gender_name'] = '';
            foreach ($texts as $key => $text) {
                $answer = OptionUser::where('user_id', $user->id)->where('survey_id', $text->id)->get();
                if (count($answer) > 0)
                    $a[$key] = $answer;
//                    $user['answer'[$key]]=$answer;
                else
                    $a[$key] = null;
            }
            $user['user_answers'] = $a;

        }

//        chand gozineii
        $tests = Survey::where('user_id', $auth_user->id)->where('type', '!=', '1')->get();
        foreach ($tests as $test) {
            $options = Option::where('survey_id', $test->id)->get();
            $test['options'] = $options;
            foreach ($options as $key => $option) {
                $v[$key] = OptionUser::where('survey_id', $test->id)->where('answer', $option->id)->count();
            }

            $test['count'] = $v;
            $test['all_ans'] = OptionUser::where('survey_id', $test->id)->count();

//            return $test->count[1];
        }


//        return $tests;

        return $excel->download(new VotesExport, "malisan_report.xlsx");
    }

    public function home(Request $request)
    {
        $cat=$request->cat_id;
        $user = Auth::user();
         if($request->cat_id)
            $serveys = Survey::where('cat_id',$request->cat_id)->orderBy('id', 'asc')->get();
        elseif($request->course_id)
            $serveys = Survey::where('cat_id',$request->course_id)->orderBy('id', 'asc')->get();
        foreach ($serveys as $servey) {
            $options = Option::where('survey_id', $servey->id)->get();
            $servey['options'] = $options;

            if ($servey->group == '0')
                $servey['rec'] = 'همه دانشجویان';
            elseif ($servey->group < 0)
            {
                $servey['rec'] = 'دانشجویان استاد';
            }
            else {
                $cou = Course::find($servey->group);
                $servey['rec'] = $cou->name;
            }

            if ($servey->type == 1)
                $servey['type_name'] = 'پاسخ کوتاه';
            elseif ($servey->type == 2)
                $servey['type_name'] = 'تک جواب';
            elseif ($servey->type == 3)
                $servey['type_name'] = 'چند جواب';

            if ($servey->active == 1)
                $servey['active_name'] = 'فعال';
            elseif ($servey->active == 0)
                $servey['active_name'] = 'غیر فعال';
        }
        $courses = $user->courses()->get();

        $cats=Category::all();
        $cat_obj=Category::find($cat);

        if($request->course_id)
        {
            $course=Course::find($request->course_id);
            return view('management.servays.survays', compact('serveys','cat_obj', 'courses','cats','cat','course'));

        }
        return view('management.servays.survays', compact('serveys','cat_obj', 'courses','cats','cat'));
    }

    public function create(Request $request)
    {

        $options = preg_split("/\r\n|\n|\r/", $request->options);

        $user = Auth::user();
        $survey = new Survey();
        $survey->user_id = $user->id;
        if(Auth::user()->hasRole('admin')||Auth::user()->hasRole('content'))
        {

            $survey->group = 0;
            $survey->cat_id=$request->cat_id;

        }else {

            if ($request->group == 0)
                $survey->group = -$user->id;
            else
                $survey->group = $request->group;
        }
        $survey->text = $request->question;
        $survey->type = $request->answer;
        if ($request->active) {
//            return 1;
            $survey->active = 1;

        } else {
//            return 0;
            $survey->active = 0;

        }
        $survey->desc_add = '0';



        if($request->cat_id)
            $survey->cat_id = $request->cat_id;
        else
            $survey->group= $request->group;

        if ($request->answer == 2 || $request->answer == 3) {
            if ($request->desc_add)
                $survey->desc_add = '1';
        }
        try {
            $survey->save();

//            if ($request->option && $request->answer != '1') {
            foreach ($options as $item) {
                $option = new Option();
                $option->survey_id = $survey->id;
                $option->option = $item;
                $option->save();
            }
//            }
            DB::commit();
            if(Auth::user()->hasRole('teacher') && !$request->cat_id) {
                $student_role = Role::where("name", "student")->first();
                $course=Course::find($request->group);
return $request;
                $users=$course->users()->where('role_id', $student_role->id)->pluck('user_id');
                $fcm = FCM::whereIn('user_id', $users);
                if (sizeof($fcm->get()) != 0) {
                    $title = "نظر سنجی";
                    $body = "در نظر سنجی شرکت کنید";
                    $clickAction = "http://google.com";
                    $tokens = $fcm->pluck('token');
                    $this->push_notification($tokens, $title, $body, $clickAction, 'data');
                }
            }
            return back()->with('success', 'موفق');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }
    }

    public function showEdit($id)
    {
        return $id;
        $user = Auth::user();
        $serv = Survey::findOrFail($id);
        $options = Option::where('survey_id', $serv->id)->get();
        $serv['options'] = $options;

        $courses = $user->courses()->get();

        $serveys = Survey::where('user_id', $user->id)->get();
        foreach ($serveys as $servey) {
            $options = Option::where('survey_id', $servey->id)->get();
            $servey['options'] = $options;

            if ($servey->group == '0')
                $servey['rec'] = 'همه دانشجویان';
            else {
                $cou = Course::find($servey->group);
                $servey['rec'] = $cou->name;
            }

            if ($servey->type == 1)
                $servey['type_name'] = 'پاسخ کوتاه';
            elseif ($servey->type == 2)
                $servey['type_name'] = 'تک جواب';
            elseif ($servey->type == 3)
                $servey['type_name'] = 'چند جواب';

            if ($servey->active == 1)
                $servey['active_name'] = 'فعال';
            elseif ($servey->active == 0)
                $servey['active_name'] = 'غیر فعال';
        }
        $cats=Category::all();
        return view('dashboard2.survey.list', compact('serv', 'courses','cats'));

    }

    public function edit(Request $request, $id)
    {
        $user=Auth::user();
//        return $request;
        $survey = Survey::findOrFail($id);
        if(Auth::user()->hasRole('admin'))
        {
            $survey->group = 0;

        }else {
            if ($request->group == 0)
                $survey->group = -$user->id;
            else
                $survey->group = $request->group;
        }        $survey->text = $request->question;
        $survey->type = $request->answer;
        if ($request->active) {
//            return 1;
            $survey->active = 1;

        } else {
//            return 0;
            $survey->active = 0;
        }
//        $survey->cat_id = $request->cat;

        try {
            $survey->save();
            DB::commit();
            return redirect('dashboard/survey?cat_id='.$survey->cat_id)->with('success', 'موفق');

        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
            return back()->with('error', 'خطایی در سرور رخ داده است');
        }

    }

    public function remove(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);

        $survey->delete();

        $answers = OptionUser::where('survey_id', $id)->get();
        foreach ($answers as $answer) {
            $answer->delete();
        }
        return redirect()->back()->with('success', 'حذف با موفقیت انجام شد.');

    }

    public function active(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);

        if ($survey->active == 0)
            $survey->active = 1;
        else
            $survey->Active = 0;

        $survey->save();
        return redirect()->back()->with('success', 'حذف با موفقیت انجام شد.');

    }

    public function sendTest()
    {
        $fcm = FCM::where('user_id', '1');
        if (sizeof($fcm->get()) != 0) {
            $title = "نظر سنجی";
            $body = "در نظر سنجی شرکت کنید";
            $clickAction = "/dashboard/survey/";
            $tokens = $fcm->pluck('token');
            return $this->push_notification($tokens, $title, $body, $clickAction, 'data');
        }
    }
    function push_notification($tokens, $title, $body, $clickAction, $type)
    {
        $serverKey = env('FCM_SERVER_KEY');
        $header = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];
        $msg = [
            'title' => $title,
            'body' => $body,
            'click_action' => $clickAction,
        ];
        $payload = [
            'registration_ids' => $tokens,
            "$type" => $msg,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => $header,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return false;
        } else {
            return $response;
        }
    }

}
