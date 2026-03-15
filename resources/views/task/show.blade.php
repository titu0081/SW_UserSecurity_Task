@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge rounded-pill {{ $task->completed ? 'text-bg-success' : 'text-bg-warning' }} mb-2">
                                {{ $task->completed ? 'Completed' : 'Pending' }}
                            </span>
                            <h1 class="h3 fw-bold mb-0">{{ $task->title }}</h1>
                        </div>
                        <small class="text-secondary">Due: {{ optional($task->limit_date)->format('d M Y, h:i A') }}</small>
                    </div>

                    <p class="text-secondary fs-5">{{ $task->description }}</p>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <a href="{{ route('task.index') }}" class="btn btn-outline-secondary">Back</a>
                        @can('edit tasks')
                            <a href="{{ route('task.edit', $task->id_task) }}" class="btn btn-primary">Edit</a>
                        @endcan
                        @can('delete tasks')
                            <form action="{{ route('task.destroy', $task->id_task) }}" method="POST" onsubmit="return confirm('Delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
