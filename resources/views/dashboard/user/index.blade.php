@extends('layouts.home')
@section('content')

      <!-- HEADER APLIKASI & WELCOME -->
    <div class="card mb-2 shadow-sm bg-success text-white">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="p-3">
                <h5 class="mb-0">Selamat Datang, <b>{{ auth()->user()->name }}</b> 👋 di <b>HMS</b> (Helpdesk Management System)</h5>
                <small class=" text-white">
                    Sistem layanan permintaan & ticketing
                </small><hr>
                <p class="text-white">
                Silakan gunakan menu di bawah ini untuk mengajukan permintaan atau menyampaikan keluhan.
                </p>
            </div>
            <div class="text-end">
                <h6 id="tanggal" class="mb-0"></h6>
                <span id="jam" class="badge bg-dark"></span>
            </div>
        </div>
    </div>


    <!-- Menu Utama -->
    <div class="row">

        <!-- Permintaan Barang -->
        <div class="col-md-6 mt-2">
            <div class="card h-90 shadow-sm" style="background: #FAEB92">
                <div class="card-body text-center">
                    <h5 class="card-title">📦 Permintaan Barang</h5>
                    <p class="card-text">
                        Ajukan permintaan barang yang Anda butuhkan untuk keperluan kerja.
                    </p>
                    <a href="{{ route('user.transaksi-out.create') }}" class="btn btn-primary">
                        Buat Permintaan
                    </a>
                </div>
            </div>
        </div>

        <!-- Keluhan / Tiket -->
        <div class="col-md-6 mt-2">
            <div class="card h-90 shadow-sm" style="background: #FAEB92">
                <div class="card-body text-center">
                    <h5 class="card-title">🎫 Keluhan / Tiket</h5>
                    <p class="card-text">
                        Laporkan masalah atau keluhan yang Anda alami.
                    </p>
                    <a href="{{ route('user.ticketing.create') }}" class="btn btn-danger">
                        Buat Keluhan
                    </a>
                </div>
            </div>
        </div>

<!-- SCRIPT JAM -->
<script>
    function updateDateTime() {
        const now = new Date();

        const hari = now.toLocaleDateString('id-ID', { weekday: 'long' });
        const tanggal = now.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });
        const jam = now.toLocaleTimeString('id-ID');

        document.getElementById('tanggal').innerHTML = `${hari}, ${tanggal}`;
        document.getElementById('jam').innerHTML = jam;
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
</script>
@endsection