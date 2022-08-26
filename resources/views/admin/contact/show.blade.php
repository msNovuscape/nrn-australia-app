@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contact</h1>
                        <a href="{{url('admin/contacts')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">List</a>
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
                        <h3 class="card-title">View Contact</h3>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="service_name">Contact Person Name:</label>
                                          {{$contact->name}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="email">Email:</label>
                                          {{$contact->email}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="query_type">Query Type:</label>
                                          {{$contact->query_type == '1' ? 'Contact Query' : 'Quick Enquiry'}}
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="contact_us_type">Contact Type:</label>
                                          {{$contact->contact_description->contact_us_type == '1' ? 'Academy' : 'Service'}}
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Message:</label>
                                          {{$contact->contact_description->message}} 
                                       </div>
                                    </div>
                                </div>
                                </br>
   

            
            {!! Form::close() !!}
            </div>
                </div>
            </div>
        </section>
    </div>
@endsection