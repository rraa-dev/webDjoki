@extends('layouts.app')

@section('title', 'Add Hero - Djoki')

@section('content')
<div class="mb-4">
    <a href="{{ route('heroes.index') }}" class="btn btn-outline-secondary mb-3">
        <i class="fas fa-arrow-left me-2"></i>Back
    </a>
    <h2 class="fw-bold"><i class="fas fa-dragon me-2"></i>Add New Hero</h2>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('heroes.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Fanny, Ling, Chou" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="">Select Role</option>
                            <option value="Assassin" {{ old('role') == 'Assassin' ? 'selected' : '' }}>Assassin</option>
                            <option value="Fighter" {{ old('role') == 'Fighter' ? 'selected' : '' }}>Fighter</option>
                            <option value="Mage" {{ old('role') == 'Mage' ? 'selected' : '' }}>Mage</option>
                            <option value="Marksman" {{ old('role') == 'Marksman' ? 'selected' : '' }}>Marksman</option>
                            <option value="Tank" {{ old('role') == 'Tank' ? 'selected' : '' }}>Tank</option>
                            <option value="Support" {{ old('role') == 'Support' ? 'selected' : '' }}>Support</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Difficulty <span class="text-danger">*</span></label>
                        <select name="difficulty" class="form-select @error('difficulty') is-invalid @enderror" required>
                            <option value="">Select Difficulty</option>
                            <option value="Easy" {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
                            <option value="Medium" {{ old('difficulty') == 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="Hard" {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>Hard</option>
                        </select>
                        @error('difficulty')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Save Hero
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
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Slug will be created from hero name</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Choose appropriate role and difficulty</li>
                </ul>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="fas fa-lightbulb text-warning me-2"></i>Popular Heroes</h6>
                <ul class="list-unstyled small">
                    <li class="mb-1">🗡️ Fanny - Assassin (Hard)</li>
                    <li class="mb-1">🗡️ Ling - Assassin (Medium)</li>
                    <li class="mb-1">⚔️ Chou - Fighter (Medium)</li>
                    <li class="mb-1">🔮 Kagura - Mage (Hard)</li>
                    <li class="mb-1">🏹 Wanwan - Marksman (Medium)</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
