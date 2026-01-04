@extends('layout.templateAdmin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">{{ $barang->nama_barang }}</h1>
            <p class="mb-0 text-muted small">Kategori: {{ $barang->kategori->nama_kategori ?? 'Tanpa Kategori' }}</p>
        </div>
        <div>
            <a href="{{ route('variant.create', ['barang_id' => $barang->id]) }}" class="btn btn-sm shadow-sm mr-2" style="background-color: #1e3a8a; color: white;">
                Tambah Varian
            </a>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                Kembali
            </a>
        </div>
    </div>

    <div class="row">
        @forelse($barang->variants as $v)
            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm h-100 border">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px; overflow: hidden;">
                        @if($v->foto && file_exists(public_path('assets/img/' . $v->foto)))
                            <img src="{{ asset('assets/img/' . $v->foto) }}" class="img-fluid w-100" style="height: 100%; object-fit: cover;">
                        @else
                            <i class="fas fa-image fa-3x text-gray-300"></i>
                        @endif
                    </div>

                    <div class="card-body p-3">
                        <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">
                            SKU: {{ $v->sku ?? '-' }}
                        </div>
                        <h6 class="font-weight-bold text-dark mb-3">{{ $v->nama_variant }}</h6>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-dark font-weight-bold small">Rp{{ number_format($v->harga, 0, ',', '.') }}</span>
                            <span class="text-muted small">Stok: {{ $v->stok }}</span>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top-0 d-flex justify-content-between pb-3">
                        <a href="{{ route('variant.edit', $v->id) }}" class="btn btn-outline-dark btn-sm flex-fill mr-1">
                            Edit
                        </a>
                        <form action="{{ route('variant.destroy', $v->id) }}" method="POST" class="flex-fill ml-1">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Hapus varian ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light border text-center py-5">
                    <i class="fas fa-box-open fa-3x text-gray-200 mb-3 d-block"></i>
                    Belum ada varian untuk barang ini.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection