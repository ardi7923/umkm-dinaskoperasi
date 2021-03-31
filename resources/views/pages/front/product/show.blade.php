			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
			</div>
			<div class="modal-body">
				<div class="row no-gutters">
					<div class="col-lg-6 offset-lg-3 col-12">
						<h4 style="margin-top:100px;font-size:14px; font-weight:500; color:#F7941D; display:block; margin-bottom:5px;"></h4>

						<h3 style="font-size:30px;color:#333;">{{ $data->name }}<h3>
						<h4 style="font-size:14px; font-weight:500; color:#F7941D; display:block; margin-bottom:5px;"> Rp. {{ rupiah_format($data->price) }}</h4>
							<p style="display:block; margin-top:20px; color:#888; font-size:14px; font-weight:400;">{{ $data->description }}</p>
							<div class="button" style="margin-top:30px;">
								<a href="{{ url('cart/'.$data->id) }}"  class="btn" style="color:#fff;">Tambahkan Ke Keranjang</a>
							</div>
						</div>