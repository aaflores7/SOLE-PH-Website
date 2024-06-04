<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('frontend/assets/imgs/theme/logo.png')}}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Sole PH Admin</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{route('admin.dashboard')}}">
						<div class="parent-icon"><i class='bx bx-cookie'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Brand</div>
					</a>
					<ul>
						<li> <a href="{{route('all.brand')}}"><i class="bx bx-right-arrow-alt"></i>All Brand</a>
						</li>
						<li> <a href="{{route('add.brand')}}"><i class="bx bx-right-arrow-alt"></i>Add brand</a>
						</li>

					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Category</div>
					</a>
					<ul>
						<li> <a href="{{route('all.category')}}"><i class="bx bx-right-arrow-alt"></i>All Category</a>
						</li>
						<li> <a href="{{route('add.category')}}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">SubCategory</div>
					</a>
					<ul>
						<li> <a href="{{route('all.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>All SubCategory</a>
						</li>
						<li> <a href="{{route('add.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>Add SubCategory</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Product Manage</div>
					</a>
					<ul>
						<li> <a href="{{route('all.product')}}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
						</li>
						<li> <a href="{{route('add.product')}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Slider Manager</div>
					</a>
					<ul>
						<li> <a href="{{route('all.slider')}}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
						</li>
						<li> <a href="{{route('add.slider')}}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Banner Manage</div>
					</a>
					<ul>
						<li> <a href="{{route('all.banner')}}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
						</li>
						<li> <a href="{{route('add.banner')}}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
						</li>
					</ul>
				</li>

				<li class="menu-label">UI Elements</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Vendor Manage</div>
					</a>
					<ul>
						<li> <a href="{{route('inactive.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
						</li>
						<li> <a href="{{route('active.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Order Manage</div>
					</a>
					<ul>
						<li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
						</li>
						<li> <a href="{{ route('admin.confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed Order</a>
						</li>
						<li> <a href="{{ route('admin.processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing Order</a>
						</li>
						<li> <a href="{{ route('admin.delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Delivered Order</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='lni lni-paperclip'></i>
						</div>
						<div class="menu-title">Return Order </div>
					</a>
					<ul>
						<li> <a href="{{ route('return.request') }}"><i class="bx bx-right-arrow-alt"></i>Return Request</a>
						</li>
						<li> <a href="{{ route('complete.return.request') }}"><i class="bx bx-right-arrow-alt"></i>Complete Request</a>
						</li> 
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-indent-increase"></i>
						</div>
						<div class="menu-title">Review Manage</div>
					</a>
					<ul>
						<li> <a href="{{ route('pending.review') }}"><i class="bx bx-right-arrow-alt"></i>Pending Review</a>
						</li>

							<li> <a href="{{ route('publish.review') }}"><i class="bx bx-right-arrow-alt"></i>Publish Review</a>
						</li>
						
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-cart-full"></i>
						</div>
						<div class="menu-title">Stock Manage</div>
					</a>
					<ul>
						<li> <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Product Stock</a>
						</li>
					</ul>
				</li>
			</ul>
			<!--end navigation-->
		</div>