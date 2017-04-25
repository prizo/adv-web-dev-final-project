<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Workout;
use App\WorkoutInfo;
use Session;
use Auth;

class ProfileController extends Controller
{
      public function __construct(){
        $this->middleware('auth');
      }

      public function getProfile($username){

          $user = User::where('username', '=', $username)->get()->first();

          $workouts = Workout::where('username_id', $username)->orderBy('updated_at', 'desc')->paginate(3);

          return view('profile.show')->with('user', $user)->with('workouts', $workouts);
      }

      public function getUserWorkout($workout_id){

        $workout = Workout::find($workout_id);

        $workoutInfos = WorkoutInfo::where('workout_id', '=',$workout_id)->get();

        return view('profile.workouts')->with('workout', $workout)->with('workoutInfos', $workoutInfos);

      }
}
