@extends('layouts.front')

@section('styles_page')
    <!-- Custom styles for this page -->
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">

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
										<th class="text-center">Alasan Penolakan</th>
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
												@elseif($c->sts == 3)
													<span class="badge badge-danger"> Gagal </span>
												@else
													<span class="badge badge-success"> Sukses </span>
												@endif
											</td>
											<td>
												@if($c->sts == 3) 
													{{ $c->statement_reject }}
												@endif
											</td>
											<td>
												@if($c->sts == 0) 
												<a href="{{ url('user-order/'.$c->id) }}">
													<button type="" class="btn"> 
														Kirim Bukti Pembayaran
													</button>
												</a>
												
												<a href="{{ url('user-order/'.$c->id) }}">
													<button type="" class="btn"> 
														Batalkan Pemesanan
													</button>
												</a>
												@elseif($c->sts == 1)
												<!-- 	<span class="badge badge-warning"> tes </span> -->
												@elseif($c->sts == 3) 
												<a href="{{ url('user-order/'.$c->id) }}">
													<button type="" class="btn" style="width: 280px;"> 
														Kirim Ulang Bukti Pembayaran
													</button>
												</a><br>
												
												
													<button type="" class="btn btn-delete" data-id="{{ $c->id }}" style="margin-top: 5px; width: 280px;"> 
														Batalkan Pemesanan
													</button>
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

@section('scripts_page')
  <!-- Page level custom scripts -->
  <script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>

@endsection

@section('js')
<script>
$('.btn-delete').click(function(){
	var data = {
				_method : 'DELETE',
				_token  : $('meta[name="token"]').attr('content')
			   };

	Swal({
          title: 'Apakah Anda Yakin?',
          html: "Membatalkan Pemesanan ini ?",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: '<i class="fa fa-trash"></i> YA',
          cancelButtonText: '<i class="fa fa-reply-all"></i> Batal',
          showCancelButton: true,
          showLoaderOnConfirm: true,
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
			id = $(this).attr('data-id');
            deleteData2( "user-order/"+id,data)
          
        })
});

const deleteData2 =  function(url,data){

$.ajax({
  url  : url,
  data : data,
  type : "POST",
  dataType : 'json',
  success : function(response){
	  if(response['code'] == 200){
		
		  location.reload();
		
		Swal({
		  title:'Berhasil',
		  text:response['msg'],
		  type:'success',
		  showConfirmButton:false,
		  timer:2000,
		  allowOutsideClick:false,
		})
	  }else{
		 Swal({
		  title:'Perhatian',
		  text:response['errors'],
		  type:'error'
		})
	  }
  }
});

return false;
}

</script>
@endsection