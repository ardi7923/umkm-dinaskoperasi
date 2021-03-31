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
							<li class="active"><a href="{{ url('cart') }}">Keranjang</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="margin-top: 20px; margin-bottom: 100px">

		<div class="row">
			@if(count( $carts) > 0)
	

			
			<div class="shopping-cart section">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Shopping Summery -->
							<table class="table shopping-summery" id="table-shopping">
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
								<tbody id="tableBody">
									@foreach( $carts as $i => $c )
									<tr id="tableTr">
										<td class="image" data-title="No"><img src="{{ $c->product->image }}" style="width: 100px; height: 100px" loading="lazy" alt="#"></td>
										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="#">{{ $c->product->name }}</a></p>
											<p class="product-des">{{ $c->product->description }}</p>
										</td>
										<td class="price" data-title="Price"><span>Rp. {{ number_format( $c->product->price,0,',','.' ) }} </span></td>
										<td class="qty" data-title="Qty"><!-- Input Order -->
											<div class="input-group">
												<div class="button minus">
													<button type="button" class="btn btn-primary btn-number" data-type="minus" data-field="quant[{{ $i }}]" disabled="disabled" onclick="minus('{{ $i }}','{{ $c->product->price }}')">
														<i class="ti-minus"></i>
													</button>
												</div>

												<input type="text" name="quant[{{ $i }}]"  class="input-number inputqty-{{ $i }}" data-min="1" data-max="100" value="{{ $c->qty ?? 1 }}" readonly>
												

												<div class="button plus">
													<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{ $i }}]" onclick="plus('{{ $i }}','{{ $c->product->price }}')">
														<i class="ti-plus"></i>
													</button>
												</div>
											</div>
											<!--/ End Input Order -->
										</td>
										<td class="total-amount" data-title="Total">
											<span id="totalproduct-{{ $i }}"> {{ ($c->qty) ? rupiah_format( $c->product->price * $c->qty ) : rupiah_format( $c->product->price  ) }} </span>
										</td>
										<form action="{{ url('cart/'.$c->id) }}" method="POST" accept-charset="utf-8">
											@csrf
											@method('DELETE')
											<td class="action" data-title="Remove" ><button type="submit"> <i class="ti-trash remove-icon delete-rowa"></i> </button></td>
										</form>
										
									</tr>
								
									@endforeach
															
								</tbody>
							</table>
							<!--/ End Shopping Summery -->
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<!-- Total Amount -->
							<div class="total-amount">
								<div class="row">
									<div class="col-lg-8 col-md-5 col-12">
										<div class="left">
											<div class="coupon">
												
											</div>
											<div class="checkbox">
												
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-7 col-12">
										<div class="right">
											<ul>
												<!-- <li>Subtotal<span id="sub_total">Rp. {{ rupiah_format(Auth::user()->products()->sum('price')) }}</span></li> -->
											<!-- 	<li>Shipping<span>Free</span></li>
												<li>You Save<span>$20.00</span></li> -->
												<li class="last" >
													Total<span id="total"> Rp. {{ rupiah_format($carts->sum('total')) }} </span>
												</li>

												<input type="hidden" id="input-total" value="{{$carts->sum('total') }}">
											</ul>
											<div class="button5">
												<form action="{{ url('checkout') }}" method="POST">
													@csrf
												@foreach( $carts as $i => $c )
												<input type="hidden" name="id[]" value="{{ $c->id }}">
												<input type="hidden" name="qty[]" class="inputhiddenqty-{{ $i }}" value="{{ $c->qty ?? 1 }}">
												@endforeach
												<button type="submit" class="btn">Checkout</a><br>

												<a href="{{ url('product') }}"><button type=""  class="btn"> Tambahkan Item </button></a>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--/ End Total Amount -->
						</div>
					</div>
				</div>
			</div>
	
			@else
			<div class="col-xl-12 col-lg-4 col-md-4 col-12">	<!-- End Breadcrumbs -->
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
@section('scripts_page')
	<script src=" {{ asset('js/main.js') }}"></script>
@endsection

@section('js')
	<script>
		function minus(id,price)
		{
			qty = $('.inputqty-'+id).val();
			inputqty = parseInt(qty)-1;

			inputtotal = $('#input-total').val();
			total = inputtotal - price;
			$('.inputhiddenqty-'+id).val(inputqty);
			$('#input-total').val(total);
			$('#total').text('Rp. ' + numberWithCommas(total));
			$('#totalproduct-'+id).text( numberWithCommas(price * inputqty) );
		}

		function plus(id,price)
		{
			var qty = $('.inputqty-'+id).val();
			inputqty = parseInt(qty)+1;
			inputtotal = $('#input-total').val();
			total = parseInt(inputtotal) + parseInt(price);
			$('.inputhiddenqty-'+id).val(inputqty);
			$('#input-total').val(total);
			$('#total').text('Rp. ' + numberWithCommas(total));
			$('#totalproduct-'+id).text(numberWithCommas(price * inputqty));
		}

		
	</script>
@endsection