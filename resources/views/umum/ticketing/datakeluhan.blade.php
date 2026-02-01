@extends('layouts.home')
@section('content')

         <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Riwayat Problem Saya</h5>

 

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Note</th>
                    <th>Tgl</th>
                    <th>Bukti</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($keluhans as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><code><b>{{ $t->kategori}}</b></code></td>
                        <td>{{ $t->keterangan }}</td>
                        <td>{{ $t->tgl_keluhan }}</td>
                        <td>{{ $t->bukti }}</td>
                        <td>
                            <a href="">Edit</a> || <a href="">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>



@endsection