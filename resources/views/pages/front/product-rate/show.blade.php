@extends('layouts.front')

@section('styles_page')

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
						<li class="active"><a href="#">Ulasan</a></li>
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
				<div class="col-lg-12 col-12">
					<div class="checkout-form">
						<h2>Berikan Ulasan Produk yg telah anda beli!!</h2>
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
									<th class="text-center">Berikan Ulasan</th>

								</tr>
							</thead>
							<tbody>
								@foreach( $orders->lists as $i => $c )
								<tr id="tableTr">
									<td class="image" data-title="No"><img src="{{ asset($c->image) }}" style="width: 100px; height: 100px" loading="lazy" alt="#"></td>
									<td class="product-des" data-title="Description">
										<p class="product-name"><a href="#">{{ $c->name }}</a></p>

									</td>
									<td class="price" data-title="Price"><span>Rp. {{ number_format( $c->price,0,',','.' ) }} </span></td>
									<td class="qty" data-title="Qty">
										<!-- Input Order -->
										{{ $c->ammount }} 
										<!--/ End Input Order -->
									</td>
									<td class="total-amount" data-title="Total">
										<span id="totalproduct-{{ $i }}"> {{ rupiah_format( $c->total_price  ) }} </span>
									</td>
									<td>	
										
										@if(get_product_rate($c->product_id,Auth::user()->id))
										{{get_product_rate($c->product_id,Auth::user()->id)->comment}}
										@else
										<center>
											<button class="btn btn-comment" data-url="{{ url('product-rate/'.$c->product_id.'/edit') }}" style="margin-top: 5px; width: 280px;">
												Berikan Ulasan
											</button>
										</center>

										@endif
									</td>
								</tr>

								@endforeach
							</tbody>
						</table>
						<!--/ End Form -->
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

	$('body').on("click",".btn-comment", showForm);
	// $('').click(showForm);
</script>
	
@endsection