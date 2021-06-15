@extends('layouts.app')

@section('styles_page')
<link rel="stylesheet" type="text/css" href="{{  asset('plugins/alertify/css/alertify.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{  asset('plugins/alertify/css/themes/bootstrap.min.css')}}">
@endsection

@section('content')
<div class="container-fluid">

  <div class="col-lg-12 mb-4">
    <div class="card bg-danger text-white shadow">
      <div class="card-body">
        Data yg ditampilkan hanya 10 Umkm dengan penjualan terbesar 
      </div>
    </div>
  </div>

  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Statistik Penjualan Umkm</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div>
            <canvas id="myChart" width="400" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>


  </div>



</div>
@endsection

@section('scripts_page')
<script src="{{  asset('assets-admin/vendor/chart.js/Chart.min.js')}}"></script>
@endsection

@section('js')
<script>
  var statistiks = [];
  var label = [];
  
  @foreach($datas as $u)
  statistiks.push('{{$u->ammount}}');
  label.push('{{{ $u->store_name }}}')
  @endforeach

  console.log(statistiks);
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: label,
      datasets: [{
        label: 'Terjual',
        data: statistiks,
        backgroundColor: [
          'rgba(75, 192, 192, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(75, 192, 192, 0.2)',
        ],
        borderColor: [
          'rgba(75, 192, 192, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(75, 192, 192, 1)',

        ],
        borderWidth: 1
      }]
    },
    options: {
      indexAxis: 'y',

    }
  });
</script>
@endsection