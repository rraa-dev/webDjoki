@extends('layouts.app')

@section('title', 'Add Customer - Djoki')

@section('content')
<div class="mb-4">
    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="fas fa-arrow-left me-2"></i>Back
    </a>
    <h2 class="fw-bold"><i class="fas fa-user-plus me-2"></i>Add New Customer</h2>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Save Customer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i>Information</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>UUID will be generated automatically</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Slug will be created from name</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Email must be unique</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
