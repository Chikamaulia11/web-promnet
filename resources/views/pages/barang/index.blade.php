@extends('layout.templateAdmin')

@section('content')
<div class="container-fluid">

    <div class="mb-3">
        <h1 class="h3 mb-2 text-gray-800">Data Master Barang</h1>
        <a href="{{ route('barang.create') }}" class="btn btn-sm shadow-sm" style="background-color: #1e3a8a; color: white;">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Barang Utama
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($barangs->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data barang</td>
                            </tr>
                        @else
                            @foreach ($barangs as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('barang.show', $data->id) }}" class="text-primary font-weight-bold" style="text-decoration: none;">
                                            {{ $data->nama_barang }}
                                        </a>
                                    </td>
                                    <td>
                                            {{ $data->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                    </td>
                                    <td>{{ $data->deskripsi }}</td>
                                    <td>
                                        <a href="{{ route('barang.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form action="{{ route('barang.destroy', $data->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection