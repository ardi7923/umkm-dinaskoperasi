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
					@if($q)
						<p> Hasil Pencarian <strong> "{{ $q }}" </strong>
					@endif
				</div>
			</div>
		</div>
		<div class="row">
			@forelse( $products as $i => $p )
			<div class="col-xl-3 col-lg-4 col-md-4 col-12">
				<div class="single-product">
					<div class="product-img">
						<a class="product-detail" data-url="{{ url('product/'.$p->id) }}">
							<img class="default-img" src="{{ $p->image }}" style="width: 350px;height: 250px" alt="#">
							<img class="hover-img" src="{{ $p->image }}" style="width: 350px;height: 250px" alt="#">
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
						<span style="color: #F7941D; font-size: 9pt"> {{ $p->orderlists()->sum('ammount') ?? 0}} Terjual </span> <br>
						<span class="badge" style="background-color: #F7941D;color : white; font-size: 7pt"> {{ $p->category->name }}</span>
						<span class="badge badge-success" style="color : white; font-size: 7pt"> {{ $p->umkm->district }}</span>
						<br>
												<span class="badge badge-secondary" style="color : white; font-size: 7pt"> Stok : {{ $p->stock }}</span>
						<div class="product-price">
							<span>Rp {{ number_format($p->price,0,',','.') }}</span>
						</div>
					</div>
				</div>
			</div>
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

	@include('components.modal')
@endsection

@section('scripts_page')
	<script src="{{ asset('js/main.js') }}"></script>
@endsection


@section('js')
	<script>
		$('body').on("click",".product-detail", showForm);

	</script>
@endsection