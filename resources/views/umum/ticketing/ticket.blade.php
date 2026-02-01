@push('style')
<style>
.table-scroll {
  width: 100%;
  overflow-x: auto;
}

.table-scroll table {
  min-width: 1300px; /* supaya scroll muncul */
  table-layout: auto;
}

.text-wrap {
  display: inline-block;   
  white-space: normal !important;
  word-break: normal;               /* jangan pecah kata */
  overflow-wrap: break-word;  
  max-width: 400px; /* atur sesuai selera */
}

..table-scroll th:not(.text-wrap),
.table-scroll td:not(.text-wrap) {
  white-space: nowrap;
}
</style>
@endpush

@extends('layouts.home')
@section('content')
     <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ticketing Problem</h5>


              <!-- Table with stripped rows -->
              <div class="table-scroll">
                <table class="table datatable">
                  <thead>
                    <tr>
                      {{-- <th>No</th> --}}
                      <th>User</th>
                      <th>kategori</th>
                      <th>Keterangan_Masalah</th>
                      <th>Tanggal_Problem</th>
                      <th>Bukti</th>
                      <th>Status</th>
                      <th>Action</th>
                      <th>Note</th>
                      <th>Selesai</th>
                      <th>Tanggal_Acc</th>
                      <th>By</th> <!-- ini Manager -->
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $t)
                    <tr>
                        <td>{{ $t->user->name }}</td>
                        <td>{{ $t->keluhan->kategori }}</td>
                        <td class="text-wrap">{{ $t->keluhan->keterangan }}</td>
                        <td>{{ $t->keluhan->tgl_keluhan }}</td>
                        <td>{{ $t->keluhan->bukti ?? '-' }}</td>
                        <td>
                          <span class="badge bg-{{ $t->status == 'pending' ? 'warning' : ($t->status == 'rejected' ? 'danger' : ($t->status == 'proses' ? 'info'  : ($t->status == 'approved' ? 'success' : 'success'))) }}">{{ $t->status }}</span>
                        </td>
                        <td>
                          <span class="badge bg-{{ $t->action == 'created' ? 'warning' : ($t->action == 'rejected' ? 'danger' : ($t->action == 'proses' ? 'info' : ($t->status  == 'update' ? 'primary' : ($t->action == 'approved' ? 'success' : 'success')))) }}">{{ $t->action }}</span>
                        </td>
                        <td>{{ $t->catatan }}</td>
                        <td>
                          <span class="badge bg-{{ $t->keluhan->status == 'open' ? 'warning' : ($t->keluhan->status == 'done' ? 'success' : 'success') }}">{{ $t->keluhan->status }}</span>
                        </td>
                        <td>{{ $t->keluhan->tgl_selesai }}</td>
                        <td>{{ $t->keluhan->mengetahui?->name ?? '-' }}</td>
                        <td><a href="" class="text-info me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $t->id }}"> <i class="bi bi-pencil-square fs-5"></i></a></td>
                    </tr>
                    @endforeach

                    @foreach ($tickets as $t)
                        <div class="modal fade" id="editModal{{ $t->id }}" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          
                          <form action="{{ auth()->user()->hasRole('it') ? route('it.ticket.update', $t->id) : route('manager.ticket.update', $t->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-header" style="background-color: #A5C89E; color:#FFFBB1">
                              <h5 class="modal-title">
                                @if(auth()->user()->hasRole('it'))
                                  Update Riwayat (IT)
                                @else
                                  Verifikasi Keluhan (Manager)
                                @endif
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                              {{-- ================= IT ================= --}}
                              @if(auth()->user()->hasRole('it'))

                                <div class="mb-3">
                                  <label>Status</label>
                                  <select name="status" class="form-select">
                                    <option value="pending"  {{ $t->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="proses" {{ $t->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="rejected" {{ $t->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="done" {{ $t->status == 'done' ? 'selected' : '' }}>Done</option>
                                  </select>
                                </div>

                                <div class="mb-3">
                                  <label>Action</label>
                                  <select name="action" class="form-select">
                                    <option value="create"  {{ $t->action == 'create' ? 'selected' : '' }}>Created</option>
                                    <option value="approved" {{ $t->action == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $t->action == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="proses" {{ $t->action == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="update" {{ $t->action == 'update' ? 'selected' : '' }}>Update</option>
                                  </select>
                                </div>

                                <div class="mb-3">
                                  <label>Note</label>
                                  <textarea name="catatan" class="form-control">{{ $t->catatan }}</textarea>
                                </div>

                              @endif

                              {{-- ================= MANAGER ================= --}}
                              @if(auth()->user()->hasRole('manager'))

                                <div class="mb-3">
                                  <label>Status Keluhan</label>
                                  <select name="status" class="form-select">
                                    <option value="open" {{ $t->keluhan->status == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="done" {{ $t->keluhan->status == 'done' ? 'selected' : '' }}>Done</option>
                                  </select>
                                </div>

                              @endif

                            </div>

                            <div class="modal-footer">
                              <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                              <button class="btn btn-primary">Simpan</button>
                            </div>

                          </form>

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