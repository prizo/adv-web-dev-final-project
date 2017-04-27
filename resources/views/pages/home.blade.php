@extends('layouts.master')

@section('content')
    @include('partials/_table')
    <div class="row" style="padding-left: 15px; padding-right: 15px;">
      @if(count($workouts) <= 0)
        <div class="col-md-8" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px;">
          <h3 style="padding-top: 0px; margin-top: 0px; font-weight: 600;">Activity Feed</h3>
          <hr />
          <h5>
            No activity...
          </h5>
        </div>
        <div class="col-md-4" style="padding-right: 0px; margin-bottom: 20px; margin-left: 5px;">
          @include('partials/_carousel')
        </div>
        <div class="col-md-4" style="padding-right: 0px; margin-left: 653.33px;">
          <div class="panel panel-default">
            <div class="panel-heading"><span style="font-weight: bold;">Groups</span></div>
            <div class="panel-body">
              Not following any groups...
            </div>
          </div>
        </div>
      @else
        <div class="col-md-8" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px;">
          <h3 style="padding-top: 0px; margin-top: 0px; font-weight: 600;">Activity Feed</h3>
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
        <div class="col-md-4" style="padding-right: 0px; margin-bottom: 20px; margin-left: 5px;">
          @include('partials/_carousel')
        </div>
        <div class="col-md-4" style="padding-right: 0px; margin-left: 5px;">
          <div class="panel panel-default">
            <div class="panel-heading"><span style="font-weight: 600; font-size: 14px;">Groups</span></div>
            <div class="panel-body" style="padding: 0px;">
              @if(count($following) <= 0)
                Not following any groups...
              @else
                @foreach($following as $follow)
                  <h5 style="padding: 10px 15px;"><a href="{{route('groups.show', $follow->group->name)}}" style="color: #0366d6;">{{$follow->group->name}}</a></h5>
                  <p style="padding-left: 15px;"><span style="font-weight: bold;">Last post: </span>{{date('M j, Y h:i A', strtotime($follow->group->updated_at))}}</p>
                  <hr style="margin: 0px;" />
                @endforeach
                @if(count($following) > 3)
                  <a href="{{route('groups.index')}}" class="btn btn-default btn-xs" style="color: black; margin: 15px;">View all</a>
                @endif
              @endif
            </div>
          </div>
        </div>
      @endif
    </div>
@endsection
