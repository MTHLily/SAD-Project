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

@livewireStyles

{{-- Custom Styles for Tables --}}
<style>

    #computerTable table thead tr th:first-child,
    #componentTable table thead tr th:first-child,
    #peripheralTable table thead tr th:first-child,
    #computerTable table thead tr th:last-child,
    #componentTable table thead tr th:last-child,
    #peripheralTable table thead tr th:last-child
    {
        width: 13em;
    }

</style>
@endpush

@section('content')

@livewire('warranty-details', [ 'model' => 'Warranty'])


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
                <th style="width:15%;">PURCHASE DATE</th>
                <th style="width:15%;">EXPIRY DATE</th>
                <th>NOTES</th>
				<th style="width:10%;">STATUS</th>
			</thead>
			<tbody>
                @foreach ( $warranties as $warranty )
                    <tr>
                        <td>
                            <a href="#" onclick="getInfo({{$warranty->id}})"><i class="fa fa-info-circle" aria-hidden="true"></i> Details</a>
                        </td>
                        <td>{{$warranty->type()}}</td>
                        <td>{{$warranty->purchase_date->format('Y-M-d')}}</td>
                        <td>{{$warranty->warranty_life->format('Y-M-d')}}</td>
                        {{-- <td>{{$warranty->brand->brand_name}}</td>
                        <td>{{$warranty->purchase_date}}</td>
                        <td>{{$warranty->purchase_location}}</td> --}}
                        <td>{{$warranty->notes}}</td>
                        <td>
                            <span class=
                                @if($warranty->status=='Expired') 
                                    "text-danger"
                                @else
                                    "text-success"
                                @endif
                                >{{$warranty->status}}</span>
                        </td>
                    </tr>
                @endforeach
			</tbody>
		</table>

    </div>

    @livewireScripts
    <script src=" {{asset('js/warranty.js')}}"></script>
    <script src=" {{asset('js/crud.js')}}"></script>

@endsection