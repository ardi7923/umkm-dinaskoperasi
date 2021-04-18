@extends('layouts.app')

@section('title_page')
  Stok Produk
@endsection

@section('styles_page')
    <!-- Custom styles for this page -->
  <link href="{{ asset('assets-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">

@endsection

@section('content')


        <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Stok Produk</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <br><br>
                <table class="table table-bordered table-hover" id="myTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="50px">No</th>
                      <th>Gambar</th>
                      <th>Nama Toko</th>
                      <th>Nama Produk</th>
                      <th>Stok</th>
                      <th width="150px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


          @include('components.modal')

@stop

@section('scripts_page')
  <!-- Page level plugins -->
  <script src="{{ asset('assets-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets-admin/vendor/datatables/dataTables.bootstrap4.min.js') }} "></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>

@endsection

@section('js')
 
 <script type="text/javascript">

    $(document).ready(function(){

       var table   =  $('#myTable').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '{{ url("admin/stock") }}',
                            columns: [
                                { data: 'DT_RowIndex', orderable: false, 
                    searchable: false },
                                { data: 'show_image' },
                                {data: 'umkm.store_name'},
                                { data: 'name' },
                                { data: 'stock' },
                                {data : 'action_stock',orderable: false, searchable: false}
                            ]
                        });
    });

    $(".modal_add").click(showForm);
    $('body').on("click",".show_from", showForm);
    $('body').on("click",".btn_delete", deleteForm );

    $('#modals').on("submit",".forms",saveForm);


</script>
@endsection