<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Workout;
use Auth;
use App\User;
use Image;
use File;

class PagesController extends Controller
{
  public function getSettings(){

    $username = Auth::user()->username;

    $user = User::where('username', '=', $username)->first();
    return view('pages.settings')->with('user', $user);
  }

  public function update_avatar(Request $request){
    $user = Auth::user();

    //install image intervention

    if($request->hasFile('avatar')){
      $avatar = $request->file('avatar');
      $filename = time() . '.jpg' ; //creating new file name
      $path = public_path('uploads/avatars/' . $filename);

      //delete previous image before uploading new one
      if ($user->avatar !== 'default.png') {
                $file = 'uploads/avatars/' . $user->avatar;

                if (File::exists($file)) {
                    unlink($file);
                }

            }
      Image::make($avatar)->resize(300,300)->save($path);

      $user->avatar = $filename;
      $user->save();
    }
    return view('pages.settings')->with('user', $user);

  }
  public function update(){

  }


  public function getHome(){
    $user = Auth::user()->username;
    // create a variable and store all the blogs posts in it from the database
    $workouts = Workout::where('username_id', $user)->orderBy('updated_at', 'desc')->paginate(3);


    //return a view and pass in the above variable
    return view('pages.home')->
        with('workouts', $workouts);
  }
}
