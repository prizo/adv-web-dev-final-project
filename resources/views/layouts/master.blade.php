<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FiitHub @yield('title')</title>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="http://localhost/adv-web-dev-final-project/public/monkeecreate-jquery.simpleWeather-0d95e82/jquery.simpleWeather.min.js"></script> {{--simpleweather.js--}}
    <script src="http://localhost/adv-web-dev-final-project/public/assets/js/showApp.js"></script> {{--calls jquery--}}
    <script src="http://localhost/adv-web-dev-final-project/public/assets/js/parsley.min.js"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="/adv-web-dev-final-project/public/assets/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="/adv-web-dev-final-project/public/assets/css/weatherApp.css" />
    <link rel="stylesheet" href="/adv-web-dev-final-project/public/assets/css/home.css" />
    <link rel="stylesheet" href="http://localhost/adv-web-dev-final-project/public/assets/css/parsley.css" />

    @yield('stylesheets')

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Droid Sans', sans-serif;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout" >
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/login') }}">
            FiitHub <span><img src="/adv-web-dev-final-project/public/assets/img/logo2.png" height="30" width="26"></span>
        </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        {{-- <ul class="nav navbar-nav">
        <li><a href="{{ url('/home') }}">Home</a></li>
        </ul> --}}
        @if (Auth::user())
          <div class="col-md-4" style="padding: 0px; width: 300px;">
            {!!Form::open(array('data-parsley-validate' => '', 'route' => 'workouts.search', 'method' => 'GET', 'role'=> 'search', 'class'=>'navbar-form'))!!}
              <input style="height: 30px; width: 300px;" type="text" class="form-control search"  placeholder="Search FiitHub" name="search" value=@yield('search')>
              <input type="hidden" name="type" value='workout'>
            {!!Form::close()!!}
          </div>
        @endif
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/home') }}">Home</a></li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="fa fa-btn fa-plus"> <span class="fa fa-btn fa-caret-down"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/workouts/create') }}">New workout</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="fa fa-btn fa-user"> <span class="fa fa-btn fa-caret-down"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li style="margin-top: 2px;"><a href="#" class="not-active">Signed in as <span style="font-weight: bold;">{{ (Auth::user()->username) }}</span></a></li>
                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                <li><a href="{{ route('profile.get', Auth::user()->username)}}">Profile</a></li>
                <li><a href="{{ route('workouts.all') }}">Workouts</a></li>
                <li><a href="{{ route('groups.index') }}">Groups</a></li>
                <hr style="margin-top: 5px; margin-bottom: 5px;" />
                <li><a href="{{ url('/settings') }}">Settings</a></li>
                <li><a href="{{ url('/logout') }}">Sign out</a></li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
@include('partials._messages')

<div class="container">
  @yield('content')
</div>

@yield('scripts')
</body>
</html>
