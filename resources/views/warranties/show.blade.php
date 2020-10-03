@extends('layouts.app')

@section('content')

<h1>Warranty Details</h1>

Brand: {{ $warranty->brand_id }}
Purchase Date: {{ $warranty->purchase_date }}
Purchase Location: {{ $warranty->location }}
Receipt: {{ $warranty->receipt_url }}
Serial No:{{ $warranty->serial_no }}
Warranty Life: {{ $warranty->warranty_life }}
Notes: {{ $warranty->notes }}
Status: {{ $warranty->status }}

<a href="{{ str_replace(url('/'), '', url()->previous())
 }}" class="btn">Go back</a>

@endsection