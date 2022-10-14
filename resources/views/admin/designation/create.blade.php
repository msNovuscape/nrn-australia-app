@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper content-wrapper-bg">
        <!-- Content Header (Page header) -->
        <section class="content-header p-0 mb-4">
            <div class="container-fluid p-0">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Designation</h1>
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
                        <h3 class="card-title">Create Designation</h3>
                        <a href="{{url('admin/designation')}}" class="back-button btn-create">List</a>
                    </div>
                    <div class="card-body pt-0">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/designation', 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">

                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">Title <span style="color: red";> * </span></label>
                                    <input type = "text" value = "{{old('title')}}" name="title" class="form-control" rows="4" required/>
                                </div>
                            </div>

                            <!-- <div class="col-md-12" >
                                <div class="form-group" >
                                    <label>Description <span style="color: red";> * </span></label>
                                    <textarea name="description" id="body1" rows="5" style="height: 658px;" >{{old('description')}}</textarea>
                                </div>
                            </div> -->

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


