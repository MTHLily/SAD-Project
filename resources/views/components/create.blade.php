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

	<h1>Add New Component</h1>
	<form action="/components" method="POST">
		@csrf
		<input type="text" name="asset_tag" placeholder="Asset Tag" class="form-control" required>
		<input type="text" name="component_name" placeholder="Name" class="form-control" required>
		<select name="component_type_id" class="custom-select" required>
			<option value="1">Motherboard</option>
			<option value="2">CPU</option>
			<option value="3">GPU</option>
			<option value="4">RAM</option>
			<option value="5">Storage</option>
		</select>

		<button class="btn btn-success">Add Item</button>
		<a class="btn btn-danger" href="/components">Return</a>
	</form>

@endsection