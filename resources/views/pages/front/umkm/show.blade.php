@extends('layouts.front')

@section('title')
Pendaftaran Mitra
@endsection

@section('styles_page')

@endsection

@section('content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
						<li><a href="{{ url('umkm') }}">UMKM<i class="ti-arrow-right"></i></a></li>
						<li class="active"><a href="{{ url('umkm/'.$umkm->id) }}">{{ $umkm->store_name }}</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumbs -->

<!-- Start Contact -->
<section id="contact-us" class="contact-us section">
	<div class="container">
		<div class="contact-head">
			<div class="row">
				<div class="col-lg-4 col-12">
					<div class="single-head">
						<div class="single-info">
							<h4 class="title">{{ strtoupper($umkm->store_name) }}:</h4>
							<img src="{{ asset($umkm->logo) }}" alt="">
						</div>

						<div class="single-info">
							<!-- 		<i class="fa fa-location-arrow"></i> -->
							<h4 class="title">Alamat:</h4>
							<ul>
								<li>{{ $umkm->address }}</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-12">
					<div class="section-title">
						<h2>PRODUK</h2>
					</div>
					<div class="row">
						@foreach( $umkm->products as $p )

						<div class="col-xl-4 col-lg-4 col-md-4 col-12">
							<div class="single-product">
								<div class="product-img">
									<a class="product-detail" data-url="{{ url('product/'.$p->id) }}">
										<img class="default-img" src="{{ asset($p->image) }}" style="width: 350px;height: 250px" alt="#">
										<img class="hover-img" src="{{ asset($p->image) }}" style="width: 350px;height: 250px" alt="#">
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
									<span style="color: #F7941D; font-size: 9pt">{{ $p->orderlists->count() }} Terjual </span> <br>
									<span class="badge" style="background-color: #F7941D;color : white; font-size: 7pt"> {{ $p->category->name }}</span>
									<span class="badge badge-success" style="color : white; font-size: 7pt"> {{ $p->umkm->district }}</span>
									<br>
									<span class="badge badge-secondary" style="color : white; font-size: 7pt"> Stok : {{ $p->stock }}</span>
									<br>
									@include('components.product-rate',['value'=> get_avg_product_rate($p->id)])
									<div class="product-price">
										<span>Rp {{ rupiah_format($p->price) }}</span>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
<!--/ End Contact -->
@endsection