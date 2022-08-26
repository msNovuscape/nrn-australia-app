@extends('admin.layouts.app')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Enrollments</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Enrollments Table</h3>
                                    <div class="card-tools">
{{--                                         <a href="{{url('admin/sliders/create')}}" class="btn btn-primary" role="button" >Create</a>--}}
                                    </div>
                                </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                @include('success.success')
                                @include('errors.error')
                                <form id="search" class="search-form">
                                    <div class="row">
                                        <div class="input-group input-group-sm mb-3 table-search col-md-3">
                                            <input type="search"  name="name" class="form-control ds-input" placeholder="Name / Course Name" aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="filterList()">
                                        </div>
                                    </div>
                                </form>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">S.N.</th>
                                        <th class="text-center">Full Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Mobile</th>
                                        <th class="text-center">Academy Course</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($personal_details as $personal_detail)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-center">{{$personal_detail->first_name . ' '.$personal_detail->last_name}}</td>
                                            <td class="text-center">{{$personal_detail->email}}</td>
                                            <td class="text-center">{{$personal_detail->residental_address}}</td>
                                            <td class="text-center">{{$personal_detail->mobile_no}}</td>
                                            <td class="text-center">{{$personal_detail->academy_course->name}}</td>

                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" href="{{url('admin/enrollments/'.$personal_detail->id.'/view')}}">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    View
                                                </a>
{{--                                                <a class="btn btn-primary btn-sm" href="{{url('admin/enrollments/pdf/'.$personal_detail->id)}}">--}}
{{--                                                    <i class="fas fa-folder">--}}
{{--                                                    </i>--}}
{{--                                                    PDF--}}
{{--                                                </a>--}}



                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div style="margin-top: 10px;">
                                                                        {!! $personal_details->links() !!}
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
