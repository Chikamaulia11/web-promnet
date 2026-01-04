@extends('layout.templateAdmin')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            @if(auth()->user()->role_id == 1)
                <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard Analitik</h1>
                <p class="text-muted">Selamat datang Boss Admin! Berikut adalah ringkasan performa.</p>
            @else
                <h1 class="h3 mb-0 text-gray-800 font-weight-bold">User Dashboard</h1>
                <p class="text-muted">Selamat datang User! Berikut adalah aktivitas transaksi Anda.</p>
            @endif
        </div>
        </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-left-warning" style="background-color: #f6931d;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Total Barang (Qty)</div>
                            <div class="h5 mb-0 font-weight-bold text-white">{{ number_format($totalMasuk) }} <small>Masuk</small></div>
                            <div class="h5 mb-0 font-weight-bold text-white">{{ number_format($totalKeluar) }} <small>Keluar</small></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exchange-alt fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-left-primary bg-primary text-white">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Biaya Keluar (dipinjamkan)</div>
                            <div class="h5 mb-0 font-weight-bold">Rp {{ number_format($biayaKeluar, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-left-info" style="background-color: #6f42c1; color: white;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Biaya Diterima (dikembalikan)</div>
                            <div class="h5 mb-0 font-weight-bold">Rp {{ number_format($biayaDiterima, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wallet fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection