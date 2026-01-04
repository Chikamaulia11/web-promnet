@extends('layout.templateAdmin')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h1 class="h3 text-gray-800">Tambah Kategori</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf

                <div class="card shadow">
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="namaKategori">Nama Kategori</label>
                            <input type="text"
                                name="namaKategori" 
                                id="namaKategori"
                                class="form-control @error('namaKategori') is-invalid @enderror"
                                placeholder="Masukkan nama kategori"
                                value="{{ old('namaKategori') }}">
                            @error('namaKategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{ route('kategori.index') }}" class="btn mr-2" style="background-color: #1e3a8a; color: white;">
                            Kembali
                        </a>
                        <button type="submit" class="btn" style="background-color: #1e3a8a; color: white;">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection