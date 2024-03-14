@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Projects</h1>
        <ul>
            @foreach($projects as $project)
                <li>
                    <a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection