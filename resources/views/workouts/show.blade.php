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

            <hr />
            <div class="row">
              <div class="col-sm-6">
                {!! Html::linkRoute('workouts.edit', 'Edit', array('id' => $workout->id), array('class' =>
                      'btn btn-primary btn-block'))!!}
              </div>
              <div class="col-sm-6">
                {!!Form::open(array('route' => array('workouts.destroy', $workout->id), 'method' => 'DELETE'))!!}

                {!!Form::submit('Delete', array('class' => 'btn btn-danger btn-block'))!!}

                {!!Form::close()!!}
              </div>
            </div>
            <hr />
            <div class="row">
              {!! Html::linkRoute('workouts.all', 'Show All Posts', array(), array('class' =>
                    'btn btn-md btn-block'))!!}
              </div>          </div>
          </div>
      </div>
    </div>
@endsection
