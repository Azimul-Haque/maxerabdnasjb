<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function que() {
        return $this->belongsToMany('App\Question');
    }
}
