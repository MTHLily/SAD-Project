@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}

<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endpush

@section('content')
    <a href = "/employees/create" class="btn btn-success w-100"><i class="fas fa-plus"></i> Add New</a>
    <table class="table">
        <thead>
            <th></th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Initial</th>
            <th>Email Address</th>
            <th>Department</th>
           
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td><button data-toggle="modal" data-target="#employee-{{$employee->id}}-info">Open Info</button></td>
                <td>{{$employee->last_name}}</td>
                <td>{{$employee->first_name}}</td>
                <td>{{$employee->middle_initial}}</td>
                <td>{{$employee->email_address}}</td>
                <td>{{$employee->department_id}}</td>
                
                <td>
					<div class="d-flex w-100">
						<a class="btn w-100" href="/employees/{{$employee->id}}/edit"><i class="fas fa-edit fa-lg"></i></a>
						<form class="w-100" action="employees/{{$employee->id}}" method="POST">
							@method('delete')
							@csrf
							<button type="submit" class="btn w-100"><i class="fas fa-trash-alt fa-lg"></i></button>
						</form>
						</div>
				</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @foreach($employees as $employee)
        <div class="modal" id="employee-{{$employee->id}}-info">
            <div class="modal-dialog">
                <div class = "modal-content">
                    <h1>Edit Employee Details</h1>
                    <form action = "/employees/{{$employee->id}}" method = "POST">
                        @csrf
					    @method('PATCH')
                        <input type = "text" name = "last_name" placeholder = "Last Name" 
                            class = "form-control"
                            value = "{{$employee->last_name}}"
                            required>
                        <input type = "text" name = "first_name" placeholder = "First Name" 
                            class = "form-control"
                            value = "{{$employee->first_name}}"
                            required>
                        <input type = "text" name = "middle_initial" placeholder = "Middle Initial" 
                            class = "form-control"
                            value = "{{$employee->middle_initial}}"
                            required>
                        <input type = "text" name = "email_address" placeholder = "Email Address" 
                            class = "form-control"
                            value = "{{$employee->email_address}}"
                            required>
                        <input type = "text" name = "department_id" placeholder = "Department ID" 
                            class = "form-control"
                            value = "{{$employee->department_id}}"
                            required>
                        
                    </form>
                </div>
            </div>
                
        </div>
    @endforeach
@endsection

    
