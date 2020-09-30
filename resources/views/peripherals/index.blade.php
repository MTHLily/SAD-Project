@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endpush

@section('content')
	
	<!-- <div class="container">

		<div class="row">
			<div class="col-12">
				<form class="form-inline float-sm-left">
					<div class="form-group mr-2">
						<h1>Peripheral Inventory</h1>
					</div>
				</form>
				<form class="form-inline float-sm-right">
					<a data-toggle="modal" href="#peripheral-add" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> Add Item</a>
					<input type="text" class="form-control ml-2" placeholder="Search">
				</form>
			</div>
		</div>
		
		<table class="table table-striped table-bordered">
			<thead>
				<th>ASSET TAG</th>
				<th>PERIPHERAL</th>
				<th>TYPE</th>
				<th>WARRANTY</th>
				<th>STATUS</th>
				<th>ITEM DETAILS</th>
			</thead>
			<tbody>
				@foreach( $peripherals as $peripheral )
					<tr>
						<td>{{ $peripheral->asset_tag }}</td>
						<td class="name">{{ $peripheral->peripheral_name }}</td>
						<td>{{ $peripheral->type()->get()[0]->peripheral_type }}</td>
						<td class="warranty">
							{!! ($peripheral->warranty_id != null) ? 
									"<a href='/warranties/$peripheral->warranty_id'>View Warranty</a>" : 
									"<a href='/warranties/create'>Assign Warranty</a>"
							!!}
						</td>
						<td>{{ $peripheral->status }}</td>
						<td class="detail">
							<a data-toggle="modal" href="#peripheral-{{$peripheral->id}}-info">View Details</a>
						</td>  
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	@foreach( $peripherals as $peripheral )

	<div class="modal fade" id="peripheral-add" tabindex="-1" role="dialog">
  		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form action="/peripheral" method="POST">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Peripheral</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group row">
							<label for="asset_tag" class="col-sm-3 col-form-label">Asset Tag</label>
							<div class="col-sm-9">
								<input  type="text" name="asset_tag" placeholder="Asset Tag" 
											class="form-control" 
											value=""
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_name" class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_name" placeholder="Name" 
											class="form-control" 
											value=""
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_type" class="col-sm-3 col-form-label">Type</label>
							<div class="col-sm-9">
								<select name="peripheral_type_id" class="custom-select" required>
									<option value="1"
										@if($peripheral->peripheral_type_id == 1)
										selected
										@endif
									>
										Keyboard
									</option>
									<option value="2"
										@if($peripheral->peripheral_type_id == 2)
										selected
										@endif 
									>
										Phone
									</option>
									<option value="3"
										@if($peripheral->peripheral_type_id == 3)
										selected
										@endif 
									>
										Tablet
									</option>
									<option value="4"
										@if($peripheral->peripheral_type_id == 4)
										selected
										@endif 
									>
										Mouse
									</option>
									<option value="5"
										@if($peripheral->peripheral_type_id == 5)
										selected
										@endif 
									>
										Monitor
									</option>
									<option value="6"
										@if($peripheral->peripheral_type_id == 6)
										selected
										@endif 
									>
										Miscellaneous
									</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_issues" class="col-sm-3 col-form-label">Issues</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_issues" placeholder="Issues" 
											class="form-control" 
											value="{{$peripheral->issues}}"
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_remarks" class="col-sm-3 col-form-label">Remarks</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_remarks" placeholder="Remarks" 
											class="form-control" 
											value="{{$peripheral->remarks}}"
											required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
						<button type="submit" class="btn btn-success">Done</button>
					</div>
				</form>
    		</div>
  		</div>
	</div> -->

	<div class="container mb-5">
		<table class="table" id="myTable">
			  <thead class="thead-dark">
				    <tr>
					    <th scope="col">#</th>
					    <th scope="col">First</th>
					    <th scope="col">Last</th>
					    <th scope="col">Handle</th>
				    </tr>
			  </thead>
			  <tbody>
				    <tr>
					    <th scope="row">1</th>
					    <td>Mark</td>
					    <td>Otto</td>
					    <td>@mdo</td>
				    </tr>
				    <tr>
				        <th scope="row">2</th>
				        <td>Jacob</td>
				        <td>Thornton</td>
				        <td>@fat</td>
				    </tr>
				    <tr>
				        <th scope="row">3</th>
				        <td>Larry</td>
				        <td>the Bird</td>
				        <td>@twitter</td>
				    </tr>
			  </tbody>
		</table>
	</div>

	@endforeach

	@foreach( $peripherals as $peripheral )

	<div class="modal fade" id="peripheral-{{$peripheral->id}}-info" tabindex="-1" role="dialog">
  		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Peripheral Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
      			</div>
      			<div class="modal-body">
					<form action="/peripheral/{{$peripheral->id}}" method="POST">
						@csrf
						@method('PATCH')
						<div class="form-group row">
							<label for="asset_tag" class="col-sm-3 col-form-label">Asset Tag</label>
							<div class="col-sm-9">
								<input  type="text" name="asset_tag" placeholder="Asset Tag" 
											class="form-control" 
											value="{{$peripheral->asset_tag}}" 
											readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_name" class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_name" placeholder="Name" 
									class="form-control" 
									value="{{$peripheral->peripheral_name}}"
									readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_type" class="col-sm-3 col-form-label">Type</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_type" placeholder="Peripheral Type" 
									class="form-control" 
									value="{{$peripheral->type()->get()[0]->peripheral}}"
									readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_status" class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_status" placeholder="Peripheral Status" 
									class="form-control" 
									value="{{$peripheral->status}}"
									readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_issues" class="col-sm-3 col-form-label">Issues</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_issues" placeholder="Issues" 
									class="form-control" 
									value="{{$peripheral->issues}}"
									readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_remarks" class="col-sm-3 col-form-label">Remarks</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_remarks" placeholder="Remarks" 
									class="form-control" 
									value="{{$peripheral->remarks}}"
									readonly>
							</div>
						</div>
					</form>
      			</div>
				<div class="modal-footer">
					<form action="/peripheral/{{$peripheral->id}}" method="POST">
						@method('delete')
						@csrf
						<button type="submit"class="btn btn-success">Remove</button>
					</form>
					<a class="btn btn-success" data-toggle="modal" href="#peripheral-{{$peripheral->id}}-edit">Update</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">Return</button>
				</div>
    		</div>
  		</div>
	</div>
	
	@endforeach

	@foreach( $peripherals as $peripheral )

	<div class="modal fade" id="peripheral-{{$peripheral->id}}-edit" tabindex="-1" role="dialog">
  		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form action="/peripheral/{{$peripheral->id}}" method="POST">
					@csrf
					@method('PATCH')
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group row">
							<label for="asset_tag" class="col-sm-3 col-form-label">Asset Tag</label>
							<div class="col-sm-9">
								<input  type="text" name="asset_tag" placeholder="Asset Tag" 
											class="form-control" 
											value="{{$peripheral->asset_tag}}"
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_name" class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_name" placeholder="Name" 
											class="form-control" 
											value="{{$peripheral->peripheral_name}}"
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_type" class="col-sm-3 col-form-label">Type</label>
							<div class="col-sm-9">
								<select name="peripheral_type_id" class="custom-select" required>
									<option value="1"
										@if($peripheral->peripheral_type_id == 1)
										selected
										@endif
									>
										Keyboard
									</option>
									<option value="2"
										@if($peripheral->peripheral_type_id == 2)
										selected
										@endif 
									>
										Phone
									</option>
									<option value="3"
										@if($peripheral->peripheral_type_id == 3)
										selected
										@endif 
									>
										Tablet
									</option>
									<option value="4"
										@if($peripheral->peripheral_type_id == 4)
										selected
										@endif 
									>
										Mouse
									</option>
									<option value="5"
										@if($peripheral->peripheral_type_id == 5)
										selected
										@endif 
									>
										Monitor
									</option>
									<option value="6"
										@if($peripheral->peripheral_type_id == 6)
										selected
										@endif 
									>
										Miscellaneous
									</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_status" class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_status" placeholder="Peripheral Status" 
											class="form-control" 
											value="{{$peripheral->status}}"
											readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_issues" class="col-sm-3 col-form-label">Issues</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_issues" placeholder="Issues" 
											class="form-control" 
											value="{{$peripheral->issues}}"
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_remarks" class="col-sm-3 col-form-label">Remarks</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_remarks" placeholder="Remarks" 
											class="form-control" 
											value="{{$peripheral->remarks}}"
											required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
						<button type="submit" class="btn btn-success">Done</button>
					</div>
				</form>
    		</div>
  		</div>
	</div>

	@endforeach

@endsection