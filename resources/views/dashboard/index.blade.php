@extends('layouts.app')

@section('title', 'Dashboard - Djoki')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="fas fa-chart-line me-2"></i>Dashboard</h2>
    <p class="text-muted mb-0">Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-2">Total Orders</h6>
                    <h2 class="fw-bold mb-0">{{ $totalOrders }}</h2>
                </div>
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-2">Total Customers</h6>
                    <h2 class="fw-bold mb-0">{{ $totalCustomers }}</h2>
                </div>
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-2">Total Heroes</h6>
                    <h2 class="fw-bold mb-0">{{ $totalHeroes }}</h2>
                </div>
                <i class="fas fa-dragon"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold"><i class="fas fa-clock me-2"></i>Recent Orders</h5>
            <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">
                View All <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Hero</th>
                        <th>Rank</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                    <tr>
                        <td>
                            <strong>{{ $order->customer->name }}</strong><br>
                            <small class="text-muted">{{ $order->customer->email }}</small>
                        </td>
                        <td>
                            <i class="fas fa-dragon text-primary me-1"></i>
                            {{ $order->hero->name }}
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $order->current_rank }}</span>
                            <i class="fas fa-arrow-right mx-1"></i>
                            <span class="badge bg-success">{{ $order->target_rank }}</span>
                        </td>
                        <td><strong>Rp {{ number_format($order->price, 0, ',', '.') }}</strong></td>
                        <td>
                            @if($order->status == 'Completed')
                                <span class="badge-status bg-success text-white">Completed</span>
                            @elseif($order->status == 'In Progress')
                                <span class="badge-status bg-warning text-dark">In Progress</span>
                            @elseif($order->status == 'Pending')
                                <span class="badge-status bg-secondary text-white">Pending</span>
                            @else
                                <span class="badge-status bg-danger text-white">Cancelled</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                            No orders yet
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Info Box -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="alert alert-info border-0" role="alert">
            <div class="d-flex align-items-start">
                <i class="fas fa-info-circle fa-2x me-3"></i>
                <div>
                    <h5 class="alert-heading">💡 Fitur Relasi Database</h5>
                    <p class="mb-0">Jika Anda menghapus Customer atau Hero, maka Order yang berelasi akan otomatis terhapus (CASCADE). Setiap data memiliki UUID dan Slug unik untuk identifikasi.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
