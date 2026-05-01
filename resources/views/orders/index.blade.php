@extends('layouts.app')

@section('title', 'Orders - Djoki')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="fas fa-shopping-cart me-2"></i>Orders</h2>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Order
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>UUID / Slug</th>
                        <th>Customer</th>
                        <th>Hero</th>
                        <th>Rank</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>
                            <small class="text-muted font-monospace">{{ substr($order->id, 0, 8) }}...</small><br>
                            <span class="text-primary">{{ $order->slug }}</span>
                        </td>
                        <td>
                            <strong>{{ $order->customer->name }}</strong><br>
                            <small class="text-muted">{{ $order->customer->email }}</small>
                        </td>
                        <td>
                            <i class="fas fa-dragon text-warning me-1"></i>
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
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="fas fa-shopping-cart fa-3x mb-3 d-block"></i>
                            No orders found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
