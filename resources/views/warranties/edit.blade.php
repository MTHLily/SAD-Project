extends('layouts.app')

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
    <h1>Edit Warranty Details</h1>
    <form action = "/warranties/{{$warranty->id}}" method = "POST" enctype ="multipart/form-data">
    @csrf
    @method('PATCH')
        <div class="d-flex">
			{{-- Transition is there for pretty pretty. Safe to remove if you dont want to use it --}}
			<select id="brand_select" name="brand_id" class="custom-select w-100" style="transition: 250ms;" >
				<option value=""></option>
			@foreach( $brands as $brand )
				<option value="{{$brand->id}}">{{ $brand->brand_name }}</option>
			@endforeach
				<option value="new_brand">Add New brand</option>
			</select>

			{{-- Transition is there for pretty pretty. Safe to remove if you dont want to use it --}}
			<input id="new_brand" name="new_brand" type="text" class="form-control"  disable style="width: 0; transition: 250ms;" placeholder="New Brand">
		</div>
        <input type = "text" name = "purchase_date" placeholder = "Purchase Date" class = "form-control" required>
        <input type = "text" name = "location" placeholder = "Location" class = "form-control" required>
        <input type = "file" name = "receipt_url" placeholder = "Receipt" class = "form-control" required>
        <input type = "text" name = "serial_no" placeholder = "Serial Number" class = "form-control" required>
        <input type = "date" name = "warranty_life" placeholder = "Warranty Life" class = "form-control" required>
        <input type = "text" name = "notes" placeholder = "notes" class = "form-control" required>
        <input type = "text" name = "status" placeholder = "status" class = "form-control" required>

        
        <button class="btn btn-success">Add</button>
		<a class="btn btn-danger" href="/warranties">Return</a>

	    <script src="{{asset('js/addBrand.js')}}"></script>
    <form>
@endsection