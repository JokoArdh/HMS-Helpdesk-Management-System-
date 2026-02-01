@extends('layouts.home')
@section('content')
    <div class="mt-3">
        <a href="{{ auth()->user()->hasRole('admin') ? route('admin.logtrobel.index') : route('it.logtrobel.index') }}" class="btn btn-secondary mb-3">Kembali </a>
    </div>

    <div class="card">
        <div class="card-title p-3">
            <h5>Isi Form Trouble</h5>
        </div>
    @role('admin|it')
    @if($route = \App\Helpers\logtrobel\StoreLogHelper::storeLogRoute())
        <div class="w-75 me-auto ">
        <form action="{{ route($route) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="problem" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="penyebab" id="penyebab" class="form-control" cols="20" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label for="bukti" class="form-label">Bukti</label>
            <input type="file" class="form-control" id="bukti" name="gambar">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
    @endif
@endrole()
    </div>

@endsection