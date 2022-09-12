@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper content-wrapper-bg">
        <!-- Content Header (Page header) -->
        <section class="content-header p-0">
            <div class="container-fluid p-0">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Membership Type</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content p-0">
            <div class="container-fluid p-0">
                <!-- SELECT2 EXAMPLE -->
                <div class="card mb-0">

                    <div class="card-header">
                        <h3 class="card-title">Create Membership Type</h3>
                        <a href="{{url('admin/membership_types')}}" class="back-button btn-create">back</a>
                    </div>

                    <div class="card-body pt-0">
                        @include('success.success')
                        @include('errors.error')
                        {!! Form::open(['url' => '/admin/membership_types', 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Membership Type Name <span style="color: red">*</span> </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="name" value="{{old('name')}}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expiration Years</label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="expiration_years" value="{{old('expiration_years')}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Amount<span style="color: red">*</span> </label>
                                    <input type="text" class="form-control"  id="inputPassword3" name="amount" value="{{old('amount')}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <span style="color: red">*</span> </label>
                                    <select name="status" class="form-control" id="type" required>
                                        <option value="" selected disabled>Please select status</option>
                                        @foreach(config('custom.status') as $in => $val)
                                            <option value="{{$in}}" @if(old('status') == $in) selected @endif >{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Eligibility Type <span style="color: red">*</span> </label>
                                    <select  class="form-control"  id="inputPassword3" name="eligibility_type_ids[]" multiple required>
                                        @foreach($eligibility_types as $eligibility_type)
                                            <option value = "{{$eligibility_type->id}}">{{$eligibility_type->title}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="select-block">
                                        <table>
                                            <tbody>
                                                @foreach($eligibility_types as $eligibility_type)
                                                <tr class="d-flex">
                                                    <input class="form-check-input" type="checkbox" name="eligibility_type_ids[]" id="flexCheckDefault">
                                                    <p value="{{$eligibility_type->id}}">{{$eligibility_type->title}}</p>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> -->
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div id="value_section">
                                </div>
                            </div>
                        </div>

                        <div class="row create-button">
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

    <script>
        $(document).ready(function() {
            $('.mdb-select').materialSelect();
        });
    </script>

@endsection


