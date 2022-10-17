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
                        <h3 class="card-title">Update Team</h3>
                        <a href="{{url('admin/team')}}" class="back-button">List</a>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/team/'.$team->id, 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Type <span style="color: red">*</span> </label>
                                    <select name="team_type" class="form-control" id="type" onchange="hideState(this.value)" required>
                                        <option value="" selected disabled>Please select team type</option>
                                        @foreach(config('custom.team_types') as $in => $val)
                                            <option value="{{$in}}" @if($team->team_type == $in) selected @endif >{{$val}}</option>
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
                                            <option value="{{$team_period->id}}" @if($team->period_id == $team_period->id) selected @endif >{{$team_period->title}}</option>
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
                                            <option value="{{$designation->id}}" @if($team->designation_id == $designation->id) selected @endif >{{$designation->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id = "state-div">
                                <div class="form-group">
                                    <label>Select State <span style="color: red">*</span> </label>
                                    <select name="state" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select state</option>
                                        <option value = "0" @if($team->state_id == 0) selected @endif>All Australia</option>
                                        @foreach(config('custom.states') as $in => $val)
                                            <option value="{{$in}}" @if($team->state_id == $in) selected @endif >{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">Full Name <span style="color: red";> * </span></label>
                                    <input type = "text" value = "{{$team->full_name}}" name="full_name" class="form-control" rows="4" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Image <span style="color: red";> * </span></label>
                                    <input type="file" class="form-control"   name="image" value="{{old('image')}}">
                                    <br>
                                    <span >
                                        <img src="{{url($team->image ?? '' )}}" alt="N/A" style="width: 100px;">
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span> </label>
                                    <select name="status" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}"{{($team->status == $in) ? 'selected' :  '' }}>{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>
                        
                        <div class="form-group row create-button">
                            <div class="col-sm-10 col-md-12">
                                <button type="submit" class="btn btn-primary">Update</button>
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
            
                function hideState(team_type){
                    if(team_type == 1){
                        $('#state-div').hide();
                    }else{
                        $('#state-div').show();
                    }
                }

                document.addEventListener( 'DOMContentLoaded', function() {
                    if($('#type').val() == 1){
                        $('#state-div').hide();
                    }
                } );





       

    </script>
@endsection

