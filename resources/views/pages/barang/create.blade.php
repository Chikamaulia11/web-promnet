@extends('layout.templateAdmin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Tambah Barang Utama (Induk)</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf

            <div class="card shadow">
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text"
                            name="nama_barang"
                            id="nama_barang"
                            class="form-control @error('nama_barang') is-invalid @enderror"
                            placeholder="Contoh: Lampu"
                            value="{{ old('nama_barang') }}">
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="kategori_id">Kategori</label>
                        <select name="kategori_id" 
                                id="kategori_id" 
                                class="form-control @error('kategori_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi Barang</label>
                        <textarea name="deskripsi"
                            id="deskripsi"
                            rows="4"
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            placeholder="Jelaskan detail umum barang di sini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Info:</strong> Detail seperti Harga, Stok, dan Foto akan diinput nanti di halaman <strong>Varian Barang</strong> setelah data utama ini disimpan.
                    </div>

                </div>

                <div class="card-footer d-flex justify-content-end" style="gap: 10px;">
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn" style="background-color: #1e3a8a; color: white">
                        <i class="fas fa-save"></i> Simpan Barang Utama
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection