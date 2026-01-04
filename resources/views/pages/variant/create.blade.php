@extends('layout.templateAdmin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Tambah Varian Baru</h1>
            <p class="text-muted small">Untuk Produk: <span class="font-weight-bold text-dark">{{ $barang->nama_barang }}</span></p>
        </div>
        <a href="{{ route('barang.show', $barang->id) }}" class="btn shadow-sm px-3" style="background-color: #1e3a8a; color: white; border-radius: 8px;">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('variant.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="barang_id" value="{{ $barang->id }}">

                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label class="text-dark font-weight-bold small">Nama Varian Barang</label>
                                <input type="text" name="nama_variant" id="nama_variant" 
                                    class="form-control @error('nama_variant') is-invalid @enderror" 
                                    style="border-radius: 8px; padding: 0.6rem 1rem;"
                                    placeholder="Contoh: Meja bundar" 
                                    value="{{ old('nama_variant') }}" required>
                                @error('nama_variant') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="text-dark font-weight-bold small">Nomor SKU</label>
                                <input type="text" class="form-control bg-light" 
                                    style="border-radius: 8px; padding: 0.6rem 1rem;"
                                    placeholder="SKU dibuat otomatis oleh sistem" readonly>
                                <small class="text-muted font-italic">Kode unik akan dibuat berdasarkan nama varian.</small>
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="text-dark font-weight-bold small">Harga Sewa (Rp)</label>
                                <input type="number" name="harga" id="harga" 
                                    class="form-control @error('harga') is-invalid @enderror" 
                                    style="border-radius: 8px; padding: 0.6rem 1rem;"
                                    placeholder="Contoh: Rp 50000" value="{{ old('harga') }}">
                                @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="text-dark font-weight-bold small">Jumlah Stok (Pcs)</label>
                                <input type="number" name="stok" id="stok" 
                                    class="form-control @error('stok') is-invalid @enderror" 
                                    style="border-radius: 8px; padding: 0.6rem 1rem;"
                                    placeholder="Contoh: 100" value="{{ old('stok') }}">
                                @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12 form-group mb-2">
                                <label class="text-dark font-weight-bold small">Foto Produk Varian</label>
                                <div class="p-4 border text-center bg-light" style="border: 2px dashed #e3e6f0 !important; border-radius: 12px;">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-gray-300 mb-2 d-block"></i>
                                    <input type="file" name="foto" id="foto" class="@error('foto') is-invalid @enderror">
                                    <p class="text-muted small mt-2 mb-0">Format: JPG, PNG. Maksimal 2MB</p>
                                    @error('foto') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top-0 d-flex justify-content-end pb-4">
                        <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-light border mr-2 px-4" style="border-radius: 8px; font-weight: 600;">
                            Batal
                        </a>
                        <button type="submit" class="btn px-4 shadow-sm" style="background-color: #1e3a8a; color: white; border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-save fa-sm mr-1"></i> Simpan Varian
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection