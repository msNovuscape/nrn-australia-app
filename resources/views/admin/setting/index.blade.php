@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

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
                            <h3 class="card-title">Settings Table</h3>
                                <div class="card-tools">
                                    <a class="btn btn-create" href="{{url('admin/settings/create')}}" role="button">Create</a>
                                </div>
                            </div>
                            <!-- this is the table and the pagination -->
                            <div class="card-body">
                                @include('success.success')
                                @include('errors.error')
                                <form id="search" class="search-form">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm mb-3 table-search w-100">
                                                <input type="search" name="name" class="form-control ds-input" placeholder="name" aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="filterList()">
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
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Slug</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Value</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($settings as $setting)

                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-center">{{$setting->key}}</td>
                                            <td class="text-center">{{$setting->slug}}</td>
                                            <td class="text-center">{{config('custom.setting_types')[$setting->type]}}</td>
                                            @if($setting->type == array_search('Image',config('custom.setting_types')))
                                                <td>
                                                    <a href="{{url($setting->value)}}" target="_blank">
                                                        <img src="{{url($setting->value)}}" alt="">
                                                    </a>
                                                </td>
                                            @else
                                                <td>{!! Str::limit($setting->value,100,'......') !!}</td>
                                            @endif
                                            <td class="text-center">
                                                {{config('custom.status')[$setting->status]}}
                                            </td>

                                            <!-- <td class="text-center">
                                                <a class="btn btn-primary btn-sm" href="{{url('admin/settings/'.$setting->id)}}">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    View
                                                </a>
                                                <a class="btn btn-info btn-sm" href="{{url('admin/settings/'.$setting->id.'/edit')}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?');" href="{{url('admin/settings/'.$setting->id.'/delete')}}">
                                                    <i class="fas fa-trash">
                                                        </i>
                                                            Delete
                                                        </a>
                                            </td> -->

                                            <td class="text-center">
                                                <div class="action-icons d-flex justify-content-center">
                                                    <a href="{{url('admin/settings/'.$setting->id)}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="view">
                                                        <i class="fas fa-folder"></i>
                                                    </a>
                                                    <a href="{{url('admin/settings/'.$setting->id.'/edit')}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{url('admin/settings/'.$setting->id.'/delete')}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="delete" onclick="return confirm('Are you sure you want to delete?');">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-default" style="margin-top: 30px;">
                                    {!! $settings->links() !!}
                                </div>
                                <!-- this is the table and the pagination -->
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

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    <script>
        const exampleEl = document.getElementById('example')
        const tooltip = new bootstrap.Tooltip(exampleEl, options)
    </script>
@endsection
