@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Slider</h1>
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
                        <h3 class="card-title">Edit Slider</h3>
                        <a href="{{url('admin/sliders')}}" class="back-button">List</a>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/sliders/'.$slider->id, 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label> Image <span style="color: red";> * </span></label>
                                    <input type="file" class="form-control" name="image" value="{{old('image')}}">
                                    <br>
                                    <span>
                                        <img src="{{url($slider->image ?? '' )}}" alt="N/A" style="width: 100px;">
                                    </span>
                            </div>

                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">Order <span style="color: red";> * </span></label>
                                    <input type = "number" value = "{{$slider->order}}" name="order" class="form-control" rows="4" required/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span> </label>
                                    <select name="status" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}"{{($slider->status == $in) ? 'selected' :  '' }}>{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row create-button">
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





    </script>
@endsection

