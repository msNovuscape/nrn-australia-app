@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Clients </h1>
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
                        <h3 class="card-title"> Client Edit</h3>
                        <a href="{{url('admin/clients')}}" class="back-button">back</a>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => 'admin/clients/'.$setting->id, 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Logo <span style="color: red";> * </span> </label>
                                    <input type="file" class="form-control"  id="logo" name="logo"  value="{{$setting->logo}}">
                                    <br>
                                    <span>
                                        <a href="{{url($setting->logo)}}" target="_blank">
                                            <img src="{{url($setting->logo)}}" alt="" style="width: 100px">
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Image Alt</label>
                                    <input type="text" class="form-control"  id="image_alt" name="image_alt" required value="{{$setting->image_alt}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Link <span style="color: red";> * </span> </label>
                                    <input type="text" class="form-control"  id="link" name="link" required value="{{$setting->link}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status <span style="color: red";> * </span> </label>
                                    <select name="status" class="form-control" id="status" required>
                                        <option value="" selected disabled>Please Select Status Type</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}"{{($setting->status==$in) ? 'selected' : ''}}>{{$val}}</option>
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
        $(function () {
            // Summernote
            $('.summernote_class').summernote()

        })
    </script>
@endsection

