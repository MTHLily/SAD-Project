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

@endsection