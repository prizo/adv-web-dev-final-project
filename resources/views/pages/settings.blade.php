@extends('layouts.master')

@section('title', 'Edit Workout')

@section('content')
  <div class="col-md-4">
    <img src="uploads/avatars/{{$user->avatar}}" style="width:150px; height:150px; border-radius:50%; margin-right:25px;" />
      <form enctype="multipart/form-data" action="settings" method="POST">
        <label>Update Profile Image</label>
        <input type="file" name="avatar" />
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <input type="submit" class="btn btn-sm btn-primary"/>
      </form>
  </div>
    <div class="col-md-8">
      {!! Form::open(array('route' => 'workouts.store', 'data-parsley-validate' => '', 'method' => 'PUT')) !!}

      <!--- make sure first paramater matches column in database -->
      {{Form::label('fname', 'First Name:')}}
      <input  type="text" name="fname" value="{{$user->fname}}"/>
      <br />

      {{Form::label('lname', 'Last Name:')}}
      <input  type="text" name="lname" value="{{$user->lname}}"/>
      <br />

      {{Form::label('password', 'Password:')}}
      <input  type="password" name="password" value="{{$user->password}}"/>
      <br />
      {{Form::label('passwordConfirm', 'Re-type Password:')}}
      <input  type="password" name="passwordConfirm" value="{{$user->password}}"/>
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

@endsection
