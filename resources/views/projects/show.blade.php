@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $project->name }}</h1>
        <p>Description: {{ $project->description }}</p>
        <p>Duration: {{ $project->duration }}</p>
        <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection