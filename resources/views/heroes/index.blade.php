@extends('layouts.app')

@section('title', 'Heroes - Djoki')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="fas fa-dragon me-2"></i>Heroes</h2>
    <a href="{{ route('heroes.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Hero
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
                        <th>Role</th>
                        <th>Difficulty</th>
                        <th>Orders</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($heroes as $hero)
                    <tr>
                        <td>
                            <small class="text-muted font-monospace">{{ substr($hero->id, 0, 8) }}...</small><br>
                            <span class="text-primary">{{ $hero->slug }}</span>
                        </td>
                        <td>
                            <i class="fas fa-dragon text-warning me-1"></i>
                            <strong>{{ $hero->name }}</strong>
                        </td>
                        <td><span class="badge bg-info">{{ $hero->role }}</span></td>
                        <td>
                            @if($hero->difficulty == 'Hard')
                                <span class="badge bg-danger">{{ $hero->difficulty }}</span>
                            @elseif($hero->difficulty == 'Medium')
                                <span class="badge bg-warning text-dark">{{ $hero->difficulty }}</span>
                            @else
                                <span class="badge bg-success">{{ $hero->difficulty }}</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $hero->orders_count }} orders</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('heroes.edit', $hero->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('heroes.destroy', $hero->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this hero? Related orders will also be deleted!')">
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
                            <i class="fas fa-dragon fa-3x mb-3 d-block"></i>
                            No heroes found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $heroes->links() }}
        </div>
    </div>
</div>
@endsection
