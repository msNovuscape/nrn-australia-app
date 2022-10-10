@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper content-wrapper-bg">
        {{--start loader--}}
        <div class="loader loader-default" id="loader"></div>
        {{--end loader--}}

        <!-- Content Header (Page header) -->
        <section class="content-header p-0">
            <div class="container-fluid p-0">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content p-0">

            <div class="container-fluid p-0">
                <div class="card mb-0">

                    <div class="card-header">
                        <h3 class="card-title">Create Project</h3>
                        <a href="{{url('admin/projects')}}" class="back-button btn-create">List</a>
                    </div>

                    <div class="card-body pt-0">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/projects', 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Title <span style="color: red";> * </span></label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="title" value="{{old('title')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Image <span style="color: red";> * </span></label>
                                    <input type="file" class="form-control"   name="image" value="{{old('image')}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Excerpt <span style="color: red";> * </span></label>
                                    <input type="text" class="form-control"   name="excerpt" value="{{old('excerpt')}}">
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Featured News<span style="color: red";> * </span> </label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="" selected disabled>Please select</option>
                                        @foreach(config('custom.featured_types') as $in => $val)
                                            <option value="{{$in}}" @if(old('type') == $in) selected @endif>{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Project Type<span style="color: red";> * </span> </label>
                                    <select name="project_type" id="news_type" class="form-control" required onchange="getNewsType()">
                                        <option value="" selected disabled>Please select project type</option>
                                        @foreach(config('custom.notice_types') as $index => $value)
                                            <option value="{{$index}}" @if(old('news_type') == $index) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Publish Date <span style="color: red";> * </span></label>
                                    <input type="date" class="form-control getDate"   name="publish_date" value="{{old('publish_date')}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status<span style="color: red";> * </span> </label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $indexa => $value1)
                                            <option value="{{$indexa}}" @if(old('news_type') == $indexa) selected @endif>{{$value1}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="news_section">
                        </div>

                        <div class="row create-button">
                            <div class="col-sm-10 col-md-12">
                                <button type="submit" class="btn btn-create" onclick="validateForm()">Create</button>
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

        function getNewsType() {
            var news_type = $('#news_type').val();
            start_loader();
            $.ajax({
                type: 'GET',
                url:Laravel.url+'/admin/news_type/'+news_type,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                success:function(data){
                    end_loader()
                    $('.my_section').remove();
                    $('#news_section').append(data['html']);
                    getCk();

                },
                error: function(error) {
                    end_loader()
                }
            });
        }
        function getCk(){
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
        }
        $(document).ready(function() {
            $('.summernote_class').summernote()
        })

        function validateForm(){
            $('#body1').removeAttr('required');
            $('#body2').removeAttr('required');
            $('#body3').removeAttr('required');
        }
    </script>



@endsection

