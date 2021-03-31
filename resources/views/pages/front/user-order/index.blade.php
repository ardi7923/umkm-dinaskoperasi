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
							<li class="active"><a href="{{ url('user-order') }}">Data Pemesanan</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="margin-top: 20px; margin-bottom: 100px">

		<div class="row">
			@if(count($user_orders) > 0)
			<div class="shopping-cart section">
				<div class="container">
					<div class="row">
						
						<div class="col-12">
							<!-- Shopping Summery -->
							
							<table class="table shopping-summery">
								<thead>
									<tr class="main-hading">
										<th>PRODUK</th>
										<th>NAMA</th>
										<th class="text-center">HARGA SATUAN</th>
										<th class="text-center">JUMLAH</th>
										<th class="text-center">TOTAL</th> 
										<th class="text-center"><i class="ti-trash remove-icon"></i></th>
									</tr>
								</thead>
								<tbody>
						
									@foreach( $user_orders as $i => $c )
									<tr>
										<td class="image" data-title="No"><img src="{{ $c->product->image }}" style="width: 100px; height: 100px" loading="lazy" alt="#"></td>
										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="#">{{ $c->product->name }}</a></p>
											<p class="product-des">{{ $c->product->description }}</p>
										</td>
										<td class="price" data-title="Price"><span>Rp. {{ number_format( $c->product->price,0,',','.' ) }} </span></td>
										<td class="qty" data-title="Qty"><!-- Input Order -->
											<div class="input-group">
												<div class="button minus">
													<button type="button" class="btn btn-primary btn-number" data-type="minus" data-field="quant[{{ $i }}]" disabled="disabled">
														<i class="ti-minus"></i>
													</button>
												</div>
												<input type="text" name="quant[{{ $i }}]" class="input-number" data-min="1" data-max="100" value="1">
												<div class="button plus">
													<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{ $i }}]">
														<i class="ti-plus"></i>
													</button>
												</div>
											</div>
											<!--/ End Input Order -->
										</td>
										<td class="total-amount" data-title="Total"><span></span></td>
										<td class="action" data-title="Remove"><a href="#"><i class="ti-trash remove-icon"></i></a></td>
									</tr>
									@endforeach
									
								
										
								</tbody>
							</table>
							</div>
							
					</div>

				</div>
			</div>
			@else
			<div class="col-xl-12 col-lg-12 col-md-12 col-12">	<!-- End Breadcrumbs -->
				<center>
					<img src="{{ asset('data-not-found.png') }}" width="450px" style="margin-top: 70px" alt="">

					<h2>
						DATA TIDAK DITEMUKAN
					</h2>
					<a href="{{ url('/') }}"> <button type="button" class="btn btn-primary col-md-4" style="margin-top: 20px; margin-bottom: 100px"> Kembali ke Home </button> </a>
				</center>
			</div>			
			@endif
			

		</div>
	</div>
@endsection