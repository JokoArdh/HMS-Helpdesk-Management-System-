@extends('layouts.home')
@section('content')

             <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Barang Masuk</h5>

              <div class="row mb-3 align-items-center">

                <div class="col-md-6">
                  @role('admin|it')
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Transaksi-In
                    </button>
                  @endrole
                </div>

                <div class="col-md-6 text-end">
                  <form action="{{ route(request()->segment(1).'.transaksi-masuk.export.pdf') }}" method="GET" class="mb-3">

                      <div class="row g-2 align-items-end justify-content-end">

                           <div class="col-auto">
                              <select name="filter" id="filter" class="form-control" required>
                                  <option value="">-- Pilih Filter --</option>
                                  <option value="minggu">Per Minggu</option>
                                  <option value="bulan">Per Bulan</option>
                              </select>
                          </div>

                          <div class="col-auto" id="filter-minggu" style="display:none;">  
                              <input type="date" name="tanggal" class="form-control">
                            
                          </div>

                          <div class="col-auto" id="filter-bulan" style="display:none;">
                              <input type="month" name="bulan" class="form-control">
                          </div>

                          <div class="col-auto">
                              <button type="submit" class="btn btn-danger w-100">
                                  <i class="bi bi-file-earmark-pdf"></i> Export
                              </button>
                          </div>

                      </div>
                  </form>
                </div>
              </div>

              <!-- MODAL TAMBAH TRANSAKSI -->
              <div class="modal fade auto-open-on-error" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header bg-info text-white justify-content-center">
                      <h5 class="modal-title text-center" id="exampleModalLabel"><b>Restock Barang IT</b></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      @role('admin|it')
                      @if($route = \App\Helpers\transaksi\MasukHelper::masukRoute())
                      <form action="{{ route($route) }}" method="POST">
                        @csrf
                        
                        <!--KODE DAN NAMA OTOMATIS -->
                        
                        <div class="mb-3">
                          <label class="form-label">Pilih Barang</label>
                          <select id="barang_id" name="barang_id" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach ($barangs as $barang)
                              <option 
                                value="{{ $barang->id }}"
                                data-kode="{{ $barang->kode_barang }}"
                                data-nama="{{ $barang->nama_barang }}"
                                data-merk = "{{ $barang->merk }}">
                                {{ $barang->kode_barang }} - {{ $barang->nama_barang }} - {{ $barang->merk }}
                              </option>
                            @endforeach
                          </select>
                        </div>

                        <div class="mb-3">
                          <label for="merk" class="form-label">Jumlah</label>
                          <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah">
                          @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <input type="hidden" name="jenis_transaksi" value="masuk"> 
                        <div class="mb-3">
                          <label for="merk" class="form-label">Tanggal</label>
                          <input type="date" class="form-control @error('tgl_transaksi') is-invalid @enderror" name="tgl_transaksi">
                          @error('tgl_transaksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </div>
                      </form>
                      @endif
                      @endrole()
                    </div>

                  </div>
                </div>
              </div>


              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Merk/Tipe</th>
                    <th>Kategori</th>
                    <th>Transaksi</th>
                    <th>Qty</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code><b>{{ $t->barang->kode_barang ?? '-'}}</b></code></td>
                        <td>{{ $t->barang->nama_barang ?? '-' }}</td>
                        <td>{{ $t->barang->merk ?? '-' }}</td>
                        <td>{{ $t->barang->category->nama_kategori ?? '-' }}</></td>
                        <td>
                          <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>{{ $t->jenis_transaksi }}</span>
                        </td>
                        <td><span class="badge bg-primary">{{ $t->jumlah }}</span></td>
                        <td>{{ $t->tgl_transaksi }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>



@endsection