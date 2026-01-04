@extends('layout.templateAdmin')

@section('content')
<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="text-center">
        <div class="position-relative d-inline-block">
            <img src="{{ asset('assets/img/' . ($user->photo ?? 'default.png')) }}" 
                 id="preview" class="rounded-circle border" width="120" height="120" style="object-fit: cover;">
            
            <label for="photo" class="btn btn-sm position-absolute rounded-circle" style="background-color: #1e3a8a; color: white bottom: 0; right: 0;">
                <i class="fas fa-camera"></i>
            </label>
            <input type="file" name="photo" id="photo" class="d-none" onchange="previewImage(this)">
        </div>
        
        <div class="mt-2">
            <h4>{{ $user->name }}</h4>
            <span class="badge bg-danger">{{ $user->role }}</span>
        </div>
    </div>

    <div class="mt-3">
        <label>Nama Lengkap</label>
        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
        </div>
        <div class="col-md-6">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
    </div>

    <button type="submit" class="btn w-100 mt-4" style="background-color: #1e3a8a; color: white">Simpan Perubahan</button>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
</form>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => document.querySelector('#preview').src = e.target.result;
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection