<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Workout;

class WorkoutChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     //this middleware checks whether or not the workout the user is trying to see is
     //actually theirs, if not it willbe redirected to their own workouts index
    public function handle($request, Closure $next)
    {
        $workout_id = $request->workouts;
        $workout_owner = Workout::find($workout_id)->username_id;
        $current_user = Auth::user()->username;

        if($current_user != $workout_owner){
          return redirect()->route('workouts.all');
        }
        return $next($request);
    }
}
