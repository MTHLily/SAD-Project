@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
{{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script> --}}

@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
<link href="{{ asset('css/crud.css') }}" rel="stylesheet">

{{-- Custom Styles for Tables --}}
<style>

    #computerTable table thead tr th:first-child,
    #componentTable table thead tr th:first-child,
    #peripherals table thead tr th:first-child,
    #computerTable table thead tr th:last-child,
    #componentTable table thead tr th:last-child,
    #peripherals table thead tr th:last-child
    {
        width: 10em;
    }

</style>
@endpush

@section('content')
<script src=" {{asset('js/warranty.js')}}"></script>
{{-- Warranty Info Modal --}}
<div class="modal"  id="infoModal">
    <div class="modal-dialog mw-100 h-75 w-50 modal-dialog-scrollable" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Warranty Details</h4>
            </div>
            <div class="modal-body">
                <div id="infoLoading" style="text-align: center; padding: 2em;"><h3>Loading details...</h3></div>
                <div id="infoLoaded">
                    <div class="form-group row">
                        <label for="brand_id" class="col-sm-3 col-form-label">Brand</label>
                        <div class="col-sm-9 d-flex">
                            <select name="brand_id" readonly type="text" class="form-control" onchange="toggleNew(true)">
                                <option value="New Brand">New Brand</option>
                                @foreach ( $brands as $brand )
                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                            <div class="w-100 d-none" id="new_department_div">
                                <input name="new_brand" readonly placeholder="New Brand" type="text" class="form-control">
                                <button type="button" class="close w-25" onclick="toggleNew(false)">&times;</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="purchase_date" class="col-sm-3 col-form-label">Purchase Date</label>
                        <div class="col-sm-9">
                            <input name="purchase_date" readonly type="date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="purchase_location" class="col-sm-3 col-form-label">Purchase Location</label>
                        <div class="col-sm-9">
                            <input name="purchase_location" readonly type="text"class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="receipt_url" class="col-sm-3 col-form-label">Receipt</label>
                        <div class="col-sm-9 align-items-center d-flex">
                            <a href="#" id="receipt_url">See Receipt</a>
                              <div class="custom-file d-none">
                                <input name="receipt_url" type="file" class="custom-file-input">
                                <label class="custom-file-label" for="receipt_url">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="serial_no" class="col-sm-3 col-form-label">Serial No.</label>
                        <div class="col-sm-9">
                            <input name="serial_no" readonly type="text"class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="warranty_life" class="col-sm-3 col-form-label">End of Warranty</label>
                        <div class="col-sm-9">
                            <input name="warranty_life" readonly type="text"class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="notes" class="col-sm-3 col-form-label">Notes</label>
                        <div class="col-sm-9">
                            <textarea name="notes" readonly type="text"class="form-control">
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <input name="status" readonly type="text"class="form-control">
                        </div>
                    </div>
                    <div id="computerTable" class="pt-2">
                        <table class="table">
                            <thead>
                                <th>ASSET TAG</th>
                                <th>COMPUTER NAME</th>
                                <th>STATUS</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div id="componentTable" class="pt-2">
                        <table class="table">
                            <thead>
                                <th>ASSET TAG</th>
                                <th>COMPONENT NAME</th>
                                <th>STATUS</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div id="peripheralTable" class="pt-2">
                        <table class="table">
                            <thead>
                                <th>ASSET TAG</th>
                                <th>PERIPHERAL NAME</th>
                                <th>STATUS</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="updateButtons" class="d-none">
                    <button class="btn btn-danger" onclick="toggleEdit()">Cancel</button>
                    <button class="btn btn-success">Save</button>
                </div>
                <div id="viewButtons">
                    <button class="btn btn-primary" onclick="toggleEdit()">Update</button>
                    <button class="btn btn-secondary">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container">

        <div class="row">
            <div class="col-12">
                <form class="form-inline float-sm-left">
                    <div class="form-group mr-2">
                        <h2>Warranties</h1>
                    </div>
                </form>
                <div class="form-inline float-sm-right">
                    <input type="text" class="form-control ml-2" id="searchBox" placeholder="Search">
                </div>
            </div>
        </div>

		<table class="table table-striped table-bordered dataTable mb-5" id="warrantyTable">
			<thead>
				<th style="width:10%;">DETAILS</th>
				<th style="width:15%;">WARRANTY TYPE</th>
                {{-- <th>BRAND</th>
                <th>PURCHASE DATE</th>
                <th>PURCHASE LOCATION</th> --}}
                <th>NOTES</th>
				<th style="width:10%;">STATUS</th>
			</thead>
			<tbody>
                @foreach ( $warranties as $warranty )
                    <tr>
                        <td><a href="#" onclick="getInfo({{$warranty->id}})">Details</a></td>
                        <td>{{$warranty->type()}}</td>
                        {{-- <td>{{$warranty->brand->brand_name}}</td>
                        <td>{{$warranty->purchase_date}}</td>
                        <td>{{$warranty->purchase_location}}</td> --}}
                        <td>{{$warranty->notes}}</td>
                        <td>{{$warranty->status}}</td>
                    </tr>
                @endforeach
			</tbody>
		</table>

    </div>

@endsection