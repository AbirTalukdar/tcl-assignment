@extends('layouts.app')

@section('content')

    <!-- <div class="container">
    <form action="{{ route('investors.register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Register</button>
    </form>
    </div> -->
    <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Investor Registration</h4>
                    <p class="card-description"> Use Email and Password Investor Can login the system </p>
                    <form action="{{ route('investors.register') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                          <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
@endsection