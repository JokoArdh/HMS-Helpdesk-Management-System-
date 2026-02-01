@extends('layouts.home')
@section('content')
    
    <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Master Data Barang</h5>
              <div class="d-flex justify-content-end align-items-center gap-2 mb-3">
                  @role('admin|it')
                  <button type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#exampleModal">
                      Tambah Barang
                  </button>
                  @endrole
                  
                  @role('admin|it')
                  <a href="{{ route(request()->segment(1).'.barang.export.pdf') }}"
                    class="btn btn-danger"
                    target="_blank">
                      <i class="fa fa-file-pdf"></i> Export PDF
                  </a>
                  @endrole
              </div>

              <!-- MODAL UNTUK TAMBAH USER -->
              <div class="modal fade auto-open-on-error" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header bg-info text-white justify-content-center">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel">Tambah Barang Baru</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      @role('admin|it')
                      @if($route = \App\Helpers\barang\AddBarangHelper::createbarRoute())
                      <form action="{{ route($route) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="kode" class="form-label">Kode</label>
                          <input type="text" class="form-control" name="kode_barang" value="{{ $kode_barang }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="kode" class="form-label">Nama</label>
                          <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang">
                          @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" @if (old('kategori_id') == $kategori->id) selected
                                            @endif>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                          <label for="merk" class="form-label">Merk</label>
                          <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk">
                          @error('merk')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Satuan</label>
                            <select name="satuan" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="pcs">Pcs</option>
                            <option value="set">Set</option>
                            <option value="unit">Unit</option>
                            </select>
                        </div>
                         <div class="mb-3">
                            <label for="status" class="form-label">Kondisi</label>
                            <select name="kondisi" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="baru">Baru</option>
                            <option value="second">Second</option>
                            <option value="rusak">Rusak</option>
                            </select>
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
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Merk</th>
                    @if(auth()->user()->hasAnyRole(['admin', 'manager', 'it']))
                    <th>Satuan</th>
                    <th>Kondisi</th>
                    <th>Qty</th>
                    @endif
                    @if(auth()->user()->hasAnyRole(['admin', 'it']))
                    <th>Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $item)
                    <tr>
                        <td><code><b>{{ $item->kode_barang }}</b></code></td>
                        <td>{{ $item->category->nama_kategori ?? '-' }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->merk }}</td>
                      @if(auth()->user()->hasAnyRole(['admin', 'it', 'manager']))
                        <td>{{ $item->satuan }}</td>
                        <td>
                          <span class="badge bg-{{ $item->kondisi == 'baru' ? 'primary' : ($item->kondisi == 'second' ? 'secondary' : 'danger') }}">{{ $item->kondisi }}</span>
                        </td>
                        <td>
                        <span class="badge bg-{{ $item->stok == 0 ? 'danger' : ($item->stok <= 5 ? 'warning' : 'success') }}">
                            {{ $item->stok }}
                        </span>
                        </td>
                        @endif
                        @if(auth()->user()->hasAnyRole(['admin', 'it']))
                        <td class="text-center">
                        <a href="" class="text-info me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"> <i class="bi bi-pencil-square fs-5"></i></a>
                        <a href="#" class="text-danger me-2"> <i class="bi bi-trash-fill fs-5"></i></a>
                        </td>
                        @endif
                    </tr>
                    @endforeach

                    <!-- MODAL UNTUK EDIT USER -->
                    @foreach ($barangs as $item)
                    
                    <!-- MODAL UNTUK EDIT USER -->
                      <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Barang</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                              @role('admin|it')
                              @if($route = \App\Helpers\barang\UpdateBarangHelper::updatebarRoute())
                              <form action="{{ route($route, $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                  <label for="name" class="form-label">Nama barang</label>
                                  <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ $item->nama_barang }}">
                                  @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>
                                <div class="mb-3">
                                  <label for="status" class="form-label">Kategori</label>
                                  <select name="kategori_id" class="form-select" required>
                                  <option value="">-- Pilih Kategori --</option>
                                  @foreach($kategoris as $kategori)
                                      <option value="{{ $kategori->id }}" 
                                        {{ old('kategori_id', $item->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}</option>
                                  @endforeach
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="merk" class="form-label">Merk</label>
                                  <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ $item->merk }}">
                                  @error('merk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>
                  
                                <div class="mb-3">
                                  <label for="status" class="form-label">Satuan</label>
                                  <select name="satuan" class="form-select">
                                    <option value="pcs" {{ $item->satuan === 'pcs' ? 'selected' : '' }}>Pcs</option>
                                    <option value="set" {{ $item->satuan === 'set' ? 'selected' : '' }}>Set</option>
                                    <option value="unit" {{ $item->satuan === 'unit' ? 'selected' : '' }}>Unit</option>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="status" class="form-label">Kondisi</label>
                                  <select name="kondisi" class="form-select">
                                    <option value="baru" {{ $item->kondisi === 'baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="second" {{ $item->kondisi === 'second' ? 'selected' : '' }}>Second</option>
                                    <option value="rusak" {{ $item->kondisi === 'rusak' ? 'selected' : '' }}>rusak</option>
                                  </select>
                                </div>
                                
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Update</button>
                                </div>
                              </form>
                              @endif
                              @endrole
                            </div>  
                          </div>
                        </div>
                      </div>
                   
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>

@endsection