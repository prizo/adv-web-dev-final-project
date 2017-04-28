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
    if(Auth::Check()) {

        $request_data = $request->All();
        $validator = $this->rules($request_data);


        if($validator->fails()) {
            return Redirect::back()->withErrors(['Incorrect Password']);}

        else {

          $current_password = Auth::User()->password;

          if(Hash::check($request_data['current-password'], $current_password)) {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request_data['password']);;

            $obj_user->save();
            return Redirect::back()->with('Operation Successful !');  }

          else {
          return Redirect::back()->withErrors(['Incorrect Password']);}
              }
                      }

      else {
        return redirect()->to('/'); }
  }
}
