@extends('layouts.home')
@section('content')
<div class="container mt-4">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8"> --}}

            <div class="card shadow-sm border-0 rounded-3">
                
                <!-- Header -->
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $title }}</h5>
                </div>

                <!-- Body -->
                <div class="card-body">

                    <!-- Gambar -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $trobel->gambar) }}" 
                             alt="Gambar"
                             class="img-fluid rounded shadow-sm"
                             style="max-height: 300px;">
                    </div>

                    <!-- Detail Data -->
                    <h4 class="fw-bold text-center mb-3">
                        {{ $trobel->problem }}
                    </h4>

                    <hr>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <h6 class="text-muted">Deskripsi</h6>
                        <p style="text-align: justify;">
                            {{ $trobel->penyebab }}
                        </p>
                    </div>

                    <!-- Info tambahan -->
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">Dibuat:</small><br>
                            <strong>{{ $trobel->created_at }}</strong>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <small class="text-muted">Update:</small><br>
                            <strong>{{ $trobel->updated_at }}</strong>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="card-footer text-end bg-light">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                        ← Kembali
                    </a>
                </div>

            </div>

        {{-- </div>
    </div> --}}
</div>
@endsection