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
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Logo </label>
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
                                    <input type="text" class="form-control"  id="image_alt" name="image_alt" required value="{{$setting->image_alt}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Link </label>
                                    <input type="text" class="form-control"  id="link" name="link" required value="{{$setting->link}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status </label>
                                    <select name="status" class="form-control" id="status" required disabled>
                                        <option value="" selected disabled>Please Select Status Type</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}"{{($setting->status==$in) ? 'selected' : ''}}>{{$val}}</option>
                                        @endforeach
                                    </select>
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
        $(function () {
            // Summernote
            $('.summernote_class').summernote()

        })
    </script>
@endsection

