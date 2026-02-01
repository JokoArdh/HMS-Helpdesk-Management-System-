@extends('layouts.home')
@section('content')

    <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Master Data Users</h5>
              <p>
                {{-- <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-1">Tambah Data User</a>   --}}
                <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Tambah User
                </button>
              </p>

              <!-- MODAL UNTUK TAMBAH USER -->
              <div class="modal fade auto-open-on-error" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header bg-info text-white justify-content-center">
                      <h5 class="modal-title fw-bold" id="exampleModalLabel">Tambah User Baru</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                          @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                          @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="gambar" class="form-label">Gambar</label>
                          <input type="file" class="form-control" id="gambar" name="gambar">
                          </div>   
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>


              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>N</b>ame
                    </th>
                    <th>Email</th>
                    <th>Status</th>
                    {{-- <th data-type="date" data-format="YYYY/DD/MM">Start Date</th> --}}
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                        <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                            {{ $user->status}}
                        </span>
                        </td>
                        <td>
                        @foreach ($user->roles as $role)
                            <span class="badge bg-secondary">{{ $role->name }}</span>
                        @endforeach
                        </td>
                        <td>
                        <a href="" class="btn btn-info btn-sm" style="color: white" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        {{-- <a href="#" class="btn btn-info btn-sm">Show</a> --}}
                        </td>
                    </tr>
                    @endforeach

                    <!-- MODAL UNTUK EDIT USER -->
                    @foreach ($users as $user)
                    
                    <!-- MODAL UNTUK EDIT USER -->
                      <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <div class="modal-header">
                              <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                              <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                  <label for="name" class="form-label">Name</label>
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
                                  @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>
                                <div class="mb-3">
                                  <label for="email" class="form-label">Email</label>
                                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
                                  @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>
                                <div class="mb-3">
                                  <label for="password" class="form-label">Password</label>
                                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                  @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>
                  
                                <div class="mb-3">
                                  <label for="status" class="form-label">Status</label>
                                  <select name="status" class="form-select">
                                    <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="nonaktif" {{ $user->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                  </select>

                                </div>
                                
                                <div class="mb-3">
                                  <label for="role" class="form-label">Role</label>
                                  <select name="role" class="form-select">
                                    <option value="">-- Pilih Role --</option>
                                    @foreach($roles as $role)
                                      <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Update</button>
                                </div>
                              </form>
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