
    <!-- HEADER -->
	<header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<span>Welcome to Smack-Bazar!</span>
				</div>
				<div class="pull-right">
					<ul class="header-top-links">
						<li>
							<a href="@if(session()->get('lang') == 'eng') {{ route('switch.lang.bangla') }} @else {{ route('switch.lang.english') }} @endif">
								<span style="margin-right: 4px"><i class="fa fa-language"></i></span>
								@if(session()->get('lang') == 'eng') বাংলা @else English @endif
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /top Header -->

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="{{ url('/') }}">
							<img src="{{ asset('frontend') }}/img/logo.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<form>
							<input class="input search-input search-field" type="text" placeholder="Enter your keyword">
							<button class="search-btn"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<!-- /Search -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Account -->

						@auth
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
							</div>
							<a href="#" class="text-uppercase">{{ Auth::user()->name }}</a>
							<ul class="custom-menu">
								<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
								<li><a href="#"><i class="fa fa-heart-o"></i> My Wishlist</a></li>
								<li><a href="{{ route('user.logout') }}"><i class="fa fa-check"></i> Logout</a></li>
								<li><a href="#"><i class="fa fa-unlock-alt"></i> Login</a></li>
								<li><a href="#"><i class="fa fa-user-plus"></i> Create An Account</a></li>
							</ul>
						</li>
						@else
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
							</div>
							<ul class="custom-menu">
								<li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> Login</a></li>
								<li><a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> Create An Account</a></li>
							</ul>
						</li>
						@endauth
						<!-- /Account -->

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span id="cart_qty" class="qty"></span>
								</div>
								<strong class="text-uppercase">My Cart:</strong>
								<br>
								<span id="cart_total">$</span>
							</a>
						</li>
						<!-- /Cart -->

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
			<!-- header -->
		</div>
		<!-- container -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav show-on-click">
					<span class="category-header">@if(session()->get('lang') == 'eng') Categories @else ক্যাটেগরীজ @endif <i class="fa fa-list"></i></span>
					<ul class="category-list">
						@php
						$categories = \App\Models\Category::where('status', '=', 1)->get();
						@endphp
						@foreach($categories as $category)
						<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								@if(session()->get('lang') == 'eng')
								{{ $category->cat_name_en }}
								@else
								{{ $category->cat_name_bn }}
								@endif 
								<i class="fa fa-angle-right"></i>
							</a>
							<div class="custom-menu">
								<ul class="list-links">
									@php
									$subcats = \App\Models\Subcat::where(['status' => 1, 'cat_id' => $category->id])->get();
									@endphp
									@foreach($subcats as $subcat)
									<li>
										<a href="#">
										@if(session()->get('lang') == 'eng')
										{{ $subcat->subcat_name_en }}
										@else
										{{ $subcat->subcat_name_bn }}
										@endif 
										</a>
									</li>
									@endforeach
								</ul>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
				<!-- /category nav -->

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
						<li><a href="{{ url('/') }}">Home</a></li>
						<li><a href="#">Shop</a></li>
						<li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Pages <i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="index.html">Home</a></li>
								<li><a href="products.html">Products</a></li>
								<li><a href="product-page.html">Product Details</a></li>
								<li><a href="checkout.html">Checkout</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->
