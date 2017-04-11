@extends('layouts.master')

@section('title', '|  All Your Workouts')

@section('content')

  <div class="row">
    <div class="col-md-10">
      <h1>All Workouts</h1>
    </div>
    <div class="col-md-2">
      <a href="{{route('workouts.create')}}" class="btn btn-lg btn-primary btn-h1-spacing"> Create New Workout</a>
    </div>
    <div class="col-md-12">
      <hr />
    </div>
  </div> <!--end of row-->
  <div class="row">
    <div class="col-md-12">
      @if(count($workouts) <= 0)
        <h3>No Workouts created</h3>
      @else
      <table class="table">
          <thead>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Created At</th>
            <th></th>
          </thead>
          <tbody>
            <?php $count = 1 ?>
            @foreach($workouts as $workout)
              <tr>
                <th>
                  {{$count}}
                  <?php $count++ ?>

                </th>
                <td>
                  {{$workout->title}}
                </td>
                <td>
                  {{-- only show a snippet of the body --}}
                  {{substr($workout->description, 0, 50)}}
                  {{-- ternary conditional? if true: if false --}}
                  {{strlen($workout->description) > 50 ? '...': ""}}
                </td>
                <td>
                  {{date('M j, Y h:i A', strtotime($workout->created_at))}}
                </td>
                <td>
                  <a href="{{route('workouts.show', $workout->id)}}" class="btn btn-sm btn-default">View</a>
                  <a href="{{route('workouts.edit', $workout->id)}}" class="btn btn-sm btn-default">Edit</a>

                </td>
              </tr>
            @endforeach
          </tbody>
      </table>
      <div class="text-center">
        {!!$workouts->links()!!}
      </div>
    @endif

    </div>
  </div>

@endsection
