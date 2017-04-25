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
  <script src="http://localhost/AdvWeb_Project/FiitHub/public/monkeecreate-jquery.simpleWeather-0d95e82/jquery.simpleWeather.min.js"></script> {{--simpleweather.js--}}
  <script src="http://localhost/AdvWeb_Project/FiitHub/public/assets/js/showApp.js"></script> {{--calls jquery--}}
  <script src="http://localhost/AdvWeb_Project/Fiithub/public/assets/js/parsley.min.js"></script>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="/AdvWeb_Project/FiitHub/public/assets/css/weatherApp.css" />
  <link rel="stylesheet" href="/AdvWeb_Project/FiitHub/public/assets/css/home.css" />
  <link rel="stylesheet" href="http://localhost/AdvWeb_Project/Fiithub/public/assets/css/parsley.css">


  @yield('stylesheets')


  {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

  <style>
  body {
    font-family: 'Open Sans';
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
          FiitHub
        </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        {{-- <ul class="nav navbar-nav">
        <li><a href="{{ url('/home') }}">Home</a></li>
      </ul> --}}
      @if (Auth::user())
        <div class="col-sm-6 col-md-6">
          {!!Form::open(array('data-parsley-validate' => '', 'route' => 'workouts.search', 'method' => 'GET', 'role'=> 'search', 'class'=>'navbar-form'))!!}
            <div class="input-group">
              <input style="height: 30px;width: 400px;" type="text" class="form-control"  placeholder="Search" name="search" value=@yield('search')>
              <input type="hidden" name="type" value='workout'>
              <div class="input-group-btn">
                <button style="height: 30px; width: 40px;" class="btn" type="submit"><label class="glyphicon glyphicon-search"></label></button>
              </div>
            </div>
            {!!Form::close()!!}
        </div>
      @endif

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
          <li><a href="{{ url('/login') }}">Login</a></li>
          <li><a href="{{ url('/register') }}">Register</a></li>
        @else
          <li><a href="{{ url('/home') }}">Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ strtoupper(Auth::user()->fname) }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ route('profile.get', Auth::user()->username)}}"><i class="fa fa-btn fa-sign-out"></i>Profile</a></li>
              <li><a href="{{ route('workouts.all') }}"><i class="fa fa-btn fa-anchor"></i>Workouts</a></li>
              <li><a href="{{ route('groups.index') }}"><i class="fa fa-btn fa-anchor"></i>Groups</a></li>
              <li><a href="{{ url('/settings') }}"><i class="fa fa-btn fa-cogs"></i>Settings</a></li>
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>

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
