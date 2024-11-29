@extends('layouts')

@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <div class="card-header bg-dark">
            <h2 class="mb-0 text-white card-title">Tasks</h2>
        </div>

        <!-- Success message -->
        @if (session('message'))
            <div class="alert alert-success col-3" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="card-body">
            <a href="{{ route('tasks.create') }}" class="mb-3 btn btn-primary">Add Task</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Student</th>
                            <th>Teacher</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->student->name }}</td>
                            <td>{{ $task->teacher->name }}</td>
                            <td>{{ $task->due_date }}</td>
                            <td>{{ $task->status }}</td>
                            <td>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
