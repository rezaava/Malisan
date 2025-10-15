<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    public function course()
    {
        return $this->belongsTo("App\Course");
    }
}
