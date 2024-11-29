@extends('layouts')

@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <!-- Card Header -->
        <div class="card-header bg-dark d-flex justify-content-between">
            <h2 class="mb-0 text-white card-title">Student Details</h2>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <!-- Student Details Table -->
            <h4 class="mb-3 text-danger">Student Details</h4>
            <div class="table-responsive">
                <table class="table table-rounded table-flush">
                    <thead>
                        <tr class="py-4 border-gray-200 fw-semibold fs-7 text-danger border-bottom">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="py-5 border-gray-300 fw-semibold border-bottom fs-6">
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->address }}</td>
                            <td>{{ $student->date_of_birth }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Enrolled Courses Table -->
            <h4 class="mt-5 mb-3 text-danger">Enrolled Courses</h4>
            @if($student->enrollments->isEmpty())
                <p class="text-muted">No courses enrolled.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-rounded table-flush">
                        <thead>
                            <tr class="py-4 border-gray-200 fw-semibold fs-7 text-danger border-bottom">
                                <th>Course Name</th>
                                <th>Duration (weeks)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student->enrollments as $enrollment)
                                <tr class="py-5 border-gray-300 fw-semibold border-bottom fs-6">
                                    <td>{{ $enrollment->course->name }}</td>
                                    <td>{{ $enrollment->course->duration }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Assigned Tasks Table -->
            <h4 class="mt-5 mb-3 text-danger">Assigned Tasks</h4>
            @if($student->tasks->isEmpty())
                <p class="text-muted">No tasks assigned.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-rounded table-flush">
                        <thead>
                            <tr class="py-4 border-gray-200 fw-semibold fs-7 text-danger border-bottom">
                                <th>Task Title</th>
                                <th>Due Date</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student->tasks as $task)
                                <tr class="py-5 border-gray-300 fw-semibold border-bottom fs-6">
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->due_date }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->status }}</td>
                                    <td>{{ $task->teacher->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
