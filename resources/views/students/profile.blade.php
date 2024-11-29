@extends('layouts')

@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <div class="card-header bg-dark">
            <h2 class="mb-0 text-white card-title">Student Profile</h2>
        </div>

        <div class="card-body">
            <!-- Student Details -->
            <h3>Name: {{ $student->name }}</h3>
            <p>Email: {{ $student->email }}</p>
            <p>Date of Birth: {{ $student->date_of_birth }}</p>
            <p>Phone: {{ $student->phone }}</p>
            <p>Address: {{ $student->address }}</p>

            <!-- Enrolled Courses -->
            <h4>Enrolled Courses</h4>
            @if($student->enrollments->isEmpty())
                <p>No courses enrolled.</p>
            @else
                <ul>
                    @foreach($student->enrollments as $enrollment)
                        <li>{{ $enrollment->course->name }} (Duration: {{ $enrollment->course->duration }} weeks)</li>
                    @endforeach
                </ul>
            @endif

            <!-- Assigned Tasks -->
            <h4>Assigned Tasks</h4>
            @if($student->tasks->isEmpty())
                <p>No tasks assigned.</p>
            @else
                <ul>
                    @foreach($student->tasks as $task)
                        <li>
                            <strong>{{ $task->title }}</strong> (Due: {{ $task->due_date }}) <br>
                            <em>{{ $task->description }}</em><br>
                            Status: {{ $task->status }} <br>
                            Teacher: {{ $task->teacher->name }} <!-- Assuming Teacher has a name field -->
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
