@extends('layout.templateAdmin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Input {{ $judul }}</h1>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <input type="hidden" name="jenis" value="{{ $jenis }}">

        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3" style="background-color: #1e3a8a; color: white">
                        <h6 class="m-0 font-weight-bold text-white">Data Nota</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Nama {{ $jenis == 'masuk' ? 'Supplier' : 'Penerima' }}</label>
                            <input type="text" name="nama_orang" class="form-control" placeholder="Contoh: Budi" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Kontak (HP/WA)</label>
                            <input type="text" name="kontak" class="form-control" placeholder="Optional">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan catatan alamat juga..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Barang yang {{ $jenis }}</h6>
                        <button type="button" class="btn btn-sm shadow-sm" onclick="addBaris()" style="background-color: #1e3a8a; color:white;">
                            <i class="fas fa-plus fa-sm"></i> Tambah Baris
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tabelBarang">
                                <thead>
                                    <tr class="bg-light text-center">
                                        <th>Pilih Barang & Variant</th>
                                        <th width="100">Qty</th>
                                        <th width="180">Harga Satuan</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="data[0][variant_id]" class="form-control select-variant" required onchange="updateHarga(this)">
                                                <option value="" data-harga="0">-- Pilih Barang --</option>
                                                @foreach($barangs as $b)
                                                <option value="{{ $b->id }}" data-harga="{{ $b->harga }}">
                                                    {{ $b->barang->nama_barang }} ({{ $b->nama_variant }})
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="data[0][qty]" class="form-control text-center" min="1" value="1" required>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="number" name="data[0][harga_satuan]" class="form-control input-harga" placeholder="0" required>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-block shadow-sm py-2 font-weight-bold" style="background-color: #1e3a8a; color: white">
                            <i class="fas fa-save mr-1"></i> SIMPAN TRANSAKSI SEKARANG
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    let i = 1;

    function addBaris() {
        let table = document.getElementById('tabelBarang').getElementsByTagName('tbody')[0];
        let row = table.insertRow();
        row.innerHTML = `
            <td>
                <select name="data[${i}][variant_id]" class="form-control" required onchange="updateHarga(this)">
                    <option value="" data-harga="0">-- Pilih Barang --</option>
                    @foreach($barangs as $b)
                    <option value="{{ $b->id }}" data-harga="{{ $b->harga }}">
                        {{ $b->barang->nama_barang }} ({{ $b->nama_variant }})
                    </option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="data[${i}][qty]" class="form-control text-center" min="1" value="1" required>
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" name="data[${i}][harga_satuan]" class="form-control" placeholder="0" required>
                </div>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-circle btn-sm shadow-sm" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        `;
        i++;
    }

    function updateHarga(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');
        
        const row = selectElement.closest('tr');
        
        const inputHarga = row.querySelector('input[name*="[harga_satuan]"]');
        
        if (harga && harga != 0) {
            inputHarga.value = harga;
        } else {
            inputHarga.value = '';
        }
    }
</script>
@endsection