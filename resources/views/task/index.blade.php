@extends('layouts.app')

@section('content')
    <div class="task-hero card border-0 rounded-4 shadow-sm mb-4">
        <div class="card-body p-4 p-md-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <p class="text-uppercase small fw-semibold text-secondary mb-1">Tablero de Tareas</p>
                <h1 class="display-6 fw-bold mb-0">Tus Tareas</h1>
            </div>
            <div class="d-flex flex-wrap gap-2">
                @can('create tasks')
                    <a href="{{ route('task.create') }}" class="btn btn-primary">Crear Tarea</a>
                @endcan
            </div>
        </div>
    </div>


    <div id="task-list" class="task-container">
        @include('task.partials.cards', ['task' => $task])
    </div>


    <style>
        .task-hero {
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
        }

        .task-card {
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .task-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.9rem 1.8rem rgba(15, 23, 42, 0.08) !important;
        }
    </style>
@endsection



