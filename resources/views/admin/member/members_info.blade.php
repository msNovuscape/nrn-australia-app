@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper p-4 content-wrapper-mi">
    {{--start loader--}}
    <div class="loader loader-default" id="loader"></div>
    {{--end loader--}}
    <div class="d-flex justify-content-end">
        <img src="{{url('admin/images/edit-icon.png')}}" href="{{url('admin/members/edit/'.$member->id)}}" alt="">
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
                                <img src="{{url($member->image ?? '/admin/images/no-image.png')}}" alt="">
                            </div>
                            <div class="profile-name d-flex flex-column">
                                <p>{{$member->first_name. ($member->middle_name ? ' '.$member->middle_name.' '.$member->last_name : ' '.$member->last_name)}}</p>
                                <p>{{$member->nrna_code}}</p>
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
                                @if(auth()->user()->hasRole('State Coordinator') )
                                @php $status = config('custom.membership_status')[$member->document_status_id] ; @endphp

                                @elseif(auth()->user()->hasRole('President') || auth()->user()->hasRole('General Secretary') )
                                @php $status = config('custom.membership_status')[$member->president_status_id]; @endphp
                                @else

                                @php $status = config('custom.payment_status')[$member->payment_status_id]; @endphp
                                @endif
                                <p id = "member_status">{{ $status  }}</p>
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
                            <input class="form-check-input" type="radio" name="membership_status_id" id="exampleRadios1" value=@role('Treasurer')'2'@endrole @role('State Coordinator')'2'@endrole @role('General Secretary')'2'@endrole @role('President')'2'@endrole {{$status == 'Verified' ? 'checked' : ''}}>
                            <label class="form-check-label" for="exampleRadios1">
                            {{$status == 'Verified' ? 'Verified' : 'Verify'}}
                            </label>
                        </div>
                        <div class="form-check mx-4">
                            <input class="form-check-input" type="radio" name="membership_status_id" id="exampleRadios2" value=@role('Treasurer')'1'@endrole @role('State Coordinator')'1'@endrole @role('General Secretary')'1'@endrole @role('President')'1'@endrole {{$status == 'Pending' ? 'checked' : ''}}>
                            <label class="form-check-label" for="exampleRadios2">
                                Pending
                            </label>
                        </div>
                        <div class="form-check mx-4">
                            <input class="form-check-input" type="radio" name="membership_status_id" id="exampleRadios3" value=@role('Treasurer')'3'@endrole @role('State Coordinator')'3'@endrole @role('General Secretary')'3'@endrole @role('President')'3'@endrole {{$status == 'Rejected' ? 'checked' : ''}}>
                            <label class="form-check-label" for="exampleRadios3">
                                Rejected
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="membership_status_id" id="exampleRadios3" value=@role('Treasurer')'4'@endrole @role('State Coordinator')'4'@endrole @role('President')'4'@endrole {{$status == 'Reapply' ? 'checked' : ''}}>
                            <label class="form-check-label" for="exampleRadios3">
                                Reapply
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="row">
                    @hasanyrole('State Coordinator|General Secretary|President')
                        <div class="col-md-12">
                            <div class="ml-1">
                                <h3>Documents</h3>
                                <h6>Documents submitted by members</h6>
                            </div>
                            @if($member->membership_status_id !== 2)
                            @role('President')
                                <div class="verification-block mb-4">
                                        <div class="document-verify">
                                            <h3>Verification By State Coordinator</h3>
                                        </div>
                                        <form class="gsForm" id="gs-form" action="" method="post">
                                            <input type="hidden" value="{{$member->id}}" name = "member_id"/>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                <input class="form-check-input" type="radio" name="document_status_id" id="verify" value="1" {{($member->document_status_id == 2) ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Verified
                                                    </label>
                                                </div>
                                                <div class="form-check mx-4">
                                                    <input data-bs-toggle="modal" data-bs-target="#exampleModal" class="form-check-input" type="radio" name="document_status_id" id="document_status_id" value="1" {{$member->document_status_id == 1 ? 'checked' : ''}}>
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
                                            <div class="profile-icon mr-4">
                                                <img src="{{url('admin/images/calendar-icon.png')}}" alt="">
                                            </div>
                                            <p>Expiry date of ID</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p>{{$member->member_document->identification_expiry_date}}</p>
                                        </div>
                                        @if($member->membership_status_id !== 2)
                                            <div class="col-md-4 detail-left">
                                                <a target = "_blank" href="{{url($member->member_document->identification_image)}}" class="d-flex">
                                                    <div class="profile-icon mr-2">
                                                        <img src="{{url('admin/images/view-icon.png')}}" alt="">
                                                    </div>
                                                    <p>View Documents</p>
                                                </a>
                                            </div>
                                        @endif
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
                                        @if($member->membership_status_id !== 2)
                                            <div class="col-md-4 detail-left">
                                                <a target = "_blank" href="{{url($member->member_document->proof_of_residency_image)}}" class="d-flex">
                                                    <div class="profile-icon mr-2">
                                                        <img src="{{url('admin/images/view-icon.png')}}" alt="">
                                                    </div>
                                                    <p>View Documents</p>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endhasanyrole
                    @hasanyrole('Treasurer|President|General Secretary')
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
                                    <form class="treasurerForm" id="treasurer-form" action="" method="post">
                                        <input type="hidden" value="{{$member->id}}" name = "member_id"/>
                                        <div class="d-flex">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_status_id" id="verify" value="1" {{($member->payment_status_id == 2) ? 'checked' : ''}}>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Verified
                                                </label>
                                            </div>
                                            <div class="form-check mx-4">
                                                <input data-bs-toggle="modal" data-bs-target="#exampleModal2" class="form-check-input" type="radio" name="payment_status_id" id="payment_status_id" value="1" {{$member->payment_status_id == 1 ? 'checked' : ''}}>
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
                                                            <textarea class="form-control" name = "comment_for_treasurer" id="comment_for_treasurer" rows="3" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn close-btn" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" id ="treasurer-form-submit" class="btn ctm-primarybtn">Save changes</button>
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
                    @endhasanyrole
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
    // var isOk = confirm('Are u sure want to change the status?');
    var membership_status_id = this.value;
    var id = "<?php echo $member->id; ?>";
    // var isOk = false;
    Swal.fire({
                    title: 'Confirmation required!!',
                    text: 'Are you sure want to change the status?',
                    // showDenyButton: true,
  showCancelButton: true,
                    // icon: 'success'
                })
                .then(function(result){
                    if(result.isConfirmed){
                        start_loader();
                        $.ajax({
                            url: "/admin/members/update_status/finance",
                            type: "POST",
                            data: {
                                membership_status_id: membership_status_id,
                                id: id
                            },
                            success: function (response) {
                                    end_loader();
                                    Swal.fire({
                                        title: 'Success!!',
                                        text: (response.msg),
                                        icon: 'success'
                                    })
                                    .then(function(){
                                        location.reload();

                                    })
                                    // location.reload();
                            },
                            error: function (response) {
                                end_loader();
                                    Swal.fire({
                                        title: 'Denied!!',
                                        text: 'Something went wrong. Please try again!',
                                        icon: 'error'
                                    })
                                    .then(function(){
                                        location.reload();

                                    })
                            }



                        })  ;
                    }else{
                        end_loader();
                                    Swal.fire({
                                        title: 'Cancelled!!',
                                        text: 'Status update is cancelled!',
                                         icon: 'error'
                                    })
                                    .then(function(){
                                        location.reload();

                                    })
                    }
                })

    // if (isOk) {
        // start_loader();
        // $.ajax({
        //  url: "/admin/members/update_status/finance",
        //  type: "POST",
        //  data: {
        //     membership_status_id: membership_status_id,
        //     id: id
        //  },
        //  success: function (response) {
        //         end_loader();
        //         Swal.fire({
        //             title: 'Success!!',
        //             text: (response.msg),
        //             icon: 'success'
        //         })
        //         .then(function(){
        //           location.reload();
        //         })
        //         // location.reload();
        //   }



        // })  ;
    //  }
});

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
