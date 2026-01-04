@extends('layout.templateAdmin')

@section('content')
<div class="mb-4">
    <h1 class="h3 mb-2 text-gray-800">Riwayat {{ $judul }}</h1>
    <a href="{{ url(Request::path().'/create') }}" class="btn btn-sm shadow-sm"style="background-color: #1e3a8a; color: white;">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah {{ $judul }}
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode Transaksi</th> 
                        <th>{{ str_contains($judul, 'Masuk') ? 'Supplier' : 'Penerima' }}</th>
                        <th class="text-center">Hapus</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_data as $data)
                    <tr>
                        <td>{{ $data->tanggal }}</td>
                        <td>
                            <a href="{{ route('transaksi.show', $data->id) }}" class="badge badge-primary font-weight-bold p-2 shadow-sm">
                                <i class="fas fa-eye mr-1"></i> {{ $data->kode_transaksi }}
                            </a>
                        </td>
                        <td>{{ $data->nama_orang }}</td>
                        <td class="text-center">
                            <form action="{{ route('transaksi.destroy', $data->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Hapus seluruh riwayat transaksi ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection