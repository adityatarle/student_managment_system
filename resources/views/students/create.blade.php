@extends('layouts')

@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <div class="card-header bg-dark">
            <h2 class="mb-0 text-white card-title">Add New Student</h2>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Add Student</button>
            </form>
        </div>
    </div>
</div>
@endsection
