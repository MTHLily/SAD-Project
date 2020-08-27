@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endpush

@section('content')

	<a href="/components/create" class="btn btn-success w-100"><i class="fas fa-plus"></i> Add New</a>
	<table class="table">
		<thead>
			<th></th>
			<th>Asset Tag</th>
			<th>Component</th>
			<th>Type</th>
			<th>System</th>
			<th>Warranty</th>
			<th>Status</th>
			<th>Actions</th>
		</thead>
		<tbody>
			@foreach( $components as $component )
				<tr>
					<td><input type="checkbox" class="w-100"name="index" value="{{$component->id}}"></td>
					<td>{{ $component->asset_tag }}</td>
					<td>{{ $component->component_name }}</td>
					<td>{{ $component->type()->get()[0]->component_type }}</td>
					<td>{{ $component->system_id }}</td>
					<td>{{ $component->warranty_id }}</td>
					<td>{{ $component->status }}</td>
					<td>
						<div class="d-flex w-100">
							<a class="btn w-100" href="/components/{{$component->id}}/edit"><i class="fas fa-edit fa-lg"></i></a>
							<form class="w-100" action="/components/{{$component->id}}" method="POST">
								@method('delete')
								@csrf
								<button class="btn w-100"><i class="fas fa-trash-alt fa-lg"></i></button>
							</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection