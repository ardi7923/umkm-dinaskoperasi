<form class="forms" data-url="{{ url('admin/category') }}" method="POST">
  <div class="modal-header">
    <h4 class="modal-title" id="exampleModalLabel"> @lang('main.form.add')</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    
  </div>
  <div class="modal-body">
    <div class="errors"></div>

    @csrf

    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Nama Kategori</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="name" required>
      </div>
    </div>



    
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-reply-all"></i> @lang('main.button.cancel')</button>
    <button type="submit" class="btn btn-success "> <i class="fa fa-paper-plane"></i> @lang('main.button.save')</button>
  </div>
</form>

