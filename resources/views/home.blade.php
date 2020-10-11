<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <title>Landing Page</title>
  </head>

  <style>
    .text
    {
      color: #14A83B;
      
    }

    .nav-link
    {
      margin-top: 10px;
      color: white;
      font-size: 25px; 
      font-weight: bolder;
    }

    .navbar-brand
    {
      margin-top:7px;
    }

    .dropdown-toggle
    {
      font-size: 20px;
    }

    a:hover 
    {
      color: #cdd5db;
    }
    .menu   
    {
      position: relative;
      left: 30px;
      top: 70px;

    }
    
    img.logo
    {
      height:50px;
    }

    .box 
    {
      color: white;
      border-radius: 25px;
      background: #14A83B;
      float: left;
      margin: 3.122%;
      height: 250px;
      width: 250px;
      text-align: center;
    }

    img.pic
    {
      object-fit: scale-down;
      object-position: center;
      margin-top: 15%;
      filter: invert(1)
    }

    img.pics
    {
      object-fit: scale-down;
      object-position: center;
      margin-top: 15%;
    }

  </style>
  
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

      <ul class="navbar-nav mr-auto">
        <img class="logo" src="logo.png">  
        <a class="navbar-brand" href="{{ url('/') }}">Inventory System</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      </ul>
      <ul class="navbar-nav ml-auto">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
            @else
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </li>
            @endguest
            </ul>
          </ul>
        </div>
      </ul>
     </nav>
      
      <div class ="menu">
        <div class="text">
          <h1>Logged In</h1>
        </div>
        <div class="icons">
          <div class="box-set">
            <figure class="box box-1">
              <img class="pic" src="monitor.svg" class="w3-round" color="white" alt="Computer" style="width:50%">
              <a class="nav-link" href="/computers">Computers</a>
            </figure>

            <figure class="box box-2">
              <img class="pic" src="chip.svg" class="w3-round" color="white" alt="Peripherals" style="width:50%">
              <a class="nav-link" href="/peripherals">Peripherals</a>
            </figure>

            <figure class="box box-3" onclick="#">
              <img class="pic" src="computer-mouse.svg" class="w3-round" color="white" alt="Components" style="width:50%">
              <a class="nav-link" href="/components">Components</a>
            </figure>

            <figure class="box box-4">
              <img class="pic" src="man.svg" class="w3-round" color="white" alt="Employee" style="width:50%">
              <a class="nav-link" href="/employees">Employees</a>
            </figure>

            <figure class="box box-5"> 
              <img class="pics" src="assignment 1.svg" class="w3-round" color="white" alt="Assignment" style="width:50%">
              <a class="nav-link" href="/assignments">Assignment</a>
            </figure>
          </div>
        </div>
        
      </div>
  </body>
</html>
