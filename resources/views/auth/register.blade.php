<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enlink - Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/assets/images/logo/favicon.png') }}">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{ asset('/assets/css/app.min.css') }}" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex"
            style="background-image: url('/public/assets/images/others/login-3.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <img class="img-fluid" alt=""
                                            src="{{ asset('/assets/images/logo/logo.png') }}">
                                        <h2 class="m-b-0">Sign In</h2>
                                    </div>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group">
                                            <i class="prefix-icon anticon anticon-user"></i>
                                            <label class="font-weight-semibold" for="name">Name:</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                placeholder="Name" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <i class="prefix-icon anticon anticon-user"></i>
                                            <label class="font-weight-semibold" for="email">Email:</label>
                                            <input type="text" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                placeholder="Email" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <i class="prefix-icon anticon anticon-lock"></i>
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <a class="float-right font-size-13 text-muted"
                                                href="{{ url('') }}">Forget Password?</a>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" placeholder="Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <i class="prefix-icon anticon anticon-lock"></i>
                                            <label class="font-weight-semibold" for="password">Password
                                                Confirmation:</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password-confirm" name="password_confirmation"
                                                placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted">
                                                    Have an account?
                                                    <a class="small" href="{{ route('login') }}">
                                                        Singin</a>
                                                </span>
                                                <button class="btn btn-primary">Sign Up</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="">© 2019 ThemeNate</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="/">Legal</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="/">Privacy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{ asset('/assets/js/vendors.min.js') }}"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="{{ asset('/assets/js/app.min.js') }}"></script>

</body>

</html>
