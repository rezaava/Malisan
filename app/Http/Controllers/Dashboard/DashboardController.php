<?php

namespace App\Http\Controllers\Dashboard;

use App\Course;
use App\Http\Controllers\Controller;
use App\Role;
use App\Score;
use App\Angizesh;
use App\Scoring;
use App\Session;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



class DashboardController extends Controller
{

    public function angizeshDelete(Request $request)
    {
        $ang=Angizesh::where('id',$request->id)->first();
        $ang->delete();
        $angizeshs=Angizesh::all();
        return view('management.angizesh.list',compact('angizeshs'));

    }

    public function angizeshEditPost(Request $request)
    {
        $ang=Angizesh::where('id',$request->id)->first();
        $ang->text=$request->text;
        $ang->level=$request->level;
        $ang->save();
        $angizeshs=Angizesh::all();
        return view('management.angizesh.list',compact('angizeshs'));

    }

    public function angizeshEdit(Request $request)
    {
        $ang=Angizesh::where('id',$request->id)->first();
        return view('management.angizesh.list',compact('ang'));

    }
    public function angizeshPost(Request $request)
    {
        $ang=new Angizesh();
        $ang->text=$request->text;
        $ang->level=$request->level;
        $ang->save();
        return redirect()->back();
    }
    public function angizeshList()
    {
        $angizeshs=Angizesh::all();
        return view('management.angizesh.list',compact('angizeshs'));

    }
    public function sms($msg,$rec)
    {

        $client = new \GuzzleHttp\Client();
        $token=$msg;
        $reciever=$rec;
        $url='https://api.kavenegar.com/v1/4D68334756567946623268746B364C747430764D78426D437935475A34594A3146492B4B5949684E61546F3D/verify/lookup.json?receptor='.$reciever.'&token='.$token.'&template=active';
        $request = $client->get($url);
        $response = $request->getBody();
        return $response;

    }
    public function dashboards(Request $request)
    {
                 $user = Auth::user();
                 $aneto=null;
                 $angizesh=Angizesh::whereIn('level',[7,8])->inRandomOrder()->first();
                 if($user->national!='admin')
        $aneto=$this->anetoWallet(Auth::user());
        // return $aneto;
        if ($user->hasRole('student')) {


            // if($request->code){
            //     if($request->code==$user->sms){
            //         $user->active=1;
            //         $user->save();
            //     }
            // }
            // if($user->active==0 || !$user->mobile){
            //     if($user->mobile){

            //         $user->sms=rand(1111,9999);
            //         $user->save();
            //         $this->sms($user->sms,$user->mobile);
            //     }

            //     return view('management.users.students.dashboard.index',compact('user','aneto'))
            //         ->with([
            //             'pageTitle' => 'صفحه دانشجو',
            //             'pageName' => 'دانشجو',
            //             'pageDescription' => 'دوست من ! لطفا حسابتو تکمیل و فعال کن',
            //         ]);
            // }

 
            return view('management.users.students.dashboard.index',compact('user','aneto','angizesh'))
                ->with([
                    'pageTitle' => 'صفحه دانشجو',
                    'pageName' => 'دانشجو',
                    'pageDescription' => '    خوش امدید',
                ]);
        } else {
            return view('management.users.teachers.dashboard.index',compact('user','aneto','angizesh'))
                ->with([
                    'pageTitle' => 'صفحه مدرس',
                    'pageName' => 'مدرس',
                    'pageDescription' => ' خوش امدید',
                ]);
        }
    }
    //
    public function faq()
    {
        return view('dashboard2.soalat.list');
    }
    public function home()
    {

        $user = Auth::user();
        if ($user->hasRole('admin')) {

            $courses = Course::all();
        } else {
            $courses = $user->courses()->get();
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

        }
        return view('dashboard2.course.list', compact('courses'));
    }

    public function back()
    {
        return redirect()->back();
    }

    public function barom(Request $request)
    {
        $user=Auth::user();
        if($user->hasRole('admin')){
            $scoring=Scoring::find(99999);
            $setting=Setting::find(99999);

            return view('management.settings.admin',compact('scoring','setting'));
        }
        else{
            abort(404);
        }
    }
}
