@extends('layouts.app')

@section('title', 'Customers - Djoki')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="fas fa-users me-2"></i>Customers</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Customer
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>UUID / Slug</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Orders</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td>
                            <small class="text-muted font-monospace">{{ substr($customer->id, 0, 8) }}...</small><br>
                            <span class="text-primary">{{ $customer->slug }}</span>
                        </td>
                        <td><strong>{{ $customer->name }}</strong></td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>
                            <span class="badge bg-info">{{ $customer->orders->count() }} orders</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this customer? Related orders will also be deleted!')">
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
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fas fa-users fa-3x mb-3 d-block"></i>
                            No customers found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection
