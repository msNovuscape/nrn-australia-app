@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper p-4 content-wrapper-mi">
    <div class="d-flex justify-content-end">
        <img src="{{url('admin/images/edit-icon.png')}}" href="{{url('admin/members/edit')}}" alt="">
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
                        <div class="d-flex">
                            <div class="profile-image mr-4">
                                <img src="{{str_replace(public_path(), url('/'), $member->image ?? '')}}" alt="">
                            </div>
                            <div class="profile-name d-flex flex-column">
                                <p>{{$member->first_name. ($member->middle_name ? ' '.$member->middle_name.' '.$member->last_name : ' '.$member->last_name)}}</p>
                                <!-- <p>NRNA-20220601</p> -->
                                <div class="d-flex">
                                    <div class="profile-icon mr-2">
                                        <img src="{{url('admin/images/life-icon.png')}}" alt="">
                                    </div>
                                    <p>{{$member->membership_type->name}}</p>
                                </div>
                            </div>
                            <div class="d-flex ml-4">
                                <div class="profile-icon mr-1">
                                    <img src="{{url('admin/images/pending-icon.png')}}" alt="">
                                </div>
                                <p id = "member_status">{{config('custom.membership_status')[$member->membership_status_id]}}</p>
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
                                    <p>{{$member->occupation ?? 'Not mentioned'}}</p>
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
                                    <p>{{config('custom.gender')[$member->gender_id]}}</p>
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
                                    <p>{{$member->mobile_number}}</p>
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
                                    <p>{{$member->email}}</p>
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
                                    <p>{{$member->dob}}</p>
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
                                    <p>{{$member->postcode}}</p>
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
                                    <p>{{$member->residential_address}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>State</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>{{config('custom.states')[$member->state_id]}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Suburb</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>{{$member->suburb}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Country</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>{{config('custom.countries')[$member->country_id]}}</p>
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
                            <input class="form-check-input" type="radio" name="membership_status_id" id="exampleRadios1" value="2" {{$member->membership_status_id == 2 ? 'checked' : ''}}>
                            <label class="form-check-label" for="exampleRadios1">
                                Verify
                            </label>
                        </div>
                        <div class="form-check mx-4">
                            <input class="form-check-input" type="radio" name="membership_status_id" id="exampleRadios2" value="1" {{$member->membership_status_id == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="exampleRadios2">
                                Pending
                            </label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="membership_status_id" id="exampleRadios3" value="3" {{$member->membership_status_id == 3 ? 'checked' : ''}}>
                            <label class="form-check-label" for="exampleRadios3">
                                Rejected
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="membership_status_id" id="exampleRadios3" value="4" {{$member->membership_status_id == 4 ? 'checked' : ''}}>
                            <label class="form-check-label" for="exampleRadios3">
                                Reapply
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
                                        <p>{{$member->member_document->identification_expiry_date}}</p>
                                    </div>

                                    <div class="col-md-4 detail-left">
                                        <a href="{{str_replace(public_path(), url('/'), $member->member_document->identification_image)}}" class="d-flex">
                                            <div class="profile-icon mr-2">
                                                <img src="{{url('admin/images/view-icon.png')}}" alt="">
                                            </div>
                                            <p>View Documents</p>
                                        </a>
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
                                        <p>{{$member->member_document->proof_of_residency_expiry_date}}</p>
                                    </div>

                                    <div class="col-md-4 detail-left">
                                        <a href="{{str_replace(public_path(), url('/'), $member->member_document->proof_of_residency_image)}}" class="d-flex">
                                            <div class="profile-icon mr-2">
                                                <img src="{{url('admin/images/view-icon.png')}}" alt="">
                                            </div>
                                            <p>View Documents</p>
                                        </a>
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
                                            <p>{{$member->member_payment->account_name}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Payment Date</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>{{$member->member_payment->payment_date}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Bank Name</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>{{$member->member_payment->bank_name}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Total Amount</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <p>{{$member->member_payment->amount}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Payment Slip</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <img src="{{str_replace(public_path(), url('/'), $member->member_payment->payment_slip)}}" alt="">
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

@section('script')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
$('input[type=radio][name=membership_status_id]').change(function() {
    var isOk = confirm('Are u sure want to change the status?');
    var membership_status_id = this.value;
    var id = "<?php echo $member->id; ?>";
    if (isOk) {
        $.ajax({
         url: "/admin/members/update_status",
         type: "POST",
         data: {
            membership_status_id: membership_status_id,
             id: id
         },
         success: function (response) {
                var element = document.getElementById("member_status");
                if(response.membership_status_id == 1){
                    element.innerHTML = 'Pending';
                }
                if(response.membership_status_id == 2)
                {
                    element.innerHTML = 'Verfiied';
                }
                if(response.membership_status_id == 3){
                    element.innerHTML = 'Rejected';
                }

                if(response.membership_status_id == 4){
                    element.innerHTML = 'Reapply';
                }
                Swal.fire({
                    title: 'Success!!',
                    text: (response.msg),
                    icon: 'success'
                })
         }


         
       })  ;  
     }    
});
</script>
@endsection