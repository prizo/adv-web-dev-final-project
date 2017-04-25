@extends('layouts.master')

@section('title', "| Groups")

@section('content')
  <div class="row">
    <div class="col-md-12">
      @if(count($following) <= 0)
        <h3>Not following any groups</h3>
      </div>
      @else
        <div class="col-md-3">
        <h2><b>Groups Activity</b></h2>
        </div>
        <div class="col-md-9">

        @foreach($following as $follow)
          <div class="workout">
            <h3>{{$follow->workouts->title}}</h3>
            <p>
              {{substr($follow->workouts->description, 0 , 200)}}

              {{strlen($follow->workouts->description) > 200 ? '...': ""}}
            </p>
            <p>{{date('M j, Y h:i A', strtotime($follow->workouts->updated_at))}}</p>

            <a href="{{route('workouts.show', $follow->workouts->id)}}" class="btn btn-primary btn-xs">Read More</a>
          </div>
          <hr />
        @endforeach
      <div class="text-center">
        {!!$following->links()!!}
      </div>
    @endif

    </div>
  </div>

@endsection
