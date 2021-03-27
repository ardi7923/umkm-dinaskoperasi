@extends('layouts.front')

@section('content')
<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="{{ url('product') }}">Product</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="margin-top: 20px; margin-bottom: 100px">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>PRODUK</h2>
				</div>
			</div>
		</div>
		<div class="row">
			@forelse( $products as $i => $p )
			@if($i > 2)
				<section class="shop-home-list section" style="margin-right: 20px; margin-top: -100px"  >
			@else
				<section class="shop-home-list section" style="margin-right: 20px;"  >
			@endif
			
			<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="{{ $p->image }}" style="width: 114px; height: 140px" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h4 class="title"><a href="#">{{ $p->name }}</a></h4>
								<h4 class="title"><a href="#">35 Terjual</a></h4>
								<p class="price with-discount">Rp {{ number_format( $p->price,0,',','.' ) }}</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			@empty
			<div class="col-xl-12 col-lg-4 col-md-4 col-12">	<!-- End Breadcrumbs -->
			<center>
				<img src="{{ asset('data-not-found.png') }}" width="450px" style="margin-top: 70px" alt="">

				<h2>
					DATA TIDAK DITEMUKAN
				</h2>
				<a href="{{ url('/') }}"> <button type="button" class="btn btn-primary col-md-4" style="margin-top: 20px; margin-bottom: 100px"> Kembali ke Home </button> </a>
			</center>
		</div>
			@endforelse

		</div>
	</div>
@endsection