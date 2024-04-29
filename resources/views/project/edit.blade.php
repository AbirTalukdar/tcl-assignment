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
                                            <label for="vendor_firstName">First Name</label>
                                            <input class="form-control" id="vendor_firstName" name="vendor_firstName" type="text" placeholder="Vendor First Name" value="{{ @$vendor->vendor_firstName }}" required>
                                            <span class="text-danger"> <b>{{  $errors->first('vendor_firstName') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vendor_lastName">Last Name</label>
                                            <input class="form-control" id="vendor_lastName" name="vendor_lastName" type="text" placeholder="Vendor Last Name" value="{{ @$vendor->vendor_lastName }}" required>
                                            <span class="text-danger"> <b>{{  $errors->first('vendor_lastName') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vendor_phone">Phone Number</label>
                                            <input class="form-control" id="vendor_phone" name="vendor_phone" type="text" placeholder="Vendor Phone Number" value="{{ @$vendor->vendor_phone }}" required>
                                            <span class="text-danger"> <b>{{  $errors->first('vendor_phone') }}</b></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vendor_shop_name">Shop Name</label>
                                            <input class="form-control" id="vendor_shop_name" name="vendor_shop_name" type="tel" placeholder="Vendor Shop Name" value="{{ @$vendor->vendor_shop_name }}" required>
                                            <span class="text-danger"> <b>{{  $errors->first('vendor_shop_name') }}</b></span>
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
