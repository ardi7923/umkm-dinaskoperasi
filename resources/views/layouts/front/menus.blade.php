						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">	
										<div class="nav-inner">	
											<ul class="nav main-menu menu navbar-nav">
													<li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
													<li class="{{ Request::is('product') ? 'active' : '' }}"><a href="{{ url('product') }}">Produk</a></li>												
													<li class="{{ Request::is('umkm') ? 'active' : '' }}"><a href="{{ url('umkm') }}">Umkm</a></li>
											<!-- 		<li><a href="#">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>
														<ul class="dropdown">
															<li><a href="cart.html">Cart</a></li>
															<li><a href="checkout.html">Checkout</a></li>
														</ul>
													</li> -->
													<li class="{{ Request::is('registration-umkm') ? 'active' : '' }}"><a href="{{ url('registration-umkm') }}">Daftar Mitra</a></li>

													@if( Auth::check() && Auth::user()->role == 'CUSTOMER' )
														<li class="{{ Request::is('registration-umkm') ? 'active' : '' }}"><a href="{{ url('registration-umkm') }}">Data Pemesanan</a></li>
													@endif									
													<!-- <li><a href="#">Blog<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="blog-single-sidebar.html">Blog Single Sidebar</a></li>
														</ul>
													</li> -->
													<!-- <li><a href="contact.html">Kontak Kami</a></li> -->
												</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->	
							</div>
						</div>