@extends('admin.layouts.app')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contacts</h1>
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
                            <div class="card-header d-flex flex-column">
                                <h3 class="card-title">Contacts Table</h3>
                                 <div class="card-tools">
{{--                                        <a class="btn btn-primary" href="{{url('admin/projects/create')}}" role="button">Create</a>--}}
                                    </div>
                                </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @include('success.success')
                                @include('errors.error')

                                <form id="search" class="search-form">
                                    <div class="row">
                                        <div class="input-group input-group-sm mb-3 table-search col-md-3">
                                            <input type="search"  name="name" class="form-control ds-input" placeholder="Name / Query Type" aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="filterList()">
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
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Query Type</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-center">{{$contact->name}}</td>
                                            <td class="text-center">{{$contact->email}}</td>
                                            <td class="text-center">{{$contact->query_type == '1' ? 'Contact' : 'Quick Enquiry'}}</td>

                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" href="{{url('admin/contacts/'.$contact->id.'/view')}}">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    View
                                                </a>



                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div style="margin-top: 10px;">
                                                                        {!! $contacts->links() !!}
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
