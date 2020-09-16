@extends('layouts.app')

@push('scripts')
{{-- JQuery Import for Javascript --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
<link rel="stylesheet" src="{{asset('createSystem.css')}}">
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

	{{-- 

		Values of name for each corresponding field.
		
		Straight values: just pass it on to /computers/assign_system/computer_id
		'motherboard_id'
		'processor_id'
		'gpu_id'
		'operating_system_id'
		
		Currently, javascript gets all the values with the names:
		'ram_id'
		'storage_id'
		^backend will check for the presence of the above names. it will return an error if no ram_id or storage_id is found.

		And then pass it on as a JSON array ( Ex. "[1, 2, 3 ]" ) to
		'rams'
		'storages'
		^ this is what backend actually uses to make the references for the ram and storage tables.

	 --}}

	<h1>Assign System to {{$computer->pc_name}}</h1>

	<form id="assignSystemForm" action="/computers/assign_system/{{$computer->id}}" method="POST">
		@csrf
		<select name="motherboard_id" class="custom-select" required>
			<option  value="">Select Motherboard...</option>
			@foreach( $motherboards as $motherboard )
				@if( $motherboard->status == "Available" )
					<option  value="{{$motherboard->id}}">{{$motherboard->component_name}}</option>
				@endif
			@endforeach
		</select>

		<select name="processor_id" class="custom-select" required>
			<option value="">Select Processor...</option>
			@foreach( $cpus as $cpu )
				@if( $cpu->status == "Available" )
					<option value="{{$cpu->id}}">{{$cpu->component_name}}</option>
				@endif
			@endforeach
		</select>

		<select name="gpu_id" class="custom-select" required>
			<option value="">Select Graphics Card...</option>
			@foreach( $gpus as $gpu )
				@if( $gpu->status == "Available" )
					<option value="{{$gpu->id}}">{{$gpu->component_name}}</option>
				@endif
			@endforeach
		</select>

		<select name="operating_system_id" class="custom-select" required>
			<option value="">Select Operating System...</option>
			@foreach( $operatingSystems as $os )
				<option value="{{$os->id}}">{{$os->name}}</option>
			@endforeach
		</select>

		<div id="ramDiv" class="d-flex">
			<select name="ram_id" class="custom-select" required>
				<option value="">Select RAM...</option>

				@foreach( $rams as $ram )
					@if( $ram->status == "Available" )
						<option value="{{$ram->id}}">{{$ram->component_name}}</option>
					@endif
				@endforeach
			</select>
		</div>

		<div id="storageDiv" class="d-flex">
			<select name="storage_id" class="custom-select" required>
				<option value="">Select Storage...</option>

				@foreach( $storages as $storage )
					@if( $storage->status == "Available" )
						<option value="{{$storage->id}}">{{$storage->component_name}}</option>
					@endif
				@endforeach
			</select>
		</div>

		<input type="hidden" name="rams" value="" id="ram_ids" value="">
		<input type="hidden" name="storages" value="" id="storage_ids" value="">

		<a href="/computers" class="btn btn-danger">Back</a>
		<button type="submit" class="btn btn-primary">Assign System</button>
	</form>

	{{-- Add script to handle the ram and storages thing thing --}}
	<script src="{{asset('js/createSystem.js')}}"></script>

@endsection