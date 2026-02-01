@extends('layouts.home')
@section('content')

             <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Riwayat Permintaan Saya</h5>

 

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
                  </tr>
                </thead>
                <tbody>
                    @foreach ($mydata as $t)
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
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>



@endsection