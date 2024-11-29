@extends('layouts')

@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <div class="card-header bg-dark">
            <h2 class="mb-0 text-white card-title">Assign Task</h2>
        </div>


        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="student_id" class="form-label">Student</label>
                    <select name="student_id" class="form-control" required>
                        <option value="">Select Student</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">


                    @if(auth()->user()->role == 'teacher') <!-- Check if the logged-in user is a teacher -->
                        <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}" /> <!-- Hidden input for teacher_id -->
                    @else
                    <label for="teacher_id" class="form-label">Teacher</label>
                        <select name="teacher_id" class="form-control" required>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>


                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Attach File (PDF/DOC)</label>
                    <input type="file" name="file" class="form-control" accept=".pdf, .doc, .docx">
                </div>

                <button type="submit" class="btn btn-primary">Save Task</button>
            </form>
        </div>
    </div>
</div>
@endsection
