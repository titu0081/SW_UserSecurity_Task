@extends('layouts.app')

@section('content')

<div class="d-flex flex-column h-100">

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">Editar Tarea</h1>
        <a href="{{ route('task.index') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="contenedorForm">

        <form action="{{ route('task.update', $task->id_task) }}" method="POST">
            @csrf
            @method('PUT')

            @include('task.partials.form', ['task'=>$task])

        </form>

    </div>

</div>

@endsection