<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function topic(){
        return $this->belongsTo('App\Topic');
    }

    public function questionexplanation(){
        return $this->hasMany('App\Question');
    }
}
