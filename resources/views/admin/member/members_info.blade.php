@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper p-4 content-wrapper-mi">
    <div class="d-flex justify-content-end">
        <img src="{{url('admin/images/edit-icon.png')}}" href="#" alt="">
    </div>
    <section class="content p-0">
        <div class="container-fluid">
            <div class="row members-info-row">
                <div class="col-md-6">
                    <div>
                        <h3>Personal Information</h1>
                        <h6>Member personal details</h6>
                    </div>
                    <div class="card p-4 mr-1">
                        <div class="info-profile d-flex">
                            <div class="profile-image mr-4">
                                <img src="{{url('admin/images/image-profile.png')}}" alt="">
                            </div>
                            <div class="profile-name d-flex flex-column">
                                <p>Samir Bhandari</p>
                                <p>NRNA-20220601</p>
                                <div class="d-flex">
                                    <div class="profile-icon mr-2">
                                        <img src="{{url('admin/images/life-icon.png')}}" alt="">
                                    </div>
                                    <p>Life Membership</p>
                                </div>
                            </div>
                            <div class="d-flex ml-4">
                                <div class="profile-icon mr-1">
                                    <img src="{{url('admin/images/pending-icon.png')}}" alt="">
                                </div>
                                <p>Pending</p>
                            </div>
                        </div>
                        <div class="profile-detail mt-4">
                            <div class="row">
                                <div class="col-md-5 d-flex detail-left">
                                    <div class="profile-icon mr-4">
                                        <img src="{{url('admin/images/occupation-icon.png')}}" alt="">
                                    </div>
                                    <p>Occupation</p>
                                </div>
                                <div class="col-md-7 detail-right">
                                    <p>Manager</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 d-flex detail-left">
                                    <div class="profile-icon mr-4">
                                        <img src="{{url('admin/images/gender-icon.png')}}" alt="">
                                    </div>
                                    <p>Gender</p>
                                </div>
                                <div class="col-md-7 detail-right">
                                    <p>Male</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 d-flex detail-left">
                                    <div class="profile-icon mr-4">
                                        <img src="{{url('admin/images/phone-icon.png')}}" alt="">
                                    </div>
                                    <p>Phone</p>
                                </div>
                                <div class="col-md-7 detail-right">
                                    <p>9841882877</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 d-flex detail-left">
                                    <div class="profile-icon mr-4">
                                        <img src="{{url('admin/images/email-icon.png')}}" alt="">
                                    </div>
                                    <p>Email</p>
                                </div>
                                <div class="col-md-7 detail-right">
                                    <p>bhandari@extratechs.com.au</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 d-flex detail-left">
                                    <div class="profile-icon mr-4">
                                        <img src="{{url('admin/images/calendar-icon.png')}}" alt="">
                                    </div>
                                    <p>Date of Birth</p>
                                </div>
                                <div class="col-md-7 detail-right">
                                    <p>01/06/2004</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 d-flex detail-left">
                                    <div class="profile-icon mr-4">
                                        <img src="{{url('admin/images/postal-icon.png')}}" alt="">
                                    </div>
                                    <p>Postal Code</p>
                                </div>
                                <div class="col-md-7 detail-right">
                                    <p>446600</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 d-flex detail-left">
                                    <div class="profile-icon mr-4">
                                        <img src="{{url('admin/images/residential-icon.png')}}" alt="">
                                    </div>
                                    <p>Residental Address</p>
                                </div>
                                <div class="col-md-7 detail-right">
                                    <p>Suite 132 & 133, Level 3, 10 Park Road, Hurstville NSW 2220, Australia</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>State</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>NSW</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Suburb</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>Sydney</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Country</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>Australia</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="member-verify mt-4">
                        <h3>Member Verification</h3>
                        <h6>Please click below to change membership status</h6>
                    </div>
                    <div class="d-flex">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Verify
                            </label>
                        </div>
                        <div class="form-check mx-4">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                Pending
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                            <label class="form-check-label" for="exampleRadios3">
                                Rejected
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ml-1">
                                <h3>Documents</h3>
                                <h6>Documents submitted by members</h6>
                            </div>
                            <div class="card p-4 ml-1">
                            <div class="profile-detail">
                                <div class="row">
                                    <div class="col-md-5 d-flex detail-left">
                                        <div class="profile-icon mr-4">
                                            <img src="{{url('admin/images/calendar-icon.png')}}" alt="">
                                        </div>
                                        <p>Expiry date of ID</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>01/06/2024</p>
                                    </div>
                                    <div class="col-md-4 d-flex detail-left">
                                        <div class="profile-icon mr-4">
                                            <img src="{{url('admin/images/view-icon.png')}}" alt="">
                                        </div>
                                        <p>View Documents</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5  d-flex detail-left">
                                        <div class="profile-icon mr-4">
                                            <img src="{{url('admin/images/calendar-icon.png')}}" alt="">
                                        </div>
                                        <p>Expiry date of Residency</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>01/06/2026</p>
                                    </div>
                                    <div class="col-md-4 d-flex detail-left">
                                        <div class="profile-icon mr-4">
                                            <img src="{{url('admin/images/view-icon.png')}}" alt="">
                                        </div>
                                        <p>View Documents</p>
                                    </div>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="ml-1">
                                <h3>Payment Details</h3>
                                <h6>Payment details made by member</h6>
                            </div>
                            <div class="card p-4 ml-1">
                                <div class="profile-detail">
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Account Name</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>Samir Bhandari</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Payment Date</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>01/06/2026</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Bank Name</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>National Australian Bank (NAB)</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Total Amount</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>$150 AUD</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Payment Slip</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <img src="" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection