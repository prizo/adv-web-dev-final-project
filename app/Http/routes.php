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

  Route::get('home', 'PagesController@getHome');

});

Route::get('workouts/all', 'WorkoutController@getWorkouts')->name('workouts.all');
Route::get('workouts/{workouts}', 'WorkoutController@show')->middleware('workout.check')->name('workouts.show');
Route::resource('workouts', 'WorkoutController', ['except' => 'show']);

Route::auth();
