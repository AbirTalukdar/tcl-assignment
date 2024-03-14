@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Project</h1>
        <form method="POST" action="{{ route('projects.update', $project) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $project->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" required>{{ $project->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="duration">Duration:</label>
                <input type="date" name="duration" id="duration" class="form-control" value="{{ $project->duration }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Project</button>
        </form>
    </div>
@endsection