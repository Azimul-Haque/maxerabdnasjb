<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courseexam extends Model
{
    public function exams(){
        return $this->hasMany('App\Exam');
    }
}
