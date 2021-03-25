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
							<li class="active"><a href="{{ url('umkm') }}">Umkm</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	<section>
		
	
	<div class="container" style="margin-top: 20px; margin-bottom: 40px ">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Umkm</h2>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach($umkms as $u)
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Single Blog  -->
					<div class="shop-single-blog">
						<img src="{{ asset($u->logo) }}" alt="#">
						<div class="content">
							<!-- <p class="date">22 July , 2020. Monday</p> -->
							<center><h3 class="title">{{ $u->store_name }}</h3> </center>
							<!-- <a href="#" class="more-btn">Continue Reading</a> -->
						</div>
					</div>
					<!-- End Single Blog  -->
				</div>
				@endforeach

					<!-- End Single Blog  -->
				</div>
			</div>
		</div>
</section>
@endsection