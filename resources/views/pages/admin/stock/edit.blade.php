<form class="forms" data-url="{{ url('admin/stock/'.$data->id) }}" method="POST">
  <div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel"> Verifikasi Umkm</h4>
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
          <th>Stok Sekarang</th>
          <th>{{ $data->stock }}</th>
        </tr>

      </thead>

    </table>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Stok Baru</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="stock"  required>
      </div>
    </div>

    
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-reply-all"></i> @lang('main.button.cancel')</button>
    <button type="submit" class="btn btn-success "> <i class="fa fa-paper-plane"></i> Ubah Stok</button>
  </div>
</form>

