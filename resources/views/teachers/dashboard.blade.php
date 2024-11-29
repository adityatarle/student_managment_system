@extends('layouts')
@section('content')
<div class="container mt-2 col-12">
    <div class="shadow card">
        <div class="card-header bg-dark ">
            <h2 class="mb-0 text-white card-title">Teachers Dashboard</h2>
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

        </div>
    </div>
</div>



@endsection
