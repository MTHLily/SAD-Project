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
					<td><button data-toggle="modal" data-target="#component-{{$component->id}}-info">Open Info</button></td>
					<td>{{ $component->asset_tag }}</td>
					<td>{{ $component->component_name }}</td>
					<td>{{ $component->type()->get()[0]->component_type }}</td>
					<td>{{ $component->remarks }}</td>
					<td>{{ $component->issues }}</td>
					<td>{{ $component->system_id }}</td>
					<td>
						{!! ($component->warranty_id != null) ? 
								"<a href='/warranties/$component->warranty_id'>View Warranty</a>" : 
								"<a href='/warranties/create'>Assign Warranty</a>"
						!!}
					</td>
					<td>{{ $component->status }}</td>
					<td>
						<div class="d-flex w-100">
							<a class="btn w-100" href="/components/{{$component->id}}/edit"><i class="fas fa-edit fa-lg"></i></a>
							<form class="w-100" action="/components/{{$component->id}}" method="POST">
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

	@foreach( $components as $component )

	<div class="modal" id="component-{{$component->id}}-info">
		<div class="modal-dialog">
			<div class="modal-content">
				<h1>Edit Component</h1>
				<form action="/components/{{$component->id}}" method="POST">
					@csrf
					@method('PATCH')
					<input  type="text" name="asset_tag" placeholder="Asset Tag" 
							class="form-control" 
							value="{{$component->asset_tag}}" 
							required>
					<input  type="text" name="component_name" placeholder="Name" 
							class="form-control" 
							value="{{$component->component_name}}"
							required>
					<select name="component_type_id" class="custom-select" required>
						<option value="1"
							@if($component->component_type_id == 1)
							selected
							@endif
						>
							Motherboard
						</option>
						<option value="2"
							@if($component->component_type_id == 2)
							selected
							@endif 
						>
							CPU
						</option>
						<option value="3"
							@if($component->component_type_id == 3)
							selected
							@endif 
						>
							GPU
						</option>
						<option value="4"
							@if($component->component_type_id == 4)
							selected
							@endif 
						>
							RAM
						</option>
						<option value="5"
							@if($component->component_type_id == 5)
							selected
							@endif 
						>
							Storage
						</option>
					</select>

					<button class="btn btn-primary">Edit Item</button>
					<a class="btn btn-danger" href="/components">Return</a>
				</form>

			</div>
		</div>
	</div>

	@endforeach

@endsection