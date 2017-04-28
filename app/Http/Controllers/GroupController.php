<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Workout;
use App\WorkoutInfo;
use Session;
use Auth;
use App\Group;
use App\Follow;

class GroupController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(){
    $user = Auth::user();


    $following = Follow::where('user_id', $user->id)->paginate(4); //get who the user is following

    $groupsFollowing = array();
    foreach($following as $follow){
      $groupsFollowing[] .= $follow->group->name;
    }

    return view('groups.index')->with('following', $following)->with('groupsFollowing', $groupsFollowing);

  }

  public function getGroup($name){

    $user = Auth::user();
    $group = Group::where('name' ,'=', $name)->first();
    $isFollowing = true;


    $following = Follow::where('user_id', $user->id)->where('group_id', $group->id)->first();

    if(count($following) <= 0){
      $isFollowing = false;
    }

    $workouts = Workout::where('group_id', $group->id)->orderBy('updated_at', 'desc')->paginate(4);

    return view('groups.show')
            ->with('group', $group)
            ->with('workouts', $workouts)
            ->with('isFollowing', $isFollowing);

  }

  public function followGroup($groupId){

    $user = Auth::user();

    $group = Group::find($groupId);
    $groupName = strtoupper($group->name);

    if($groupId == 3){
      return redirect()->route('groups.show', $groupName); //url only not actual "html" page\
    }


    $following = Follow::where('user_id', $user->id)->where('group_id', $group->id)->first();

    if(count($following) > 0){ //if a user is trying to manually follow via url and is already following
      Session::flash('nosuccess', "You are already following $groupName");
      return redirect()->route('groups.show', $groupName); //url only not actual "html" page
    }
    $follow = new Follow;


    $follow->group_id = $groupId;
    $follow->user_id = $user->id;

    $follow->save();

    Session::flash('success', "You are now following $groupName!");

    return redirect()->route('groups.show', $groupName); //url only not actual "html" page

  }

  public function unfollowGroup($groupId){
    $user = Auth::user();

    $group = Group::find($groupId);
    $groupName = strtoupper($group->name);


    $following = Follow::where('user_id', $user->id)->where('group_id', $group->id)->first();

    if(count($following) <= 0){ //if a user is trying to manually unfollow via url and is not following
      return redirect()->route('groups.show', $groupName); //url only not actual "html" page
    }

    $following->delete();

    Session::flash('success', "You have successfully unfollowed $groupName!");

    return redirect()->route('groups.show', $groupName); //url only not actual "html" page

  }

}
