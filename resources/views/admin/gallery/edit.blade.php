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
                        <h3 class="card-title">Edit Gallery</h3>
                        <a href="{{url('admin/gallery')}}" class="back-button btn-green">Back</a>

                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/gallery/'.$setting->id, 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Title <span style="color: red";> * </span></label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="title" value="{{$setting->title}}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Event Date <span style="color: red";> * </span></label>
                                    <input type="date" class="form-control getDate"   name="date" value="{{$setting->date}}" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
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
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label> Image <span style="color: red";> * </span></label>
                                    <input type="file" class="form-control"   name="images[]" multiple>
                                    <p>Please, Shift + Click to upload multiple images.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status<span style="color: red";> * </span> </label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $indexa => $value1)
                                            <option value="{{$indexa}}" @if($setting->status == $indexa) selected @endif>{{$value1}}</option>
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

        function getNewsType() {
            var news_type = $('#news_type').val();
            var news_id = '<?php echo $setting->id ; ?>';
            start_loader();
            $.ajax({
                type: 'GET',
                url:Laravel.url+'/admin/news_type/'+news_type+'/'+news_id,
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

