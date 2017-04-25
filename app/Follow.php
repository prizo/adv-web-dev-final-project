<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
  //create relationship between follow table and workouts table
  public function workouts(){
    return $this->belongsTo('App\Workout', 'group_id', 'group_id');
  }

  public function group(){
    return $this->belongsTo('App\Group', 'group_id', 'id');
  }
}
