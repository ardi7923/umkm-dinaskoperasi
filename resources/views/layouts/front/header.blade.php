	<header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li><i class="ti-headphone-alt"></i> (0411) 853991</li>
								<li><i class="ti-email"></i> support@umkmsulsel.com</li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-7 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
							  @if(!Auth::check())
								<li>
									<i class="ti-user"></i> <a href="{{ url('register') }}">Register</a>
								</li>
								<li>
									<i class="ti-power-off"></i><a href="{{ url('login') }}">Login</a>
								</li>
							  @elseif(Auth::check() && Auth::user()->role == 'CUSTOMER')
							  	<li>
									<i class="ti-user"></i> <a href="#">{{ Auth::user()->name }}</a>
								</li>
								<li>
									<i class="ti-power-off"></i>
									<a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
								</li>

							  @else
							  	<li>
									<i class="ti-user"></i> <a href="{{ url('login') }}">{{ Auth::user()->name }}</a>
								</li>
							  								 
							  @endif

							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="{{ url('/') }}"><img src="{{ asset('logo.png') }}" style="height: 60px" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form">
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<select>
									<option selected="selected">Semua</option>
									@foreach(get_categories() as $c)
										<option value=""> {{ $c->name }} </option>
										
									@endforeach
								</select>
								<form>
									<input name="search" placeholder="Cari Produk Disini....." type="search">
									<button class="btnn"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
						<!-- 	<div class="sinlge-bar">
								<a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar">
								<a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
							</div> -->
							@if(Auth::check() && Auth::user()->role == 'CUSTOMER')
							<div class="sinlge-bar shopping">
								<a href="{{ url('cart') }}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{ Auth::user()->carts->count() }}</span></a>
								<!-- Shopping Item -->
								
								<div class="shopping-item">
									@if(count(Auth::user()->carts) > 0)
									<div class="dropdown-cart-header">
										<span>{{ Auth::user()->carts->count() }} Items</span>
										<a href="{{ url('cart') }}">Lihat Keranjang</a>
									</div>

									<ul class="shopping-list">
									  @foreach( Auth::user()->carts as $c )
										<li>
											<a href="#" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
											<a class="cart-img" href="#"><img src="{{ $c->product->image }}" style="width: 70px; height: 70px" alt="#"></a>
											<h4><a href="#">{{ $c->product->name }}</a></h4>
											<p class="quantity">1x - <span class="amount">{{ rupiah_format($c->product->price ) }}</span></p>
										</li>
										@endforeach
									</ul>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount">Rp {{ rupiah_format(Auth::user()->products()->sum('price')) }}</span>
										</div>
										
											<a href="checkout.html" class="btn animate">Checkout</a>
										
									</div>
									@else
										<div class="dropdown-cart-header">
										 <center> <strong> Belum Ada Pesanan </strong> </center>
										</div>
									@endif
								</div>
								
								<!--/ End Shopping Item -->
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						@if(Request::is('/'))
						<div class="col-lg-3">
							<div class="all-category">
								<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
								<ul class="main-category">
									@foreach(get_categories() as $c)
									<li><a href="#">{{ $c->name }}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
						@endif

						@include('layouts.front.menus')
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header