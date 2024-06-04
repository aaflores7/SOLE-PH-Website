@php
	$id = Auth::user()->id;
	$vendorId = App\Models\User::find($id);
	$status = $vendorId->status;
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('frontend/assets/imgs/theme/logo.png')}}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Sole PH Vendor</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{route('vendor.dashboard')}}">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>

				@if($status === 'active')
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Product Manage</div>
					</a>
					<ul>
						<li> <a href="{{route('vendor.all.product')}}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
						</li>
						<li> <a href="{{route('vendor.add.product')}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
						</li>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Order Manage</div>
					</a>
					<ul>
						<li> <a href="{{route('vendor.order')}}"><i class="bx bx-right-arrow-alt"></i>Vendor Order</a>
						</li>
						<li> <a href="{{route('vendor.return.order')}}"><i class="bx bx-right-arrow-alt"></i>Return Order</a>
						</li>
						<li> <a href="{{ route('vendor.complete.return.order') }}"><i class="bx bx-right-arrow-alt"></i>Complete Return Order</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-indent-increase"></i>
						</div>
						<div class="menu-title"> Review Manage </div>
					</a>
					<ul>
						<li> <a href="{{ route('vendor.all.review') }}"><i class="bx bx-right-arrow-alt"></i>All Review</a>
						</li>

						 
					</ul>
				</li>
				@else
				
				@endif
						
			</ul>
			<!--end navigation-->
		</div>