@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Document</h1>
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
                        <h3 class="card-title">Update Document</h3>
                        <a href="{{url('admin/document')}}" class="back-button">List</a>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/document/'.$setting->id, 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">
                        <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">Document Category <span style="color: red";> * </span></label>
                                    <select name="document_category" id="document_category" class="form-control" required">
                                        <option value="" selected disabled>Please select category</option>
                                        @foreach($document_categories as $category)
                                        <option @if ($category -> id == $setting->document_category_id) selected @endif value = "{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>    
                                </div>
                            </div>

                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">Period <span style="color: red";> * </span></label>
                                    <select name="period" id="period" class="form-control" required">
                                        <option value="" selected  disabled>Please select period</option>
                                        @foreach($periods as $period)
                                        <option @if ($period -> id == $setting->period_id) selected @endif value = "{{$period->id}}">{{$period->title}}</option>
                                        @endforeach
                                    </select>    
                                </div>
                            </div>

                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">Title <span style="color: red";> * </span></label>
                                    <input type = "text" value = "{{$setting->title}}" name="title" class="form-control" rows="4" required/>
                                </div>
                            </div>

                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">File <span style="color: red";> * </span></label>
                                    <input type = "file" value = "{{old('file')}}" name="file" class="form-control" rows="4"/>
                                </div>
                                <a target = "_blank" href="{{url($setting->file)}}" class="d-flex">
                                            <div class="profile-icon mr-2">
                                                <img src="{{url('admin/images/view-icon.png')}}" alt="">
                                            </div>
                                            <p>View File</p>
                                        </a>
                            </div>

                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">Image <span style="color: red";></span></label>
                                    <input type = "file" value = "{{old('image')}}" name="image" class="form-control" rows="4"/>
                                </div>
                                <span>
                                        <a href="{{url($setting->image ?? '')}}" target="_blank">
                                            <img src="{{url($setting->image ?? '')}}" alt="">
                                        </a>
                                    </span>
                            </div>

                            <div class="col-md-6" >
                                <div class="form-group" >
                                    <label class="w-100">Publish Date</label>
                                    <input type = "date" value = "{{$setting->publish_date}}" name="publish_date" class="form-control" rows="4" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span> </label>
                                    <select name="status" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}"{{($setting->status == $in) ? 'selected' :  '' }}>{{$val}}</option>
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
            
      
       

    </script>
@endsection

