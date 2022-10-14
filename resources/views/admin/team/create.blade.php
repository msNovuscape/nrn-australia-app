@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper content-wrapper-bg">
        <!-- Content Header (Page header) -->
        <section class="content-header p-0 mb-4">
            <div class="container-fluid p-0">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Team</h1>
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
                        <h3 class="card-title">Create Team</h3>
                        <a href="{{url('admin/team')}}" class="back-button btn-create">List</a>
                    </div>
                    <div class="card-body pt-0">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/team', 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Type <span style="color: red">*</span> </label>
                                    <select name="team_type" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select team type</option>
                                        @foreach(config('custom.team_types') as $in => $val)
                                            <option value="{{$in}}" @if(old('status') == $in) selected @endif >{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Period <span style="color: red">*</span> </label>
                                    <select name="period" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select team period</option>
                                        @foreach($teamPeriods as $team_period)
                                            <option value="{{$team_period->id}}" @if(old('period') == $team_period->id) selected @endif >{{$team_period->title}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Designation <span style="color: red">*</span> </label>
                                    <select name="designation" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}" @if(old('designation') == $designation->id) selected @endif >{{$designation->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select State <span style="color: red">*</span> </label>
                                    <select name="state" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select state</option>
                                        <option value = "0" @if(old('state') == '0') selected @endif>All Australia</option>
                                        @foreach(config('custom.states') as $in => $val)
                                            <option value="{{$in}}" @if(old('state') == $in) selected @endif >{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">Full Name <span style="color: red";> * </span></label>
                                    <input type = "text" value = "{{old('full_name')}}" name="full_name" class="form-control" rows="4" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Image <span style="color: red";> * </span></label>
                                    <input type="file" class="form-control"   name="image" value="{{old('image')}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span> </label>
                                    <select name="status" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}" @if(old('status') == $in) selected @endif >{{$val}}</option>
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
                                <button type="submit" class="btn btn-create">Create</button>
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
                .catch( error => {
                    // console.error( error );
                } );
                
    </script>
@endsection


