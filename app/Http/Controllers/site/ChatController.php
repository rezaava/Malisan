<?php

namespace App\Http\Controllers\site;

use App\Models\Chat;
use App\Models\Course;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Coworker;
use App\Models\Touruser;
// use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //
    public function chats()
    {

        $user = Auth::user();
        $content = Coworker::where('user_id', $user->id)->first();
        $mosabeghat = Touruser::where('user_id', $user->id)->count();
        if ($user->hasRole('student')) {
//            $chats = Chat::where('student_id',$user->id)->get();
            $courses=$user->courses()->get();
//            return $courses;
            foreach ($courses as $course) {
                $chat=Chat::where('course_id',$course->id)->where('student_id',$user->id)->orderBy('updated_at','desc')->first();
                if($chat) {
                    $messages = \App\Models\Message::where('chat_id', $chat->id)->get();
                    $last=\App\Models\Message::where('chat_id', $chat->id)->orderBy('id','desc')->first();
                    if($chat->seen==0)
                    {
                        $chat->seen=1;
                        $chat->save();
                        $course['seen']  = 0;
                    }
                    elseif($chat->seen==1 )
                    {
                        $course['seen']  = 1;
                    }elseif($chat->seen==2)
                    {
                        $chat->seen=3;
                        $chat->save();
                        $course['seen']  = 2;
                    }else
                        $course['seen'] = 3;


                    $course['messages'] = $messages;
                    if($last)
                        $course['time'] = $last->created_at;
                    else
                        $course['time'] = '0-00-1 16:25:53';
                    $course['chat_id'] = $chat->id;

                }else {
                    $chat=new Chat();
                    $chat->course_id=$course->id;
                    $chat->student_id=$user->id;
                    $chat->save();
//                    $message=new \App\Message();
//                    $message->chat_id=$chat->id;
//                    $message->text='';
//                    $message->sender=1;
//                    $message->save();

                    $chat=Chat::where('course_id',$course->id)->first();

                    $course['messages'] = [];
                    $course->chat_id=$chat->id;
                    $course['chat_id'] = $chat->id;
                }

            }
            $chats=$courses->sortByDesc('time');
            // $chats=$courses;

            if ($user->hasRole('teacher')) {         
                $user2 = User::where('national', $user->national)->where('role', 3)->first(); 
            } elseif ($user->hasRole('student')) {
                $user2 = User::where('national', $user->national)->where('role', 2)->first();
            }
         
            return view('melisan.management.chat.list', compact('chats','user','content','mosabeghat','user2'),
            ['show_nav' => false])->with([
                 'pageDescription' => 'مکالمات'
            ]);
        }

        $courses = $user->courses()->pluck('course_id');
 

        $chats=Chat::whereIn('course_id',$courses)->orderBy('updated_at','desc')->get();
// return $chats;
        foreach ($chats as $key => $chat) {
            $messages = \App\Models\Message::where('chat_id', $chat->id)->get();
            if(count($messages)==0)
                unset($chats[$key]);

            if($chat->seen==0)
            {
                $chat->seen=2;
                $chat->save();
                $chat['status'] = 0;
            }
            elseif($chat->seen==2 )
            {
                $chat['status'] = 2;
            }elseif($chat->seen==1)
            {
                $chat->seen=3;
                $chat->save();
                $chat['status'] = 1;
            }else
                $chat['status'] = 3;

            $chat['messages'] = $messages;
            $chat['student'] = $user->id;
            $chat['chat_id'] = $chat->id;
            $chat['course'] = Course::where('id',$chat->course_id)->first();
            $chat['student'] = User::where('id',$chat->student_id)->first();


        }
        if ($user->hasRole('teacher')) {         
            $user2 = User::where('national', $user->national)->where('role', 3)->first(); 
        } elseif ($user->hasRole('student')) {
            $user2 = User::where('national', $user->national)->where('role', 2)->first();
        }
            // return $chats;
        return view('melisan.management.chat.list', compact('chats','user','content','mosabeghat','user2'),
        ['show_nav' => false])->with([
                 'pageDescription' => 'مکالمات'
        ]);


    }

    public function chat(Request $request)
    {
        // return $request;
         $user = Auth::user();
        $chat=Chat::where('id',$request->id)->first();
        if ($user->hasRole('student'))
            $chat->seen=1;
        else
            $chat->seen=2;
        $chat->updated_at=Carbon::now();
        $chat->save();

        $message = new \App\Models\Message();
        if ($user->hasRole('student'))
            $message->sender = '1';
        else
            $message->sender = '2';
        $message->text = $request->text;
        $message->chat_id = $chat->id;
        $message->save();
        return back()->with('success', 'با موفقیت انجام شد');

    }
       
}
