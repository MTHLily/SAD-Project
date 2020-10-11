@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>

{{-- JQuery Import for Javascript --}}
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@livewireStyles
@endpush

@section('content')

@livewire('assignment-create')
@livewire('assignment-details')
@livewire('assign-peripherals')
@livewire('computer-system-details')
@livewire('computer-details')

<div class="container">
	<div class="row">
		<div class="col-12">
			<form class="form-inline float-sm-left">
				<div class="form-group mr-2">
					<h1>Assignments</h1>
				</div>
			</form>
			<div class="float-sm-right d-flex">
				<button class="btn btn-success" data-toggle="modal" data-target="#assignmentCreateModal"><i class="fas fa-plus"></i> Create Assignment</button>
				<input type="text" class="form-control ml-2" id="searchBox" placeholder="Search">
			</div>
		</div>
	</div>

	<table class="table table-striped table-bordered dataTable mb-5">
		<thead>
            <th>Details</th>
			<th>Employee Name</th>
			<th>PC Name</th>
			<th>Peripherals</th>
			<th>Department</th>
		</thead>
		<tbody>
            @foreach ( $assignments as $assign )
                <tr>
                    <td><a href='#' onclick="getAssignmentInfo({{$assign->id}})">View Details</a></td>
                    <td>{{$assign->employee->full_name()}}</td>
                    <td>{{$assign->computer->pc_name}}</td>
                    <td>
                        <a href="#" onclick="showAssignPeripherals({{$assign->id}})">Assign Peripherals</a>
                    </td>
                    <td>{{$assign->employee->department->department_name}}</td>
                </tr>
            @endforeach
		</tbody>
    </table>
</div>
	{{-- Add script to handle the new department thing --}}
	<script src="{{asset('js/assignment.js')}}"></script> 
@livewireScripts
@endsection