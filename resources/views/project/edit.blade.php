@extends('layouts.main')
@section('title'){{ 'Project Edit' }}@endsection
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
                        <h3>Project Edit</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <!-- <li class="breadcrumb-item">Settings</li> -->
                            <li class="breadcrumb-item active">Project</li>
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
                            <form class="form-wizard" action="{{ route('project.update', $project->id ) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="name">Project Name</label>
                                            <input class="form-control" id="name" name="name" type="text" placeholder="Project Name" value="{{ @$project->name }}" required>
                                            <span class="text-danger"> <b>{{  $errors->first('name') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description">Project Description</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Project Details" required>{{ @$project->description }} </textarea>
                                            <span class="text-danger"><b>{{  $errors->first('description') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status">Vendor Status</label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="">Select Vendor Status</option>
                                                <option value="active" @if($project->status === 'active') selected @endif>Active</option>
                                                <option value="inactive" @if($project->status === 'inactive') selected @endif>Inactive</option>
                                            </select>
                                            <span class="text-danger"> <b>{{  $errors->first('status') }}</b></span>
                                        </div>
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('project.show') }}">Cancel</a></button>
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
