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
          {{Form::label('description', "Post Body: " )}}
          {{Form::textarea('description', null, array('class' => "form-control", 'required' => ''))}}
          <br />
          @for($i = 1; $i <= 3; $i++)
              {{Form::label("workout".$i, "Workout".$i) }}
              {{Form::text("workout".$i, null, array('required' => '', 'maxlength' => '255'))}}
              {{Form::label("sets".$i, 'Sets: ') }}
              {{Form::text("sets".$i, null, array( 'required' => '', 'maxlength' => '255'))}}
              {{Form::label("reps".$i, "Reps") }}
              {{Form::text("reps".$i, null, array('required' => '', 'maxlength' => '255'))}}
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
