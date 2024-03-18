@extends('layouts.app')
@section('content') 
    <div class="container">
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
        Home
        </a>
        <h2>Investment Details for Project: {{ $project->name }}</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Investor Name</th>
                        <th>Investment Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($investors as $investment)
                        <tr>
                            <td>{{ $investment->user->name }}</td>
                            <td>{{ number_format($investment->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection
