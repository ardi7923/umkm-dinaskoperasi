@extends('layouts.front')

@section('seo-title')Umkm Sulsel - Umkm @endsection
@section('seo-description')Umkm yang terdaftar di dinas koperasi dan Umkm Sulsel @endsection
@section('seo-type')umkm @endsection
@section('seo-image'){{ asset('logo.png') }} @endsection

@section('content')
<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="{{ url('umkm') }}">Umkm</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
<section class="shop-blog section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>UMKM</h2>
				</div>
			</div>
		</div>
		<div class="row">
			@foreach($umkms as $u)
			<div class="col-lg-4 col-md-6 col-12">
				<!-- Start Single Blog  -->
				<div class="shop-single-blog">
					<a href="{{ url('umkm/'.$u->slug) }}">
						<img src="{{ asset($u->logo) }}" alt="{{ $u->name }}">
					</a>
					<div class="content">
						<!-- <p class="date">22 July , 2020. Monday</p> -->
						<a href="{{ url('umkm/'.$u->slug) }}" class="title">{{ $u->store_name }}</a>
						<!-- <a href="#" class="more-btn">Continue Reading</a> -->
					</div>
				</div>
				<!-- End Single Blog  -->
			</div>
			@endforeach
			</div>
		</div>
	</div>
</section>
@endsection