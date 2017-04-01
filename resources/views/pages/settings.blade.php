@extends('layouts.master')

@section('title', 'Edit Workout')

@section('content')

  <div class="row">
     <!--- tells laravel to open an existing form model and connecting them-->
     {!! Form::open(array('route' => 'workouts.store', 'data-parsley-validate' => '', 'method' => 'PUT')) !!}

    <div class="col-md-8">
      <!--- make sure first paramater matches column in database -->
      {{Form::label('fname', 'First Name:')}}
      {{Form::text('fname', $user->fname, array('class' => 'form-control input-lg'))}}
      <hr />
      {{Form::label('lname', 'Last Name:')}}
      {{Form::text('lname', $user->fname, array('class' => 'form-control input-lg'))}}
      <hr />
      {{Form::label('password', 'Password:')}}
      {{Form::password('password', $user->fname, array('class' => 'form-control input-lg'))}}
    </div>
    {{-- <div class="col-md-4">
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
    </div> --}}
    {!!Form::close()!!} <!--- !! bc we are not echoing it out just executing code -->
  </div> <!---end of .row (form) -->

@endsection
