@extends('layout.templateAdmin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Ubah Varian</h1>
            <p class="text-muted small">Produk Utama: <span class="font-weight-bold">{{ $barang->nama_barang }}</span></p>
        </div>
        <a href="{{ route('barang.show', $variant->barang_id) }}" class="btn btn-sm btn-light border shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('variant.update', $variant->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label class="text-dark font-weight-bold small">Nama Varian</label>
                                <input type="text" name="nama_variant" 
                                    class="form-control @error('nama_variant') is-invalid @enderror" 
                                    value="{{ old('nama_variant', $variant->nama_variant) }}" 
                                    placeholder="Misal: Meja Kayu / 5 Watt" required>
                                @error('nama_variant') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="text-dark font-weight-bold small">Nomor SKU</label>
                                <input type="text" class="form-control bg-light" 
                                    value="{{ $variant->sku }}" readonly>
                                <small class="text-muted font-italic">SKU dihasilkan otomatis oleh sistem.</small>
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="text-dark font-weight-bold small">Harga Sewa (Rp)</label>
                                <input type="number" name="harga" 
                                    class="form-control @error('harga') is-invalid @enderror" 
                                    value="{{ old('harga', $variant->harga) }}">
                                @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="text-dark font-weight-bold small">Stok (Pcs)</label>
                                <input type="number" name="stok" 
                                    class="form-control @error('stok') is-invalid @enderror" 
                                    value="{{ old('stok', $variant->stok) }}">
                                @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12 form-group mb-2">
                                <label class="text-dark font-weight-bold small">Foto Produk</label>
                                <div class="mb-3 d-flex align-items-center">
                                    @if($variant->foto && file_exists(public_path('assets/img/' . $variant->foto)))
                                        <div class="mr-3">
                                            <small class="d-block text-muted mb-1">Foto Saat Ini:</small>
                                            <img src="{{ asset('assets/img/' . $variant->foto) }}" width="120" class="img-thumbnail border-0 shadow-sm rounded">
                                        </div>
                                    @else
                                        <div class="mr-3 p-3 bg-light rounded border text-muted small">
                                            <i class="fas fa-image mr-1"></i> Belum ada foto
                                        </div>
                                    @endif
                                    
                                    <div class="flex-grow-1">
                                        <small class="d-block text-muted mb-1">Upload Foto Baru:</small>
                                        <input type="file" name="foto" 
                                            class="form-control-file @error('foto') is-invalid @enderror">
                                        @error('foto') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top-0 d-flex justify-content-end pb-4">
                        <a href="{{ route('barang.show', $variant->barang_id) }}" class="btn btn-light border mr-2 px-4">
                            Batal
                        </a>
                        <button type="submit" class="btn text-white px-4 shadow-sm" style="background-color: #1e3a8a; color: white">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection