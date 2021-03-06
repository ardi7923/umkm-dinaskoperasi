@extends('layouts.front')

@section('seo-title')Umkm Sulsel - Maju Bersama UMKM @endsection
@section('seo-description')Program Dari Dinas Koperasi dan umkm, membantu  umkm dalam penjualan produk @endsection
@section('seo-type')Home @endsection
@section('seo-image'){{ asset('logo.png') }} @endsection

@section('styles_page')
<link rel="stylesheet" type="text/css" href="{{  asset('plugins/alertify/css/alertify.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{  asset('plugins/alertify/css/themes/bootstrap.min.css')}}">

@endsection


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

									<!-- 		<p style="color: white">Maboriosam in a nesciung eget magnae <br> dapibus disting tloctio in the find it pereri <br> odiy maboriosm.</p>
									<div class="button">
										<a href="#" class="btn">Shop Now!</a>
									</div> -->
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
						<div class="tab-pane fade show {{ ($i == 0) ? 'active' : '' }}" id="{{ $c->id }}" role="tabpanel">
							<div class="tab-single">
								<div class="row">
									@foreach( $c->product()->where('stock','>',0)->limit(8)->get()->sortByDesc(function($best_sellers)
									{
									return $best_sellers->orderlists()->sum('ammount');
									}) as $p )
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a class="product-detail" data-url="{{ url('product/'.$p->id) }}">
													<img class="default-img" src="{{ $p->image }}" alt="{{ $p->name }}" style="width: 350px;height: 250px" alt="#">
													<img class="hover-img" src="{{ $p->image }}" alt="{{ $p->name }}" style="width: 350px;height: 250px" alt="#">
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
												<h3><a href="#">{{ $p->name }}</a></h3>
												<span style="color: #F7941D; font-size: 9pt"> {{ $p->orderlists->sum('ammount') ?? 0 }} Terjual </span>
												<br>
												<span class="badge" style="background-color: #F7941D;color : white; font-size: 7pt"> {{ $c->name }}</span>
												<span class="badge badge-success" style="color : white; font-size: 7pt"> {{ $p->umkm->district }}</span>
												<br>
												<span class="badge badge-secondary" style="color : white; font-size: 7pt"> Stok : {{ $p->stock }}</span>
												<br>
												
												@include('components.product-rate',['value'=> get_avg_product_rate($p->id)])
												<br>
												
												<div class="product-price">
													<span>Rp {{ number_format($p->price,0,',','.') }}</span>
												</div>
												@if($p->discount)
													<i style="font-size: 8pt;color:red">Potongan Harga Rp. {{ rupiah_format($p->discount) }} </i>
												@endif
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
				@foreach($on_sales as $os)
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="{{ asset($os->image) }}" alt="{{ $os->name }}" style="width:115px;height:140px;
										" alt="#">
								<a href="{{ url('cart/'.$os->id) }}" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">{{ $os->name }}</a></h5>
								<span style="color: #F7941D; font-size: 9pt"> {{ $os->orderlists()->sum('ammount') ?? 0 }} Terjual </span> <br>

								<span class="badge" style="background-color: #F7941D;color : white; font-size: 7pt"> {{ $os->category->name }}</span>
								<span class="badge badge-success" style="color : white; font-size: 7pt"> {{ $os->umkm->district }}</span>
								<br>
								<span class="badge badge-secondary" style="color : white; font-size: 7pt"> Stok : {{ $os->stock }}</span><br>
								@include('components.product-rate',['value'=> get_avg_product_rate($os->id)]) <br>
								<p class="price with-discount">{{ rupiah_format($os->price) }}</p>
								@if($os->discount)
									<br><i style="font-size: 8pt;color:red">Potongan Harga Rp. {{ rupiah_format($os->discount) }} </i>
								@endif
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				@endforeach
			</div>
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>Best Seller</h1>
						</div>
					</div>
				</div>
				@foreach($best_sellers as $bs)
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="{{ asset($bs->image) }}" alt="{{ $bs->name }}" style="width:115px;height:140px;
										!important" alt="#">
								<a href="{{ url('cart/'.$bs->id) }}" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">{{ $bs->name }}</a></h5>
								<span style="color: #F7941D; font-size: 9pt"> {{ $bs->orderlists()->sum('ammount') ?? 0 }} Terjual </span> <br>
								<span class="badge" style="background-color: #F7941D;color : white; font-size: 7pt"> {{ $bs->category->name }}</span>
								<span class="badge badge-success" style="color : white; font-size: 7pt"> {{ $bs->umkm->district }}</span>
								<br>
								<span class="badge badge-secondary" style="color : white; font-size: 7pt"> Stok : {{ $bs->stock }}</span><br>
								@include('components.product-rate',['value'=> get_avg_product_rate($bs->id)])<br>
								<p class="price with-discount">{{ rupiah_format($bs->price) }}</p>
								@if($bs->discount)
									<br><i style="font-size: 8pt;color:red">Potongan Harga Rp. {{ rupiah_format($bs->discount) }} </i>
								@endif
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				@endforeach

			</div>
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>Recomended</h1>
						</div>
					</div>
				</div>
				@foreach($recomendeds as $r)
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="{{ asset($r->image) }}" alt="{{ $r->name }}" style="width:115px;height:140px;
										!important" alt="#">
								<a href="{{ url('cart/'.$r->id) }}" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">{{ $r->name }}</a></h5>
								<span style="color: #F7941D; font-size: 9pt"> {{ $r->orderlists()->sum('ammount') ?? 0 }} Terjual </span> <br>
								<span class="badge" style="background-color: #F7941D;color : white; font-size: 7pt"> {{ $r->category->name }}</span>
								<span class="badge badge-success" style="color : white; font-size: 7pt"> {{ $r->umkm->district }}</span>
								<br>
								<span class="badge badge-secondary" style="color : white; font-size: 7pt"> Stok : {{ $r->stock }}</span><br>
								@include('components.product-rate',['value'=> get_avg_product_rate($r->id)])<br>
								<p class="price with-discount">{{ rupiah_format($r->price) }}</p>
								@if($r->discount)
									<br><i style="font-size: 8pt;color:red">Potongan Harga Rp. {{ rupiah_format($r->discount) }} </i>
								@endif
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				@endforeach
			</div>
		</div>
	</div>
</section>
<!-- End Shop Home List  -->




@include('components.modal')

@endsection

@section('scripts_page')

<script src="{{ asset('js/main.js') }}"></script>
<script src="{{  asset('plugins/alertify/alertify.min.js')}}"></script>
@endsection


@section('js')
<script>
	$(document).ready(function() {
		@if(Session::get('success'))
		alertify.notify('Login Berhasil !! <br> Selamat Datang {{ Auth::user()->name }}', 'success', 5, function() {});
		@endif
	});
	$('body').on("click", ".product-detail", showForm);
</script>
@endsection