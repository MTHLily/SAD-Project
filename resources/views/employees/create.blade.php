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
        <input type = "text" name = "department_id" placeholder = "Department ID" class = "form-control" required>
        <input type = "text" name = "status" placeholder = "Status" class = "form-control" required>

        <button class="btn btn-success">Add Item</button>
		<a class="btn btn-danger" href="/components">Return</a>
    </form>
@endsection