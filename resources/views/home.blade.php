@extends('layouts.app')
{{-- <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <title>Landing Page</title>
  </head> --}}
@push('styles')
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>
  <style>
    .box 
    {
      display:flex;
      flex-direction: column;
      justify-content: space-around;
      align-items: center;

      border-radius: 25px;
      background: #14A83B;

      padding: 50px;
      height: 300px;
      width: 300px;

      text-align: center;

    }

    .icons{
      display: grid;
      grid-template-columns: auto auto auto;
      grid-gap: 50px;

    }

    .fa-receipt{
      color: white;
      font-size: 175px;
    }

    img.pic
    {
      height: 175px;
      filter: invert(1)
    }

    img.pics
    {
      height: 175px;
      margin-top: 15%;
    }

    .box_text{
      font-size: 1.5rem;
      color: white;
    }

  </style>
  @endpush

@section('content')
<div class="container">
  <div class="icons">
      <a class="box" href/computers" >
        <img class="pic" src="monitor.svg" class="w3-round" color="white" alt="Computer">
        <span class="box_text">Computers</span>
      </a>
      <a class="box" href="/peripherals">
        <img class="pic" src="chip.svg" class="w3-round" color="white" alt="Peripherals">
        <span class="box_text">Peripherals</span>
      </a>

      <a class="box" href="/components">
        <img class="pic" src="computer-mouse.svg" class="w3-round" color="white" alt="Components">
        <span class="box_text" >Components</span>
      </a>

      <a class="box" href="/employees">
        <img class="pic" src="man.svg" class="w3-round" color="white" alt="Employee">
        <span class="box_text" >Employees</span>
      </a>

      <a class="box" href="/assignments">  
        <img class="pics" src="assignment 1.svg" class="w3-round" color="white" alt="Assignment">
        <span class="box_text" >Assignment</span>
      </a>

      <a class="box" href="/warranties">
        <i class="fas fa-receipt"></i>
        <span class="box_text" >Warranties</span>
      </a>
  </div>
      </div>
  {{-- </body>
</html> --}}
@endsection