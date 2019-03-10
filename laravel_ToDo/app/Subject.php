<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    
    // post has one=to-one relationship with User model
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function assignments() {
        return $this->hasMany('App\Assignment');
    }
}
