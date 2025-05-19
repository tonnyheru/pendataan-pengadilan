@extends('layouts.root')

@section('title', 'Usulan')

@section('breadcrum')
<div class="col-lg-6 col-7">
  <h6 class="h2 text-white d-inline-block mb-0">Administrasi</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
      <li class="breadcrumb-item"><a href="#"><i class="fas fa-user-md-chat"></i></a></li>
      <li class="breadcrumb-item active" aria-current="page">Usulan</li>
    </ol>
  </nav>
</div>
@endsection

@section('page')
<div class="row">
  <div class="col-xl-12 order-xl-1">
    <div class="card">
      <div class="card-header">
        <h3 class="mb-0">Pilih Menu Usulan</h3>
      </div>
      <div class="card-body">
        <div class="row">
          @php
          $usulan = [
            'perbaikan_akta' => [
              'title' => 'Perbaikan Akta',
              'icon' => 'fas fa-file-alt',
              'description' => 'Perbaikan Akta Kelahiran, Perkawinan, Perceraian, Kematian',
            ],
            'penerbitan_akta_kematian' => [
              'title' => 'Penerbitan Akta Kematian',
              'icon' => 'fad fa-coffin',
              'description' => 'Penerbitan Akta Kematian',
            ],
            'penerbitan_akta_perkawinan' => [
              'title' => 'Penerbitan Akta Perkawinan',
              'icon' => 'fas fa-rings-wedding',
              'description' => 'Penerbitan Akta Perkawinan',
            ],
            'penerbitan_akta_perceraian' => [
              'title' => 'Penerbitan Akta Perceraian',
              'icon' => 'fas fa-heart-broken',
              'description' => 'Penerbitan Akta Perceraian',
            ],
            'pengangkatan_anak' => [
              'title' => 'Pengangkatan Anak',
              'icon' => 'fas fa-child',
              'description' => 'Pengangkatan Anak',
            ],
            'pengesahan_dan_pengakuan_anak' => [
              'title' => 'Pengesahan dan Pengakuan Anak',
              'icon' => 'fas fa-child',
              'description' => 'Pengesahan dan Pengakuan Anak',
            ],
            'pembatalan_akta_kelahiran' => [
              'title' => 'Pembatalan Akta Kelahiran',
              'icon' => 'fas fa-file-invoice',
              'description' => 'Pembatalan Akta Kelahiran',
            ],
            'pembatalan_perceraian' => [
              'title' => 'Pembatalan Perceraian',
              'icon' => 'fas fa-file-invoice',
              'description' => 'Pembatalan Perceraian',
            ],
            'pembatalan_perkawinan' => [
              'title' => 'Pembatalan Perkawinan',
              'icon' => 'fas fa-file-invoice',
              'description' => 'Pembatalan Perkawinan',
            ],
          ];
          @endphp
          @foreach($usulan as $key => $value)
            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
              <a href="" class="text-decoration-none text-reset">
                <div class="card shadow-lg border-0 h-120">
                  <div class="d-flex" style="min-height: 120px;">
                    <!-- Icon Box -->
                    <div class="flex-shrink-0 bg-diy d-flex align-items-center justify-content-center"
                        style="width: 100px; border-top-left-radius: 1rem; border-bottom-left-radius: 1rem;">
                      <i class="{{ $value['icon'] }} fa-3x text-white"></i>
                    </div>
                    <!-- Text Content -->
                    <div class="flex-grow-1 p-3 d-flex flex-column justify-content-center">
                      <h5 class="mb-1 font-weight-bold">{{ $value['title'] }}</h5>
                      <p class="mb-0 text-muted small">Usulan administratif perihal {{ strtolower($value['description']) }}</p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
</div>
@endsection