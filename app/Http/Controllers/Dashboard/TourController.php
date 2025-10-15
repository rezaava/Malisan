<?php

namespace App\Http\Controllers\Dashboard;

use App\Course;
use App\Exports\QuestionsExport;
use App\Http\Controllers\Controller;
use App\Question;
use App\Score;
use App\Session;
use App\User;
use App\Tour;
use App\Touruser;
use App\Touradmin;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Excel;
use Validator;

class TourController extends Controller
{
    
    

    
    public function score($id){
        $user=Auth::user();
        $answer=Touruser::where('id',$id)->first();
        $tour=Tour::find($answer->tour_id);
             return view('management.tour.score',compact('answer','tour'));

    }   
    

    
    public function scorePost(Request $request,$id){
        $user=Auth::user();
        $answer=Touruser::where('id',$id)->first();
        $answer->score_title=$request->score_title;
        $answer->score_abs=$request->score_abs;
        $answer->score_key=$request->score_key;
        $answer->score_file=$request->score_file;
        $answer->desc_title=$request->desc_title;
        $answer->desc_abs=$request->desc_abs;
        $answer->desc_key=$request->desc_key;
        $answer->desc_file=$request->desc_file;
        $answer->davar=$user->id;
        $answer->save();
             return redirect('/dashboard/tour/davari/'.$answer->tour_id);

    }   
    public function list(){
        $user=Auth::user();
        if($user->hasRole('touradmin'))
        $tours=Tour::all();
        else{
            $tours_id=Touradmin::where('user_id',$user->id)->pluck('tour_id');
                    $tours=Tour::whereIn('id',$tours_id)->get();

            
        }
     
     return view('management.tour.list',compact('tours'));
        
    }
    public function davaran($id){
        $davaran=Touradmin::where('tour_id',$id)->get();
        foreach($davaran as $davar){
            $us=User::find($davar->user_id);
            $davar['user']=$us->name.' '.$us->family;
        }
     
     return view('management.tour.davaran',compact('davaran','id'));
        
    }
    
    public function davar(Request $req,$id){
        $user=User::where('national',$req->national)->first();
        if($user){
            $ta=new Touradmin();
            $ta->tour_id=$id;
            $ta->user_id=$user->id;
            $ta->save();
        }
        return redirect()->back();
    }
    
    public function davari($id){
        $answers=Touruser::where('tour_id',$id)->get();
     return view('management.tour.davari',compact('answers','id'));
    }
    
 public function create(){
     
     return view('management.tour.create');
 }
 
 
 public function createPost(Request $request){
    //  return $request;
     $tour=new Tour();
     $tour->title=$request->title;
     $tour->title_hint=$request->title_hint;
     $tour->abs_hint=$request->abs_hint;
     $tour->keyword_hint=$request->keyword_hint;
     $tour->file_hint=$request->file_hint;
     $tour->sponser_name=$request->sponsor_hint;
     $tour->donate=$request->donate;
     $tour->title_min=$request->title_min;
     $tour->title_max=$request->title_max;
     $tour->abs_min=$request->abs_min;
     $tour->abs_max=$request->abs_max;
     $tour->key_min=$request->key_min;
     $tour->key_max=$request->key_max;
     $tour->keyword_min=$request->keyword_min;
     $tour->keyword_max=$request->keyword_max;
     $tour->file_max=$request->file_max;

$tour->save();
return $tour;
      return view('management.tour.create');
 }

}
