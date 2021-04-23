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
		<section class="shop checkout section">
			<div class="container">
				<div class="row"> 
					<div class="col-lg-8 col-12">
						<div class="checkout-form">
							<h2>Kirim Bukti Pembayaran Untuk Menyelesaikan Transaksi</h2>
							<!-- <p>Kirim Bukti Pembayaran anda</p> -->
							<!-- Form -->
						
								<table style="margin-top: 50px">
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
									@foreach( $order->lists as $i => $o )
									<tr>
										<td class="image" data-title="No">
												<img src="{{ asset($o->image) }}" style="width: 100px; height: 100px" loading="lazy" alt="#">
										</td>

										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="#">{{ $o->name }}</a></p>
										
										</td>
										<td class="price" data-title="Price"><span>{{ number_format( $o->price,0,',','.' ) }} </span></td>
										<td class="qty" data-title="Qty"><!-- Input Order -->
											{{ $o->ammount }}
											
										</td>
										<td class="total-amount" data-title="Total">
											<span id="totalproduct-{{ $i }}"> {{  rupiah_format( $o->total_price )  }} </span>
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
								<h2>Total Pesanan</h2>
								<div class="content">
									<ul>
									    <li>Sub Total<span>{{ rupiah_format($order->lists->sum('sub_total')) }}</span></li>
										<li>Potongan<span style="color:red">-{{ rupiah_format($order->lists->sum('total_discount')) }}</span></li> 
										<li class="last">Total<span>Rp. {{ rupiah_format( $order->lists->sum('total_price') ) }}</span></li>
									</ul>
								</div>
							</div>
							<!--/ End Order Widget -->
							<!-- Order Widget -->
							<div class="single-widget">
								<h2>Metode Pembayaran</h2>
								<table style="margin-top: 20px">
									
									<tbody>
										<tr>
											<td style="vertical-align: middle">
												<img src="{{ asset($order->bank->logo) }}" lazy="loading" width="80px" style="margin-left: 20px;"  alt=""> 
											</td>
												
											<td style="vertical-align: middle">
												<strong> {{ $order->bank->alias }} </strong> <br> {{ $order->bank->name }}
											</td>
										</tr>
										<tr>
											<td colspan="2" style="padding-left: 23px">  A/n {{ $order->bank->account_name }} <br> {{ $order->bank->account_number }} </td> 
										</tr>
									</tbody>
								</table>
								<div class="content">
									
									
								</div>
							</div>
							<!--/ End Order Widget -->
							<!-- Payment Method Widget -->
							<form action="{{ url('user-order') }}" method="post" enctype="multipart/form-data">
								
							@csrf
							<div class="single-widget">
								<h2>Masukkan Bukti Pembayaran</h2>
								<div class="content">
									<div class="form-group row" style="margin: 20px 10px 0px 0px">
										<label class="col-sm-3 col-form-label">Bukti</label>
										<div class="col-sm-9">
											<input type="file" class="form-control" name="image_transaction" required>
										</div>
									</div>
									<input type="hidden" name="id" value="{{ $id }}">
								</div>
							</div>
							<!--/ End Payment Method Widget -->
							<!-- Button Widget -->
							<div class="single-widget get-button">
								<div class="content">
									<div class="button">
										<button  type="submit" class="btn">Kirim Bukti Pembayaran</a>
									</div>
								</div>
							</div>

							</form>
							<!--/ End Button Widget -->
						</div>
					</div>
				</div>
			</div>
		</section>

		@include('components.modal')
@endsection

@section('scripts_page')
	<script src="{{ asset('js/main.js') }}"></script>
@endsection

@section('js')
	<script>
		
		$("#modal_add").click(showForm);
	</script>
@endsection