<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkoutInfo extends Model
{
    protected $table = 'workout_infos';
    public function workout(){
      return $this->belongsTo('App\Workout', 'workout_id','id');
    }
}
