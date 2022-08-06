<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function receiver() {
      return $this->belongsTo('App\User');
    }
}
