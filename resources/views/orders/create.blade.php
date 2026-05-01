@extends('layouts.app')

@section('title', 'Add Order - Djoki')

@section('content')
<div class="mb-4">
    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="fas fa-arrow-left me-2"></i>Back
    </a>
    <h2 class="fw-bold"><i class="fas fa-shopping-cart me-2"></i>Add New Order</h2>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Customer <span class="text-danger">*</span></label>
                        <select name="customer_id" class="form-select @error('customer_id') is-invalid @enderror" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} ({{ $customer->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($customers->count() == 0)
                            <small class="text-danger">No customers available. <a href="{{ route('customers.create') }}">Create one first</a></small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero <span class="text-danger">*</span></label>
                        <select name="hero_id" class="form-select @error('hero_id') is-invalid @enderror" required>
                            <option value="">Select Hero</option>
                            @foreach($heroes as $hero)
                                <option value="{{ $hero->id }}" {{ old('hero_id') == $hero->id ? 'selected' : '' }}>
                                    {{ $hero->name }} ({{ $hero->role }} - {{ $hero->difficulty }})
                                </option>
                            @endforeach
                        </select>
                        @error('hero_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($heroes->count() == 0)
                            <small class="text-danger">No heroes available. <a href="{{ route('heroes.create') }}">Create one first</a></small>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Current Rank <span class="text-danger">*</span></label>
                            <select name="current_rank" class="form-select @error('current_rank') is-invalid @enderror" required>
                                <option value="">Select Rank</option>
                                <option value="Warrior">Warrior</option>
                                <option value="Elite">Elite</option>
                                <option value="Master">Master</option>
                                <option value="Grandmaster">Grandmaster</option>
                                <option value="Epic">Epic</option>
                                <option value="Legend">Legend</option>
                                <option value="Mythic">Mythic</option>
                                <option value="Mythic Glory">Mythic Glory</option>
                            </select>
                            @error('current_rank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Target Rank <span class="text-danger">*</span></label>
                            <select name="target_rank" class="form-select @error('target_rank') is-invalid @enderror" required>
                                <option value="">Select Rank</option>
                                <option value="Warrior">Warrior</option>
                                <option value="Elite">Elite</option>
                                <option value="Master">Master</option>
                                <option value="Grandmaster">Grandmaster</option>
                                <option value="Epic">Epic</option>
                                <option value="Legend">Legend</option>
                                <option value="Mythic">Mythic</option>
                                <option value="Mythic Glory">Mythic Glory</option>
                            </select>
                            @error('target_rank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Price (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="150000" min="0" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Save Order
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
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Slug will be created automatically</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Select customer and hero from database</li>
                </ul>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="fas fa-coins text-warning me-2"></i>Price Guide</h6>
                <ul class="list-unstyled small">
                    <li class="mb-1">💰 Warrior → Elite: Rp 50,000</li>
                    <li class="mb-1">💰 Elite → Master: Rp 75,000</li>
                    <li class="mb-1">💰 Master → GM: Rp 100,000</li>
                    <li class="mb-1">💰 Epic → Legend: Rp 150,000</li>
                    <li class="mb-1">💰 Legend → Mythic: Rp 200,000</li>
                    <li class="mb-1">💰 Mythic → Glory: Rp 300,000</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
