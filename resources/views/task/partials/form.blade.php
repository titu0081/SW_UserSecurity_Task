@php
    $isEditing = isset($task);
    $titulo = $isEditing ? 'Editar Tarea' : 'Crear Tarea';
@endphp

<div class="card border shadow-sm rounded-4">
    <div class="card-body p-4 p-md-5">
        <div class="mb-4">
            <h2 class="h4 fw-bold mb-1">{{ $titulo }}</h2>
            <p class="text-secondary mb-0">{{ $isEditing ? 'Actualiza los detalles de tu tarea.' : 'Agrega una nueva tarea a tu tablero de planificación.' }}</p>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label fw-semibold">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control form-control-lg @error('title') is-invalid @enderror"
                value="{{ old('title', $task->title ?? '') }}"
                placeholder="Ejemplo: Terminar integración de API"
                required
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-semibold">Descripción</label>
            <textarea
                id="description"
                name="description"
                rows="5"
                class="form-control @error('description') is-invalid @enderror"
                placeholder="Describe lo que se necesita hacer..."
                required
            >{{ old('description', $task->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row g-3 align-items-end">
            <div class="col-md-7">
                <label for="limit_date" class="form-label fw-semibold">Fecha Límite</label>
                <input
                    type="datetime-local"
                    id="limit_date"
                    name="limit_date"
                    class="form-control @error('limit_date') is-invalid @enderror"
                    value="{{ old('limit_date', isset($task) && $task->limit_date ? $task->limit_date->format('Y-m-d\\TH:i') : '') }}"
                    required
                >
                @error('limit_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-5">
                <div class="form-check form-switch mt-4 mt-md-0">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        role="switch"
                        id="completed"
                        name="completed"
                        value="1"
                        {{ old('completed', $task->completed ?? false) ? 'checked' : '' }}
                    >
                    <label class="form-check-label fw-semibold" for="completed">
                        Marcar como completada
                    </label>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2 mt-4">
            <button type="submit" class="btn btn-primary btn-lg px-4">
                {{ $isEditing ? 'Actualizar Tarea' : 'Guardar Tarea' }}
            </button>
            <a href="{{ route('task.index') }}" class="btn btn-outline-danger btn-lg">Cancelar</a>
        </div>
    </div>
</div>
