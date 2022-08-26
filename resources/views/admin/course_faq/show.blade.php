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
                        <h3 class="card-title">View Course FAQ</h3>
                        <a href="{{url('admin/course_faqs')}}" class="back-button">back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Course <span style="color: red">*</span> </label>
                                    <select name="academic_course_id" class="form-control" id="type" required disabled>
                                        <option value="" selected disabled>Please select Academic Course</option>
                                        @foreach($academic_courses as $academic_course)
                                            <option value="{{$academic_course->id}}" {{($setting->academy_course->id == $academic_course->id) ? 'selected':''}}>{{$academic_course->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Question <span style="color: red">*</span> </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="question" value="{{$setting->question}}" required disabled>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span> </label>
                                    <select name="status" class="form-control" id="type" required disabled>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}"{{($setting->status==$in) ? 'selected' : '' }}>{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12" >
                                <div class="form-group" >
                                    <label>Answer <span style="color: red">*</span> </label>
                                    <textarea name="answer" class="summernote_class" rows="5" style="height: 658px;" >{{$setting->answer}}
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

