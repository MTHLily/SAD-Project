@extends('layouts.app')

@push('scripts')
@endpush

@push('styles')
@endpush

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Add New Employee</h1>
    <form action = "/employees" method = "POST">
        @csrf
        <input type = "text" name = "last_name" placeholder = "Last Name" class = "form-control" required>
        <input type = "text" name = "first_name" placeholder = "First Name" class = "form-control" required>
        <input type = "text" name = "middle_initial" placeholder = "Middle Initial" class = "form-control" required>
        <input type = "text" name = "email_address" placeholder = "Email Address" class = "form-control" required>
        <div class="d-flex">
			{{-- Transition is there for pretty pretty. Safe to remove if you dont want to use it --}}
			<select id="department_select" name="department_id" class="custom-select w-100" style="transition: 250ms;" >
				<option value=""></option>
			@foreach( $departments as $department )
				<option value="{{$department->id}}">{{ $department->department_name }}</option>
			@endforeach
				<option value="new_department">Add New Department</option>
			</select>

			{{-- Transition is there for pretty pretty. Safe to remove if you dont want to use it --}}
			<input id="new_department" name="new_department" type="text" class="form-control"  disable style="width: 0; transition: 250ms;" placeholder="New Department">
		</div>
        <input type = "text" name = "status" placeholder = "Status" class = "form-control" required>

        <button class="btn btn-success">Add</button>
		<a class="btn btn-danger" href="/employees">Return</a>
        
    </form>
@endsection