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

	<h1>Edit {{$peripheral->peripheral_name}}</h1>
	<form action="/peripherals" method="POST">
		@csrf
		<input type="text" value="{{$peripheral->asset_tag}}" name="asset_tag" placeholder="Asset Tag" class="form-control" required>
		<input type="text" value="{{$peripheral->peripheral_name}}" name="peripheral_name" placeholder="Name" class="form-control" required>
		<select name="peripheral_type" class="custom-select" required>
			{{ $types = \App\PeripheralType::all() }}
			@foreach( $types as $type )
				<option value="{{$type->id}}"
					@if( $type->id == $peripheral->peripheral_type )
					selected
					@endif 
					>
					{{$type->peripheral_type}}
				</option>
			@endforeach
		</select>
	
		<textarea class="form-control">
			
		</textarea>

		<button class="btn btn-success">Add Item</button>
		<a class="btn btn-danger" href="/peripherals">Return</a>
	</form>

@endsection