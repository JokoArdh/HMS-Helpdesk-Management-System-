@extends('layouts.home')
@section('content')

         <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ticketing Problem Saya</h5>

 

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Note</th>
                    <th>Tgl</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Note</th>
                    <th>Acc</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code><b>{{ $t->keluhan->kategori}}</b></code></td>
                        <td>{{ $t->keluhan->keterangan }}</td>
                        <td>{{ $t->keluhan->tgl_keluhan }}</td>
                        <td>
                          <span class="badge bg-{{ $t->status == 'pending' ? 'warning' : ($t->status == 'rejected' ? 'danger' : ($t->status == 'proses' ? 'info' : ($t->status == 'approved' ? 'success' : 'success'))) }}">{{ $t->status }}</span>
                        </td>
                        <td>
                          <span class="badge bg-{{ $t->action == 'created' ? 'warning' : ($t->action == 'rejected' ? 'danger' : ($t->action == 'proses' ? 'info' : ($t->action == 'update' ? 'primary' : ($t->action == 'approved' ? 'success' : 'success')))) }}">{{ $t->action }}</span>
                        </td>
                        <td>{{ $t->catatan }}</td>
                        <td>{{ $t->handler?->name ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>



@endsection