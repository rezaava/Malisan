<?php

namespace App\Http\Controllers\Api;

use App\CourseUser;
use App\Http\Controllers\Controller;
use App\Option;
use App\OptionUser;
use App\Role;
use App\Format;
use App\Survey;
use App\User;
use App\Tour;
use App\Touruser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class TourController extends Controller
{
    //
        public function app( )
    {
        return redirect('/app.apk');
    }
    public function home(Request $request)
    {

        $user=Auth::user();
        $tour=Tour::where('active',1)->orderBy('id','desc')->first();
       
        return response()->json([
            'status' => '1',
            'message' => 'خانه',
            'tour_id' => $tour->id,
        ],
            200,
            array('Content-Type' => 'application/json;charset:utf-8;'),
            JSON_UNESCAPED_UNICODE
        );


    }
     public function articleTour(Request $request,$id)
    {

        $user=Auth::user();
        $tour=Tour::find($id);
        $tour['format']=Format::all();
       
        return response()->json([
            'status' => '1',
            'message' => 'tour detail',
            'tour' => $tour,
        ],
            200,
            array('Content-Type' => 'application/json;charset:utf-8;'),
            JSON_UNESCAPED_UNICODE
        );


    }
    public function articleTourPost(Request $request,$id)
    {

        $user=Auth::user();
        $tour=new Touruser();
        $tour->user_id=$user->id;
        $tour->tour_id=$id;
        $tour->title=$request->title;
        $tour->abstract=$request->abstract;
        $tour->keywords=$request->keywords;
           if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = time() . "." . $file->getClientOriginalExtension();
            $destination_path = 'files/tour/answer';
            $file->move($destination_path, $file_name);
            $tour->file = '/' . $file_name;
        }
        $tour->save();

        return response()->json([
            'status' => '1',
            'message' => 'با تشکر...مقاله شما ارسال گردید',
        ],
            200,
            array('Content-Type' => 'application/json;charset:utf-8;'),
            JSON_UNESCAPED_UNICODE
        );


    }
    


}
