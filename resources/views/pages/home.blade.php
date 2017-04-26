@extends('layouts.master')
@section('content')
    @include('partials/_table')
    <div class="row" style="padding-left: 15px; padding-right: 15px;">
      @if(count($workouts) <= 0)
        <div class="col-md-8" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px;">
          <h1 style="padding-top: 0px; margin-top: 0px;">Activity Feed</h1>
          <hr />
          <h3>
            No activity...
          </h3>
        </div>
        <div class="col-md-4" style="padding-right: 0px; margin-bottom: 20px; margin-left: 5px;">
          @include('partials/_carousel')
        </div>
        <div class="col-md-4" style="padding-right: 0px; margin-left: 653.33px;">
          <div class="panel panel-default">
            <div class="panel-heading"><span style="font-weight: bold;">Groups</span></div>
            <div class="panel-body">

            </div>
          </div>
        </div>
      @else
        <div class="col-md-8" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px;">
          <h1 style="padding-top: 0px; margin-top: 0px;">Activity Feed</h1>
          <hr />
          @foreach($workouts as $workout)
            <div class="workout">
              <h3>{{$workout->title}}</h3>
              <p>
                {{substr($workout->description, 0 , 200)}}

                {{strlen($workout->description) > 200 ? '...': ""}}
              </p>
              <p class="pull-right">{{date('M j, Y h:i A', strtotime($workout->updated_at))}}</p>

              <a href="{{route('workouts.show', $workout->id)}}" class="btn btn-xs" style="color: #0366d6;
                background-color: #fff;
                border: 1px solid rgba(27,31,35,0.2);
                border-radius: 0.25em;">Read More</a>
            </div>
            <hr />
          @endforeach
          <div class="text-center" style="height: 60px;">
            {!!$workouts->links()!!}
          </div>
        </div>
        <div class="col-md-4" style="padding-right: 0px; margin-bottom: 20px; margin-left: 5px;">
          @include('partials/_carousel')
        </div>
        <div class="col-md-4" style="padding-right: 0px; margin-left: 5px;">
          <div class="panel panel-default">
            <div class="panel-heading"><span style="font-weight: 600; font-size: 14px;">Groups</span></div>
            <div class="panel-body">
              @if(count($following) <= 0)
                <p>
                  Not following any groups...
                </p>
              @else
                @foreach($following as $follow)
                  <h4><a href="{{route('groups.show', $follow->group->name)}}">{{$follow->group->name}}</a></h4>
                  <label>Last Post: {{date('M j, Y h:i A', strtotime($follow->group->updated_at))}}</label>
                  <hr />
                @endforeach
                <label><a href="{{route('groups.index')}}">View all</a></label>
              @endif
            </div>
          </div>
        </div>
      @endif
    </div>
@endsection
