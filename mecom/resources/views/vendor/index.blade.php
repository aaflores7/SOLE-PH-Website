@extends('vendor.vendor_dashboard')
@section('vendor')

@php
	$id = Auth::user()->id;
	$vendorId = App\Models\User::find($id);
	$status = $vendorId->status;
@endphp
<div class="page-content">

	@if($status === 'active')
		<h4>Vendor Account is <span class="badge bg-success">Active</span></h4>
	@else
		<h4>Vendor Account is <span class="badge bg-danger">Inactive</span></h4>
		<p class="text-danger">Please wait for admin approval</p>
	@endif
</div>

@endsection