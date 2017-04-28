<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//using middleware to only access settings if logged in
Route::group(['middleware' => 'auth'], function () {
  Route::get('/', 'PagesController@getHome');


  Route::get('settings', 'PagesController@getSettings');
  Route::put('settings', 'PagesController@update')->name('user.update');
  //Route::post('settings', 'PagesController@update_avatar');
  Route::post('settings', 'SettingsController@update')->name('user');


  Route::get('home', 'PagesController@getHome');

  Route::get('search', 'WorkoutController@search')->name('workouts.search');



});

//needs to be before {username}, if not it will think that "login" is a name and it will be
//redirected to login and create an infinite loop
Route::auth();

Route::get('{username}', 'ProfileController@getProfile')->name('profile.get');

Route::get('workouts/all', 'WorkoutController@getWorkouts')->name('workouts.all');
Route::resource('workouts', 'WorkoutController', ['except' => 'show']);
Route::get('workouts/{workouts}', 'WorkoutController@show')->middleware('workout.check')->name('workouts.show');

Route::get('groups/show/{groupname}', 'GroupController@getGroup')->middleware('group.check')->name('groups.show');
Route::get('profile/{workout}', 'ProfileController@getUserWorkout')->name('profile.workouts');

Route::get('groups/index', 'GroupController@index')->name('groups.index');

Route::get('groups/follow/{groupid}', 'GroupController@followGroup')->name('groups.follow');
Route::get('groups/unfollow/{groupid}', 'GroupController@unfollowGroup')->name('groups.unfollow');
