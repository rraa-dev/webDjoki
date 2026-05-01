@extends('layouts.app')

@section('title', 'Edit Hero - Djoki')

@section('content')
<div class="mb-4">
    <a href="{{ route('heroes.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="fas fa-arrow-left me-2"></i>Back
    </a>
    <h2 class="fw-bold"><i class="fas fa-dragon me-2"></i>Edit Hero</h2>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('heroes.update', $hero->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">UUID</label>
                        <input type="text" class="form-control" value="{{ $hero->id }}" disabled>
                        <small class="text-muted">UUID cannot be changed</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Slug</label>
                        <input type="text" class="form-control" value="{{ $hero->slug }}" disabled>
                        <small class="text-muted">Slug will be auto-updated from name</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $hero->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="">Select Role</option>
                            <option value="Assassin" {{ old('role', $hero->role) == 'Assassin' ? 'selected' : '' }}>Assassin</option>
                            <option value="Fighter" {{ old('role', $hero->role) == 'Fighter' ? 'selected' : '' }}>Fighter</option>
                            <option value="Mage" {{ old('role', $hero->role) == 'Mage' ? 'selected' : '' }}>Mage</option>
                            <option value="Marksman" {{ old('role', $hero->role) == 'Marksman' ? 'selected' : '' }}>Marksman</option>
                            <option value="Tank" {{ old('role', $hero->role) == 'Tank' ? 'selected' : '' }}>Tank</option>
                            <option value="Support" {{ old('role', $hero->role) == 'Support' ? 'selected' : '' }}>Support</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Difficulty <span class="text-danger">*</span></label>
                        <select name="difficulty" class="form-select @error('difficulty') is-invalid @enderror" required>
                            <option value="">Select Difficulty</option>
                            <option value="Easy" {{ old('difficulty', $hero->difficulty) == 'Easy' ? 'selected' : '' }}>Easy</option>
                            <option value="Medium" {{ old('difficulty', $hero->difficulty) == 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="Hard" {{ old('difficulty', $hero->difficulty) == 'Hard' ? 'selected' : '' }}>Hard</option>
                        </select>
                        @error('difficulty')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Update Hero
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i>Hero Info</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-calendar text-primary me-2"></i><strong>Created:</strong> {{ $hero->created_at->format('d M Y') }}</li>
                    <li class="mb-2"><i class="fas fa-clock text-primary me-2"></i><strong>Updated:</strong> {{ $hero->updated_at->format('d M Y') }}</li>
                    <li class="mb-2"><i class="fas fa-shopping-cart text-primary me-2"></i><strong>Total Orders:</strong> {{ $hero->orders->count() }}</li>
                </ul>
            </div>
        </div>

        @if($hero->orders->count() > 0)
        <div class="alert alert-warning mt-3">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Warning!</strong> This hero has {{ $hero->orders->count() }} order(s). Deleting will also delete related orders!
        </div>
        @endif
    </div>
</div>
@endsection
