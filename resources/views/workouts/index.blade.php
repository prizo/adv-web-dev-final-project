@extends('layouts.master')

@section('title', '| All Workouts')

@section('content')
    @include('partials/_table')
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading" style="font-weight: 600; color: #586069; padding: 4px 15px 4px 15px; height: 48px;">
            <h4 style="margin-top: 3px;"><span style="font-weight: bold;">
              Your workouts
              <a href="{{route('workouts.create')}}" class="btn btn-success btn-workout" style="margin-left: 715px;">New workout</a>
            </span></h4>
          </div>
            @if(count($workouts) <= 0)
              <div class="panel-body">No workouts created...</div>
            @else
              <div class="panel-body" style="padding: 0px;">
                <table class="table" style="margin-bottom: 0px;">
                    {{--<thead>
                      <th class="">Workout name</th>
                      <th class="">Description</th>
                      <th class="">Created on</th>
                      <th class="col-md-2"></th>
                    </thead>--}}
                    <tbody>
                      @foreach($workouts as $workout)
                        <tr>
                          <td>
                            <span class="title-custom">{{$workout->title}}</span>

                            {{-- only show a snippet of the body --}}
                            {{substr($workout->description, 0, 50)}}
                            {{-- ternary conditional? if true: if false --}}
                            {{strlen($workout->description) > 50 ? '...': ""}}

                            <span style="font-weight: bold;">created on</span> {{date('M j, Y h:i A', strtotime($workout->created_at))}}
                          </td>
                          <td style="width: 205px;">
                            <a href="{{route('workouts.show', $workout->id)}}" class="btn btn-default btn-sm" style="color: black; margin-left: 48px;">
                              <span class="glyphicon glyphicon-eye-open"></span> View
                            </a>
                            <span>&nbsp</span>
                            <a href="{{route('workouts.edit', $workout->id)}}" class="btn btn-default btn-sm" style="color: black;">
                              <span class="glyphicon glyphicon-pencil"></span> Edit
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                  {!!$workouts->links()!!}
                </div>
              </div>
            @endif
        </div>
      </div>
    </div>
    {{--<div class="row">
      <div class="container">
        <a href="{{route('workouts.create')}}" class="btn btn-success btn-workout">Create workout</a>
      </div>
    </div>--}}
@endsection
