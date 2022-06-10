<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function examcategory(){
        return $this->belongsTo('App\Examcategory');
    }

    public function exams(){
        return $this->hasMany('App\Exam');
    }
}
