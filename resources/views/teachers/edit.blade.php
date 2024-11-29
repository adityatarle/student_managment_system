@extends('layouts')

@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <div class="card-header bg-dark">
            <h2 class="mb-0 text-white card-title">Edit Teacher</h2>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card-body">
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" id="teacher_info_form" class="content-form needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Specifies the PUT request for updating -->

                <div class="mb-3 row">
                    <!-- Teacher Name -->
                    <div class="col-md-6">
                        <label for="name" class="mb-2 form-label required fs-5 fw-semibold">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter teacher name" value="{{ old('name', $teacher->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Teacher Email -->
                    <div class="col-md-6">
                        <label for="email" class="mb-2 form-label required fs-5 fw-semibold">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter teacher email" value="{{ old('email', $teacher->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" class="text-white btn btn-dark">Update Teacher</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
