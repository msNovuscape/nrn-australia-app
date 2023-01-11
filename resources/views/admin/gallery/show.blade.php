@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{--start loader--}}
        <div class="loader loader-default" id="loader"></div>
        {{--end loader--}}

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gallery</h1>
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
                        <h3 class="card-title">Show Gallery</h3>
                        <a href="{{url('admin/gallery')}}" class="back-button btn-green">List</a>
                        <!-- <a href="{{url('admin/gallery/edit/'.$setting->id)}}" class="back-button btn-green">Edit</a> -->

                    </div>
                    <div class="card-body">
                       
                    <div class="col-md-4">
                        <div class="form-group">
                            <b>Event Title:</b>
                            {{$setting->title}}
                        </div>
                        <div class="form-group">
                            <b>Event Date:</b>
                            {{$setting->date}}
                        </div>
                    </div>

                    <div class="form-group">
                        <b>Images:</b>
                        <div class="gallery-images-div">
                            @foreach($setting->gallery_images as $image)
                            <span>
                                <a href="{{url($image->image)}}" target="_blank">
                                    <div class="gallery-images">
                                        <img src="{{url($image->image)}}" class="img-fluid" alt="">
                                    </div>
                                </a>
                            </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <b>Created Date:</b>
                            {{$setting->created_at}}
                        </div>
                    </div>
                      
                    </div>

                               
                      
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


