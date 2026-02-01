@extends('layouts.home')
@section('content')
    <p>Selamat datang <b>{{ auth()->user()->name }}</b> di halaman Manager Dashboard.</p>

     <div class="row">
    <!-- Card 1: User Active -->
    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">User <span>| Active</span></h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $totalUserActive }}</h6>
                        <span class="text-success small pt-1 fw-bold">Active</span>
                        <span class="text-muted small pt-2 ps-1">Users</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Total Items Barang -->
    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Total Items Barang</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $totalBarang }}</h6>
                        <span class="text-success small pt-1 fw-bold">Items</span>
                        <span class="text-muted small pt-2 ps-1">Barang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Ticket Done</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-chat-left-text"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $totalKeluhan }}</h6>
                        <span class="text-primary small pt-1 fw-bold">Verifikasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Status Ticket</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $totalStatus }}</h6>
                        <span class="text-warning small pt-1 fw-bold">Pending</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

 <div class="col-lg-6 col-md-12 mb-4">
        <div class="card">
            <div class="card-body pb-0">
                <h5 class="card-title">Permintaan Barang Traffic</h5>
                <div id="kategoriChart" style="min-height:400px;" class="echart"></div>
            </div>
        </div>
    </div>

    <!-- Chart 2: Keluhan per Kategori -->
    <div class="col-lg-6 col-md-12 mb-4">
        <div class="card">
            <div class="card-body pb-0">
                <h5 class="card-title">Kategori Tickets</h5>
                <div id="keluhanChart" style="min-height:400px;" class="echart"></div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Chart 1: Permintaan Barang
    echarts.init(document.querySelector("#kategoriChart")).setOption({
        tooltip: { trigger: 'item' },
        legend: { top: '5%', left: 'center' },
        series: [{
            name: 'Barang Keluar',
            type: 'pie',
            radius: ['30%', '55%'],
            avoidLabelOverlap: false,
            label: { show: false, position: 'center' },
            emphasis: { label: { show: true, fontSize: '12', fontWeight: 'bold' } },
            labelLine: { show: false },
            data: @json($chartData)
        }]
    });

    // Chart 2: Keluhan
    echarts.init(document.querySelector("#keluhanChart")).setOption({
        tooltip: { trigger: 'item' },
        legend: { top: '5%', left: 'center' },
        series: [{
            name: 'Keluhan',
            type: 'pie',
            radius: ['30%', '55%'],
            avoidLabelOverlap: false,
            label: { show: false, position: 'center' },
            emphasis: { label: { show: true, fontSize: '12', fontWeight: 'bold' } },
            labelLine: { show: false },
            data: @json($keluhanChartData),
            color: ['#3498db','#2ecc71','#f1c40f'] // hardware, software, pengadaan aset
        }]
    });
});
</script>


<div class="row">
    <!-- BARANG MENIPIS -->
    <div class="col-lg-6 col-md-12 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Stok Barang Menipis <span class="text-danger">( &lt; 5 )</span>
                </h5>

                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">No</th>
                                <th>Nama Barang</th>
                                <th>Tipe/Merk</th>
                                <th class="text-center" width="20%">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barangMenipis as $index => $barang)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->merk }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-danger">
                                            {{ $barang->stok }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        Tidak ada stok menipis
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- BAR PERMINTAAN BARANG PALING BANYAK -->
    <div class="col-lg-6 col-md-12 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    Permintaan Terbanyak & Acc
                </h5>

                <div id="barChart" style="min-height:350px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#barChart"), {
        series: [{
            name: 'Jumlah Permintaan',
            data: @json($productTotal)
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: true
        },
        xaxis: {
            categories: @json($product),
            title: {
                text: 'Jumlah Permintaan Disetujui'
            }
        },
        colors: ['#0d6efd'],
        tooltip: {
            y: {
                formatter: val => val + " item"
            }
        }
    }).render();
});
</script>

@endsection