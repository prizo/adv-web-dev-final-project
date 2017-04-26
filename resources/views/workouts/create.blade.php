@extends('layouts.master')

@section('title', "| Create Workout")

@section('stylesheets')
  <link rel="stylesheet" href="http://localhost/AdvWeb_Project/FiitHub/public/assets/css/parsley.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="row">
      <div class="col-md-8" style="float: none; margin: 0 auto; width: 700px; padding: 0px;">
        <h3>Create a new workout</h3>
        <hr /><br />
        {!! Form::open(array('route' => 'workouts.store', 'data-parsley-validate' => '')) !!}
            {{ Form::hidden('username_id', Auth::user()->username) }}

            {{Form::label('title', 'Workout name') }}
            {{Form::text('title', null, array('class' => 'form-control create-workout', 'required' => '', 'maxlength' => '255'))}}
            <br /><br />

            {{-- {{Form::label('slug', 'Slug:')}}
            {{Form::text('slug', null, array('class'=> 'form-control', 'required' => '', 'minlength' => '5',
            'maxlength' => '255'))}} --}}

            {{Form::label('description', 'Description')}}
            {{Form::text('description', null, array('class' => "form-control create-workout", 'style' => 'width: 700px', 'required' => ''))}}
            <hr />

            <div class="form-group">
              @if($isAdmin == '0')
                <select name="group" class="selectpicker" required>
                  <option value="3">
                    Miscellaneous
                  </option>
                </select>
              @else
                <select name="group" class="selectpicker show-tick" title="Select a group..." data-dropup-auto="false" required>
                  @foreach($groups as $group)
                    <option value="{{$group->id}}">
                      {{$group->name}}
                    </option>
                  @endforeach
                </select>
              @endif
            </div>
            <hr />

            <div class="table-responsive">
              <table class="table" id="dynamic_field">
                @for($i=1; $i < 4; $i++)
                  <tr>
                    <td style="padding-left: 0px;"><label>Exercise</label></td>
                    <td><input type="text" name="workout[]" id="workout" class="form-control create-workout" required></td>
                    <td><label>Sets</label></td>
                    <td><input type="text" name="sets[]" id="sets" class="form-control create-workout" style="width: 70px;" required></td>
                    <td><label>Reps</label></td>
                    <td><input type="text" name="reps[]" id="reps" class="form-control create-workout" style="width: 70px;" required></td>
                  @if($i == 3)
                    <td><button type="button" name="add" id="add" class="btn btn-default btn-sm" style="">Add More</button></td>
                  @else
                    <td></td>
                  @endif
                  </tr>
                @endfor
              </table>
              <hr />
            </div>
            <input type="submit" name="submit" id="submit" value="Create workout" class="btn btn-success btn-workout">
            <br />
            <br />

            <!-- {{Form::submit('Create Workout', array('class' => "btn-success btn-lg btn-block",
              'style' => 'margin-top: 20px' ))}} -->
        {!! Form::close() !!}
      </div>
    </div>
@endsection

@section('scripts')
    <script src="http://localhost/AdvWeb_Project/FiitHub/public/assets/js/parsley.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script>
    $(document).ready(function(){
      var i = 1;
      $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'">\
                                      <td style="padding-left: 0px;"><label>Exercise</label></td>\
                                      <td><input type="text" name="workout[]" id="workout" class="form-control create-workout" required></td>\
                                      <td><label>Sets</label></td>\
                                      <td><input type="text" name="sets[]" id="sets" class="form-control create-workout" style="width: 70px;" required></td>\
                                      <td><label>Reps</label></td>\
                                      <td><input type="text" name="reps[]" id="reps" class="form-control create-workout" style="width: 70px;" required></td>\
                                      <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm btn-delete">X</button></td>\
                                    </tr>');
      });
      $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $("#row"+button_id+"").remove();
      });
    });
    </script>
@endsection
