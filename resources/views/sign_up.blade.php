<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card card-signin flex-row my-5">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image for card set in CSS! -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Register</h5>
                        <form action="{{ route('register') }}" method="POST" class="form-signin">
                            @csrf

                            {{ $errors->first('username') }}
                            <div class="form-label-group">
                                <input type="text" name="username" value="{{ old('username') }}" id="inputUsername" class="form-control" placeholder="Username" />
                                <label for="inputUsername">Username</label>
                            </div>

                            {{ $errors->first('email') }}
                            <div class="form-label-group">
                                <input type="email" name="email" value="{{ old('email') }}" id="inputEmail" class="form-control" placeholder="Email address" />
                                <label for="inputEmail">Email address</label>
                            </div>

                            <hr />

                            {{ $errors->first('password') }}
                            <div class="form-label-group">
                                <input type="password" name="password" value="{{ old('password') }}" id="inputPassword" class="form-control" placeholder="Password" />
                                <label for="inputPassword">Password</label>
                            </div>

                            {{ $errors->first('confirm') }}
                            <div class="form-label-group">
                                <input type="password" name="confirm" value="{{ old('confirm') }}" id="inputConfirmPassword" class="form-control" placeholder="Password" />
                                <label for="inputConfirmPassword">Confirm password</label>
                            </div>

                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button>
                            <a class="d-block text-center mt-2 small" href="{{ route('sign_in') }}">Sign In</a>
                            <hr class="my-4" />
                            <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign up with Google</button>
                            <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</html>
