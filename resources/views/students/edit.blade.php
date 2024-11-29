@extends('layouts')

@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <div class="card-header bg-dark">
            <h2 class="mb-0 text-white card-title">Edit Student</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('students.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $student->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $student->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth', $student->date_of_birth) }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $student->phone) }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" required>{{ old('address', $student->address) }}</textarea>
                </div>

                <button type="submit" class="btn btn-warning">Update Student</button>
            </form>
        </div>
    </div>
</div>
@endsection
