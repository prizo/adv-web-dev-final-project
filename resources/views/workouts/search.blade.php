@extends('layouts.master')

@section('title', '|  Search')

@section('search', $search)

@section('content')
  <div class="row">
    <div class="col-md-3">
      {!!Form::open(array('data-parsley-validate' => '', 'route' => 'workouts.search', 'method' => 'GET', 'role'=> 'search', 'class'=>'navbar-form'))!!}
        <div class="input-group">
          <input type="hidden" name="search" value="{{$search}}">
          <input type="hidden" name="type" value='workout'>
          <button type="submit" class="form-control">Workouts | {{$allFoundWorkouts}}</button>
        </div>
        {!!Form::close()!!}

        {!!Form::open(array('data-parsley-validate' => '', 'route' => 'workouts.search', 'method' => 'GET', 'role'=> 'search', 'class'=>'navbar-form'))!!}
          <div class="input-group">
            <input type="hidden" name="search" value="{{$search}}">
            <input type="hidden" name="type" value='group'>
            <button type="submit" class="form-control ">Groups | {{$allFoundGroups}}</button>
          </div>
          {!!Form::close()!!}
    </div>
    @if(strtolower($type) == 'workout' || $type == '')
      @if(count($workouts) <= 0 || $isEmpty)
          <h3>
            We couldn't find any workouts matching
            <br />
            '{{$search}}' "
          </h3>

      @else
        <div class="col-md-offset-3">

        @section('type', 'workout')
          <h2>Searched for workout "{{$search}} "...</h2>

          @foreach($workouts as $workout)
              <h3>{{$workout->title}}</h3>
              <p>
                {{substr($workout->description, 0 , 200)}}

                {{strlen($workout->description) > 200 ? '...': ""}}
              </p>
              <p>{{date('M j, Y h:i A', strtotime($workout->updated_at))}}</p>

              @if($workout->user->fname == Auth::user()->fname)
                <p>
                  By: You
                </p>
              @else
                <p>
                  By: <a href="{{route('profile.get', $workout->user->username)}}">{{$workout->user->fname}} {{$workout->user->lname}}</a>
                </p>
              @endif

              <a href="{{route('workouts.show', $workout->id)}}" class="btn btn-primary btn-xs">Read More</a>
            <hr />
          @endforeach
        @endif
          <div class="text-center">
            {{-- for when the user goes to the next page it still is showing the results of what is searched --}}
            {!!$workouts->appends(['search' => Request::get("search")])->links()!!}
          </div>
        @else
        @if(count($groups) <= 0)
            <h3>
              We couldn't find any groups matching
              <br />
              '{{$search}}'
            </h3>
    @else
      <div class="col-md-offset-3">
      <h2>Searched for group "{{$search}} "...</h2>

      @foreach($groups as $group)
        <a href="{{route('groups.show', $group->name)}}"><h3>{{$group->name}}</h3></a>
        <hr />
      @endforeach
    @endif
      </div>
    </div>
  @endif

@endsection
