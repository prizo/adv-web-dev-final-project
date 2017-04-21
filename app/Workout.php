<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    public function user(){
      return $this->belongsTo('App\User', 'username_id', 'username');
    }

    public function group(){
      return $this->belongsTo('App\Group', 'group_id', 'id');
    }

    public function workoutInfos(){
      return $this->hasMany('App\WorkoutInfo');
    }
}
