@extends('layouts')

@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <div class="card-header bg-dark">
            <h2 class="mb-0 text-white card-title">Add Enrollment</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('enrollments.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="student_id" class="form-label">Student</label>
                    <select name="student_id" class="form-control" required>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="course_id" class="form-label">Course</label>
                    <select name="course_id" class="form-control" required>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="enrollment_date" class="form-label">Enrollment Date</label>
                    <input type="date" class="form-control" name="enrollment_date" required>
                </div>

                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
