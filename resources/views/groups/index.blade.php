@extends('layouts.master')

@section('title', "| Groups")

@section('content')
    @if(count($following) <= 0)
      <div class="col-md-8 col-md-offset-2" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px;">
        <h3 style="padding-top: 0px; margin-top: 0px; font-weight: 600;">Groups Activity Feed</h3>
        <hr />
        <h5>
          Not following any groups...
        </h5>
      </div>
    @else
    <div class="col-md-8 col-md-offset-2" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px;">
      <h3 style="padding-top: 0px; margin-top: 0px; font-weight: 600;">Groups Activity Feed</h3>
      <hr />
      @foreach($following as $follow)
        <div class="workout">
          <h5><a href="{{route('workouts.show', $follow->workouts->id)}}" style="color: #0366d6;">{{$follow->workouts->title}}</a></h5>
          <p style="padding-top: 10px; padding-bottom: 10px;">
            {{substr($follow->workouts->description, 0 , 200)}}

            {{strlen($follow->workouts->description) > 200 ? '...': ""}}
          </p>
          <p>{{$follow->group->name}}</p>
          <p style="padding-top: 10px; padding-bottom: 5px;"><span style="font-weight: bold;">Updated on: </span>{{date('M j, Y h:i A', strtotime($follow->workouts->updated_at))}}</p>
        </div>
        <hr />
      @endforeach
      <div class="text-center">
        {!!$following->links()!!}
      </div>
    </div>
    @endif
@endsection
