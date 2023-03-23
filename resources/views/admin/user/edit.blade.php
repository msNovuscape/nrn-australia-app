@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Update User</h3>
                        <a href="{{url('admin/users')}}" class="back-button">List</a>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/users/'.$user->id, 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label>Select Role <span style="color: red">*</span> </label>
                                    <select name="role" class="form-control" id="role" required onchange="hideState(this.value)">
                                        <option value="" selected disabled>Please select role for user</option>
                                        @foreach($roles as $value)
                                            <option value="{{$value['id']}}" @if($user->roles->first()->id == $value['id']) selected @endif>{{$value['name']}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id = "state-div">
                                <div class="form-group">
                                    <label>State <span style="color: red">*</span> </label>
                                    <select name="state" class="form-control" id="type">
                                        <option value="" selected disabled>Please select state</option>
                                        @foreach(config('custom.states') as $in => $val)
                                            <option value="{{$in}}" @if($user->state_id == $in) selected @endif>{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">Name <span style="color: red";> * </span></label>
                                    <input type = "text" value = "{{$user->full_name}}" name="full_name" class="form-control" rows="4" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Email <span style="color: red";> * </span></label>
                                    <input type="text" class="form-control"   name="email" value="{{$user->email}}">
                                </div>
                            </div>

                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label> Password <span style="color: red";> * </span></label>
                                    <input type="text" class="form-control"   name="password" value="{{old('password')}}">
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span> </label>
                                    <select name="status" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}" @if($user->status == $in) selected @endif>{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="value_section">

                                </div>
                            </div>

                        </div>
                        <div class="row create-button">
                            <div class="col-sm-10 col-md-12">
                                <button type="submit" class="btn btn-create">Update</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
ClassicEditor
                .create( document.querySelector( '#body1' ) )

                function hideState(role){
                    if(role == 3){
                        $('#state-div').show();
                    }else{
                        $('#state-div').hide();
                    }
                }
                document.addEventListener( 'DOMContentLoaded', function() {
                    if($('#role').val() != 3){
                        $('#state-div').hide();
                    }
                } );







    </script>
@endsection

