@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

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
                        <h3 class="card-title">Create Settings</h3>
                        <a href="{{url('admin/settings')}}" class="back-button btn-create">List</a>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/settings', 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="type" class="form-control" id="type" required onchange="getParagraph()">
                                                <option value="" selected disabled>Please select Type</option>
                                                    @foreach(config('custom.setting_types') as $index => $value)
                                                    <option value="{{$index}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control"  id="inputPassword3" name="key">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control" id="type" required>
                                                <option value="" selected disabled>Please select Status</option>
                                                @foreach(config('custom.status') as $in => $val)
                                                    <option value="{{$in}}">{{$val}}</option>
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
                                <div class="form-group row create-button">
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
        $(function () {
            // Summernote
            $('#summernote').summernote()

        })
        function getParagraph() {
            var val = $('#type').val();
            var html = '';
            $('#sentence').remove();
            $('#paragraph').remove();
            $('#image').remove();
            if(val == 1){
                html += '<div class="col-md-12" id="sentence">'+
                            '<div class="form-group">'+
                                '<label>Sentence</label>'+
                                '<input type="text" class="form-control" id="inputPassword4"  name="value">'+
                            '</div>'+
                        '</div>';
                $('#value_section').append(html);
            }else if(val == 2){
                html += '<div class="col-md-12" id="paragraph">'+
                    '<div class="form-group">'+
                    '<label>Paragraph</label>'+
                    '<textarea id="summernote" name="value" ></textarea>'+
                    '</div>'+
                    '</div>';
                $('#value_section').append(html);
                $('#summernote').summernote()
                // initTinymce();
            }else {
                html += '<div class="col-md-6" id="image">'+
                    '<div class="form-group">'+
                    '<label>Image</label>'+
                    '<input type="file" class="form-control" id="inputPassword4"  name="value">'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-md-6" id="image">'+
                    '<div class="form-group">'+
                    '<label>Image alt</label>'+
                    '<input type="text" class="form-control" id="inputPassword4"  name="image_alt">'+
                    '</div>'+
                    '</div>';
                $('#value_section').append(html);
            }
        }
    </script>
@endsection

