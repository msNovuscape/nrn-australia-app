@extends('admin.layouts.app')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Membership Type</h1>
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
                                <h3 class="card-title">Membership Type Table</h3>
                                    <div class="card-tools">
                                        <a class="btn btn-create" href="{{url('admin/membership_types/create')}}" role="button">Create</a>
                                    </div>
                                </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @include('success.success')
                                @include('errors.error')
                                <form id="search" class="search-form">
                                    <div class="row">
                                        <div class="input-group input-group-sm mb-3 table-search col-md-3">
                                            <input type="search"  name="name" class="form-control ds-input" placeholder="Author name / Heading " aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="filterList()">
                                        </div>
                                        <div class="input-group input-group-sm mb-3 table-search col-md-3">
                                            <select name="status" class="form-control ds-input" onchange="filterList()">
                                                <option value="" disabled selected>Search By Status</option>
                                                @foreach(config('custom.status') as $in => $val)
                                                    <option value="{{$in}}">{{$val}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">S.N.</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Expiration Years</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($settings as $setting)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-center">{{$setting->name}}</td>
                                            <td class="text-center">{{$setting->expiration_years ?? 'Forever'}}</td>
                                            <td class="text-center">{{$setting->amount}}</td>
                                            <td class="text-center">{{config('custom.status')[$setting->status]}}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center action-icons">
                                                    <a href="{{url('admin/membership_types/'.$setting->id.'/edit')}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{url('admin/membership_types/delete/'.$setting->id)}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="delete" onclick="return confirm('Are you sure want to delete?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
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
