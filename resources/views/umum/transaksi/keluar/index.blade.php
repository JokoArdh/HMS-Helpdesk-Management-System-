@extends('layouts.home')
@section('content')

             <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Permintaan Barang</h5>

 

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Tgl</th>
                    <th>Note</th>
                    <th>User</th>
                    <th>Acc</th>
                    <th>By</th>
                    <th>Tgl</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($outdata as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code><b>{{ $t->barang->kode_barang ?? '-'}}</b></code></td>
                        <td>{{ $t->barang->nama_barang ?? '-' }}</td>
                        <td><span class="badge bg-secondary">{{ $t->jumlah }}</span></td>
                        <td>{{ $t->tgl_transaksi }}</td>
                        <td>{{ $t->keterangan }}</td>
                        <td>{{ $t->user->name }}</td>
                        <td>
                         <span class="badge bg-{{ $t->status == 'pending' ? 'warning' : ($t->status == 'rejected' ? 'danger' : ($t->status == 'approved' ? 'success' : 'success')) }}">{{ $t->status }}</span>
                        </td>
                        <td>{{ $t->approver?->name }}</td> <!--nama approver ini menunjuk ke relasi yg ada di transaksi model -->
                        <td>{{ $t->tgl_approve }}</td>
                        <td><a href="" class="text-info me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $t->id }}"> <i class="bi bi-pencil-square fs-5"></i></a></td>
                    </tr>
                    @endforeach

                    @foreach ($outdata as $t)
                        
                      <!-- MODAL UNTUK ACC -->
                      <div class="modal fade" id="editModal{{ $t->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $t->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">

                            <div class="modal-header" style="background-color: #A5C89E; color: #FFFBB1">
                              <h5 class="modal-title" id="editModalLabel{{ $t->id }}">Tindakan Acc</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            @role('admin|it')
                            @if($route = \App\Helpers\transaksi\AccHelper::accRoute())
                            <div class="modal-body">

                              <form action="{{ route($route, $t->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                  <label for="status" class="form-label">proses</label>
                                  <select name="status" class="form-select">
                                    <option value="pending" {{ $t->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $t->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $t->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                  </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Update</button>
                                </div>
                              </form>
                            </div>  
                            @endif
                            @endrole
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