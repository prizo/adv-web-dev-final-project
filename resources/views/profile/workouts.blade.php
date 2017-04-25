@extends('layouts.master')

@section('title', "| View Workout")

@section('content')

<div class="row">
    <div class="col-md-8">
      {{-- <h1>{{$workoutInfos->name}}</h1> --}}
      <h1>{{$workout->title}}</h1>

      <p class="lead">
        {{$workout->description}}
      </p>
      <p>
        @if($workout->group_id != '3')
          <a href="{{route('groups.show', $workout->group->name)}}">{{$workout->group->name}}</a>
        @endif
      </p>
      <table class="table">
          <thead>
            <th>Workout Name</th>
            <th>Sets</th>
            <th>Reps</th>
          </thead>
          <tbody>
            @foreach($workoutInfos as $info)
              <tr>
                <td>
                  {{$info->name}}
                </td>
                <td>
                  {{$info->sets}}
                </td>
                <td>
                  {{$info->reps}}
                </td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
    <div class="col-md-4">
        <div class="well">
          {{-- <dl class="dl-horizontal">
            <label>Url: </label>
            <p><a href="{{route('blog.single', $post->slug)}}">{{route('blog.single', $post->slug)}}</a></p>
          </dl> --}}
          <dl class="dl-horizontal">
            <labelp>Created at: </labelp>
            <p>{{date('M j, Y h:i A', strtotime($workout->created_at))}}</p>
          </dl>
          <dl class="dl-horizontal">
            <labelp>Last Updated: </labelp>
            <p>{{date('M j, Y h:i A', strtotime($workout->updated_at))}}</p>
          </dl>

        </div>
      </div>

@endsection
