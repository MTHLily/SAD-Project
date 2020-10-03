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

    {{-- Modal for adding assignments --}}
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
                        <button class="btn btn-danger" data-dismiss="modal" type="button">Cancel</button>
                        <button class="btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal for editing assignments. Is being modified by JS so look at public/js/assignment.js --}}
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="loading">Loading...</div>
                        <div class="loaded">
                            <select name="employee_id" id="employeeSelect"></select>
                            <select name="computer_id" id="computerSelect"></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal" type="button">Cancel</button>
                            <button class="btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal for editing peripherals. Is JS heavy so check the assignment.js --}}
    <div class="modal fade" id="editPeripheralsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editPeripheralsForm" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="loading">Loading...</div>
                        <div class="loaded">
                            <div id="peripheralSelectDiv"></div>
                            <button class="btn btn-primary" onclick="addPeripheralSelect(undefined)"type="button" id="addPeripheralButton">Add Peripheral</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <input type="hidden" name="peripheral_ids" id="peripheral_ids">
                            <button class="btn btn-danger" data-dismiss="modal" type="button">Cancel</button>
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
                        <button class="btn" onclick="editPeripherals({{$assign->id}})">Assign Peripherals</button>
                    </td>
                    <td>{{$assign->status}}</td>
                    <td>
                        <button class="btn"
                            onclick="edit({{$assign->id}}, {{$assign->computer_id}}, {{$assign->employee_id}})">
                                Edit
                        </button>
                        <form method="POST" action="/assignments/{{$assign->id}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
		</tbody>
    </table>
    
	{{-- Add script to handle the new department thing --}}
	<script src="{{asset('js/assignment.js')}}"></script> 

@endsection