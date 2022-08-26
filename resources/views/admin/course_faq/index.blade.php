@extends('admin.layouts.app')
@section('content')


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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">FAQ Table</h3>
                                    <div class="card-tools">
                                        <a class="btn btn-primary" href="{{url('admin/course_faqs/create')}}" role="button">Create</a>
                                    </div>
                                </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                @include('success.success')
                                @include('errors.error')

                                <form id="search" class="search-form">
                                    <div class="row">
                                        <div class="input-group input-group-sm mb-3 table-search col-md-3">
                                            <input type="search"  name="name" class="form-control ds-input" placeholder="Question / Answer" aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="filterList()">
                                        </div>

                                        <div class="input-group input-group-sm mb-3 table-search col-md-3">
                                            <select name="course_type" class="form-control ds-input" onchange="filterList()">
                                                <option value="" disabled selected>Search By Academic Courses</option>
                                                @foreach($setting_academic as  $setting)
                                                    <option value="{{$setting->id}}">{{$setting->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="input-group input-group-sm mb-3 table-search col-md-3">
                                            <select name="status" class="form-control ds-input" onchange="filterList()">
                                                <option value="" disabled selected>Search By Status</option>
                                                @foreach(config('custom.status') as $in => $val)
                                                    <option value="{{$in}}" @if(old('status') ==$in) selected @endif>{{$val}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">S.N.</th>
                                        <th class="text-center">Academic Course</th>
                                        <th class="text-center">Question</th>
                                        <th class="text-center">Answer</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($settings as $setting)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-center">{{$setting->academy_course->name}}</td>
                                            <td class="text-center">{{$setting->question}}</td>
                                            <td class="text-center">{{$setting->answer}}</td>
                                            <td class="text-center">{{config('custom.status')[$setting->status]}}</td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" href="{{url('admin/course_faqs/'.$setting->id)}}">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    View
                                                </a>
                                                <a class="btn btn-info btn-sm" href="{{url('admin/course_faqs/'.$setting->id.'/edit')}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div style="margin-top: 10px;">
                                    {!! $settings->links() !!}
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
