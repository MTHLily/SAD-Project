@extends('layouts.app')

@push('scripts')

@endpush

@push('styles')

@endpush

@section('content')

	{{-- Code If Errors are found in the validation of the data --}}
	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif

	<h1>Add New Computer</h1>

	<form action="/computers" method="POST">

		@csrf

		<input type="text" name="asset_tag" placeholder="Asset Tag" class="form-control" required>

		<input type="text" name="pc_name" placeholder="Computer Name" class="form-control" required>

		<select name="computer_type" class="custom-select" required>
			<option value="1">Desktop</option>
			<option value="2">Laptop</option>
		</select>

		<div class="d-flex">
			{{-- Transition is there for pretty pretty. Safe to remove if you dont want to use it --}}
			<select id="department_select" name="department_id" class="custom-select w-100" style="transition: 250ms;" required>
				<option value=""></option>
			@foreach( $departments as $department )
				<option value="{{$department->id}}">{{ $department->department_name }}</option>
			@endforeach
				<option value="new_department">Add New Department</option>
			</select>

			{{-- Transition is there for pretty pretty. Safe to remove if you dont want to use it --}}
			<input id="new_department" name="new_department" type="text" class="form-control" disabled style="width: 0; transition: 250ms;" placeholder="New Department">
		</div>

		<button class="btn btn-success">Add Item</button>
		<a class="btn btn-danger" href="/computers">Return</a>
	</form>

	{{-- Add script to handle the new department thing --}}
	<script src="{{asset('js/addComputer.js')}}"></script>

@endsection