@extends('layouts.master')


@section('title', "| Create Workout")

@section('stylesheets')
  <link rel="stylesheet" href="http://localhost/AdvWeb_Project/Fiithub/public/assets/css/parsley.css">
@endsection

@section('content')

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Create New Workout</h1>
      <hr />
      {!! Form::open(array('route' => 'workouts.store', 'data-parsley-validate' => '')) !!}
      {{ Form::hidden('username_id', Auth::user()->username) }}
      {{Form::label('title', 'Title:') }}
      {{Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255'))}}

      {{-- {{Form::label('slug', 'Slug: ')}}
      {{Form::text('slug', null, array('class'=> 'form-control', 'required' => '', 'minlength' => '5',
      'maxlength' => '255'))}} --}}
      {{Form::label('description', "Workout Information: " )}}
      {{Form::textarea('description', null, array('class' => "form-control", 'required' => ''))}}
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
            <option value="{{$group->id}}">
              {{$group->name}}
            </option>
          @endforeach
        </select>
      @endif
      </div>
      @for($i = 1; $i <= 3; $i++)
        <br />
        {{Form::label("workout", "Workout"." ".$i) }}
        <input type="text" name="workout[]" required />
        {{Form::label("sets", 'Sets: ') }}
        <input type="text" name="sets[]" required />
        {{Form::label("reps", "Reps: ") }}
        <input type="text" name="reps[]" required />
        <br />
      @endfor


      {{Form::submit('Create Workout', array('class' => "btn-success btn-lg btn-block",
        'style' => 'margin-top: 20px' ))}}
        {!! Form::close() !!}
      </div>
    </div>

  @endsection

  @section('scripts')
    <script src="http://localhost/AdvWeb_Project/Fiithub/public/assets/js/parsley.min.js"></script>

  @endsection
