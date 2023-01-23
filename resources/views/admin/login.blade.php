
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NRNA | Australia</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
{{--    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">--}}
{!! Html::style('admin/plugins/fontawesome-free/css/all.min.css') !!}
    <!-- icheck bootstrap -->
{{--    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">--}}
{!! Html::style('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}
    <!-- Theme style -->
{{--    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">--}}
    {!! Html::style('admin/dist/css/adminlte.min.css') !!}
    {!! Html::style('admin/css/custom-admin.css') !!}

    <link rel="stylesheet" href="">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="" class="h1">
                <img class="extratech-logo img-fluid" src="{{url(\App\Models\Setting::where('slug','logo')->first()->value ?? '')}}" alt="Insert Logo from Settings">
            </a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            @include('errors.error')
            @include('success.success')
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3 login-icon">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text ">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>

                </div>
                <div class="input-group mb-3 login-icon">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text ">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-8">
                        <a href="{{route('admin.forget_password')}}">
                            <!-- <input type="checkbox" id="remember"> -->
                            <label for="remember">
                                Forget Password?
                            </label>
                        </a>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-create btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
{{--<script src="../../plugins/jquery/jquery.min.js"></script>--}}
{!! Html::script('admin/plugins/jquery/jquery.min.js') !!}
<!-- Bootstrap 4 -->
{{--<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
{!! Html::script('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
<!-- AdminLTE App -->
{{--<script src="../../dist/js/adminlte.min.js"></script>--}}
{!! Html::script('admin/dist/js/adminlte.js') !!}
</body>
</html>
