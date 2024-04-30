@extends('layouts.main')
@section('title'){{ 'Cash Create' }}@endsection
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
                        <h3>Cash Create</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <!-- <li class="breadcrumb-item">Settings</li> -->
                            <li class="breadcrumb-item active">Cash</li>
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
                            <form class="form-wizard" action="{{ route('cash.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="projectId">Select Project</label>
                                            <select class="form-control" id="projectId" name="projectId" required>
                                                <option value="">Select Project</option>
                                                @foreach($projects as $project)
                                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('projectId') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="clientId">Select Client</label>
                                            <select class="form-control" id="clientId" name="clientId" required>
                                                <option value="">Select Client</option>
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"><b>{{  $errors->first('clientId') }}</b></span>
                                        </div>
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('cash.show') }}">Cancel</a></button>
                                            <button class="btn btn-primary" type="submit">Create</button>
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
