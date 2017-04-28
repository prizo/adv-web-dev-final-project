@extends('layouts.master')

@section('title', "| View Workout")

@section('content')
    <div class="row">
      <div class="col-md-8" style="margin-top: 20px;">
        {{-- <h1>{{$workoutInfos->name}}</h1> --}}
        <h3 style="margin-top: 0px;">{{$workout->title}}</h3>
        <p style="padding-top: 10px; padding-bottom: 10px;">
          {{$workout->description}}
        </p>
        <p>
          @if($workout->group_id != '11')
            <a href="{{route('groups.show', $workout->group->name)}}" style="color: #0366d6;">{{$workout->group->name}}</a>
          @endif
        </p>
        <br />
        <div class="panel panel-default">
          <table class="table table-bordered table-hover">
              <thead>
                <th>Exercise</th>
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
      </div>
      <div class="col-md-4">
        <div class="well" style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; margin-top: 20px;">
          {{-- <dl class="dl-horizontal">
            <label>Url: </label>
            <p><a href="{{route('blog.single', $post->slug)}}">{{route('blog.single', $post->slug)}}</a></p>
          </dl> --}}
          <div align="right" style="padding-right: 30px;">
            <dl class="dl-horizontal">
              <p><span style="font-weight: bold;">Created on: </span>{{date('M j, Y h:i A', strtotime($workout->created_at))}}</p>
            </dl>
          </div>
          <hr />
          <div align="right" style="padding-right: 30px;">
            <dl class="dl-horizontal">
              <p><span style="font-weight: bold;">Last updated: </span>{{date('M j, Y h:i A', strtotime($workout->updated_at))}}</p>
            </dl>
          </div>
          <hr />
          <div class="row">
            <div class="col-sm-6" style="padding-left: 45px;">
              <a href="{{route('workouts.edit', $workout->id)}}" class="btn btn-primary btn-edit btn-block">
                Edit
              </a>
              {{--{!! Html::linkRoute('workouts.edit', 'Edit', array('id' => $workout->id), array('class' =>
                    'btn btn-primary btn-block'))!!}--}}
            </div>
            <div class="col-sm-6" style="padding-right: 45px;">
              {!!Form::open(array('route' => array('workouts.destroy', $workout->id), 'method' => 'DELETE'))!!}

              <button type="submit" name="button" class="btn btn-danger btn-delete btn-block">
                Delete
              </button>
              {{--{!!Form::submit('Delete', array('class' => 'btn btn-danger btn-block'))!!}--}}

              {!!Form::close()!!}
            </div>
          </div>
          <hr />
          <div align="center">
            <dl class="dl-horizontal">
              <h5 style="padding: 0px 15px;"><a href="{{route('workouts.all')}}" style="color: #0366d6;">Show all workouts</a></h5>
            </dl>
          </div>
            {{--{!! Html::linkRoute('workouts.all', 'Show all workouts', array(), array('class' =>
                  'btn btn-md btn-block'))!!}--}}
        </div>
      </div>
    </div>
@endsection
