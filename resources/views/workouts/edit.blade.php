@extends('layouts.master')

@section('title', 'Edit Workout')

@section('content')

  <div class="row">
     <!--- tells laravel to open an existing form model and connecting them-->
    {!!Form::model($workoutInfos, array('route' => array('workouts.update', $workout->id), 'method' => 'PUT'))!!}

    <div class="col-md-8">
      <!--- make sure first paramater matches column in database -->
      {{Form::label('title', 'Title:')}}
      {{Form::text('title', $workout->title, array('class' => 'form-control input-lg'))}}
      {{-- <hr />
      {{Form::label('slug', 'Slug: ')}}
      {{Form::text('slug', null, array('class'=> 'form-control', 'required' => '', 'minlength' => '5',
        'maxlength' => '255'))}} --}}
      <hr />
      {{Form::label('description', 'Body:')}}
      {{Form::textarea('description', $workout->description, array('class' => 'form-control input-lg'))}}

      <br />
      <div class="form-group">
        @if($isAdmin == '0')
          <select size="1" name="group" required>
              <option value="3">
                  Miscellaneous
              </option>
          </select>
        @else
        <select size="2" name="group" required>
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
      @for($i = 1; $i <= 3; $i++)
        <br />
          {{Form::label("workout", "Workout".$i) }}
          <input type="text" name="workout[]" value="{{$workoutInfos[$i-1]->name}}" required />
          {{Form::label("sets", 'Sets: ') }}
          <input type="text" name="sets[]" value="{{$workoutInfos[$i-1]->sets}}" required />
          {{Form::label("reps", "Reps: ") }}
          <input type="text" name="reps[]" value="{{$workoutInfos[$i-1]->reps}}" required />
        <br />
      @endfor

    </div>
    <div class="col-md-4">
        <div class="well">
          <dl class="dl-horizontal">
            <dt>Created at: </dt>
            <dd>{{date('M j, Y h:i A', strtotime($workout->created_at))}}</dd>
          </dl>
          <dl class="dl-horizontal">
            <dt>Last Updated: </dt>
            <dd>{{date('M j, Y h:i A', strtotime($workout->updated_at))}}</dd>
          </dl>

          <hr />
          <div class="row">
            <div class="col-sm-6">
              {!! Html::linkRoute('workouts.show', 'Cancel', array('id' => $workout->id), array('class' =>
                    'btn btn-danger btn-block'))!!}
            </div>
            <div class="col-sm-6">
              {{Form::submit('Save Changes', array("class" => 'btn btn-block btn-success'))}}
            </div>
          </div>
        </div>
    </div>
    {!!Form::close()!!} <!--- !! bc we are not echoing it out, just executing code -->
  </div> <!---end of .row (form) -->

@endsection
