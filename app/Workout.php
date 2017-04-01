<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    public function user(){
      return $this->belongsTo('App\User', 'username_id', 'username');
    }

    public function workoutInfos(){
      return $this->hasMany('App\WorkoutInfo');
    }
}
