<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Workout;
use App\WorkoutInfo;
use Session;
use Auth;
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
        //
         return view('workouts.create');

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

        $workout->title = $request->title;
        // $post->slug = $request->slug;
        $workout->description = $request->description;

        $workout->username_id = $request->username_id;

        $workout->save();

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
        $workoutInfos = WorkoutInfo::where('workout_id', '=',$id)->first();

        // print_r($workoutInfos->name);
        // exit;


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

      //return the view and pass in the variable we previously created
      return view('workouts.edit')->with('workout', $workout);
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
      //check if slug is changed
      $workout = Workout::find($id);
      //$currentSlug = $post->slug;
      //
      // if ($request->input('slug') == $currentSlug) {
      //   // validate data
      //   $this->validate($request, array(
      //           'title' => 'required|max:255',
      //           'body' => 'required'
      //   ));
      // }
      // else{
      //   // validate data
      //   $this->validate($request, array(
      //           'title' => 'required|max:255',
      //           'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
      //           'body' => 'required'
      //   ));
      // }

      $this->validate($request, array(
              'title' => 'required|max:255',
              'description' => 'required'
      ));

      // save the data to the database

      $workout->title = $request->title;
      // $post->slug = $request->slug;
      $workout->description = $request->description;

      $workout->save();

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
}
