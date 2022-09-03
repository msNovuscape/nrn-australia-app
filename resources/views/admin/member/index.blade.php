@extends('admin.layouts.app')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Members</h1>
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
                                <h3 class="card-title">Members Table</h3>
                            </div>
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
                                        <th class="text-center">Full Name</th>
                                        <th class="text-center">DOB</th>
                                        <th class="text-center">Mobile Number</th>
                                        <th class="text-center">Membership Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($settings as $setting)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-center">{{$setting->first_name. ($setting->middle_name ? ' '.$setting->middle_name.' '.$setting->last_name : ' '.$setting->last_name)}}</td>
                                            <td class="text-center">{{$setting->dob}}</td>
                                            <td class="text-center">{{$setting->mobile_number}}</td>
                                            <td class="text-center">{{config('custom.membership_status')[$setting->membership_status_id]}}</td>
                                            <td class="d-flex justify-content-center action-icons">
                                                <a href="{{url('admin/members/'.$setting->id.'/show')}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a href="{{url('admin/members/delete/'.$setting->id)}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="delete" onclick="return confirm('Are you sure want to delete?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                            <th scope="row">1</th>
                                            <td class="text-center">Mahesh Sharma</td>
                                            <td class="text-center">2022-09-02</td>
                                            <td class="text-center">0987654321</td>
                                            <td class="text-center">Verified</td>
                                            <td class="d-flex justify-content-center action-icons">
                                                <a href="members/1/" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="show">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a href="" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="delete" onclick="return confirm('Are you sure want to delete?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
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
