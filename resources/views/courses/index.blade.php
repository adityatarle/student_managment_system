@extends('layouts')
@section('content')
<div class="container mt-2">
    <div class="shadow card">
        <div class="card-header bg-dark">
            <h2 class="mb-0 text-white card-title">All Courses</h2>
        </div>

        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="card-body">
            <a href="{{ route('courses.create') }}" class="mb-3 btn btn-primary">Add New Course</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->description }}</td>
                                <td>{{ $course->duration }}</td>
                                <td>
                                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
