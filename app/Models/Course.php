<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'course_user')->withPivot('role_id');
    }

    public function sessions()
    {
        return $this->hasMany("App\Models\Session");
    }

    public function setting()
    {
        return $this->hasOne("App\Models\Setting");
    }

    public function questions()
    {
        return $this->hasMany("App\Models\Question");
    }

    public function quizCount($course)
    {
        $sessions = $course->sessions()->pluck('id');
        $setting=Setting::where('course_id',$course->id)->first();
        if($setting->sath_khod=='2')
        $question = Question::whereIn('session_id', $sessions)->whereIn('status', [1, 2])->inRandomOrder()->first();
        elseif($setting->sath_khod=='1')

            $question = Question::whereIn('session_id', $sessions)->where('status', '1')->inRandomOrder()->first();
        elseif($setting->sath_khod=='3')
            $question = Question::whereIn('session_id', $sessions)->where('status', '2')->inRandomOrder()->first();

        if ($question == null) {
            return true;

        } else {
            return false;
        }

    }

}
