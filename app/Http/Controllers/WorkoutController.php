<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Workout;
use App\WorkoutInfo;
use Session;
use Auth;
use App\Group;

class WorkoutController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {

  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //get Groups
    $groups = Group::all();
    $user = Auth::user();
    $isAdmin = $user->isAdmin;

    return view('workouts.create')->with('groups', $groups)->with('isAdmin', $isAdmin);

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //validate the database
    //if there is an error, it jumps back to create fxn and show errors
    $this->validate($request, array(
      'title' => 'required|max:255',
      'description' => 'required'
    ));


    //store in the database
    //laravel provides eloquent
    //you dont have to write mysql code like INSERT INTO ....
    $workout = new Workout;
    $group = Group::find($request->group);

    $workout->title = $request->title;
    // $post->slug = $request->slug;
    $workout->description = $request->description;

    $workout->username_id = $request->username_id;

    $workout->group_id = $request->group;

    $workout->save();

    $group->touch();


    //get workout info arrays
    $workouts = $request->workout;
    $sets = $request->sets;
    $reps = $request->reps;


    for($i = 0; $i < sizeof($workouts) ; $i++){
      //instantiate new object for every database input
      $workoutInfo = new WorkoutInfo;

      $workoutInfo->name = $workouts[$i];
      $workoutInfo->reps = $reps[$i];
      $workoutInfo->sets = $sets[$i];

      $workoutInfo->workout_id = $workout->id;

      $workoutInfo->save();

    }


    Session::flash('success', 'The Workout was successfuly saved!');

    //redirect to another page
    return redirect()->route('workouts.show', $workout->id); //url only not actual "html" page
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $workout = Workout::find($id); //find workout using id

    // print_r($id);
    $workoutInfos = WorkoutInfo::where('workout_id', '=',$id)->get();

    return view('workouts.show')
    ->with('workout', $workout)->with('workoutInfos', $workoutInfos);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    // find the post in the database and save it as a variable
    $workout = Workout::find($id);
    $workoutInfos = WorkoutInfo::where('workout_id', '=',$id)->get();
    $user = Auth::user();
    $isAdmin = $user->isAdmin;
    $groups = Group::all();
    $groupSelected = $workout->group_id;
    $array_length = count($workoutInfos);




    //return the view and pass in the variable we previously created
    return view('workouts.edit')
    ->with('workout', $workout)
    ->with('workoutInfos', $workoutInfos)
    ->with('isAdmin', $isAdmin)
    ->with('groups', $groups)
    ->with('groupSelected', $groupSelected)
    ->with('array_length', $array_length);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $this->validate($request, array(
      'title' => 'required|max:255',
      'description' => 'required'
    ));

    //check if slug is changed
    $workout = Workout::find($id);

    $group = Group::find($request->group);


    // save the data to the database

    $workout->title = $request->title;
    // $post->slug = $request->slug;
    $workout->description = $request->description;

    $workout->group_id = $request->group;


    $workout->save();
    $group->touch(); //show when a workout was last pushed to a group


    // get workout info arrays from FORM
    $workouts = $request->workout;
    $sets = $request->sets;
    $reps = $request->reps;


    //get all workout infos from DATABASE
    $workoutInfos = WorkoutInfo::where('workout_id', '=',$id)->get();


    for($i = 0; $i < sizeof($workouts) ; $i++){

      $workoutInfos[$i]->name = $workouts[$i];
      $workoutInfos[$i]->reps = $reps[$i];
      $workoutInfos[$i]->sets = $sets[$i];

      $workoutInfos[$i]->workout_id = $workout->id;

      $workoutInfos[$i]->save();

    }
    //need to manually update the time because if we make changes to
    //the workoutinfo model it wont change the actual workout update bc no changes where
    //made to that model only the workoutinfo model (our views rely on the workout model)
    $workout->touch();

    // set flash data with success message
    Session::flash('success', "This post was successfuly saved."); //in _messages partial

    // redirect with flash data to posts.show
    return redirect()->route('workouts.show', $workout->id); //url only not actual "html" page
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    // find post in database
    $workout = Workout::find($id);


    $currentUser = Workout::where('id', $id)->first();

    //delete post
    $workout->delete();

    //show that it deleted using flash Session
    Session::flash('success', 'The post was successfully deleted.');

    //redirect to all posts aka index
    return redirect()->route('workouts.all');
  }

  public function getWorkouts(){

    $user = Auth::user()->username;
    // create a variable and store all the blogs posts in it from the database
    $workouts = Workout::where('username_id', $user)->orderBy('id', 'desc')->paginate(5);

    //return a view and pass in the above variable
    return view('workouts.index')->
    with('workouts', $workouts);
  }

  public function search(){

    $search = \Request::get('search');
    $type = \Request::get('type');


    $isEmpty = false;

    if($search == ''){
      $isEmpty = true;
    }

    if($isEmpty == false){
      $allFoundWorkouts = Workout::where('title', 'like', '%'.$search.'%')->get();

      $workouts = Workout::where('title', 'like', '%'.$search.'%')->orderBy('id')->paginate(4);

      $groups = Group::where('name', 'like', '%'.$search.'%')->paginate(4);

      $allFoundGroups = Group::where('name', 'like', '%'.$search.'%')->get();

    }
    else{
      $allFoundWorkouts=null;

      $workouts= null;

      $groups= null;

      $allFoundGroups=null ;
    }


      return view('workouts.search')
      ->with('workouts', $workouts)
      ->with('search', $search)
      ->with('isEmpty', $isEmpty)
      ->with('groups', $groups)
      ->with('type', $type)
      ->with('allFoundWorkouts', $allFoundWorkouts)
      ->with('allFoundGroups', $allFoundGroups);


  }
}
