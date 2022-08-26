@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Course FAQ</h1>
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
                        <h3 class="card-title">Create Course FAQ</h3>
                        <a href="{{url('admin/course_faqs')}}" class="back-button">back</a>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/course_faqs', 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Academic Courses <span style="color: red">*</span> </label>
                                    <select name="academic_course_id" class="form-control" id="type" required >
                                        <option value="" selected disabled>Please select Academic Course</option>
                                        @foreach($settings as $setting)
                                            <option value="{{$setting->id}}" @if(old('academic_course_id') == $setting->id) selected @endif>{{$setting->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Question <span style="color: red">*</span> </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="question" value="{{old('question')}}" required>
                                </div>
                            </div>


                            <div class="col-md-4">
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

                            <div class="col-md-12" >
                                <div class="form-group" >
                                    <label>Answer <span style="color: red">*</span> </label>
                                    <textarea name="answer" class="summernote_class" rows="5" style="height: 658px;" >{{old('answer')}}
            </textarea>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="value_section">

                                </div>
                            </div>

                        </div>
                        <div class="form-group row create-button">
                            <div class="col-sm-10 col-md-12">
                                <button type="submit" class="btn btn-primary">Create</button>
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
        $(document).ready(function() {
            $('.summernote_class').summernote()

        })

    </script>
@endsection

