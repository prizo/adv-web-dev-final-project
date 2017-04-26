@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <div class="col-md-3">
      <img src="uploads/avatars/{{$user->avatar}}" style="width:150px; height:150px; border-radius:50%; margin-bottom: 20px; margin-right:25px;" />
      <h3 style="padding-left: 15px">{{strtoupper($user->fname) }} {{strtoupper($user->lname)}}</h3>
    </div>
    <div class="col-md-9">
      @foreach($workouts as $workout)
        <div class="workout">
          <h3>{{$workout->title}}</h3>
          <p>
            {{substr($workout->description, 0 , 200)}}

            {{strlen($workout->description) > 200 ? '...': ""}}
          </p>
          <p class="pull-right">Updated: {{date('M j, Y h:i A', strtotime($workout->updated_at))}}</p>

          <a href="{{route('workouts.show', $workout->id)}}" class="btn btn-primary btn-xs">Read More</a>
          <hr />
        </div>
      @endforeach
      <div class="text-center">
        {!!$workouts->links()!!}
      </div>
  </div>
@endsection
