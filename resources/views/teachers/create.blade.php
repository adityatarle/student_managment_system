@extends('layouts')
@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <div class="card-header bg-dark ">
            <h2 class="mb-0 text-white card-title">Add Teacher</h2>
        </div>
        @if (session()->has('errors'))
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach (session('errors')->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Display Success Messages -->
    @if (session('message'))
        <div class="alert alert-success col-3" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="card-body">
        <!-- Laravel form setup -->
        <form action="{{ route('teachers.store') }}" method="POST" id="teacher_info_form" class="content-form needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <!-- Teacher Name -->
                <div class="col-md-6">
                    <label for="name" class="mb-2 form-label required fs-5 fw-semibold">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter teacher name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Teacher Email -->
                <div class="col-md-6">
                    <label for="email" class="mb-2 form-label required fs-5 fw-semibold">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mb-4">
                <button type="submit" class="text-white btn btn-dark">Submit</button>
            </div>
        </form>
    </div>

    </div>
</div>
<script>
    $("#kt_datatable_vertical_scroll").DataTable({
        "scrollY": "500px",
        "scrollCollapse": true,
        "paging": false,
        "dom": "<'table-responsive'tr>"
    });
</script>


@endsection
