@extends('layouts.app')

@section('content')
    <h2>{{ isset($college) ? 'Edit College' : 'Add College' }}</h2>

    <form action="{{ isset($college) ? route('colleges.update', $college->id) : route('colleges.store') }}" method="POST">
        @csrf
        @if(isset($college))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $college->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $college->address ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($college) ? 'Update' : 'Create' }}</button>
    </form>
@endsection
