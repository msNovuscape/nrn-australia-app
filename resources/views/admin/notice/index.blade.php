@extends('admin.layouts.app')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Notice</h1>
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
                                <h3 class="card-title">Notice Table</h3>
                                <div class="card-tools">
                                    <a class="btn btn-create" href="{{url('admin/notices/create')}}" role="button">Create</a>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                @include('success.success')
                                @include('errors.error')
                                <form id="search" class="search-form">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm mb-3 table-search w-100">
                                                <input type="search"  name="title" class="form-control ds-input" placeholder="Search by notice title" aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="filterList()">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm mb-3 table-search w-100">
                                                <select name="status" class="form-control ds-input" onchange="filterList()">
                                                    <option value="" disabled selected>Search By Status</option>
                                                    @foreach(config('custom.status') as $in => $val)
                                                        <option value="{{$in}}">{{$val}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">S.N.</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Notice Type</th>
                                        <th class="text-center">Publish Date</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Slug</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($settings as $setting)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <th scope="row" class="text-center">{{strip_tags($setting->title)}}</th>
                                            <th scope="row" class="text-center">{{config('custom.notice_types')[$setting->notice_type]}}</th>
                                            <td class="text-center">{{$setting->publish_date}}</td>
                                            <td class="text-center">
                                                <a href="{{url($setting->image ?? '')}}" target="_blank">
                                                    <img src="{{url($setting->image ?? '')}}" alt="N/A" style="width: 100px;">

                                                </a>
                                            </td>
                                            <td class="text-center">{{$setting->slug}}</td>
                                            <td class="text-center"> {{config('custom.status')[$setting->status]}}</td>


                                            <td class="text-center">
                                                <div class="d-flex justify-content-center action-icons">
                                                    <a href="{{url('admin/notices/'.$setting->id)}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="view">
                                                        <i class="fas fa-folder"></i>
                                                    </a>
                                                    <a href="{{url('admin/notices/'.$setting->id.'/edit')}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{url('admin/notices/delete/'.$setting->id)}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="delete" onclick="return confirm('Are you sure want to delete?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div class="pagination-page" style="margin-top: 30px;">
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
