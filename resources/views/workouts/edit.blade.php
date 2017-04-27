@extends('layouts.master')

@section('title', '| Edit Workout')

@section('stylesheets')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="row">
       <!--- tells laravel to open an existing form model and connecting them-->
      {!!Form::model($workoutInfos, array('route' => array('workouts.update', $workout->id), 'method' => 'PUT'))!!}

      <div class="col-md-8">
        <h3>Edit workout</h3>
        <hr /><br />
        <!--- make sure first paramater matches column in database -->
        {{Form::label('title', 'Workout name') }}
        {{Form::text('title', $workout->title, array('class' => 'form-control create-workout'))}}
        <br /><br />

        {{-- {{Form::label('slug', 'Slug: ')}}
        {{Form::text('slug', null, array('class'=> 'form-control', 'required' => '', 'minlength' => '5',
          'maxlength' => '255'))}} --}}

        {{Form::label('description', 'Description')}}
        {{Form::text('description', $workout->description, array('class' => "form-control create-workout", 'style' => 'width: 643.325px'))}}
        <hr />

        {{Form::label('group', 'Group')}}
        <br /><br />
        <div class="form-group">
          @if($isAdmin == '0')
            <select name="group" class="selectpicker" required>
              <option value="11">
                Miscellaneous
              </option>
            </select>
          @else
          <select name="group" class="selectpicker show-tick" data-dropup-auto="false" required>
            @foreach($groups as $group)
              @if($group->id == $groupSelected)
                <option value="{{$group->id}}" selected>
                  {{$group->name}}
                </option>
              @else
                <option value="{{$group->id}}">
                  {{$group->name}}
                </option>
              @endif
            @endforeach
          </select>
        @endif
        </div>
        <hr />

        <div class="table-responsive">
            <table class="table" id="dynamic_field">
              @for($i=0; $i < $array_length; $i++)
                <tr>
                  <td style="padding-left: 0px;"><label>Exercise</label></td>
                  <td><input type="text" name="workout[]" value="{{ $workoutInfos[$i]->name }}" class="form-control create-workout" required></td>
                  <td><label>Sets</label></td>
                  <td><input type="text" name="sets[]" value="{{ $workoutInfos[$i]->sets }}" class="form-control create-workout" style="width: 70px;" required></td>
                  <td><label>Reps</label></td>
                  <td><input type="text" name="reps[]" value="{{ $workoutInfos[$i]->reps }}" class="form-control create-workout" style="width: 70px;" required></td>
                </tr>
              @endfor
            </table>
          </div>
      </div>
      <div class="col-md-4">
        <div class="well" style="padding-left: 0px; padding-right: 0px; margin-top: 20px;">
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
              <a href="{{route('workouts.show', $workout->id)}}" class="btn btn-danger btn-delete btn-block">
                Cancel
              </a>
            </div>
            <div class="col-sm-6" style="padding-right: 45px;">
              <button type="submit" name="button" class="btn btn-primary btn-edit btn-block">
                Save
              </button>
            </div>
          </div>
        </div>
      </div>
      {!!Form::close()!!} <!--- !! bc we are not echoing it out, just executing code -->
    </div> <!---end of .row (form) -->
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
@endsection
