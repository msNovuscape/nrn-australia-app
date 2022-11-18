@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper p-4 content-wrapper-mi">
    <section class="content p-0">
        <div class="container-fluid">
        @include('success.success')
                        @include('errors.error')
        {!! Form::open(['url' => '/admin/members/'.$member->id, 'class' => 'form-horizontal', 'method'=> 'POST','files' => true]) !!}
            @csrf
            <div class="row members-info-row">
                <div class="col-md-6">
                    <div>
                        <h3>Personal Information</h1>
                        <h6>Member personal details</h6>
                    </div>
                    <div class="card p-4 mr-1">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                            <div class="image-upload d-flex">
                                                <div id="img-preview" class="profile-image">
                                                    <img src="{{url($member->image)}}" alt="">
                                                </div>
                                                <input type="file" accept="image/*" id="choose-file" name="image" />
                                                <label for="choose-file" class="profile-icon ml-2">
                                                    <img src="{{url('admin/images/edit-icon.png')}}" href="{{url('admin/members/edit')}}" alt="">
                                                </label>
                                            </div>
                                    </div>
                                    <div class="col-md-5 profile-name d-flex flex-column">
                                        <input type="text" class="form-control" name = "name" id="name" value ="{{$member->first_name. ($member->middle_name ? ' '.$member->middle_name.' '.$member->last_name : ' '.$member->last_name)}}" placeholder="Enter Name">
                                        <input type="text" class="form-control" name="nrna_code" value ="{{$member->nrna_code}}" readonly>
                                        <div class="d-flex">
                                            <div class="profile-icon mr-2">
                                                <img src="{{url('admin/images/life-icon.png')}}" alt="">
                                            </div>
                                            <p>{{$member->membership_type->name}}</p>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4 d-flex">
                                        <div class="profile-icon mr-1">
                                            <img src="{{url('admin/images/pending-icon.png')}}" alt="">
                                        </div>
                                        <div class="detail-right">
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="Pending">Pending</option>
                                            <option value="1">Verify</option>
                                            <option value="2">Pending</option>
                                            <option value="3">Rejected</option>
                                        </select>
                                        </div>
                                    </div> -->
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
                                            <input type="text" class="form-control" name="occupation" value ="{{$member->occupation}}" placeholder="Enter Occupation">
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
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender_id" id="male" value="1" {{($member->gender_id == 1) ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check mx-4">
                                                    <input class="form-check-input" type="radio" name="gender_id" id="female" value="2" {{($member->gender_id == 2) ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        Female
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender_id" id="other" value="3" {{($member->gender_id == 3) ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="exampleRadios3">
                                                        Other
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 d-flex detail-left">
                                            <div class="profile-icon mr-4">
                                                <img src="{{url('admin/images/phone-icon.png')}}" alt="">
                                            </div>
                                            <p>Mobile</p>
                                        </div>
                                        <div class="col-md-7 detail-right">
                                            <input type="text" class="form-control" name="mobile_number" value="{{$member->mobile_number}}" placeholder="Enter Phone Number">
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
                                            <input type="email" class="form-control" name="email" value="{{$member->email}}" placeholder="Enter Email Address">
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
                                            <input type="date" id="dob" name="dob" class="w-100 form-control birthday-input" value="{{$member->dob}}" placeholder="Enter Date of Birth">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 d-flex detail-left">
                                            <div class="profile-icon mr-4">
                                                <img src="{{url('admin/images/postal-icon.png')}}" alt="">
                                            </div>
                                            <p>Post Code</p>
                                        </div>
                                        <div class="col-md-7 detail-right">
                                            <input type="number" class="form-control" name="postcode"  value="{{$member->postcode}}" placeholder="Enter Postal Code">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 d-flex detail-left">
                                            <div class="profile-icon mr-4">
                                                <img src="{{url('admin/images/residential-icon.png')}}" alt="">
                                            </div>
                                            <p>Residential Address</p>
                                        </div>
                                        <div class="col-md-7 detail-right">
                                            <input type="text" class="form-control" name="residential_address" value="{{$member->residential_address}}" placeholder="Enter Redidential Address">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-4 d-flex detail-left">
                                                    <p>State</p>
                                                </div>
                                                <select name="state_id" class="form-control" id="type" required>
                                                    @foreach(config('custom.states') as $in => $val)
                                                    <option value="{{$in}}" @if($member->state_id == $in)selected @endif >{{$val}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-4 d-flex detail-left">
                                                    <p>Suburb</p>
                                                </div>
                                                <div class="col-md-8 detail-right">
                                                    <input type="text" class="form-control" name="suburb" value="{{$member->suburb}}" placeholder="Suburb">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-4 d-flex detail-left">
                                                    <p>Country</p>
                                                </div>
                                                <div class="col-md-8 detail-right">
                                                    <input type="text" class="form-control" name="country_id" value="{{config('custom.countries')[$member->country_id]}}" placeholder="Country">
                                                </div>
                                            </div>
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
                            <input class="form-check-input" type="radio" name="membership_status_id" id="verify" value="2" {{($member->president_status_id == 2) ? 'checked' : ''}}>
                            <label class="form-check-label" for="exampleRadios1">
                                Verify
                            </label>
                        </div>
                        <div class="form-check mx-4">
                            <input class="form-check-input" type="radio" name="membership_status_id" id="pending" value="1" {{($member->president_status_id == 1) ? 'checked' : ''}}>
                            <label class="form-check-label" for="exampleRadios2">
                                Pending
                            </label>
                        </div>
                        <div class="form-check mx-4">
                            <input class="form-check-input" type="radio" name="membership_status_id" id="rejected" value="3" {{($member->president_status_id == 3) ? 'checked' : ''}}>
                            <label class="form-check-label" for="exampleRadios3">
                                Rejected
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="membership_status_id" id="reapply" value="4" {{($member->president_status_id == 4) ? 'checked' : ''}}>
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
                            @if($member->membership_status_id !== 2)
                            @role('President')
                            <div class="verification-block mb-4">
                                    <div class="document-verify">
                                        <h3>Verification By General Secretary</h3>
                                    </div>
                                    <form class="gsForm" id="gs-form" action="" method="post">
                                        <input type="hidden" value="{{$member->id}}" name = "member_id"/>
                                        <div class="d-flex">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="document_status_id_new" id="verify" value="2" {{($member->document_status_id == 2) ? 'checked' : ''}}>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Verified
                                                </label>
                                            </div>
                                            <div class="form-check mx-4">
                                                <input data-bs-toggle="modal" data-bs-target="#exampleModal" class="form-check-input" type="radio" name="document_status_id_new" id="document_status_id_new" value="1" {{$member->document_status_id == 1 ? 'checked' : ''}}>
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Make Pending
                                                </label>
                                            </div>
                                        </div>
                                    <!-- Comment Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Change <span>General Secretary Verification</span></h5>
                                                        <button type="button" class="icon-close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="comment_for_general_secretary" class="form-label">Please specifiy the reason.</label>
                                                        <textarea class="form-control" name  = "comment_for_general_secretary" id="comment_for_general_secretary" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn close-btn" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" id = "gs-form-submit" class="btn ctm-primarybtn">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- End of Comment Modal -->
                            </div>
                            @endrole
                            @endif
                            <div class="card p-4 ml-1">
                            <div class="profile-detail">
                                <div class="row">
                                    <div class="col-md-5 d-flex detail-left">
                                        <div class="profile-icon mr-2">
                                            <img src="{{url('admin/images/calendar-icon.png')}}" alt="">
                                        </div>
                                        <p>Expiry date of ID</p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" id="dob" name="identification_expiry_date" class="w-100 form-control birthday-input" value = "{{$member->member_document->identification_expiry_date}}">
                                    </div>
                                    @if($member->membership_status_id !== 2)
                                    <div class="col-md-4 detail-left">
                                        <a target = "_blank" href="{{url($member->member_document->identification_image)}}" class="d-flex">
                                            <div class="profile-icon mr-2">
                                                <img src="{{url($member->member_document->identification_image)}}" alt="">
                                            </div>
                                            <p>View Documents</p>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-5 d-flex detail-left">
                                        <div class="profile-icon mr-2">
                                            <img src="{{url('admin/images/calendar-icon.png')}}" alt="">
                                        </div>
                                        <p>Expiry date of Residency</p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" id="dob" name="proof_of_residency_expiry_date" class="w-100 form-control birthday-input" value = "{{$member->member_document->proof_of_residency_expiry_date}}">
                                    </div>
                                    @if($member->membership_status_id !== 2)
                                    <div class="col-md-4 detail-left">
                                        <a target = "_blank" href="{{url($member->member_document->proof_of_residency_image)}}" class="d-flex">
                                            <div class="profile-icon mr-2">
                                                <img src="{{url($member->member_document->proof_of_residency_image)}}" alt="">
                                            </div>
                                            <p>View Documents</p>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="ml-1">
                                <h3>Payment Details</h3>
                                <h6>Payment details made by member</h6>
                            </div>
                            @if($member->membership_status_id !== 2)
                            @role('President')
                            <div class="verification-block mb-4">
                                    <div class="document-verify">
                                        <h3>Verification By Treasurer</h3>
                                    </div>
                                    
                                        <div class="d-flex">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_status_id_new" id="verify" value="2" {{($member->payment_status_id == 2) ? 'checked' : ''}}>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Verified
                                                </label>
                                            </div>
                                            <div class="form-check mx-4">
                                                <input data-bs-toggle="modal" data-bs-target="#exampleModal2" class="form-check-input" type="radio" name="payment_status_id_new" id="payment_status_id" value="1" {{$member->payment_status_id == 1 ? 'checked' : ''}}>
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Make Pending
                                                </label>
                                            </div>
                                        </div>
                                    <!-- Comment Modal -->
                                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Change <span>Treasurer verification</span></h5>
                                                    <button type="button" class="icon-close-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                                                </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="commentArea" class="form-label">Please specifiy the reason.</label>
                                                            <textarea class="form-control" name = "comment_for_treasurer" id="comment_for_treasurer" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn close-btn" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" id ="treasurer-form-submit" class="btn ctm-primarybtn">Save changes</button>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>

                                    <!-- End of Comment Modal -->
                            </div>
                            @endrole
                            @endif
                            <div class="card p-4 ml-1">
                                <div class="profile-detail">
                                    <!-- <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Account Name</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <input type="text" class="form-control" id="occupation" value="Samir Bhandari" placeholder="Enter Account Name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Payment Date</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <input type="date" id="dob" name="birthday" class="w-100 form-control birthday-input">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Bank Name</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <input type="text" class="form-control" id="bank" value="National Australian Bank (NAB)" placeholder="Enter Bank Amount">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Total Amount</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <input type="text" class="form-control" id="total_amount" value="$150 AUD" placeholder="Enter Total Amount">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Payment Slip</p>
                                        </div>
                                        <div class="col-md-5 detail-right">
                                            <div class="slip-image mr-4">
                                                <img src="{{url('admin/images/payment-slip.png')}}" alt="">
                                            </div>
                                            <input class="form-control mt-4" type="file" id="formFileDisabled"/>
                                        </div>
                                    </div> -->
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
                                    @if($member->membership_status_id !== 2)
                                    <div class="row">
                                        <div class="col-md-4 d-flex detail-left">
                                            <p>Payment Slip</p>
                                        </div>
                                        <div class="col-md-8 detail-right">
                                            <div class="slip-image mr-4">
                                                <img src="{{url($member->member_payment->payment_slip)}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4 d-flex justify-content-center">
                    <div class="submit-button">
                        <button>Submit</button>
                    </div>
                </div>
            </div> 
            {!! Form::close() !!}    
        </div>
    </section>
</div>

<script>
    const chooseFile = document.getElementById("choose-file");
    const imgPreview = document.getElementById("img-preview");
    chooseFile.addEventListener("change", function () {
        getImgData();
    });
    function getImgData() {
        const files = chooseFile.files[0];
        if (files) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function () {
            imgPreview.style.display = "block";
            imgPreview.innerHTML = '<img src="' + this.result + '" />';
            });    
        }
    }

    $('#treasurer-form-submit').on('click', function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{ url('admin/members/update_status/president') }}",
        data: $('form.treasurerForm').serialize(),
        success: function(response) {
            Swal.fire({
                    title: 'Success!!',
                    text: (response.msg),
                    icon: 'success'
                })
                .then(function(){ 
                    $('#exampleModal2').modal('hide');
                    window.location = response.redirect_url;
                })
        },
        error: function() {
            alert('Error');
        }
    });
    return false;
});

$('#gs-form-submit').on('click', function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{ url('admin/members/update_status/president') }}",
        data: $('form.gsForm').serialize(),
        success: function(response) {
            Swal.fire({
                    title: 'Success!!',
                    text: (response.msg),
                    icon: 'success'
                })
                .then(function(){ 
                    $('#exampleModal').modal('hide');
                    window.location = response.redirect_url;
                })
        },
        error: function() {
            alert('Error');
        }
    });
    return false;
});
    
</script>

@endsection