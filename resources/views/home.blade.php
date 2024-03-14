@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if(Auth::user()->role === 'admin')
        <h2>Admin Dashboard</h2>
            <!-- Button for registering an investor -->
            <a href="{{ route('investors.register') }}" class="btn btn-primary mt-3">
                Register Investor
            </a>

            <a href="{{ route('list') }}" class="btn btn-primary mt-3">
                User List
            </a>

            <a href="{{ route('projects.create') }}" class="btn btn-primary mt-3">
                Create Project
            </a>

            <a href="{{ route('projects.list') }}" class="btn btn-primary mt-3">
                Project List
            </a>
        @endif
        @if(Auth::user()->role === 'investor')
            <h2>Investor Dashboard</h2>
            <a href="{{ route('projects.list') }}" class="btn btn-primary mt-3">
                Project List
            </a>
        @endif
            </div>
        </div>
    </div>
</div>


@endsection
