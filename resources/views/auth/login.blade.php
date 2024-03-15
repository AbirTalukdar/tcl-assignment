<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TCL ASSIGNMENT</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- End layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}" />
    
  </head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <!-- <img src="../../assets/images/logo.svg"> -->
                        </div>
                        <h4>Hello! Let's get started</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>
                        <form method="POST" action="{{ route('login') }}" class="pt-3">
                            @csrf
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" placeholder="Email Address" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input" name="remember" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Keep me signed in
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
                            </div>
                            <div class="mb-2">
                                <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                                    <i class="mdi mdi-facebook me-2"></i>Connect using Facebook
                                </button>
                            </div>
                            <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="{{ route('register') }}" class="text-primary">Create</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('assets/js/off-canvas.js')}}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
<script src="{{ asset('assets/js/misc.js')}}"></script>
<!-- endinject -->
</body>
</html>