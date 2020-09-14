@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>

{{-- JQuery Import for Javascript --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
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

	<h1>View System of {{ $system->computer->pc_name }}</h1>

	<form id="editSystemForm" action="/computers/system_details/{{$system->id}}" method="POST">
		@csrf
		@method('PATCH')
		<select name="motherboard_id" class="custom-select" required>
			<option  value="">Select Motherboard...</option>
			<option value="{{$system->motherboard->id}}" selected>{{$system->motherboard->component_name}}</option>
			@foreach( $motherboards as $motherboard )
				@if( $motherboard->status == "Available" )
					<option  value="{{$motherboard->id}}">{{$motherboard->component_name}}</option>
				@endif
			@endforeach
		</select>

		<select name="processor_id" class="custom-select" required>
			<option value="">Select Processor...</option>
			<option value="{{$system->processor->id}}" selected>{{$system->processor->component_name}}</option>
			@foreach( $cpus as $cpu )
				@if( $cpu->status == "Available" )
					<option value="{{$cpu->id}}">{{$cpu->component_name}}</option>
				@endif
			@endforeach
		</select>

		<select name="gpu_id" class="custom-select" required>
			<option value="">Select Graphics Card...</option>
			<option value="{{$system->gpu->id}}" selected>{{$system->gpu->component_name}}</option>
			@foreach( $gpus as $gpu )
				@if( $gpu->status == "Available" )
					<option value="{{$gpu->id}}">{{$gpu->component_name}}</option>
				@endif
			@endforeach
		</select>

		<select name="operating_system_id" class="custom-select" required>
			<option value="">Select Operating System...</option>
			@foreach( $operatingSystems as $os )
				<option @if($system->operating_system->id == $os->id) selected @endif value="{{$os->id}}">{{$os->name}}</option>
			@endforeach
		</select>

		<div id="ramDiv" class="d-flex">
			@foreach( $system->ram as $system_ram)
			<select name="ram_id" class="custom-select" required>
				<option value="">Select RAM...</option>
				<option value="{{$system_ram->component->id}}" selected >{{$system_ram->component->component_name}}</option>
				@foreach( $rams as $ram )
					@if( $ram->status == "Available" )
						<option value="{{$ram->id}}">{{$ram->component_name}}</option>
					@endif
				@endforeach
			</select>
			@endforeach
		</div>

		<div id="storageDiv" class="d-flex">
			@foreach( $system->storage as $system_storage)
			<select name="storage_id" class="custom-select" required>
				<option value="">Select Storage...</option>
				@foreach( $system->storage as $system_storage_options)
				<option @if( $system_storage->component->id == $system_storage_options->component->id ) selected @endif value="{{$system_storage_options->component->id}}" selected >{{$system_storage_options->component->component_name}}</option>
				@endforeach
				@foreach( $storages as $storage )
					@if( $storage->status == "Available" )
						<option value="{{$storage->id}}">{{$storage->component_name}}</option>
					@endif
				@endforeach
			</select>
			@endforeach
		</div>

		<input type="hidden" name="rams" value="" id="ram_ids" value="">
		<input type="hidden" name="storages" value="" id="storage_ids" value="">

		<a href="/computers" class="btn btn-danger">Back</a>
		<button type="submit" class="btn btn-primary">Edit System</button>
	</form>

	{{-- Add script to handle the new department thing --}}
	<script src="{{asset('js/showSystem.js')}}"></script>


@endsection