@extends('layouts.front')


@section('content')
<!-- Slider Area -->
<section class="hero-slider">
	<!-- Single Slider -->
	<div class="single-slider">
		<div class="container">
			<div class="row no-gutters">
				<div class="col-lg-9 offset-lg-3 col-12">
					<div class="text-inner">
						<div class="row">
							<div class="col-lg-7 col-12">
								<div class="hero-text">
									<h1><span>UP TO 50% OFF </span>Shirt For Man</h1>
									<p>Maboriosam in a nesciung eget magnae <br> dapibus disting tloctio in the find it pereri <br> odiy maboriosm.</p>
									<div class="button">
										<a href="#" class="btn">Shop Now!</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Single Slider -->
</section>
<!--/ End Slider Area -->



<!-- Start Product Area -->
<div class="product-area section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>Trending Item</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="product-info">
					<div class="nav-main">
						<!-- Tab Nav -->
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							@foreach($categories as $i => $c )
							<li class="nav-item">
								<a class="nav-link {{ ($i) ? '' : 'active' }}" data-toggle="tab" href="#{{ $c->id }}" role="tab">{{ $c->name }}</a>
							</li>
							@endforeach

						</ul>
						<!--/ End Tab Nav -->
					</div>
					<div class="tab-content" id="myTabContent">
						@foreach( $categories as $i => $c )
						<!-- Start Single Tab -->
						<div class="tab-pane fade show active" id="{{ $c->id }}" role="tabpanel">
							<div class="tab-single">
								<div class="row">
									@foreach( $c->product()->limit(8)->get() as $p )
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="{{ $p->image }}" alt="#">
													<img class="hover-img" src="{{ $p->image }}" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														
													</div>
													<div class="product-action-2">
														<a title="Tambahkan ke keranjang" href="{{ url('cart/'.$p->id) }}">Tambahkan ke keranjang</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">{{ $p->name }}</a></h3>
												<span style="color: #F7941D; font-size: 9pt"> {{ $p->orderlists->count() }} Terjual </span>
												<div class="product-price">
													<span>Rp {{ number_format($p->price,0,',','.') }}</span>
												</div>
											</div>
										</div>
									</div>
									
									@endforeach

								</div>
							</div>
						</div>
						<!--/ End Single Tab -->
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Product Area -->


<!-- Start Shop Home List  -->
<section class="shop-home-list section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>On sale</h1>
						</div>
					</div>
				</div>
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h4 class="title"><a href="#">Licity jelly leg flat Sandals</a></h4>
								<p class="price with-discount">$59</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$44</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$89</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
			</div>
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>Best Seller</h1>
						</div>
					</div>
				</div>
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$65</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$33</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$77</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
			</div>
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>Top viewed</h1>
						</div>
					</div>
				</div>
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$22</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$35</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$99</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
			</div>
		</div>
	</div>
</section>
<!-- End Shop Home List  -->




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
			</div>
			<div class="modal-body">
				<div class="row no-gutters">
					<div class="col-lg-6 offset-lg-3 col-12">
						<h4 style="margin-top:100px;font-size:14px; font-weight:500; color:#F7941D; display:block; margin-bottom:5px;">Eshop Free Lite</h4>
						<h3 style="font-size:30px;color:#333;">Currently You are using free lite Version of Eshop.<h3>
							<p style="display:block; margin-top:20px; color:#888; font-size:14px; font-weight:400;">Please, purchase full version of the template to get all pages, features and commercial license</p>
							<div class="button" style="margin-top:30px;">
								<a href="https://wpthemesgrid.com/downloads/eshop-ecommerce-html5-template/" target="_blank" class="btn" style="color:#fff;">Buy Now!</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal end -->
	@endsection