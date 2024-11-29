@extends('layouts')
@section('content')
<div class="container mt-2 col-12">
    <div class="card shadow">
        <div class="card-header bg-dark ">
            <h2 class="card-title text-white mb-0">All Teachers</h2>
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
            <div class="table-responsive">
                <table id="kt_datatable_vertical_scroll" class="table table-striped table-row-bordered gy-5 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800">
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
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Delete button (using POST method for deletion) -->
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-top fw-semibold fs-6 text-gray-800">
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
