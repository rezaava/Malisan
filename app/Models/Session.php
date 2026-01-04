<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  

class Session extends Model
{
    use SoftDeletes;  
    //
    public function course()
    {
        return $this->belongsTo("App\Models\Course");
    }

    public function descussions() {
        return $this->hasMany("App\Models\Discussion");
    }

    public function questions() {
        return $this->hasMany("App\Models\Question");
    }

    public function getFormatFileAttribute()
    {
        $extension = pathinfo('/files/session' . $this->file, PATHINFO_EXTENSION);

        if ($extension == 'pdf' || $extension == 'jpeg') {
            return true;

        } else {
            return false;
        }
    }

}
