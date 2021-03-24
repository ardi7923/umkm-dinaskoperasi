<form class="forms" data-url="{{ url('admin/bank') }}" method="POST" data-reqimage="logo">
  <div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel"> @lang('main.form.add')</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
  </div>
  <div class="modal-body">
    <div class="errors"></div>

    @csrf

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Nama</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="name" required>
      </div>
      <label class="col-sm-1 col-form-label">alias</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="alias" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Nama Pemilik</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="account_name" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Nomor Rekening</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="account_number" required>
      </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 label-control">Logo</label>
        <div class="col-md-9 ">
          <label  class="file center-block">
            
            <img id="upload_preview" style="width: 80px; height: 80px;" />
            <br>
            <br>
            <input type="file" id="add_logo" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Max 2 mb" accept="image/*"  required>
            <span class="file-custom"></span>
          </label>
        </div>
      </div>

    
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-reply-all"></i> @lang('main.button.cancel')</button>
    <button type="submit" class="btn btn-success "> <i class="fa fa-paper-plane"></i> @lang('main.button.save')</button>
  </div>
</form>

<script>
      $("#add_logo").change(function(){
        previewImage("add_logo","upload_preview");
    });
</script>