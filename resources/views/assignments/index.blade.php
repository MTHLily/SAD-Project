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

    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    @csrf
                    <div class="modal-body">
                        <select name="employee_id" >
                            @foreach ( $employees as $employee )
                                @if( $employee->status == 'Available' )
                                    <option value="{{$employee->id}}">{{ $employee->full_name() }}</option>
                                @endif
                            @endforeach
                        </select>
                        <select name="computer_id" >
                            @foreach ( $computers as $computer )
                                @if( $computer->status == 'Available' )
                                    <option value="{{$computer->id}}">{{ $computer->pc_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button">Cancel</button>
                        <button class="btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<button data-toggle="modal" data-target="#addModal" class="btn btn-success w-100"><i class="fas fa-plus"></i> Add New</button>
	<table class="table">
		<thead>
			<th>Employee Name</th>
			<th>PC Name</th>
			<th>Peripherals</th>
			<th>Status</th>
			<th>Actions</th>
		</thead>
		<tbody>
            @foreach ( $assignments as $assign )
                <tr>
                    <td>{{$assign->employee->full_name()}}</td>
                    <td>{{$assign->computer->pc_name}}</td>
                    <td>
                        <a href=
                        {{ route('edit_peripheral_setup', ['peripheralSetup' => $assign->peripheral_setup_id] ) }}>
                        Assign Peripherals</a>
                    </td>
                    <td></td>
                    <td><a href={{}}>Action</a></td>
                </tr>
            @endforeach
		</tbody>
	</table>

@endsection