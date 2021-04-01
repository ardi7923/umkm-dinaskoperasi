<form class="forms" data-url="{{ url('admin/payment-confirm/'.$data->id) }}" method="POST">
  <div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel"> Konfirmasi Pembayaran</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
  </div>
  <div class="modal-body">
    <div class="errors"></div>

    @csrf
    @method('PUT')

    <table class="table table-hover table-striped table-bordered">
      <thead>
        <tr>
          <th width="200px">Nama Pemesan</th>
          <th>{{ $data->user->name }}</th>
        </tr>
        <tr>
          <th>Metode Pembayaran</th>
          <th>{{ $data->bank->name }}</th>
        </tr>
        <tr>
          <th>Total</th>
          <th>{{ rupiah_format($data->lists->sum('total_price')) }}</th>
        </tr>
          <th>Bukti</th>
          <th><img src="{{ asset($data->image_transaction) }}" width="150px" alt=""></th>
        </tr>
      </thead>

    </table>
    <p><strong> Data Pesanan </strong> </p>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data->lists as $l)
          <tr>
            <td> {{ $l->name }} </td>
            <td> {{ $l->price }} </td>
            <td> {{ $l->ammount }} </td>
            <td> {{ $l->total_price }} </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-reply-all"></i> @lang('main.button.cancel')</button>
    <button type="submit" class="btn btn-success "> <i class="fa fa-paper-plane"></i> Terima</button>
  </div>
</form>

