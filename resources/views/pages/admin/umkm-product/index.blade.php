@extends('layouts.app')

@section('title_page')
  Data Umkm
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
              <h6 class="m-0 font-weight-bold text-primary">Data Umkm</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                
                <table class="table table-bordered table-hover" id="myTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="50px">No</th>
                      <th >Nik</th>
                      <th >Nama</th>
                      <th >Email</th>
                      <th >Nama Toko</th>
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
                            ajax: '{{ url("admin/data-umkm") }}',
                            columns: [
                                { data: 'DT_RowIndex', orderable: false, 
                    searchable: false, class: "row_click" },
                                { data: 'nik', class: "row_click" },
                                { data: 'name', class: "row_click" },
                                { data: 'email', class: "row_click" },
                                { data: 'store_name', class: "row_click" }
                            ]
                        });
                        
    $('#myTable tbody').on('click', '.row_click', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr).data();

          window.location.replace("{{ url('admin/umkm-product') }}"+"/"+row.id);
      });

    });

    

    $(".modal_add").click(showForm);
    $('body').on("click",".show_from", showForm);
    $('body').on("click",".btn_delete", deleteForm );

    $('#modals').on("submit",".forms",saveForm);
    $('#modals').on("submit",".edit-form",saveForm);
    

</script>
@endsection