@extends('layouts')

@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <div class="card-header bg-dark">
            <h2 class="mb-0 text-white card-title">Enrollments</h2>
        </div>

        <!-- Success message -->
        @if (session('message'))
            <div class="alert alert-success col-3" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="card-body">
            <a href="{{ route('enrollments.create') }}" class="mb-3 btn btn-primary">Add Enrollment</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Enrollment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->student->name }}</td>
                            <td>{{ $enrollment->course->name }}</td>
                            <td>{{ $enrollment->enrollment_date }}</td>
                            <td>
                                <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" style="display:inline;">
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
