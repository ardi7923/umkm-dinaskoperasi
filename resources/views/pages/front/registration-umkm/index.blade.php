@extends('layouts.front')

@section('title')
	Pendaftaran Mitra
@endsection

@section('styles_page')
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
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
							<li class="active"><a href="{{ url('registration-umkm') }}">Daftar Mitra</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Start Contact -->
	<section id="contact-us" class="contact-us section">
		<div class="container">
				<div class="contact-head">
					<div class="row">
						<div class="col-lg-12 col-12">
							<div class="form-main">
								<div class="title">
									<h4>Dapatkan Keuntungan Lebih</h4>
									<h3>Daftarkan Usaha Anda</h3>
								</div>
								<form class="form" method="post" action="{{ url('registration-umkm') }}" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Nama<span>*</span></label>
												<input name="name" type="text" placeholder="" required>
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Tempat Lahir<span>*</span></label>
												<input name="birthplace" type="text" placeholder=""  required>
											</div>	
										</div>
										
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Tanggal Lahir<span>*</span></label>
												<input name="birthday" class="datepicker" type="text" placeholder="" readonly required>
											</div>	
										</div>
										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Nomor Telepon<span>*</span></label>
												<input name="phone" type="text" placeholder="" required>
											</div>
										</div>

										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Nama Usaha<span>*</span></label>
												<input name="store_name" type="text" placeholder="">
											</div>
										</div>

										<div class="col-12">
											<div class="form-group message">
												<label>Alamat<span>*</span></label>
												<textarea name="address" placeholder="" required></textarea>
											</div>
										</div>
										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Logo<span>*</span></label>
												<input name="logo" type="file" placeholder="" required>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group button">
												<button type="submit" class="btn ">Daftar</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>
	</section>
	<!--/ End Contact -->
	


@endsection

@section('scripts_page')
  <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endsection

@section('js')
<script>
  $('.datepicker').datepicker({
      format: 'yyyy/mm/dd',
      startView : 2,
      autoclose : true
  });
</script>
@endsection