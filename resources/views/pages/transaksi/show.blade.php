@extends('layout.templateAdmin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Nota: <span class="text-primary">{{ $transaksi->kode_transaksi }}</span></h1>
    <a href="{{ url()->previous() }}" class="btn btn-sm shadow-sm" style="background-color: #1e3a8a; color: white;">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4 border-left-{{ $transaksi->jenis == 'masuk' ? 'success' : 'danger' }}">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Utama Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td class="text-gray-500" width="120">Nama {{ $transaksi->jenis == 'masuk' ? 'Supplier' : 'Penerima' }}</td>
                                <td>: {{ $transaksi->nama_orang }}</td>
                            </tr>
                            <tr>
                                <td class="text-gray-500">Kontak</td>
                                <td>: {{ $transaksi->kontak ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 border-left">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td class="text-gray-500" width="100">Status Nota</td>
                                <td>: 
                                    <span class="badge badge-{{ $transaksi->jenis == 'masuk' ? 'success' : 'danger' }}">
                                        BARANG {{ strtoupper($transaksi->jenis) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-gray-500">Tanggal</td>
                                <td>: {{ date('d F Y', strtotime($transaksi->tanggal)) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 border-left">
                        <p class="text-gray-500 mb-1 small font-weight-bold text-uppercase">Catatan / Keterangan:</p>
                        <p class="text-gray-600 italic">{{ $transaksi->keterangan ?? 'Tidak ada catatan tambahan.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-gray-100">
                <h6 class="m-0 font-weight-bold text-primary">Rincian Item Barang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="bg-light text-dark font-weight-bold text-center">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Barang / Variant</th>
                                <th width="100">Qty</th>
                                <th>Harga Satuan</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalSemua = 0; @endphp
                            @foreach ($list_detail as $data)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="text-gray-800">{{ $data->variant->barang->nama_barang }}</span><br>
                                    <small class="text-muted">{{ $data->variant->nama_variant }}</small>
                                </td>
                                <td class="text-center">{{ $data->qty }} Pcs</td>
                                <td class="text-right text-dark">Rp {{ number_format($data->harga_satuan, 0, ',', '.') }}</td>
                                <td class="text-right text-dark">Rp {{ number_format($data->sub_total, 0, ',', '.') }}</td>
                            </tr>
                            @php $totalSemua += $data->sub_total; @endphp
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light font-weight-bold text-dark">
                        <tr>
                            <td colspan="4" class="text-right h5 mb-0 pt-3">Total Keseluruhan</td>
                            <td class="text-right font-weight-bold h5 mb-0 pt-3">
                                Rp {{ number_format($totalSemua, 0, ',', '.') }}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection