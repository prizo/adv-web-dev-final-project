<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Workout;
use App\WorkoutInfo;
use Session;
use Auth;
use App\Group;


class GroupController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function getGroup($name){
    $group = Group::where('name' ,'=', $name)->first();

    $workouts = Workout::where('group_id', $group->id)->orderBy('updated_at', 'desc')->paginate(5);

    return view('groups.show')->with('group', $group)->with('workouts', $workouts);

  }

}
