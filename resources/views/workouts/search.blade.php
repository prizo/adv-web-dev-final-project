@extends('layouts.master')

@section('title', '|  Search')

@section('search', $search)
@section('content')

  <div class="row">
    @if(count($workouts) <= 0)
      <div class="col-md-12">
        <h3 style="text-align:center">
          We couldn't find any workouts matching
          <br />
          '{{$search}}'
        </h3>
      </div>
    @else
      <h2>Searched For "{{$search}} "...</h2>
      <div class="col-md-8">
        @foreach($workouts as $workout)
          <div class="workout">
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
          </div>
          <hr />
        @endforeach
        <div class="text-center">
          {{-- for when the user goes to the next page it still is showing the results of what is searched --}}
          {!!$workouts->appends(['search' => Request::get("search")])->links()!!}
        </div>
      </div>
    @endif

@endsection
