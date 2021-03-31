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
							<li class="active"><a href="{{ url('checkout') }}">checkout</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	<form action="{{ url('checkout-process') }}" method="POST" accept-charset="utf-8">
		@csrf
<section class="shop checkout section">
			<div class="container">
				<div class="row"> 
					<div class="col-lg-8 col-12">
						<div class="checkout-form">
							<h2>Pastikan Semua data diri sudah benar !!</h2>
							<p>Pilih Bank Untuk Lakukan Pembayaran</p>
							<!-- Form -->
						
								<table>
									<thead>
										<tr>
											<th width="150px">Nama</th>
											<th>:</th>
											<th>{{ Auth::user()->name }}</th>
										</tr>
										<tr>
											<th>Nomor Telepon</th>
											<th>:</th>
											<th>{{ Auth::user()->customer->phone }}</th>
										</tr>
										<tr>
											<th>Alamat</th>
											<th>:</th>
											<th>{{ Auth::user()->customer->address }}</th>
										</tr>
									</thead>

								</table>

								<table class="table shopping-summery" id="table-shopping">
								<thead>
									<tr class="main-hading">
										<th>PRODUK</th>
										<th>NAMA</th>
										<th class="text-center">HARGA SATUAN</th>
										<th class="text-center">JUMLAH</th>
										<th class="text-center">TOTAL</th> 
										
									</tr>
								</thead>
								<tbody>
									@foreach( Auth::user()->carts as $i => $c )
									<tr id="tableTr">
										<td class="image" data-title="No"><img src="{{ $c->product->image }}" style="width: 100px; height: 100px" loading="lazy" alt="#"></td>
										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="#">{{ $c->product->name }}</a></p>
										
										</td>
										<td class="price" data-title="Price"><span>Rp. {{ number_format( $c->product->price,0,',','.' ) }} </span></td>
										<td class="qty" data-title="Qty"><!-- Input Order -->
											{{ $c->qty }}
											<!--/ End Input Order -->
										</td>
										<td class="total-amount" data-title="Total">
											<span id="totalproduct-{{ $i }}"> {{ ($c->qty) ? rupiah_format( $c->product->price * $c->qty ) : rupiah_format( $c->product->price  ) }} </span>
										</td>
									</tr>
								
									@endforeach
								</tbody>
							</table>
							<!--/ End Form -->
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="order-details">
							<!-- Order Widget -->
							<div class="single-widget">
								<h2>Total Keranjang</h2>
								<div class="content">
									<ul>
									<!-- 	<li>Sub Total<span>$330.00</span></li>
										<li>(+) Shipping<span>$10.00</span></li> -->
										<li class="last">Total<span>Rp. {{ rupiah_format(Auth::user()->carts->sum('total')) }}</span></li>
									</ul>
								</div>
							</div>
							<!--/ End Order Widget -->
							<!-- Order Widget -->
							<div class="single-widget">
								<h2>Metode Pembayaran</h2>
								<div class="content">
									@foreach($banks as $i => $b)
									<div class="form-check" style="margin-left: 50px; margin-top: 20px">
									  <input class="form-check-input" type="radio" name="bank_id"  value="{{ $b->id }}" {{ ($i == 0) ? 'checked' : '' }}>
									  <label class="form-check-label" for="exampleRadios1">
									    ({{ $b->alias }}) {{ $b->name }} 
									  </label>
									</div>
									@endforeach
								</div>
							</div>
							<!--/ End Order Widget -->
							<!-- Payment Method Widget -->
							<div class="single-widget payement">
								<div class="content">
									@foreach($banks as $i => $b)
									<img src="{{ $b->logo }}" width="60px" alt="#">
									@endforeach
								</div>
							</div>
							<!--/ End Payment Method Widget -->
							<!-- Button Widget -->
							<div class="single-widget get-button">
								<div class="content">
									<div class="button">
										<button type="submit" class="btn">Lanjutkan Pembayaran</a>
									</div>
								</div>
							</div>
							<!--/ End Button Widget -->
						</div>
					</div>
				</div>
			</div>
		</section>
	</form>
@endsection