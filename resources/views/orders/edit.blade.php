@extends('layouts.app')

@section('title', 'Edit Order - Djoki')

@section('content')
<div class="mb-4">
    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="fas fa-arrow-left me-2"></i>Back
    </a>
    <h2 class="fw-bold"><i class="fas fa-shopping-cart me-2"></i>Edit Order</h2>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">UUID</label>
                        <input type="text" class="form-control" value="{{ $order->id }}" disabled>
                        <small class="text-muted">UUID cannot be changed</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Slug</label>
                        <input type="text" class="form-control" value="{{ $order->slug }}" disabled>
                        <small class="text-muted">Slug is auto-generated</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Customer <span class="text-danger">*</span></label>
                        <select name="customer_id" class="form-select @error('customer_id') is-invalid @enderror" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} ({{ $customer->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero <span class="text-danger">*</span></label>
                        <select name="hero_id" class="form-select @error('hero_id') is-invalid @enderror" required>
                            <option value="">Select Hero</option>
                            @foreach($heroes as $hero)
                                <option value="{{ $hero->id }}" {{ old('hero_id', $order->hero_id) == $hero->id ? 'selected' : '' }}>
                                    {{ $hero->name }} ({{ $hero->role }} - {{ $hero->difficulty }})
                                </option>
                            @endforeach
                        </select>
                        @error('hero_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Current Rank <span class="text-danger">*</span></label>
                            <select name="current_rank" class="form-select @error('current_rank') is-invalid @enderror" required>
                                <option value="">Select Rank</option>
                                <option value="Warrior" {{ old('current_rank', $order->current_rank) == 'Warrior' ? 'selected' : '' }}>Warrior</option>
                                <option value="Elite" {{ old('current_rank', $order->current_rank) == 'Elite' ? 'selected' : '' }}>Elite</option>
                                <option value="Master" {{ old('current_rank', $order->current_rank) == 'Master' ? 'selected' : '' }}>Master</option>
                                <option value="Grandmaster" {{ old('current_rank', $order->current_rank) == 'Grandmaster' ? 'selected' : '' }}>Grandmaster</option>
                                <option value="Epic" {{ old('current_rank', $order->current_rank) == 'Epic' ? 'selected' : '' }}>Epic</option>
                                <option value="Legend" {{ old('current_rank', $order->current_rank) == 'Legend' ? 'selected' : '' }}>Legend</option>
                                <option value="Mythic" {{ old('current_rank', $order->current_rank) == 'Mythic' ? 'selected' : '' }}>Mythic</option>
                                <option value="Mythic Glory" {{ old('current_rank', $order->current_rank) == 'Mythic Glory' ? 'selected' : '' }}>Mythic Glory</option>
                            </select>
                            @error('current_rank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Target Rank <span class="text-danger">*</span></label>
                            <select name="target_rank" class="form-select @error('target_rank') is-invalid @enderror" required>
                                <option value="">Select Rank</option>
                                <option value="Warrior" {{ old('target_rank', $order->target_rank) == 'Warrior' ? 'selected' : '' }}>Warrior</option>
                                <option value="Elite" {{ old('target_rank', $order->target_rank) == 'Elite' ? 'selected' : '' }}>Elite</option>
                                <option value="Master" {{ old('target_rank', $order->target_rank) == 'Master' ? 'selected' : '' }}>Master</option>
                                <option value="Grandmaster" {{ old('target_rank', $order->target_rank) == 'Grandmaster' ? 'selected' : '' }}>Grandmaster</option>
                                <option value="Epic" {{ old('target_rank', $order->target_rank) == 'Epic' ? 'selected' : '' }}>Epic</option>
                                <option value="Legend" {{ old('target_rank', $order->target_rank) == 'Legend' ? 'selected' : '' }}>Legend</option>
                                <option value="Mythic" {{ old('target_rank', $order->target_rank) == 'Mythic' ? 'selected' : '' }}>Mythic</option>
                                <option value="Mythic Glory" {{ old('target_rank', $order->target_rank) == 'Mythic Glory' ? 'selected' : '' }}>Mythic Glory</option>
                            </select>
                            @error('target_rank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Price (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $order->price) }}" min="0" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="Pending" {{ old('status', $order->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ old('status', $order->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ old('status', $order->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ old('status', $order->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Update Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i>Order Info</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-calendar text-primary me-2"></i><strong>Created:</strong> {{ $order->created_at->format('d M Y H:i') }}</li>
                    <li class="mb-2"><i class="fas fa-clock text-primary me-2"></i><strong>Updated:</strong> {{ $order->updated_at->format('d M Y H:i') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
