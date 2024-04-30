@extends('layouts.main')
@section('title'){{ 'Client Edit' }}@endsection
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
                        <h3>Client Edit</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <!-- <li class="breadcrumb-item">Settings</li> -->
                            <li class="breadcrumb-item active">Client</li>
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
                            <form class="form-wizard" action="{{ route('client.update', $client->id ) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="Name">Name</label>
                                            <input class="form-control" id="name" name="name" type="text" placeholder="Client Name" value="{{ @$client->name }}" required>
                                            <span class="text-danger"> <b>{{  $errors->first('name') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Email">Email</label>
                                            <input class="form-control" id="email" name="email" type="email" placeholder="Client Name" value="{{ @$client->email }}" required>
                                            <span class="text-danger"> <b>{{  $errors->first('email') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Password" value="{{ @$client->password }}">
                                            <span class="text-danger"><b>{{ $errors->first('password') }}</b></span>
                                        </div>
                                        <div class="text-end btn-mb">
                                            <button class="btn btn-secondary" type="button"><a class="text-white" href="{{ route('client.show') }}">Cancel</a></button>
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
