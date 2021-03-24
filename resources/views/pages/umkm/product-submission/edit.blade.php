<form class="forms" data-url="{{ url('umkm/product-submission/'.$data->id) }}" method="POST" data-reqimage="image">
  <div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel"> @lang('main.form.edit')</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
  </div>
  <div class="modal-body">
    <div class="errors"></div>

    @csrf
    @method('PUT')


    <input type="hidden" class="form-control" name="umkm_id" value="{{ Auth::user()->umkm_id }}" required>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Nama Product</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Kategori</label>
      <div class="col-sm-9">
        <select name="category_id" class="form-control category_id" required>
          <option value="" disabled selected>--PILIH--</option>
          @foreach($categories as $c )
            <option value="{{ $c->id }}">{{ $c->name }}</option>
            
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Harga</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="umkm_price" value="{{ $data->umkm_price }}" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Deskripsi</label>
      <div class="col-sm-9">
        <textarea name="description" class="form-control" rows="5">{{ $data->description }}</textarea>
      </div>
    </div>

      <div class="form-group row">
        <label class="col-md-3 label-control">Gambar</label>
        <div class="col-md-9 ">
          <label  class="file center-block">
            
            <img id="upload_preview" style="width: 80px; height: 80px;" />
            <br>
            <br>
            <input type="file" id="add_logo" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Max 2 mb" accept="image/*" ><br>
            <small style="color: red"> Kosongkan apabila tidak ingin diubah </small>

          </label>
        </div>
      </div>




    
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-reply-all"></i> @lang('main.button.cancel')</button>
    <button type="submit" class="btn btn-success "> <i class="fa fa-paper-plane"></i> @lang('main.button.edit')</button>
  </div>
</form>


<script>
      $("#add_logo").change(function(){
        previewImage("add_logo","upload_preview");
    });
      $('.category_id').val('{{ $data->category_id }}');
</script>