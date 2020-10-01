@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}

<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endpush

@section('content')
<a href = "/warranties/create" class="btn btn-success w-100"><i class="fas fa-plus"></i> Add New</a>
    <table class ="table">
        <thead>
            <th>Brand</th>
            <th>Purchase Date</th>
            <th>Location</th>
            <th>Receipt</th>
            <th>Serial Number</th>
            <th>Warranty Life</th>
            <th>Notes</th>
            <th>Status</th>
        </thead>
        <tbody>
            @foreach($warranties as $warranty)
                <tr>
                <td><button data-toggle="modal" data-target="#warranty-{{$warranty->id}}-info">Open Info</button></td>
                    <td>{{$warranty->brand_id}}</td>
                    <td>{{$warranty->purchase_date}}</td>
                    <td>{{$warranty->location}}</td>
                    <td>{{$warranty->receipt_url}}</td>
                    <td>{{$warranty->serial_no}}</td>
                    <td>{{$warranty->warranty_life}}</td>
                    <td>{{$warranty->notes}}</td>
                    <td>{{$warranty->status}}</td>
                    
					<div class="d-flex w-100">
						<a class="btn w-100" href="/warranties/{{$warranty->id}}/edit"><i class="fas fa-edit fa-lg"></i></a>
						<form class="w-100" action="warranties/{{$warranty->id}}" method="POST">
							@method('delete')
							@csrf
							<button type="submit" class="btn w-100"><i class="fas fa-trash-alt fa-lg"></i></button>
						</form>
					</div>
				</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @foreach($warranties as $warranty)
        <div class="modal" id="warranty-{{$warranty->id}}-info">
            <div class="modal-dialog">
                <div class = "modal-content">
                    <h1>Edit Warranty Details</h1>
                    <form action = "/warranties/{{$warranty->id}}" method = "POST" enctype ="multipart/form-data">
                        @csrf
					    @method('PATCH')
                        <input type = "text" name = "brand_id" placeholder = "Brand" 
                            class = "form-control"
                            value = "{{$warranty->brand_id}}"
                            required>
                        <input type = "date" name = "purchase_date" placeholder = "Purchase Date" 
                            class = "form-control"
                            value = "{{$warranty->purchase_date}}"
                            required>
                        <input type = "text" name = "location" placeholder = "Location" 
                            class = "form-control"
                            value = "{{$warranty->location}}"
                            required>
                        <input type = "file" name = "receipt_url" placeholder = "Receipt" 
                            class = "form-control"
                            value = "{{$warranty->receipt_url}}"
                            required>
                        <input type = "text" name = "serial_no" placeholder = "Serial Number" 
                            class = "form-control"
                            value = "{{$warranty->serial_no}}"
                            required>
                        <input type = "date" name = "warranty_life" placeholder = "Warranty Life" 
                            class = "form-control"
                            value = "{{$warranty->warranty_life}}"
                            required>
                        <input type = "text" name = "notes" placeholder = "Notes" 
                            class = "form-control"
                            value = "{{$warranty->notes}}"
                            required>
                        <input type = "text" name = "status" placeholder = "Status" 
                            class = "form-control"
                            value = "{{$warranty->status}}"
                            required>

                        <button class="btn btn-primary">Edit Item</button>
					    <a class="btn btn-danger" href="/warranties">Return</a>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection