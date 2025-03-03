@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2>Colleges</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('colleges.create') }}" class="btn btn-success mb-3">Add College</a>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- College Table -->
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($colleges as $college)
                        <tr>
                            <td>{{ $college->name }}</td>
                            <td>{{ $college->address }}</td>
                            <td>
                                <a href="{{ route('colleges.edit', $college->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('colleges.destroy', $college->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
