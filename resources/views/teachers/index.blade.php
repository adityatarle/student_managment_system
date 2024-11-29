@extends('layouts')
@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <div class="card-header bg-dark ">
            <h2 class="mb-0 text-white card-title">All Teachers</h2>
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
            <a href="{{ route('teachers.create') }}" class="mb-3 btn btn-light-dark">Add Teacher</a>
            <div class="table-responsive">
                <table id="kt_datatable_vertical_scroll" class="table table-striped table-row-bordered gy-5 gs-7">
                    <thead>
                        <tr class="text-gray-800 fw-semibold fs-6">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>
                                <!-- Edit button (replace 'edit_teacher' with your edit route) -->
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-light-warning">Edit</a>

                                <!-- Delete button (using POST method for deletion) -->
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light-danger" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-gray-800 border-top fw-semibold fs-6">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
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
