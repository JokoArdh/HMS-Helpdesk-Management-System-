@extends('layouts.home')
@section('content')
    <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Master Data Kategori</h5>
              <p>
                <!-- tombol ini tampil ketika login admin dan it -->
               @role('admin|it')
                <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Tambah Kategori
                </button>
                @endrole
              </p>

              <!-- MODAL UNTUK TAMBAH USER -->
              <div class="modal fade auto-open-on-error" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header bg-info text-white justify-content-center">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel">Tambah Kategori Baru</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      @role('admin|it')
                      @if($route = \App\Helpers\kategori\AddKategoriHelper::createkatRoute())
                      <form action="{{ route($route) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror " id="name" name="nama_kategori">
                             @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror  
                        </div>
                        <div class="mb-3">
                          <label for="gambar" class="form-label">Icon</label>
                          <input type="file" class="form-control @error('icon') is-invalid @enderror" id="gambar" name="icon">
                           @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                          </div>   
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </div>
                      </form>
                      @endif
                      @endrole
                    </div>

                  </div>
                </div>
              </div>


              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Icon</th>
                    {{-- <th data-type="date" data-format="YYYY/DD/MM">Start Date</th> --}}
                    @if(auth()->user()->hasAnyRole(['admin', 'it']))
                    <th>Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                    @foreach ($kategories as $kategori)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>
                          <img src="{{ asset('storage/' . $kategori->icon) }}" alt="bukti" width="40">
                        </td>
                        @if(auth()->user()->hasAnyRole(['admin', 'it']))
                        <td>
                        <a href="" class="btn btn-info btn-sm" style="color: white" data-bs-toggle="modal" data-bs-target="#editModal{{ $kategori->id }}">Edit</a>
                        <form action="{{ auth()->user()->hasRole('admin') 
                                                    ? route('admin.kategori.destroy', $kategori->id) 
                                                    : route('it.kategori.destroy', $kategori->id) }}" 
                                          method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                          </form>
                        {{-- <a href="#" class="btn btn-info btn-sm">Show</a> --}}
                        </td>
                        @endif
                    </tr>
                    @endforeach

                    <!-- MODAL UNTUK EDIT USER -->
                    @foreach ($kategories as $kategori)
                    
                    <!-- MODAL UNTUK EDIT USER -->
                      <div class="modal fade" id="editModal{{ $kategori->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $kategori->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel{{ $kategori->id }}">Edit Kategori</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            @role('admin|it')
                            @if($route = \App\Helpers\kategori\UpdateKategoriHelper::updatekatRoute())

                            <div class="modal-body">
                              <form action="{{ route($route, $kategori->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                  <label for="name" class="form-label">Name</label>
                                  <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" name="nama_kategori" value="{{ $kategori->nama_kategori }}">
                                  @error('nama_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>
                                <div class="mb-3">
                                  <label for="file" class="form-label">Icon</label>
                                  <input type="file" class="form-control" name="icon" value="{{ $kategori->icon }}">
                                </div>   
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Update</button>
                                </div>
                              </form>
                            </div>  
                            @endif
                            @endrole()
                          
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