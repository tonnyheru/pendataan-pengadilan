@extends('layouts.root')

@section('title','Dashboard')

@section('breadcrum')
  <div class="col-lg-6 col-7">
    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="ni ni-tv-2"></i></a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
@endsection

@section('page')
<div class="row">
  <div class="col-xl-4">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Total Permohonan Usulan</h5>
            <span class="h2 font-weight-bold mb-0">{{ $statistics['total_usulan'] ?? 0 }}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
              <i class="fas fa-clipboard-list-check"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
          <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
          <span class="text-nowrap"></span>
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Usulan Diterima</h5>
            <span class="h2 font-weight-bold mb-0">{{ $statistics['total_usulan_approve'] ?? 0 }}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
              <i class="fas fa-clipboard-check"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
          <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
          <span class="text-nowrap"></span>
        </p>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">Usulan Ditolak</h5>
            <span class="h2 font-weight-bold mb-0">{{ $statistics['total_usulan_reject'] ?? 0 }}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
              <i class="fas fa-folder-times"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
          <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
          <span class="text-nowrap"></span>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-12">
    <div class="card ">
      <div class="card-header bg-transparent">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="text-uppercase text-muted ls-1 mb-1">Grafik</h6>
            <h5 class="h3  mb-0"><i class="fad fa-chart-pie"></i> Persentase Usulan yang Disetujui dan yang Ditolak</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <!-- Chart -->
        <div id="chart-persentase-usulan"></div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('scripts')
<script>
  let today = new Date();
  const chartData = @json($chartData);

  var optionsEkspor = {
            series: chartData.series, // Data jumlah ditolak & disetujui
            chart: {
                type: 'pie',
                height: 350
            },
            labels: chartData.labels, // Labels (Ditolak & Disetujui)
            colors: chartData.colors, // Warna sesuai kondisi
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
  var chartEkspor = new ApexCharts(document.querySelector("#chart-persentase-usulan"), optionsEkspor);

  var optionsImpor = {
    chart: {
      height: 350,
      type: 'area',
      fontFamily: 'Lexend Deca, sans-serif',
    },
    fill: {
      colors: ['#0F8CFF', '#2DCEC0', '#F53E54']
    },
    series: [
      {
        color : "#0F8CFF",
        name: 'Bahan Baku',
        data: [0,0,0,0,0,0,0,0,100,0,0,0]
      },
      {
        color: "#2DCEC0",
        name: 'Barang Jadi',
        data: [0,0,0,0,500,0,0,0,0,0,0,0]
      },
      {
        color: "#F53E54",
        name: 'Waste / Scrap',
        data: [0,0,0,0,0,0,0,0,0,0,400,100]
      },
    ],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth'
    },
    xaxis: {
      categories: [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec'
      ],
    },
  }
  var chartImpor = new ApexCharts(document.querySelector("#chart-impor"), optionsImpor);

  $(() => {
    
    // chartEkspor.render();
    // chartImpor.render();
  })
</script>
@endsection
