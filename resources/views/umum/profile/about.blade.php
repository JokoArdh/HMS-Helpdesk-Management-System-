@extends('layouts.home')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4" style="min-height:370px">

            <!-- Header -->
            <div class="mb-4">
                <h4 class="fw-bold mb-1">HMS</h4>
                <span class="badge bg-primary">Helpdesk Management System</span>
                <hr>
            </div>

            <div class="row">
                <!-- Tentang HMS -->
                <div class="col-md-5 mb-4">
                    <h6 class="fw-semibold mb-2 text-secondary">
                        <i class="bi bi-info-circle me-1"></i> Tentang Aplikasi
                    </h6>
                    <p class="text-muted">
                        HMS (Helpdesk Management System) adalah aplikasi yang digunakan
                        untuk mengelola tiket bantuan, keluhan, serta permintaan layanan
                        pengguna secara terpusat. Sistem ini dirancang untuk membantu
                        tim support dalam meningkatkan efisiensi, transparansi, dan
                        kecepatan penanganan masalah.
                    </p>
                </div>

                <!-- Developer -->
                <div class="col-md-4 mb-4">
                    <h6 class="fw-semibold mb-2 text-secondary">
                        <i class="bi bi-person-badge me-1"></i> Developer
                    </h6>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><strong>Nama:</strong> Joko Ardiyanto, S.Kom</li>
                        <li><strong>Role:</strong> Fullstack Developer</li>
                        <li><strong>Stack:</strong> Laravel, Bootstrap</li>
                    </ul>
                </div>

                <!-- Versi -->
                <div class="col-md-3 mb-4">
                    <h6 class="fw-semibold mb-2 text-secondary">
                        <i class="bi bi-tags me-1"></i> Informasi Versi
                    </h6>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Versi:</strong><span class="badge bg-success">v1.0.0</span></li>
                        <li><strong>Rilis:</strong> <span class="badge bg-secondary">Januari 2026</span></li>
                        <li><strong>Status:</strong><span class="badge bg-primary">Stable</span></li>
                    </ul>
                </div>
            </div>

            <!-- Footer -->
            <hr>
            <div class="text-end text-muted small">
                © {{ date('Y') }} HMS - Helpdesk Management System
            </div>

        </div>
    </div>
</div>
@endsection
