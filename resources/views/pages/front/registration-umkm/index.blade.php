@extends('layouts.front')

@section('seo-title')Umkm Sulsel - Registrasi Umkm @endsection
@section('seo-description')Daftarkan Usaha anda dan sukses bersama kami @endsection
@section('seo-type')registration-umkm @endsection
@section('seo-image'){{ asset('logo.png') }} @endsection

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
												<label>Nik<span>*</span></label>
												<input name="nik" type="text" placeholder="" value="{{ old('nik') }}" required>
											</div>
										</div>
										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Nama<span>*</span></label>
												<input name="name" type="text" placeholder="" value="{{ old('name') }}" required>
											</div>
										</div>
										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Email<span>*</span></label>
												<input name="email" type="email" placeholder="" value="{{ old('email') }}" required>
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Tempat Lahir<span>*</span></label>
												<input name="birthplace" type="text" placeholder="" value="{{ old('birthplace') }}" required>
											</div>	
										</div>
										
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Tanggal Lahir<span>*</span></label>
												<input name="birthday" class="datepicker" type="text" placeholder="" value="{{ old('birthday') }}" readonly required>
											</div>	
										</div>
										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Nomor Telepon<span>*</span></label>
												<input name="phone" type="text" placeholder="" value="{{ old('phone') }}" required>
											</div>
										</div>

										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Nama Usaha<span>*</span></label>
												<input name="store_name" type="text" value="{{ old('store_name') }}" placeholder="">
											</div>
										</div>
										
										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Kabupaten<span>*</span></label><br>
												<select name="district" class="district_id" style="width: 100%;"  required >
													<option value="" disabled selected>--PILIH--</option>
													@foreach( $districts as $d )
														<option> {{ $d->name }} </option>
														
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-12">
											<div class="form-group message">
												<label>Alamat<span>*</span></label>
												<textarea name="address" placeholder="" required>{{ old('address') }}</textarea>
											</div>
										</div>
										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Logo<span>*</span></label>
												<input name="logo" type="file" placeholder="" value="{{ old('logo') }}" required>
											</div>
										</div>
										@if ($errors->any())
										    <div class="alert alert-danger">
										        <ul>
										            @foreach ($errors->all() as $error)
										                <li>{{ $error }}</li>
										            @endforeach
										        </ul>
										    </div>
										@endif
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