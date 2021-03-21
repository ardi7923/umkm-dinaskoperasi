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
	@foreach($umkms as $u)
	<div class="col-xl-3 col-lg-4 col-md-4 col-12">
		<div class="single-product">
			<div class="product-img">
				<a href="#">
					<img class="default-img" src="{{ asset($u->logo) }}" alt="#">
					<img class="hover-img" src="{{ asset($u->logo) }}" alt="#">
				</a>

			</div>
			<div class="product-content">
				<center> 
					<h3><a href="#">{{ $u->store_name }}</a></h3>
				</center>
			</div>
		</div>
	</div>
	<br><br><br>
	@endforeach
@endsection