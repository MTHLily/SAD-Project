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

	<h1>Add New Peripheral</h1>
	<form action="/peripherals" method="POST">
		@csrf
		<input type="text" name="asset_tag" placeholder="Asset Tag" class="form-control" required>
		<input type="text" name="peripheral_name" placeholder="Name" class="form-control" required>
		<select name="peripheral_type" class="custom-select" required>
			<option value="1">Monitor</option>
			<option value="2">Keyboard</option>
			<option value="3">Device</option>
			<option value="4">Miscellaneous</option>
		</select>
	
		<button class="btn btn-success">Add Item</button>
		<a class="btn btn-danger" href="/peripherals">Return</a>
	</form>

@endsection