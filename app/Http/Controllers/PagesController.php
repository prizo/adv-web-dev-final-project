<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Workout;
use Auth;
use App\User;

class PagesController extends Controller
{
  public function getSettings(){

    $username = Auth::user()->username;

    $user = User::where('username', '=', $username)->first();
    return view('pages.settings')->with('user', $user);
  }

  public function update(){

  }


  public function getHome(){
    $user = Auth::user()->username;
    // create a variable and store all the blogs posts in it from the database
    $workouts = Workout::where('username_id', $user)->orderBy('id', 'desc')->paginate(3);


    //return a view and pass in the above variable
    return view('pages.home')->
        with('workouts', $workouts);
  }
}
