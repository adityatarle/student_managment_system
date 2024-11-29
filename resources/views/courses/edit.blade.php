@extends('layouts')
@section('content')
<div class="container mt-2">
    <div class="shadow card">
        <div class="card-header bg-dark">
            <h2 class="mb-0 text-white card-title">Edit Course</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('courses.update', $course->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Course Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $course->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Course Description</label>
                    <textarea class="form-control" id="description" name="description" required>{{ $course->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration (in weeks)</label>
                    <input type="number" class="form-control" id="duration" name="duration" value="{{ $course->duration }}" required>
                </div>

                <button type="submit" class="btn btn-dark">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
