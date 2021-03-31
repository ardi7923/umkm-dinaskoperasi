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

		
			@if(count(Auth::user()->orders) > 0)
			<div class="shopping-cart section">
				<div class="container">
					<div class="row">
						
						<div class="col-12">
							<!-- Shopping Summery -->
							
							<table class="table shopping-summery" >
								<thead>
									<tr class="main-hading">
										<th>NO</th>
										<th class="text-center">TANGGAL</th>
										<th class="text-center">TOTAL ITEM</th>
										<th class="text-center">TOTAL HARGA</th> 
										<th class="text-center">STATUS</th>
										<th class="text-center">AKSI</th>
									</tr>
								</thead>
								<tbody>
						
									@foreach( Auth::user()->orders as $i => $c )

										<tr>
											<td> {{ $i+1 }} </td>
											<td> {{ date_indo( $c->date ) }} </td>
											<td>  {{ $c->lists()->count() }} Item </td>
											<td> Rp.  {{ rupiah_format( $c->lists->sum('total_price') ) }} </td>
											<td>  
												@if($c->sts == 0) 
													<span class="badge badge-danger"> Belum Mengirim Bukti </span>
												@elseif($c->sts == 1)
													<span class="badge badge-warning"> Menunggu Konfirmasi </span>
												@else
													<span class="badge badge-success"> Sukses </span>
												@endif
											</td>
											<td>
												@if($c->sts == 0) 
												<a href="{{ url('user-order/'.$c->id) }}">
													<button type="" class="btn"> 
														Kirim Bukti Pembayaran
													</button>
												</a>
												@elseif($c->sts == 1)
												<!-- 	<span class="badge badge-warning"> tes </span> -->
												@else
												<!-- 	<span class="badge badge-success"> tes </span> -->
												@endif
											</td>
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
	
@endsection