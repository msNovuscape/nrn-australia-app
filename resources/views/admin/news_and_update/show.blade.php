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
                        <h1>Show</h1>
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
                        <h3 class="card-title">Show News</h3>
                        <a href="{{url('admin/news')}}" class="back-button btn-green">Back</a>

                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/news/'.$setting->id, 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Title <span style="color: red";> * </span></label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="title" value="{{$setting->title}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Image <span style="color: red";> * </span></label>
                                    <input type="file" class="form-control"   name="image" value="{{old('image')}}" disabled>
                                    <br>
                                    <span >
                                        <img src="{{url($setting->image)}}" alt="" style="width: 100px;">
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Featured News<span style="color: red";> * </span> </label>
                                    <select name="type" id="type" class="form-control" required disabled>
                                        <option value="" selected disabled>Please select</option>
                                        @foreach(config('custom.featured_types') as $in => $val)
                                            <option value="{{$in}}" @if($setting->type == $in) selected @endif>{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>News Type<span style="color: red";> * </span> </label>
                                    <select name="news_type" id="news_type" class="form-control" required disabled>
                                        <option value="" selected disabled>Please select news type</option>
                                        @foreach(config('custom.news_types') as $index => $value)
                                            <option value="{{$index}}" @if($setting->news_type == $index) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Publish Date <span style="color: red";> * </span></label>
                                    <input type="text" class="form-control getDate"   name="publish_date" value="{{$setting->publish_date}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status<span style="color: red";> * </span> </label>
                                    <select name="status" id="status" class="form-control" disabled>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $indexa => $value1)
                                            <option value="{{$indexa}}" @if($setting->status == $indexa) selected @endif>{{$value1}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="news_section">
                            @if($setting->nrn_news)
                                @include('admin.news_and_update.nrna_news')
                            @endif
                            @if($setting->third_party_news)
                                @include('admin.news_and_update.third_party_news')
                            @endif
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


