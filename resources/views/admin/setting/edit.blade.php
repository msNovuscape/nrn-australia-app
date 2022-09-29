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
                        <h3 class="card-title">Edit Settings</h3>
                        <a href="{{url('admin/settings')}}" class="back-button btn-create">List</a>
                        <a class="btn-create back-button mx-2" href="http://127.0.0.1:8000/admin/settings/create" role="button">Create</a>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/settings/'.$setting->id, 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Type{{$setting->type}}</label>
                                    <select name="type" class="form-control" id="type" required onchange="getParagraph()">
                                        <option value="" selected disabled>Please select Type</option>
                                        @foreach(config('custom.setting_types') as $index => $value)
                                            <option value="{{$index}}" @if($setting->type == $index) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="key" value="{{$setting->key}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}" @if($setting->status == $in) selected @endif>{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="value_section">
                                    @if($setting->type == array_search('Sentence',config('custom.setting_types')))
                                        <div class="col-md-12" id="sentence">
                                        <div class="form-group">
                                            <label>Sentence</label>
                                            <input type="text" class="form-control" id="inputPassword4"  name="value" value="{{$setting->value}}">
                                            </div>
                                        </div>
                                    @elseif($setting->type == array_search('Paragraph',config('custom.setting_types')))
                                        <div class="col-md-12" id="paragraph">
                                            <div class="form-group">
                                                <label>Paragraph</label>
                                                <textarea id="summernote" name="value" >{!!  $setting->value !!}</textarea>
                                                </div>
                                        </div>
                                    @elseif($setting->type == array_search('Image',config('custom.setting_types')))
                                        <div class="col-md-12" id="image">
                                            <div class="form-group col-md-6">
                                                <label>Image</label>
                                                <input type="file" class="form-control" id="inputPassword4"  name="value">
                                                <br>
                                                <span style="margin-left: 100px;">
                                                    <a href="{{url($setting->value)}}" target="_blank">
                                                        <img src="{{url($setting->value)}}" alt="" style="width: 100px;">
                                                    </a>
                                                </span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Image Alt</label>
                                                @if($setting->setting_alt)
                                                    <input type="text" class="form-control" id="inputPassword4"  name="image_alt" value="{{$setting->setting_alt->image_alt}}">
                                                @else
                                                    <input type="text" class="form-control" id="inputPassword4"  name="image_alt" >
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
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
                html += '<div class="col-md-12" id="image">'+
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

