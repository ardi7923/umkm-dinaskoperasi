<form class="forms" data-url="{{ url('admin/verify-product/'.$data->id) }}" method="POST">
  <div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel"> Data Product</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
  </div>
  <div class="modal-body">
    <div class="errors"></div>

    @csrf
    @method('PUT')

    <table class="table table-hover table-striped table-bordered">
      <thead>
        <tr>
          <th>Nama Toko</th>
          <th>{{ $data->umkm->store_name }}</th>
        </tr>
        <tr>
          <th>Kategori</th>
          <th>{{ $data->category->name }}</th>
        </tr>
        <tr>
          <th>Nama Produk</th>
          <th>{{ $data->name }}</th>
        </tr>
        <tr>
          <th>Harga dari Umkm</th>
          <th>{{ number_format($data->umkm_price) }}</th>
        </tr>
        <tr>
          <th>Harga</th>
          <th>{{ number_format($data->price) }}</th>
        </tr>
        <tr>
          <th>Deskripsi</th>
          <th>{{ $data->description }}</th>
        </tr>
        <tr>
          <th>Logo</th>
          <th><img src="{{ asset($data->image) }}" width="150px" alt=""></th>
        </tr>
      </thead>

    </table>

    
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-reply-all"></i> @lang('main.button.cancel')</button>
  </div>
</form>

