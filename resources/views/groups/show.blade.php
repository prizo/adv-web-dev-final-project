@extends('layouts.master')

@section('title', "| $group->name")

@section('content')
<div class="row">
  <div class="col-md-3">
    <div align="center">
      <img src="/adv-web-dev-final-project/public/assets/img/sports/spartans.jpeg" style="width:150px; height:150px; margin:25px" />
    </div>
    <div align="center">
      <h3>{{$group->name}}</h3>
    </div>
    @if($isFollowing)
      <a href="{{route('groups.unfollow', $group->id)}}" class="btn btn-primary btn-md">Unfollow</a>
    @else
      <a href="{{route('groups.follow', $group->id)}}" class="btn btn-primary btn-md">Follow</a>
    @endif
  </div>
  <div class="col-md-6">
    <h1>Workouts</h1>
    <hr />
    @foreach($workouts as $workout)
      <div class="workout">
        <h3>{{$workout->title}}</h3>
        <p>
          {{substr($workout->description, 0 , 200)}}

          {{strlen($workout->description) > 200 ? '...': ""}}
        </p>
        <p>{{date('M j, Y h:i A', strtotime($workout->updated_at))}}</p>

        <a href="{{route('workouts.show', $workout->id)}}" class="btn btn-primary btn-xs">Read More</a>
      </div>
    @endforeach
    <div class="text-center">
      {!!$workouts->links()!!}
    </div>
  </div>
</div>
@endsection
