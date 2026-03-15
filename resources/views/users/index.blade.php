@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <p class="text-uppercase small fw-semibold text-secondary mb-1">Panel de Administracion</p>
                    <h1 class="h3 fw-bold mb-0">Gestion de Usuarios</h1>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge text-bg-light border">Total: {{ $users->total() }}</span>
                    <a href="{{ route('task.index') }}" class="btn btn-outline-secondary btn-sm">Ir a Tareas</a>
                </div>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Nombre</th>
                                <th>Email</th>
                                <th>Rol actual</th>
                                <th class="pe-4">Asignar rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ $user->name }}</span>
                                            <small class="text-muted">ID: {{ $user->id }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            @forelse ($user->roles as $role)
                                                <span class="badge text-bg-primary">{{ $role->name }}</span>
                                            @empty
                                                <span class="badge text-bg-secondary">Sin rol</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="pe-4">
                                        <form action="{{ route('users.assign-role', $user) }}" method="POST" class="d-flex gap-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" class="form-select form-select-sm" required>
                                                <option value="">Selecciona un rol</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}"
                                                        {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No hay usuarios registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
