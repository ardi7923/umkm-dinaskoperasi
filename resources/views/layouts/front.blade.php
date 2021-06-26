<!DOCTYPE html>
<html lang="zxx">

<head>
	<!-- Meta Tag -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="token" content="{{ csrf_token() }}">
	<!-- Title Tag  -->
	<title>@yield('title') - Umkm Sulsel</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	<!-- StyleSheet -->

	@include('layouts.front.styles')
	@yield('styles_page')
	<style>
		.checked {
			color: orange;
		}
	</style>
	<style>
		.modal-backdrop {
			display: none;
		}

		.modal-search {
			overflow-y: hidden !important;
		}

		.modal-search {
			top: 167px;
			z-index: 1;
			background-color: #4444447a;
		}

		.modal-search .modal-sm {
			max-width: 600px !important;
		}

		.modal-search .modal-content {
			z-index: 100;
			top: -170px;
		}

		.modal-search .modal-body {
			padding: 20px !important;
		}

		.modal-search .modal-body h5 {
			font-weight: 600 !important;
			display: inline;
			margin-right: 10px;
		}

		.modal-search .catalog-item {
			display: flex;
			padding: 10px 10px 10px 0px;
			border-radius: 10px;
			align-items: center;
		}

		.modal-search .catalog-item:hover {
			background-color: #e2e2e2;
			cursor: pointer;
		}

		.modal-search .catalog-item img {
			width: 40px;
			height: 40px;
			float: left;
			margin-right: 10px;
			border-radius: 5px;
		}

		.modal-search .catalog-item .label-area {
			display: flex;
			flex-direction: column;
		}

		.modal-search .catalog-item .label-area span {
			max-width: 150px;
			display: inline-block;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
			font-weight: 600;
		}

		.modal-search .catalog-item .label-area small {
			color: #9c9c9c;
			font-size: 12px;
		}

		.modal-search .modal-dialog-scrollable {
			max-height: 400px;
		}

		.modal-search .search-result-item {
			padding: 5px 10px;
			font-size: 13px;
			font-weight: 600;
			width: 100%;
			margin-top: 5px;
			margin-bottom: 5px;
			border-radius: 10px;
		}

		.modal-search .search-result-item:hover {
			background-color: #dee0df;
			cursor: pointer;
		}
	</style>
</head>

<body class="js">

	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->


	@include('layouts.front.header')

	@yield('content')

	<div class="modal fade modal-search" id="searchModal">
		<div class="modal-dialog modal-sm modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-body">
					<h5 id="title-search-result">Hasil Pencarian</h5>
					<div id="search-result"></div>
					<h5>Pencarian Populer</h5>
					<div class="row my-4">
						<div class="col-lg-6">
							<div id="most-popular-start"></div>
						</div>
						<div class="col-lg-6">
							<div id="most-popular-end"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('layouts.front.footer')

	@include('layouts.front.scripts')
	@yield('scripts_page')
	<script>
		$('#search-category').change(function() {
			$('#input-search-category').val($(this).val());
		});

		$('#input-search').keyup(function() {
			$('#searchModal').modal('show');
			$('#title-search-result').show();
			keyword = $(this).val();
			$.ajax({
				url: "{{ url('search?q=') }}" + keyword,
				type: 'get',
				dataType: 'json',
				beforeSend: function() {
					$('#search-result').html('Loading........');
				},

				success: function(response) {
					if (keyword.length == 0) {
						$('#title-search-result').hide();
						$('#search-result').html(``);
					} else if (response.length == 0) {
						$('#search-result').html(` <a href="{{ url('product?q=') }}` + keyword + ` ">  <p class="search-result-item"> <i class="fa fa-search" style="margin-right:20px"></i> ` + keyword + `  </p> </a>`);
					} else if (response.length > 0) {
						var url = '{{ URL::asset(' / ') }}';
						$('#search-result').html(``);
						for (i = 0; i < 5; i++) {
							$('#search-result').append(`
								<a href="{{ url('product?q=') }}` + response[i]['name'] + ` ">
									<div class="catalog-item">
										<img src="` + url + response[i]['image'] + `" alt="">
										<div class="label-area">
											<span>` + response[i]['name'] + `</span>
										</div>
									</div>
								</a>
								`);
						}
					}
				}
			});
		});

		$('#input-search').click(function() {
			$('#searchModal').modal('show');
		});

		$("#searchModal").on('shown.bs.modal', function() {
			getMostPopular();
			$('#title-search-result').hide();
		});

		function getMostPopular() {
			$('#most-popular-start').html('');
			$('#most-popular-end').html('');
			$.ajax({
				url: "{{ url('search/most-populer') }}",
				type: 'get',
				dataType: 'json',
				success: function(response) {
					var url = '{{ URL::asset(' / ') }}';
					for (i = 0; i < 4; i++) {
						$('#most-popular-start').append(`
							 <a href="{{ url('product?q=') }}` + response[i]['product_name'] + ` ">
								<div class="catalog-item">
									<img src="` + url + response[i]['product_image'] + `" alt="">
									<div class="label-area">
										<span>` + response[i]['product_name'] + `</span>
										<small>` + response[i]['frequency'] + ` pencarian</small>
					 				</div>
					 			</div>
							</a>
								
					 	`)
					}

					for (i = 4; i < 8; i++) {
						$('#most-popular-end').append(`
							<a href="{{ url('product?q=') }}` + response[i]['product_name'] + ` ">
								<div class="catalog-item">
									<img src="` + url + response[i]['product_image'] + `" alt="">
									<div class="label-area">
										<span>` + response[i]['product_name'] + `</span>
										<small>` + response[i]['frequency'] + ` pencarian</small>
					 				</div>
					 			</div>
							</a>		
					 	`)
					}









				}
			});

			return false;
		}
	</script>
	@yield('js')
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-K688F3K85W"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'G-K688F3K85W');
	</script>
</body>

</html>