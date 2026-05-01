@extends('layouts.app')

@section('title', 'Edit Customer - Djoki')

@section('content')
<div class="mb-4">
    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="fas fa-arrow-left me-2"></i>Back
    </a>
    <h2 class="fw-bold"><i class="fas fa-user-edit me-2"></i>Edit Customer</h2>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">UUID</label>
                        <input type="text" class="form-control" value="{{ $customer->id }}" disabled>
                        <small class="text-muted">UUID cannot be changed</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Slug</label>
                        <input type="text" class="form-control" value="{{ $customer->slug }}" disabled>
                        <small class="text-muted">Slug will be auto-updated from name</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $customer->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $customer->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $customer->phone) }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Update Customer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i>Customer Info</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-calendar text-primary me-2"></i><strong>Created:</strong> {{ $customer->created_at->format('d M Y') }}</li>
                    <li class="mb-2"><i class="fas fa-clock text-primary me-2"></i><strong>Updated:</strong> {{ $customer->updated_at->format('d M Y') }}</li>
                    <li class="mb-2"><i class="fas fa-shopping-cart text-primary me-2"></i><strong>Total Orders:</strong> {{ $customer->orders->count() }}</li>
                </ul>
            </div>
        </div>

        @if($customer->orders->count() > 0)
        <div class="alert alert-warning mt-3">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Warning!</strong> This customer has {{ $customer->orders->count() }} order(s). Deleting will also delete related orders!
        </div>
        @endif
    </div>
</div>
@endsection
