<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courseexam extends Model
{
    public function examquestions(){
        return $this->hasMany('App\Examquestion');
    }
}
