@extends('layouts.home')
@section('content')
      <div class="card">
        <div class="card-title p-3">
            <h4>Isi Data Formulir Keluhan</h4>
        </div>
              
            <div class="w-75 me-auto ">
              <!-- Multi Columns Form -->
              <form action="{{ route('user.ticketing.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-sm-10">
                    <label for="kategori" class="from-label">Kategori</label>
                    <select id="kategori" name="kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="hardware">Hardware</option>
                        <option value="software">Software</option>
                        <option value="pengadaan aset">Pengadaan Aset</option>
                    </select>
                </div>
                <div class="col-sm-10">
                  <label for="tgl" class="form-label">Tanggal</label>
                  <input type="date" name="tgl_keluhan" class="form-control" required>
                </div>
                <div class="col-sm-10">
                    <label for="ket" class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" style="height: 100px;" required></textarea>
                </div>
                <div class="col-sm-10"> 
                    <label for="bukti" class="form-label">Lampiran</label>
                    <input type="file" class="form-control" name="bukti">
                </div>
                <div class="text-center mb-3 mt-4">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="reset" class="btn btn-secondary">Batal</button>
                </div>
              </form><!-- End Multi Columns Form -->
            </div>
     
    </div>

@endsection