<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use Illuminate\Support\Facades\Redirect;

use Image;
use File;
use Session;

class SettingsController extends Controller
{
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
    if($request->get('form') == 1) {
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

        Session::flash('success', 'Your profile image has been updated!');
      }
      return view('pages.settings')->with('user', $user);
    }
    else {
      if(Auth::Check()) {

          $request_data = $request->All();
          $validator = $this->rules($request_data);


          if($validator->fails()) {
              Session::flash('nosuccess', 'Incorrect password!');
              return Redirect::back();
          }
          else {

            $current_password = Auth::User()->password;

            if(Hash::check($request_data['current-password'], $current_password)) {
              $user_id = Auth::User()->id;
              $obj_user = User::find($user_id);
              $obj_user->password = Hash::make($request_data['password']);;

              $obj_user->save();

              Session::flash('success', 'Your password has been changed!');

              return Redirect::back();
            }
            else {
              Session::flash('nosuccess', 'Incorrect password!');
              return Redirect::back();
            }
          }
      }
      else {
        return redirect()->to('/');
      }
    }
  }
}
