@extends('layout.templateAdmin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Manajemen Varian</h1>
        <a href="{{ route('barang.index') }}" class="btn btn-sm shadow-sm px-3" style="background-color: #1e3a8a; color: white;">
            <i class="fas fa-arrow-left fa-sm text-secondary mr-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm mb-4 border-0" style="border-radius: 10px;">
        <div class="card-header py-3 bg-white border-bottom" style="border-radius: 10px 10px 0 0;">
            <h6 class="m-0 font-weight-bold text-dark">Informasi Produk Utama</h6>
        </div>
         <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label class="text-xs font-weight-bold text-uppercase text-muted mb-0">Nama Produk</label>
                    <p class="h5 font-weight-bold text-gray-800 mb-3">{{ $barang->nama_barang }}</p>
                    <label class="text-xs font-weight-bold text-uppercase text-muted mb-0">Kategori</label>
                    <p class="text-gray-800">{{ $barang->kategori->nama_kategori ?? 'Tanpa Kategori' }}</p>
                </div>
                <div class="col-md-6 border-left">
                    <label class="text-xs font-weight-bold text-uppercase text-muted mb-0">Deskripsi Produk</label>
                    <p class="text-gray-800 small mb-3">{{ $barang->deskripsi ?? '-' }}</p>
                    <label class="text-xs font-weight-bold text-uppercase text-muted mb-0">Total Varian</label>
                    <p class="text-gray-800 mb-0">{{ $barang->variants->count() }} Pcs</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4 border-0" style="border-radius: 10px;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white border-bottom" style="border-radius: 10px 10px 0 0;">
            <h6 class="m-0 font-weight-bold text-dark">Daftar Varian Produk</h6>
            <a href="{{ route('variant.create', ['barang_id' => $barang->id]) }}" class="btn btn-sm px-3 shadow-sm" style="background-color: #1e3a8a; color: white;">
                <i class="fas fa-plus fa-sm mr-1 text-secondary"></i> Tambah Varian
            </a>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                @forelse($barang->variants as $v)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden" style="border-radius: 12px;">
                        <div class="position-relative bg-white d-flex align-items-center justify-content-center" style="height: 250px; overflow: hidden; border-bottom: 1px solid #f1f1f1;">
                            @if($v->foto && file_exists(public_path('assets/img/' . $v->foto)))
                                <img src="{{ asset('assets/img/' . $v->foto) }}" 
                                     alt="{{ $v->nama_variant }}" 
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div class="text-center">
                                    <i class="fas fa-image fa-2x text-gray-200 mb-1"></i>
                                    <p class="small text-gray-400 mb-0">No Photo</p>
                                </div>
                            @endif
                            
                            <div class="position-absolute" style="top: 8px; left: 8px;">
                                <span class="badge badge-dark p-2 shadow-sm" style="font-size: 9px; opacity: 0.8; letter-spacing: 0.5px;">
                                    {{ $v->sku }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="card-body p-3">
                            <div class="h6 font-weight-bold text-dark mb-1">{{ $v->nama_variant }}</div>
                            
                            <div class="d-flex justify-content-between align-items-end pt-3 border-top mt-2">
                                <div>
                                    <small class="text-muted d-block" style="font-size: 10px;">HARGA</small>
                                    <span class="text-dark font-weight-bold">Rp{{ number_format($v->harga, 0, ',', '.') }}</span>
                                </div>
                                <div class="text-right">
                                    <small class="text-muted d-block" style="font-size: 10px;">STOK</small>
                                    <span class="text-dark">{{ $v->stok }} <small class="text-muted">Pcs</small></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-top-0 p-3">
                            <div class="row no-gutters">
                                <div class="col-9 pr-1">
                                    <a href="{{ route('variant.edit', $v->id) }}" class="btn btn-outline-dark btn-sm btn-block font-weight-bold">
                                        Edit Detail
                                    </a>
                                </div>
                                <div class="col-3">
                                    <form action="{{ route('variant.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Hapus varian {{ $v->nama_variant }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm btn-block">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-box-open fa-3x text-gray-200 mb-3"></i>
                    <h5 class="text-gray-500">Belum ada varian produk</h5>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection