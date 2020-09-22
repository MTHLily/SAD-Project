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
    <h1>Edit Employee Details</h1>
    <form action = "/employees" method = "POST">
        <input type = "text" name ="last_name" value = "{{$employee->last_name}}" class = "form-control" required>
        <input type = "text" name ="first_name" value = "{{$employee->first_name}}" class = "form-control" required>
        <input type = "text" name ="middle_initial"value = "{{$employee->middle_initial}}" class = "form-control" required>
        <input type = "text" name ="email_address" value = "{{$employee->email_address}}" class = "form-control" required>
        <div class="d-flex">
			{{-- Transition is there for pretty pretty. Safe to remove if you dont want to use it --}}
			<select id="department_select" name="department_id" class="custom-select w-100" style="transition: 250ms;" required>
				<option value=""></option>
			@foreach( $departments as $department )
				<option value="{{$department->id}}">{{ $department->department_name }}</option>
			@endforeach
				<option value="new_department">Add New Department</option>
			</select>
		</div>
        <input type = "text" name ="status" value = "{{$employee->status}}" class = "form-control" required>
        
        <button class="btn btn-primary">Edit Item</button>
		<a class="btn btn-danger" href="/employees">Return</a>
    </form>
@endsection
