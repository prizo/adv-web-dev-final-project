@extends('layouts.master')

@section('title', "| $group->name")

@section('content')
    <div class="row">
      <div class="col-md-3" style="padding-left: 0px;">
        <div>
          <img src="/adv-web-dev-final-project/public/assets/img/sports/{{$group->logo}}" style="width: 229px; height: 230px; border-radius: 6px;" />
        </div>
        <br />
        <div>
          <span class="name-custom">{{$group->name}}</span>
        </div>
        <br />
        @if($isFollowing)
          <a href="{{route('groups.unfollow', $group->id)}}" class="btn btn-primary btn-md" style="background-color: #6f42c1; font-weight: 600;">
            <span class="glyphicon glyphicon-minus-sign" style="vertical-align: text-top;"></span> Unfollow
          </a>
        @else
          <a href="{{route('groups.follow', $group->id)}}" class="btn btn-primary btn-md" style="background-color: #6f42c1; font-weight: 600;">
            <span class="glyphicon glyphicon-plus-sign" style="vertical-align: text-top;"></span> Follow
          </a>
        @endif
      </div>
      @if(count($workouts) <= 0)
        <div class="col-md-9" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px;">
          <h3 style="padding-top: 0px; margin-top: 0px; font-weight: 600;">Workouts</h3>
          <hr />
          <h5>
            No activity...
          </h5>
        </div>
      @else
        <div class="col-md-9" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px">
          <h3 style="padding-top: 0px; margin-top: 0px; font-weight: 600;">Workouts</h3>
          <hr />
          @foreach($workouts as $workout)
            <div class="workout">
              <h5><a href="{{route('workouts.show', $workout->id)}}" style="color: #0366d6;">{{$workout->title}}</a></h5>
              <p style="padding-top: 10px; padding-bottom: 10px;">
                {{substr($workout->description, 0 , 200)}}

                {{strlen($workout->description) > 200 ? '...': ""}}
              </p>
              <p><span style="font-weight: bold;">Updated on: </span>{{date('M j, Y h:i A', strtotime($workout->updated_at))}}</p>
            </div>
            <hr />
          @endforeach
          <div class="text-center">
            {!!$workouts->links()!!}
          </div>
        </div>
      @endif
    </div>
@endsection
