<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    public function course()
    {
        return $this->belongsTo("App\Course");
    }

    public function descussions() {
        return $this->hasMany("App\Discussion");
    }

    public function questions() {
        return $this->hasMany("App\Question");
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
