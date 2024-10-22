@extends('layouts.template')

@section('content')
<!-- Info boxes -->
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Penjualan</span>
                <span class="info-box-number">1,410</span>
                <small class="text-success"><i class="fas fa-arrow-up"></i> 12% dari bulan lalu</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pendapatan</span>
                <span class="info-box-number">Rp 2.500.000</span>
                <small class="text-success"><i class="fas fa-arrow-up"></i> 5% dari bulan lalu</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total User</span>
                <span class="info-box-number">95</span>
                <small class="text-muted">Total pengguna aktif</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-boxes"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Stok Barang</span>
                <span class="info-box-number">450</span>
                <small class="text-danger"><i class="fas fa-arrow-down"></i> Stok menipis</small>
            </div>
        </div>
    </div>
</div>

<!-- Grafik -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Grafik Penjualan Bulanan</h3>
            </div>
            <div class="card-body">
                <canvas id="salesChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Produk Terlaris</h3>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Laptop Asus
                        <span class="badge bg-primary rounded-pill">214 unit</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Smartphone Samsung
                        <span class="badge bg-primary rounded-pill">180 unit</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Monitor LG
                        <span class="badge bg-primary rounded-pill">125 unit</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header border-0">
                <h3 class="card-title">Transaksi Terbaru</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Customer</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>INV-001</td>
                                <td>John Doe</td>
                                <td>Rp 2.500.000</td>
                            </tr>
                            <tr>
                                <td>INV-002</td>
                                <td>Jane Smith</td>
                                <td>Rp 1.800.000</td>
                            </tr>
                            <tr>
                                <td>INV-003</td>
                                <td>Bob Johnson</td>
                                <td>Rp 3.200.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row untuk statistik tambahan -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Statistik Kategori Produk</h3>
            </div>
            <div class="card-body">
                <canvas id="categoryChart" style="height: 250px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Aktivitas Terbaru</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div>
                        <i class="fas fa-user bg-primary"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                            <h3 class="timeline-header">User baru terdaftar</h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-shopping-cart bg-success"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 12 mins ago</span>
                            <h3 class="timeline-header">Transaksi baru selesai</h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-box bg-warning"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                            <h3 class="timeline-header">Stok produk diperbarui</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
.info-box {
    transition: transform 0.3s;
}
.info-box:hover {
    transform: translateY(-5px);
}
.timeline {
    margin: 0;
    padding: 0;
    list-style: none;
}
.timeline > div {
    margin-bottom: 15px;
    position: relative;
    padding-left: 30px;
}
.timeline > div > i {
    position: absolute;
    left: 0;
    top: 0;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    text-align: center;
    line-height: 25px;
    color: white;
}
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Grafik Penjualan
const salesCtx = document.getElementById('salesChart').getContext('2d');
new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Penjualan 2024',
            data: [65, 59, 80, 81, 56, 55],
            borderColor: '#024CAA',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

// Grafik Kategori
const categoryCtx = document.getElementById('categoryChart').getContext('2d');
new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: ['Elektronik', 'Fashion', 'Makanan', 'Lainnya'],
        datasets: [{
            data: [45, 25, 20, 10],
            backgroundColor: ['#024CAA', '#28a745', '#ffc107', '#dc3545']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
@endpush