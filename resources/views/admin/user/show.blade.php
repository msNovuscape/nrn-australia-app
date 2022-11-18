@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Team</h1>
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
                        <h3 class="card-title">View Team</h3>
                        <a href="{{url('admin/team')}}" class="back-button">List</a>
                    </div>
                    <div class="card-body">
                        <div class="row">

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Type <span style="color: red">*</span> </label>
                                    <select name="team_type" class="form-control" id="type" disabled>
                                        @foreach(config('custom.team_types') as $in => $val)
                                            <option value="{{$in}}" @if($team->team_type == $in) selected @endif >{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Period <span style="color: red">*</span> </label>
                                    <select name="period" class="form-control" id="type" disabled>
                                            <option>{{$team->period->title}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Designation <span style="color: red">*</span> </label>
                                    <select name="designation" class="form-control" id="type" disabled>
                                            <option>{{$team->designation->title}}</option>
                                    </select>
                                </div>
                            </div>
                            @if($team->state_id !== null)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select State <span style="color: red">*</span> </label>
                                    <select name="state" class="form-control" id="type" disabled>
                                    <option {{$team->state_id == 0 ? 'selected' : ''}}>All Australia</option>
                                    @foreach(config('custom.states') as $in => $val)
                                            <option value="{{$in}}"{{($team->state_id == $in) ? 'selected' :  '' }}>{{$val}}</option>
                                     @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">Full Name <span style="color: red";> * </span></label>
                                    <input type = "text" value = "{{$team->full_name}}" name="full_name" class="form-control" rows="4" disabled/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Image <span style="color: red";> * </span></label>
                                    <br>
                                    <span >
                                        <img src="{{url($team->image ?? '' )}}" alt="N/A" style="width: 100px;">
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span> </label>
                                    <select name="status" class="form-control" id="type" disabled>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}"{{($team->status == $in) ? 'selected' :  '' }}>{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="value_section">

                                </div>
                            </div>

                        </div>

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
            ClassicEditor
                .create( document.querySelector( '#body2' ) )
                .catch( error => {
                    // console.error( error );
                } );
            ClassicEditor
                .create( document.querySelector( '#body3' ) )
                .catch( error => {
                    // console.error( error );
                } );

    </script>
@endsection


