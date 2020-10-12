@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script> --}}

<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css"> --}}
<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@livewireStyles
@endpush

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<form class="form-inline float-sm-left">
					<div class="form-group mr-2">
						<h2>Employees</h1>
					</div>
				</form>
				<form class="form-inline float-sm-right">
					<a data-toggle="modal" href="#employee-add" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> Add Employee</a>
					<input type="text" class="form-control ml-2" id="searchBox" placeholder="Search">
				</form>
			</div>
		</div>

		<table class="table table-striped table-bordered dataTable mb-5">
			<thead>
				<th>LAST NAME</th>
				<th>FIRST NAME</th>
				<th>MIDDLE INITIAL</th>
				<th>EMAIL ADDRESS</th>
                <th>DEPARTMENT</th>
                <th>STATUS</th>
                <th>DETAILS</th>
			</thead>
			<tbody>
				@foreach( $employees as $employee )
					<tr>
						<td>{{ $employee->last_name }}</td>
						<td>{{ $employee->first_name }}</td>
						<td>{{ $employee->middle_initial }}</td>
                        <td>{{ $employee->email_address }}</td>
                        <td>{{ $employee->department->department_name }}</td>
                        <td>{{ $employee->status }}</td>
						<td class="detail">
							<a data-toggle="modal" onclick="getEmployeeInfo({{$employee->id}})" href="#employee-info"><i class="fa fa-info-circle" aria-hidden="true"></i> View Details</a>
                        </td>
					</tr>
				@endforeach
			</tbody>
		</table>
    </div>
    

    <div class="modal fade" id="employee-add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="/employees" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                                <input  type="text" name="last_name" placeholder="Last Name" 
                                            class="form-control"
                                            required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                                <input  type="text" name="first_name" placeholder="First Name" 
                                            class="form-control"
                                            required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="middle_initial" class="col-sm-3 col-form-label">Middle Initial</label>
                            <div class="col-sm-9">
                                <input  type="text" name="middle_initial" placeholder="Middle Initial" 
                                            class="form-control"
                                            required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_address" class="col-sm-3 col-form-label">Email Address</label>
                            <div class="col-sm-9">
                                <input  type="email" name="email_address" placeholder="Email Address" 
                                            class="form-control"
                                            required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="department_id" class="col-sm-3 col-form-label">Department</label>
                            <div class="col-sm-9">
                                <select name="department_id" class="custom-select w-100" style="transition: 250ms;" >
                                @foreach( $departments as $department )
                                    <option value="{{$department->id}}">{{ $department->department_name }}</option>
                                @endforeach
                                    <option value="new_department">Add New Department</option>
                                </select>

                                <input id="new_department" name="new_department" type="text" class="form-control" hidden disable style="width: 0; transition: 250ms;" placeholder="New Department">
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Back</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save    "></i> Add</button>
                    </div>
                </form>
            </div>
        </div>
	</div>
	
@livewire('employee-details');
@livewireScripts

@endsection