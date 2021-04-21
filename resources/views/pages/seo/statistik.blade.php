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
                Data yg ditampilkan hanya 10 Keyword terbanyak
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Keyword</h6>
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
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Pilih Bulan</label>
                            <div class="col-sm-9">
                                <select id="month" class="form-control">
                                    <option disabled selected>--PILIH-- </option>
                                    <option value="1"> Januari </option>
                                    <option value="2"> Februari </option>
                                    <option value="3"> Maret </option>
                                    <option value="4"> April </option>
                                    <option value="5"> Mei </option>
                                    <option value="6"> Juni </option>
                                    <option value="7"> Juli </option>
                                    <option value="8"> Agustus </option>
                                    <option value="9"> September </option>
                                    <option value="10"> Oktober </option>
                                    <option value="11"> November </option>
                                    <option value="12"> Desember </option>
                                </select>
                            </div>
                        </div>
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
    $(document).ready(function(){
        $('#month').val('{{ $month }}');
    });

    var statistiks = [];
    var label = [];
    @foreach($collection as $u)
    statistiks.push('{{$u->frequency}}');
    label.push('{{{ $u->keyword }}}')
    @endforeach

    console.log(statistiks);
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: label,
            datasets: [{
                label: 'pencarian',
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

    $('#month').change(function(){
        data = $(this).val();
        
        window.location.replace("{{ url('seo-statistik') }}"+"?month="+data);
    });
</script>
@endsection