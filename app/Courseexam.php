<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courseexam extends Model
{
    public function exam(){
        return $this->hasMany('App\Examquestion');
    }
}
