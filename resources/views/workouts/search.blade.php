@extends('layouts.master')

@section('title', '| Search')

@section('search', $search)

@section('content')
    @include('partials/_table')
    <div class="row" style="margin-top: 20px;">
      <div class="col-md-2">
        {!!Form::open(array('data-parsley-validate' => '', 'route' => 'workouts.search', 'method' => 'GET', 'role'=> 'search', 'class'=>''))!!}
          <div class="input-group">
            <input type="hidden" name="search" value="{{$search}}">
            <input type="hidden" name="type" value='workout'>
            <button type="submit" class="btn btn-default">
              Workouts <span class="Counter" style="color: #fff; background-color: rgba(47,54,61,0.5);">{{count($allFoundWorkouts)}}</span>
            </button>
          </div>
        {!!Form::close()!!}
        <br />
        {!!Form::open(array('data-parsley-validate' => '', 'route' => 'workouts.search', 'method' => 'GET', 'role'=> 'search', 'class'=>''))!!}
          <div class="input-group">
            <input type="hidden" name="search" value="{{$search}}">
            <input type="hidden" name="type" value='group'>
            <button type="submit" class="btn btn-default">
              Groups <span class="Counter" style="color: #fff; background-color: rgba(47,54,61,0.5);">{{count($allFoundGroups)}}</span>
            </button>
          </div>
        {!!Form::close()!!}
      </div>
      @if(strtolower($type) == 'workout' || $type == '')
        @if(count($workouts) <= 0 || $isEmpty)
          <div class="col-md-8" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px;">
            <h3 style="padding-top: 0px; margin-top: 0px; font-weight: 600;">Workouts matching '{{$search}}'...</h3>
            <hr />
            <h5>
              We couldn't find any workouts matching '{{$search}}'
            </h5>
          </div>
        @else
          @section('type', 'workout')
          <div class="col-md-8" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px;">
            <h3 style="padding-top: 0px; margin-top: 0px; font-weight: 600;">Workouts matching '{{$search}}'...</h3>
            <hr />
            @foreach($workouts as $workout)
              <div class="workout">
                <h5><a href="{{route('workouts.show', $workout->id)}}" style="color: #0366d6;">{{$workout->title}}</a></h5>
                <p style="padding-top: 10px; padding-bottom: 10px;">
                  {{substr($workout->description, 0 , 200)}}

                  {{strlen($workout->description) > 200 ? '...': ""}}
                </p>
                @if($workout->user->fname == Auth::user()->fname)
                  <p>
                    By: You
                  </p>
                @else
                  <p>
                    By: <a href="{{route('profile.get', $workout->user->username)}}" style="color: #0366d6;">{{$workout->user->username}}</a>
                  </p>
                @endif
                <p style="padding-top: 10px; padding-bottom: 5px;"><span style="font-weight: bold;">Updated on: </span>{{date('M j, Y h:i A', strtotime($workout->updated_at))}}</p>
              </div>
              <hr />
            @endforeach
            <div class="text-center">
              {{-- for when the user goes to the next page it still is showing the results of what is searched --}}
              {!!$workouts->appends(['search' => Request::get("search")])->links()!!}
            </div>
          </div>
        @endif
      @else
        @if(count($groups) <= 0)
          <div class="col-md-8" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px;">
            <h3 style="padding-top: 0px; margin-top: 0px; font-weight: 600;">Groups matching '{{$search}}'...</h3>
            <hr />
            <h5>
              We couldn't find any groups matching '{{$search}}'
            </h5>
          </div>
        @else
          <div class="col-md-8" style="border: 2px dashed rgba(27,31,35,0.3); border-radius: 5px; padding: 30px; width: 648.33px;">
            <h3 style="padding-top: 0px; margin-top: 0px; font-weight: 600;">Groups matching '{{$search}}'...</h3>
            <hr />
            @foreach($groups as $group)
              <h5><a href="{{route('groups.show', $group->name)}}" style="color: #0366d6;">{{$group->name}}</a></h5>
              <hr />
            @endforeach
            <div class="text-center">
              {{-- not working --}}
              {!!$groups->appends(['search' => Request::get("search")])->links()!!}
            </div>
          </div>
        @endif
      @endif
    </div>
@endsection
