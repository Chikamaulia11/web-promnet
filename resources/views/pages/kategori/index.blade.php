@extends('layout.templateAdmin')

@section('content')
<div class="container-fluid">

    <div class="mb-3">
        <h1 class="h3 mb-2 text-gray-800">Data Kategori</h1>
        <a href="/kategori/create" class="btn btn-sm shadow-sm" style="background-color: #1e3a8a; color: white;">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                
                <div class="row mb-3">
                    
                    <div class="col-sm-12">
                    <form action="{{ route('kategori.index') }}" method="GET" class="d-flex justify-content-end align-items-center">
                        <label class="mr-2 mb-0">Search:</label>
                        <div class="input-group" style="width: 250px;">
                            <input type="text" name="search" class="form-control form-control-sm" 
                                value="{{ request('search') }}" placeholder="Ketik lalu Enter...">
                            
                            <div class="input-group-append">
                                <button class="btn btn-sm" type="submit" style="background-color: #1e3a8a; color: white;">
                                    <i class="fas fa-search"></i>
                                </button>

                                @if(request('search'))
                                    <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
            </div>
     </div>

                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 50px">No</th>
                            <th>Nama Kategori</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori as $index => $data)
                        <tr>
                            <td>{{ $kategori->firstItem() + $index }}</td> 
                            <td>{{ $data->nama_kategori }}</td>
                            <td>
                                <div class="">
                                    <a href="{{ route('kategori.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('kategori.destroy', $data->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Data Kategori Tidak Ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="small text-muted">
                            Showing {{ $kategori->firstItem() ?? 0 }} to {{ $kategori->lastItem() ?? 0 }} of {{ $kategori->total() }} entries
                        </p>
                    </div>
                    <div>
                        {{ $kategori->links('pagination::bootstrap-4') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection