<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    //
    public function subject() {
        return $this->belongsTo('App\Subject');
    }
}
