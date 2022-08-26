@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Enrollment</h1>
                        <a href="{{url('admin/enrollments')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">List</a>
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
                        <h3 class="card-title">View Enrollment</h3>
                    </div>
                    <div class="card-body">
                        @include('success.success')
                        @include('errors.error')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="service_name">Full Name:</label>
                                          {{$personal_detail->first_name . ' ' . $personal_detail->last_name}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="service_name">Gender:</label>
                                          {{$personal_detail->gender}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="email">Email:</label>
                                          {{$personal_detail->email}}
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="query_type">Mobile:</label>
                                          {{$personal_detail->mobile_no}}
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="personal_detail_us_type">Residental Address:</label>
                                          {{$personal_detail->residental_address}}
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="personal_detail_us_type">Academy Course:</label>
                                          {{$personal_detail->academy_course->name}}
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="personal_detail_us_type">Commencement Date:</label>
                                          {{$personal_detail->commencement_date}}
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Date of Birth:</label>
                                          {{$personal_detail->dob}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Country of Birth:</label>
                                          {{$personal_detail->cob}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">State:</label>
                                          {{$personal_detail->state}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Post Code:</label>
                                          {{$personal_detail->post_code}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Australia Permanent Resident:</label>
                                          {{$personal_detail->residency_information->is_permanent_resident == true ? 'Yes' : 'No'}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Visa type:</label>
                                          {{$personal_detail->residency_information->visa_type}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Passport Number:</label>
                                          {{$personal_detail->residency_information->passport_number}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Passport Expiry Date:</label>
                                          {{$personal_detail->residency_information->passport_expiry_date}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Currently Living In Australia:</label>
                                          {{$personal_detail->residency_information->is_current_australia == true ? 'Yes' : 'No'}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Current Country:</label>
                                          {{$personal_detail->residency_information->is_current_australia == true ? 'Australia' : $personal_detail->residency_information->current_country}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Emergency Contact:</label>
                                          {{$personal_detail->emergency_contact->full_name}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Relationship:</label>
                                          {{$personal_detail->emergency_contact->relationship}} 
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="message">Emergency Contact No:</label>
                                          {{$personal_detail->emergency_contact->contact_no}} 
                                       </div>
                                    </div>
                                </div>
                                
            {!! Form::close() !!}
            </div>
                </div>
            </div>
        </section>
    </div>
@endsection