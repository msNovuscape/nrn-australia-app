@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Show Blogs</h1>
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
                        <h3 class="card-title">Show Blogs</h3>
                        <a href="{{url('admin/blogs')}}" class="back-button btn-green">List</a>
                        <a href="{{url('admin/blogs/'.$setting->id.'/edit')}}" class="mx-2 back-button btn-green">Edit</a>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Title </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="title" value="{{$setting->title}}" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Author </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="author" value="{{$setting->author}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Image</label>
                                    <br>
                                    <span>
                                        <a href="{{url($setting->image)}}" target="_blank">
                                            <img src="{{url($setting->image)}}" alt="" style="width: 100px">
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Image Caption </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="image_caption" value="{{$setting->image_caption}}" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Image Credit </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="image_credit" value="{{$setting->image_credit}}" disabled>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Image alt</label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="image_alt" value="{{$setting->image_alt}}" disabled>
                                </div>
                            </div>


                            <div class="col-md-12" >
                                <div class="form-group" >
                                    <label>Top Description</label>
                                    <textarea name="description" class="summernote_class" rows="5" style="height: 658px;" >{{$setting->description}}
                                     </textarea>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group" >
                                    <label>Middle Description</label>
                                    <textarea name="middle_description" class="summernote_class" rows="5" style="height: 658px;" >{{$setting->middle_description}}
                                     </textarea>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group" >
                                    <label>Bottom Description</label>
                                    <textarea name="bottom_description" class="summernote_class" rows="5" style="height: 658px;" >{{$setting->bottom_description}}
                                     </textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seo Title</label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="seo_title" value="{{$setting->seo_title}}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Keyword </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="keyword" value="{{$setting->keyword}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seo Description</label>
                                    <textarea class="summernote_class" name="seo_description">{{$setting->seo_description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Meta Keyword</label>
                                    <textarea class="summernote_class" name="meta_keyword"  >{{$setting->meta_keyword}}</textarea>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Publish Date </label>
                                    <input type="text" class="form-control getDate"  id="inputPassword3" name="publish_date" value="{{$setting->publish_date}}" disabled>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="blog_type" class="form-control" id="blog_type" required disabled>
                                        <option value="" selected disabled>Please select Blog Type</option>
                                        @foreach(config('custom.blog_types') as $index => $value)
                                            <option value="{{$index}}" {{( $setting->blog_type ==$index) ? 'selected':''}}>{{$value}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" id="type" required disabled>
                                        <option value="" selected disabled>Please select Status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}" {{($setting->status ==$in) ? 'selected':''}}>{{$val}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        @if($setting->news_and_update_points->count() > 0)
                            <div class="row" id="point_dom">
                                <div class="col-md-6 rel-close" id="point_row_1">
                                    <div class="dom-box">
                                        <div class="add-points card">
                                            <div class="form-group" id="point_g_1" >
                                                <label for="">Title</label> <br>
                                                <input type="text" name="point_title" id="title1"  placeholder="title" value="{{$setting->point_title}}" disabled> <br>
                                                <label for="">Points</label>
                                                <br>
                                                @foreach($setting->news_and_update_points as $point)
                                                    <div id="point_old{{$point->id}}" class="point1" >
                                                        <input type="text" class="point"  name="point_old[]"  placeholder="points" value="{{$point->point}}" disabled> <br>
                                                        <input type="hidden"   name="point_old_id[]"  placeholder="points" value="{{$point->id}}"> <br>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
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

