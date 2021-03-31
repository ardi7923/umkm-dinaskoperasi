@extends('layouts.front')

@section('title')
	403
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
							<li class="active"><a href="{{ url('cart') }}">Keranjang</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	<center>
		<img src="{{ asset('user-remove.png') }}" width="250px" style="margin-top: 70px" alt="">

		<h2>
			Anda Belum Terdaftar !! 
		</h2>
		<p>
			Silahkan Login atau register untuk melanjutkan pemesanan
		</p>
		<a href="{{ url('/') }}"> <button type="button" class="btn btn-primary col-md-4" style="margin-top: 20px; margin-bottom: 100px"> Kembali ke Home </button> </a>
	</center>
	


@endsection