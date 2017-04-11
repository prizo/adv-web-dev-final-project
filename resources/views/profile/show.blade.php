@extends('layouts.master')

@section('title', 'Profile')

@section('content')
    <div class="col-md-8 col-md-offset-4">
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

@endsection
