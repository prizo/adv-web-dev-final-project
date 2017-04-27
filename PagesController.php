<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Workout;
use Auth;
use App\User;
use App\Group;
use App\Follow;

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
  public function rules(array $data){

    $messages = [
      'current-password.required' => 'Please enter current password',
      'password.required' => 'Please enter password',
    ];

    $validator = Validator::make($data, [
      'current-password' => 'required',
      'password' => 'required|same:password',
      'password_confirmation' => 'required|same:password',
    ], $messages);

    return $validator;
  }
  


  public function update(Request $request){
    if(Auth::Check()) {
        $request_data = $request->All();
        $validator = $this->rules($request_data);
        if($validator->fails()) {
          return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400); }
        else {

          $current_password = Auth::User()->password;

          if(Hash::check($request_data['current-password'], $current_password)) {
            $user_id = Auth::User()->id;
            $obj_user = User::find($id);
            $obj_user->password = Hash::make($request_data['password']);;

            $obj_user->save();

            return "ok";  }
          else {

            $error = array('current-password' => 'Please enter correct current password');
            return response()->json(array('error' => $error), 400); }
              }
                      }
      else {
        return redirect()->to('/'); }
}


  public function getHome(){
    $user = Auth::user();
    // create a variable and store all the blogs posts in it from the database
    $workouts = Workout::where('username_id', $user->username)->orderBy('updated_at', 'desc')->paginate(3);

    $following = Follow::where('user_id', $user->id)->get(); //get who the user is following

    // foreach($following as $follow){
    //   print_r($follow->group->name);
    // }


    //return a view and pass in the above variable
    return view('pages.home')
          ->with('workouts', $workouts)
          ->with('following', $following);
  }
}
