<form class="forms" data-url="{{ url('admin/verify-umkm/'.$data->id) }}" method="POST">
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
          <th>Nama</th>
          <th>{{ $data->name }}</th>
        </tr>
        <tr>
          <th>Tempat, Tanggal Lahir</th>
          <th>{{ $data->birthplace }}, {{ date_indo($data->birthday) }}</th>
        </tr>
        <tr>
          <th>Nomor Telepon</th>
          <th>{{ $data->phone }}</th>
        </tr>
        <tr>
          <th>Nama Usaha</th>
          <th>{{ $data->store_name }}</th>
        </tr>
        <tr>
          <th>Alamat</th>
          <th>{{ $data->address }}</th>
        </tr>
        <tr>
          <th>Logo</th>
          <th><img src="{{ asset($data->logo) }}" width="150px" alt=""></th>
        </tr>
      </thead>

    </table>



    
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-reply-all"></i> @lang('main.button.cancel')</button>
    <button type="submit" class="btn btn-success "> <i class="fa fa-paper-plane"></i> Terima</button>
  </div>
</form>

