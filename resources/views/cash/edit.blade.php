@extends('layouts.main')
@section('title'){{ 'Cash Edit' }}@endsection
@section('header.css')
    <style>

    </style>
@endsection
@section('main.content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Cash Edit</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Cash Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-wizard" action="{{ route('cash.update', $cash->id ) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="project_id">Select Project</label>
                                            <select class="form-control" id="project_id" name="projectId" required>
                                                @foreach($projects as $project)
                                                    <option value="{{ $project->id }}" {{ $assignedProject->projectId == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"> <b>{{  $errors->first('projectId') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="client_id">Select Client</label>
                                            <select class="form-control" id="client_id" name="clientId" required>
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}" {{ $assignedProject->clientId == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"> <b>{{  $errors->first('clientId') }}</b></span>
                                        </div>
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('cash.show') }}">Cancel</a></button>
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
