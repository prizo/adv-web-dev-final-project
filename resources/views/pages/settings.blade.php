@extends('layouts.master')

@section('title', '| Settings')

@section('content')
    <div class="row" style="margin-top: 20px;">
      <div class="col-md-3">
        <div>
          <img src="uploads/avatars/{{$user->avatar}}" style="width: 229px; height: 230px; border-radius: 6px;" />
        </div>
        <br />
        <div>
          <form enctype="multipart/form-data" method="POST" action="{{ url('/settings') }}">
            {{--<span class="name-custom">Change profile image</span><br /><br />--}}
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-default btn-file">
                        Browse <input type="file" name="avatar" style="display: none;">
                    </span>
                </label>
                <input type="text" class="form-control create-workout" style="margin-top: 0px; width: 157px;" readonly>
            </div><br />
            <input type="hidden" name="form" value="1" />
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <input type="submit" name="submit" value="Update" class="btn btn-success btn-workout">
          </form>
        </div>
      </div>
      <div class="col-md-9" style="width: 648.33px; margin-left: 15px;">
        <h3 style="margin-top: 0px;">Change password</h3>
        <hr /><br />
        <form id="form-change-password" role="form" method="POST" action="{{ url('/settings') }}" novalidate class="form-horizontal">
          <div class="col-md-9" style="padding-left: 0px;">
            <label for="current-password" class="col-sm-4 control-label">Current Password</label>
            <div class="col-sm-8">
              <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="password" class="form-control create-workout" id="current-password" name="current-password" placeholder="Password">
              </div>
            </div>
            <label for="password" class="col-sm-4 control-label">New Password</label>
            <div class="col-sm-8">
              <div class="form-group">
                <input type="password" class="form-control create-workout" id="password" name="password" placeholder="Password">
              </div>
            </div>
            <label for="password_confirmation" class="col-sm-4 control-label">Re-enter Password</label>
            <div class="col-sm-8">
              <div class="form-group">
                <input type="password" class="form-control create-workout" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-6" style="margin-left: 262px;">
              <input type="hidden" name="form" value="2" />
              <input type="submit" name="submit" value="Change password" class="btn btn-success btn-workout">
            </div>
          </div>
        </form>
      </div>
    </div>
@endsection

@section('scripts')
    <script>
    $(function() {

      // We can attach the `fileselect` event to all file inputs on the page
      $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
      });

      // We can watch for our custom `fileselect` event like this
      $(document).ready( function() {
          $(':file').on('fileselect', function(event, numFiles, label) {

              var input = $(this).parents('.input-group').find(':text'),
                  log = numFiles > 1 ? numFiles + ' files selected' : label;

              if( input.length ) {
                  input.val(log);
              } else {
                  if( log ) alert(log);
              }

          });
      });

    });
    </script>
@endsection
