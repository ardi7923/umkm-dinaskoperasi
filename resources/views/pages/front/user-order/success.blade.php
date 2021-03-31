@extends('layouts.front')

@section('title')
	Pemesanan Berhasil
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
							<!-- <li class="active"><a href="{{ url('cart') }}">Checkout</a></li> -->
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	<center>
		<img src="{{ asset('success-order.png') }}" width="450px" style="margin-top: 0px" alt="">

		<h2>
			Kirim Bukti Berhasil !!
		</h2>
		<p> Tunggu Konfirmasi dari Kami yaa </p>
		<a href="{{ url('user-order') }}"> <button type="button" class="btn btn-primary col-md-4" style="margin-top: 20px; margin-bottom: 100px"> Lihat Data Pemesanan </button> </a>
	</center>
	


@endsection