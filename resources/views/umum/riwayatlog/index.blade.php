@extends('layouts.home')
@section('content')

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Riwayat Logs</h5>

              @role('admin|it')
              @if($route = \App\Helpers\CreateLogHelper::createLogRoute())
                  <p>
                      <a href="{{ route($route) }}" class="btn btn-primary mb-1">Tambah Data Log</a>
                  </p>
              @endif
              @endrole
              {{-- @can('log-eror-create') --}}
                  {{-- <p>
                      <a href="{{auth()->user()->hasRole('admin') ? route('admin.logtrobel.create') : route('it.logtrobel.create')}}" class="btn btn-primary mb-1">Tambah Data Log</a>
                  </p> --}}
              {{-- @endcan --}}

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Log</th>
                    <th>Bukti</th>
                    <th>Faktor</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($trobels as $trobel)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $trobel->problem }}</td>
                        <td>
                          {!! $trobel->gambar ? '<img src="'.asset('storage/' . $trobel->gambar).'" alt="bukti" width="80">' : '-' !!}
                        </td>
                        <td>{!! \Illuminate\Support\Str::limit($trobel->penyebab, 50) !!}</td>
                        <td>{{ $trobel->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ auth()->user()->hasRole('admin') 
                                            ? route('admin.logtrobel.edit', $trobel->id) 
                                            : route('it.logtrobel.edit', $trobel->id) }}" 
                                   class="text-warning me-2"><i class="bi bi-pencil-square fs-5"></i></a>

                                    <form action="{{ auth()->user()->hasRole('admin') 
                                                    ? route('admin.logtrobel.destroy', $trobel->id) 
                                                    : route('it.logtrobel.destroy', $trobel->id) }}" 
                                          method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="btn p-0 border-0 bg-transparent"
                                                onclick="return confirm('Yakin ingin hapus?')"><i class="bi bi-trash-fill fs-5 text-danger"></i></button>
                                    </form>
 
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