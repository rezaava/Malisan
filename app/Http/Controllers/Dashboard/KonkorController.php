<?php

namespace App\Http\Controllers\Dashboard;

use App\Coworker;
use App\Http\Controllers\Controller;
use App\Imports\KonkorImport;
use App\Konkor;
use App\Leitner;
use App\Konkorq;
use App\Session;
use Carbon\Carbon;

use App\User;
use App\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laratrust\Laratrust;
use Maatwebsite\Excel\Facades\Excel;


class KonkorController extends Controller
{
    //
    
    public function konkor()
    {
        $user=Auth::user();
        if($user->hasRole('admin'))
        {
            $konkors=Konkor::all();
        }else
        {
            $konkors_id=Coworker::where('user_id',$user->id)->pluck('konkor_id');
            $konkors=Konkor::whereIn('id',$konkors_id)->get();
        }
        return view('management.konkor.list',compact('konkors'));
    }

    public function konkorAdd(Request $request)
    {
        $konkor=new Konkor();
        $konkor->dars=$request->dars;
        $konkor->gerayesh=$request->gerayesh;
        $konkor->reshte=$request->reshte;
        $konkor->save();
        return redirect()->back()->with('success', ' درس با موفقیت ویرایش شد');
    }

    public function coworker(Request $request)
    {
        $konkor=Konkor::find($request->ii);

        $coworkers=Coworker::where('konkor_id',$konkor->id)->get();
        // return $coworkers;

        foreach ($coworkers as $coworker)
        {
            $user=User::find($coworker->user_id);
            $coworker['user']=$user;
        }
        // return $coworkers;
        return view('management.konkor.coworker',compact('konkor','coworkers'));

    }


    public function delete(Request $request)
    {
        $konkor=Konkor::find($request->ii);

        $konkor->delete();
        return redirect()->back();

    }



    public function coworkerAdd(Request $request,$id)
    {
        $user=User::where('national',$request->national)->first();
        if(!$user)
            return redirect()->back()->with('warning', ' کاربری با این کد ملی یافت نشد');

        $old=Coworker::where('user_id',$user->id)->where('konkor_id',$id)->first();
        if($old)
            return redirect()->back()->with('warning', 'کاربر تکراری است');

        $coworker=new Coworker();
        $coworker->user_id=$user->id;
        $coworker->konkor_id=$id;
        $coworker->save();
        return redirect()->back()->with('success', ' همکار ثبت شد');
    }
    public function coworkerDelete(Request $request,$id,$u_id)
    {
        $user=User::where('id',$u_id)->first();
        $cowork=Coworker::where('konkor_id',$id)->where('user_id',$u_id)->first();
        $cowork->delete();

        return redirect()->back()->with('success', ' همکار حذف شد');
    }

    public function question(Request $request)
    {

        $konkor=Konkor::find($request->ii);
        return view('management.konkor.question',compact('konkor'));
    }

    public function questionEditGet($id)
    {
        $q=Konkorq::find($id);
        return view('management.konkor.edit',compact('q'));
    }
    public function questionEditPost(Request $request,$id)
    {
        $ques=Konkorq::find($id);
        $ques->question=$request->question;
        $ques->answer1=$request->answer1;
        $ques->answer2=$request->answer2;
        $ques->answer3=$request->answer3;
        $ques->answer4=$request->answer4;
        $ques->answer=$request->answer;
        if($request->desc)
            $ques->description=$request->desc;
        $ques->year=$request->year;
        $ques->save();
        return redirect('dashboard/konkor')->with('success', ' سوال ثبت شد');
    }



    public function questionDelete($id)
    {
        $q=Konkorq::find($id);
        $q->delete();
        return redirect()->back();
    }
    public function questionAdd(Request $request)
    {
        $konkor=Konkor::find($request->ii);
        $user=Auth::user();
        $ques=new Konkorq();
        $ques->user_id=$user->id;
        $ques->question=$request->question;
        $ques->answer1=$request->answer1;
        $ques->answer2=$request->answer2;
        $ques->answer3=$request->answer3;
        $ques->answer4=$request->answer4;
        $ques->answer=$request->answer;
        if($request->desc)
            $ques->description=$request->desc;
        $ques->year=$request->year;
        $ques->konkor_id=$konkor->id;
        $ques->save();

        $result=$this->anetoTrans($user,20000,5,'طراحی سوال محتوا ');


        return redirect()->back()->with('success', ' سوال ثبت شد');
    }

    public function questionMy(Request $request)
    {
        $user=Auth::user();
        $konkor=Konkor::find($request->ii);
        $questions=Konkorq::where('konkor_id',$konkor->id)->where('user_id',$user->id)->get();
        return view('management.konkor.questions',compact('konkor','questions'));
    }

    public function questionFinal(Request $request)
    {
        $konkor=Konkor::find($request->ii);
        // $questions=Konkorq::where('konkor_id',$konkor->id)->where('status',1)->get();
        $questions=Konkorq::where('konkor_id',$konkor->id)->get();
        return view('management.konkor.questions',compact('konkor','questions'));
    }

    public function refree(Request $request)
    {
        $user=Auth::user();
        $konkor=Konkor::find($request->ii);
        $questions=Konkorq::where('konkor_id',$konkor->id)->whereNull('status')->where('user_id','<>',$user->id)->get();
        return view('dashboard2.konkor.refree',compact('konkor','questions'));
    }

    public function accept(Request $request)
    {
        $user=Auth::user();

        $qu=Konkor::find($request->ii);
        $qu->status=1;
        $qu->save();
        $result=$this->anetoTrans($user,8000,5,' تائید محتوای '.$request->ii);

        return redirect()->back()->with('success', ' سوال تائید شد');

    }
    public function active(Request $request)
    {

        $qu=Konkor::find($request->ii);
        if($qu->active==0)
            $qu->active=1;
        else
            $qu->active=0;
        $qu->save();


        return redirect()->back()->with('success', '  تائید شد');

    }
    public function decline(Request $request)
    {
        $user=Auth::user();

        $qu=Konkorq::find($request->ii);
        $qu->status=0;
        $qu->save();

        $result=$this->anetoTrans($user,800,5,' رد محتوای '.$request->ii);


        return redirect()->back()->with('warning', ' سوال رد شد');

    }

    public function konkors(){
                $user=Auth::user();

        $konkors=Konkor::where('active',1)->get();
        foreach($konkors as $kk){
            $joined=Leitner::where('user_id',$user->id)->where('konkor_id',$kk->id)->first();
            if($joined)
                $kk['joined']=1;
            else
                $kk['joined']=0;
        }
        return view('management.konkor.konkors',compact('konkors'));
    }

    public function enter(Request $request){

        // $leitners=Leitner::all();
        // foreach($leitners as $ll){
        //     $kq=Konkorq::find($ll->question_id);
        //     if($kq){
        //     $kon=Konkor::find($kq->konkor_id);
        //     if($kon){
        //     $ll->konkor_id=$kon->id;
        //     $ll->save();
        //     }
        //     }
        // }

        // return "lk";

        $course=Konkor::find($request->id);
        $user=Auth::user();
        $seed5=Leitner::where('user_id',$user->id)->where('box',4)->pluck('question_id');
        $box5=Leitner::where('konkor_id',$request->id)->where('user_id',$user->id)->where('box',4)->count();
        $box4=Leitner::where('konkor_id',$request->id)->where('user_id',$user->id)->where('box',3)->count();
        $box3=Leitner::where('konkor_id',$request->id)->where('user_id',$user->id)->where('box',2)->count();
        $box2=Leitner::where('konkor_id',$request->id)->where('user_id',$user->id)->where('box',1)->count();
        $all_question=Konkorq::where('konkor_id',$request->id)->count();
        $box1=$all_question-$box2-$box3-$box4-$box5;
        $aneto=$this->anetoWallet(Auth::user());
        $rand=[1,2,3,4];
        shuffle($rand);

    //answered
//        if(\Illuminate\Support\Facades\Session::has('answered')) {
//            if(\Illuminate\Support\Facades\Session::get('answered')==1){
//                $question=\Illuminate\Support\Facades\Session::get('ques');
//                $res=\Illuminate\Support\Facades\Session::get('ans');
//                return view('management.konkor.enter',compact('question','res','aneto','course','question','box1','box5','box4','box3','box2'));
//            }
//        }

$lasts=Leitner::where('konkor_id',$request->id)->where('user_id',$user->id)->count();
if($lasts>20)
$lasts=Leitner::where('konkor_id',$request->id)->where('user_id',$user->id)->where('box',1)->orderBy('id','desc')->take(20)->pluck('question_id');
else
$lasts=Leitner::where('konkor_id',$request->id)->where('user_id',$user->id)->where('box',1)->orderBy('id','desc')->pluck('question_id');

        $question=Konkorq::where('konkor_id',$request->id)->whereNotIn('id',$seed5)->whereNotIn('id',$lasts)->inRandomOrder()->first();


        $todays=Income::where('user_id',$user->id)->where('type',1)->where('type_id',$course->id)->whereDate('created_at', Carbon::today())->get();
        $todays_price=0;
        foreach($todays as $td)
            $todays_price+=$td->price;


        $alls=Income::where('user_id',$user->id)->where('type',1)->where('type_id',$course->id)->get();
        $alls_price=0;
        foreach($alls as $td)
            $alls_price+=$td->price;


        return view('management.konkor.enter',compact('aneto','course','question','box1','box5','box4','box3','box2','rand','todays_price','alls_price'));
    }

    public function answer(Request $request,$id){
        $konkorq=Konkorq::find($request->id);
        $user=Auth::user();
        $konkor=Konkor::where('id',$konkorq->konkor_id)->first();
        $leitner=Leitner::where('user_id',$user->id)->where('question_id',$id)->first();
        if($leitner){
            if($request->sended==$konkorq->answer){
                $leitner->box+=1;
                $leitner->save();
            }else{
                $leitner->box=1;
                $leitner->save();
            }
        }else{
            $leitner=New Leitner();
            $leitner->user_id=$user->id;
            $leitner->konkor_id=$konkor->id;
            $leitner->question_id=$id;

            if($request->sended==$konkorq->answer){
                $leitner->box=1;

            }


            $leitner->save();
        }
        $plus=0;
        $old_aneto=$new_aneto=0;
        // return $request;
        // alert
        if($request->sended==$konkorq->answer){
            $correct='answer'.$konkorq->answer;

            if($leitner->box==4)
                $plus=4000;
            else
                $plus=2000;
            
            
            if($plus>0){
                $income=new Income();
                $income->user_id=$user->id;
                $income->type=1;
                $income->type_id=$konkor->id;
                $income->subject_id=$id;
                $income->price=$plus;
                $income->save();
            }
            
            
            
            
            $old_aneto=$this->anetoWallet(Auth::user());
            $this->anetoTrans($user,$plus,5,' پاسخ درست لایتنر ');
            $new_aneto=$this->anetoWallet(Auth::user());

            $msg="پاسخ شما صحیح بود"
                .'<br>'.
                $konkorq->question
                .
                '<br>'
                .
                $konkorq->$correct;
            ;
            return redirect()->back()
                ->with([

                    'ques'=>$konkorq
                    ,
                    'ans'=>$request->answer
                    ,
                    'answered'=>1
                    ,
                    'pageDescription' =>$msg
                    ,
                    // 'old_aneto'=>$old_aneto['silver_wallet']
                    // ,
                    // 'new_aneto'=>$new_aneto['silver_wallet']
                    // ,
                          'old_aneto'=>0
                    ,
                    'new_aneto'=>0
                    ,
                    'plus'=>$plus,
                ]);

        }else{
            $correct='answer'.$konkorq->answer;
            $msg="پاسخ شما اشتباه بود".
                '<br>'.
                $konkorq->question . '<br>' .$konkorq->$correct;
        }

        return redirect()->back()
            ->with([
                'answered'=>0,

                'pageDescription' =>$msg
                ,
                'old_aneto'=>0,

                'new_aneto'=>0,
                'plus'=>$plus,
            ]);

    }


    public function box5(Request $request){
        $user=Auth::user();
        $all5s=Leitner::where('user_id',$user->id)->where('box',4)->pluck('question_id');
        $questions=Konkorq::whereIn('id',$all5s)->where('konkor_id',$request->id)->get();
        return view('management.konkor.box5',compact('questions'));
    }
    public function upload(Request $request , $id) {
        $konkor = Konkor::findOrFail($id);
        if (!$request->file("file")) abort(422);
        session()->put("konkor_id",$id);
        Excel::import(new KonkorImport,$request->file("file"));
        session()->forget("konkor_id");
        return redirect()->back();
    }

    public function users()
    {
        $users_id=Leitner::groupBy('user_id')->pluck('user_id');

        $users=User::whereIn('id',$users_id)->get();
        return view('dashboard2.user.list-content', compact('users'));
    }
    
    public function students(Request $req)
    {
        
        $users_id=Leitner::where('konkor_id',$req->ii)->groupBy('user_id')->pluck('user_id');
       
        $users=User::whereIn('id',$users_id)->get();
         foreach($users as $uu){
            $uu['box5']=Leitner::where('konkor_id',$req->ii)->where('user_id',$uu->id)->where('box',4)->count();
            $uu['all_q']=Konkorq::where('konkor_id',$req->ii)->count();
        }
        return view('dashboard2.user.list-content', compact('users'));
    }
}
