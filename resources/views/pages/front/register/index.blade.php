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
							<li class="active"><a href="{{ url('register') }}">Registrasi</a></li>
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
				<div class="checkout-form">
					<div class="row">
						<div class="col-lg-12 col-12">
							<!-- <div class=""> -->
								<div class="title">
									<h4>Belanja Aman dan membantu umkm dalam negeri</h4>
									<h3>Daftar Pengguna</h3>
								</div>
								<form class="form"  action="{{ url('register') }}" method="POST">
									@csrf
									<div class="row">
										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Nama<span>*</span></label>
												<input name="name" type="text" placeholder=""  value="{{ old('name') }}" required>
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
												<label>Kabupaten<span>*</span></label><br>
												<select name="district_id" class="district_id"  required >
													<option value="" disabled selected>--PILIH--</option>
													@foreach( $districts as $d )
														<option value="{{ $d->id }}"> {{ $d->name }} </option>
														
													@endforeach
												</select>
											</div>
										</div>




										<div class="col-12">
											<div class="form-group message">
												<label>Alamat<span>*</span></label>
												<textarea name="address" placeholder="" required>
													{{ old('address') }}
												</textarea>
											</div>
										</div>

										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Username<span>*</span></label>
												<input name="username" type="text" placeholder=""  value="{{ old('username') }}" required>
											</div>
										</div>

										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Password<span>*</span></label>
												<input name="password" type="password" placeholder="" required>
											</div>
										</div>

										<div class="col-lg-12 col-12">
											<div class="form-group">
												<label>Konfirmasi Password<span>*</span></label>
												<input name="confirm_password" type="password" placeholder="" required>
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
$('.district_id').val('{{ old("district_id") }}');
  $('.datepicker').datepicker({
      format: 'yyyy/mm/dd',
      startView : 2,
      autoclose : true
  });
</script>
@endsection