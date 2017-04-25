@extends('layouts.master')
@section('content')
  <div class="row">
    @if(count($workouts) <= 0)
      <div class="col-md-8">
        <h3>
          No activity...
        </h3>
      </div>
    @else
      <div class="col-md-8">
        <h1>Your Activity</h1>
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
          <hr />
        @endforeach
        <div class="text-center">
          {!!$workouts->links()!!}
        </div>
      </div>
    @endif
    <div class="col-md-4">
      @include('partials/_carousel')
      <div class="groupFollow">
        <div class="headerGroup"><h3>Followed Groups</h3></div>
        @if(count($following) <= 0)
          <p>
            Not following any groups...
          </p>
        @else
          @foreach($following as $follow)
            <h4><a href="{{route('groups.show', $follow->group->name)}}">{{$follow->group->name}}</a></h4>
            <label>Last Updated: {{date('M j, Y h:i A', strtotime($follow->group->updated_at))}}</label>
            <hr />
          @endforeach
          <label><a href="{{route('groups.index')}}">View all</a></label>
        @endif
      </div>
    </div>
  </div class="row">
  @endsection
