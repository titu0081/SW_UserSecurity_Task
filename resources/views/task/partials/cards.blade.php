@forelse($task as $task)
    <article class="task-card card border-0 shadow-sm rounded-4 mb-3" data-task-id="{{ $task->id_task }}">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge rounded-pill {{ $task->completed ? 'text-bg-success' : 'text-bg-warning' }}">
                            {{ $task->completed ? 'Completada' : 'Pendiente' }}
                        </span>
                        <small class="text-secondary">Creada {{ $task->created_at->diffForHumans() }}</small>
                    </div>
                    <h3 class="h5 fw-bold mb-2">{{ $task->title }}</h3>
                    <p class="text-secondary mb-2">{{ \Illuminate\Support\Str::limit($task->description, 160) }}</p>
                    <small class="text-secondary">Fecha límite: {{ optional($task->limit_date)->format('d M Y, h:i A') }}</small>
                </div>

                <div class="d-flex flex-wrap gap-2 align-content-start">
                    <a href="{{ route('task.show', $task->id_task) }}" class="btn btn-sm btn-outline-dark">Ver</a>
                    @can('edit tasks')
                        <a href="{{ route('task.edit', $task->id_task) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                    @endcan
                    @can('delete tasks')
                        <form action="{{ route('task.destroy', $task->id_task) }}" method="POST" onsubmit="return confirm('¿Eliminar esta tarea?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </article>
@empty
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-5 text-center">
            <h3 class="h5 fw-bold mb-2">No existen tareas disponibles</h3>
            <p class="text-secondary mb-3">Comienza creando tu primera tarea.</p>
            @can('create tasks')
                <a href="{{ route('task.create') }}" class="btn btn-primary">Crear Tarea</a>
            @endcan
        </div>
    </div>
@endforelse
