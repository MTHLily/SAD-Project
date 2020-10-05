@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
<script src=" {{asset('js/warranty.js')}}"></script>
@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
 
<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-12">
                <form class="form-inline float-sm-left">
                    <div class="form-group mr-2">
                        <h2>Warranties</h1>
                    </div>
                </form>
                <form class="form-inline float-sm-right">
                    <a data-toggle="modal" href="#component-add" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> Add Item</a>
                    <input type="text" class="form-control ml-2" id="searchBox" placeholder="Search">
                </form>
            </div>
        </div>

		<table class="table table-striped table-bordered dataTable mb-5" id="warrantyTable">
			<thead>
				<th>WARRANTY INFO</th>
				<th>WARRANTY TYPE</th>
                <th>BRAND</th>
                <th>PURCHASE DATE</th>
                <th>PURCHASE LOCATION</th>
                <th>NOTES</th>
				<th>STATUS</th>
			</thead>
			<tbody>
                @foreach ( $warranties as $warranty )
                    <tr>
                        <td>Hello</td>
                        <td>{{$warranty->type()}}</td>
                        <td>{{$warranty->brand->brand_name}}</td>
                        <td>{{$warranty->purchase_date}}</td>
                        <td>{{$warranty->purchase_location}}</td>
                        <td>{{$warranty->notes}}</td>
                        <td>{{$warranty->status}}</td>
                    </tr>
                @endforeach
			</tbody>
		</table>

    </div>

@endsection