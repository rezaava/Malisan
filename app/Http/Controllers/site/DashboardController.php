<?php

namespace App\Http\Controllers\site;

use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Score;
use App\Models\Angizesh;
use App\Models\Scoring;
use App\Models\Session;
use App\Models\Setting;
use App\Models\Touradmin;
use App\Models\Touruser;
use App\Models\User;
use App\Models\Coworker;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;




class DashboardController extends Controller
{
    public function dashboards()
    {

        $user = Auth::user();
        $content = Coworker::where('user_id', $user->id)->first();
// return $user;
        $aneto = null;
        $angizesh = Angizesh::whereIn('level', [7, 8])->inRandomOrder()->first();
        $mosabeghat = Touruser::where('user_id', $user->id)->count();
        // return $user->hasRole();
        if ($user->hasRole('teacher')) {
            $user2 = User::where('national', $user->national)->where('role', 3)->first();
            // return $user2;
            return view('melisan.dashbord.user.index', compact('user', 'user2', 'angizesh', 'content', 'mosabeghat'))
                ->with([
                    'pageTitle' => 'صفحه دانشجو',
                    'pageName' => 'دانشجو',
                    'pageDescription' => '    خوش امدید',
                ]);
        } elseif ($user->hasRole('student')) {
            //  return 'test';
            $user2 = User::where('national', $user->national)->where('role', 2)->first();

            return view(
                'melisan.dashbord.user.index',
                compact('user', 'user2', 'aneto', 'angizesh', 'content', 'mosabeghat')
            )
                ->with([
                    'pageTitle' => 'صفحه مدرس',
                    'pageName' => 'مدرس',
                    'pageDescription' => ' خوش امدید',
                ]);
        } elseif ($user->hasRole('touradmin')) {
            $mosabeghat = Touradmin::where('user_id', $user->id)->count();
            return view('melisan.dashbord.user.index', compact('user', 'user2', 'angizesh', 'content', 'mosabeghat'))
                ->with([
                    'pageTitle' => 'صفحه دانشجو',
                    'pageName' => 'دانشجو',
                    'pageDescription' => '    خوش امدید',
                ]);
        }
    }
    /////////////////////////////////////////////////////////////////////////
    public function angizeshDelete(Request $request)
    {
        $ang = Angizesh::where('id', $request->id)->first();
        $ang->delete();
        $angizeshs = Angizesh::all();
        return view('management.angizesh.list', compact('angizeshs'));

    }

    public function angizeshEditPost(Request $request)
    {
        $ang = Angizesh::where('id', $request->id)->first();
        $ang->text = $request->text;
        $ang->level = $request->level;
        $ang->save();
        $angizeshs = Angizesh::all();
        return view('management.angizesh.list', compact('angizeshs'));

    }

    public function angizeshEdit(Request $request)
    {
        $ang = Angizesh::where('id', $request->id)->first();
        return view('management.angizesh.list', compact('ang'));

    }
    public function angizeshPost(Request $request)
    {
        $ang = new Angizesh();
        $ang->text = $request->text;
        $ang->level = $request->level;
        $ang->save();
        return redirect()->back();
    }
    public function angizeshList()
    {
        $angizeshs = Angizesh::all();
        return view('management.angizesh.list', compact('angizeshs'));

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
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $scoring = Scoring::find(99999);
            $setting = Setting::find(99999);

            return view('management.settings.admin', compact('scoring', 'setting'));
        } else {
            abort(404);
        }
    }
}
