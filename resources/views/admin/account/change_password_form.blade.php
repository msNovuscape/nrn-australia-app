@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper content-wrapper-bg">
        <!-- Content Header (Page header) -->
        <section class="content-header p-0">
            <div class="container-fluid p-0">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Account Settings</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content p-0">
            <div class="container-fluid p-0">
                <!-- SELECT2 EXAMPLE -->
                <div class="card mb-0">

                    <div class="card-header">
                        <h3 class="card-title">Change password</h3>
                        <!-- <a href="{{url('admin/change_password')}}" class="back-button btn-create">back</a> -->
                    </div>

                    <div class="card-body pt-0">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/change_password', 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Old Password<span style="color: red">*</span> </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="old_password" value="{{old('old_password')}}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-control"  id="inputPassword3" name="password" value="{{old('password')}}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Confirm New Password<span style="color: red">*</span> </label>
                                    <input type="password" class="form-control"  id="inputPassword3" name="password_confirmation" value="{{old('password_confirmation')}}" required>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div id="value_section">
                                </div>
                            </div>
                        </div>
                        <a href="{{route('admin.forget_password')}}">
                            <!-- <input type="checkbox" id="remember"> -->
                            <label for="remember">
                                Forget Password?
                            </label>
                        </a>
                        <div class="row create-button">
                            <div class="col-sm-10 col-md-12">
                                <button type="submit" class="btn btn-create">Create</button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            $('.mdb-select').materialSelect();
        });
    </script>

@endsection


