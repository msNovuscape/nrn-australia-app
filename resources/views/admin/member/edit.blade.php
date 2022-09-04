@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper p-4 content-wrapper-mi">
    <section class="content p-0">
        <div class="container-fluid">
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
                                        <form>
                                            <div class="image-upload d-flex">
                                                <div id="img-preview" class="profile-image">
                                                    <img src="{{url('admin/images/image-profile.png')}}" alt="">
                                                </div>
                                                <input type="file" accept="image/*" id="choose-file" name="choose-file" />
                                                <label for="choose-file" class="profile-icon ml-2">
                                                    <img src="{{url('admin/images/edit-icon.png')}}" href="{{url('admin/members/edit')}}" alt="">
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-5 profile-name d-flex flex-column">
                                        <input type="text" class="form-control" id="name" value ="Samir Bhandari" placeholder="Enter Name">
                                        <input type="text" class="form-control" id="code" value ="NRNA-20220601" placeholder="Enter NRNA Code">
                                        <div class="d-flex">
                                            <div class="profile-icon mr-2">
                                                <img src="{{url('admin/images/life-icon.png')}}" alt="">
                                            </div>
                                            <p>Life Membership</p>
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
                                            <input type="text" class="form-control" id="occupation" value ="Manager" placeholder="Enter Occupation">
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
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="male" value="option1" checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check mx-4">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="female" value="option2" checked>
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        Female
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="other" value="option3">
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
                                            <p>Phone</p>
                                        </div>
                                        <div class="col-md-7 detail-right">
                                            <input type="number" class="form-control" id="phone" aria-describedby="emailHelp" value="9841882877" placeholder="Enter Phone Number">
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
                                            <input type="email" class="form-control" id="exampleInputEmail1" value="bhandari@extratechs.com.au" placeholder="Enter Email Address">
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
                                            <input type="date" id="dob" name="birthday" class="w-100 form-control birthday-input" value="01/06/2004" placeholder="Enter Date of Birth">
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
                                            <input type="number" class="form-control" id="postal-code"  value="446600" placeholder="Enter Postal Code">
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
                                            <input type="text" class="form-control" id="res-address" value="Suite 132 & 133, Level 3, 10 Park Road, Hurstville NSW 2220, Australia" placeholder="Enter Redidential Address">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-4 d-flex detail-left">
                                                    <p>State</p>
                                                </div>
                                                <div class="col-md-8 detail-right">
                                                    <input type="text" class="form-control" id="state" value="NSW" placeholder="State">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-4 d-flex detail-left">
                                                    <p>Suburb</p>
                                                </div>
                                                <div class="col-md-8 detail-right">
                                                    <input type="text" class="form-control" id="suburb" value="Sydney" placeholder="Suburb">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-4 d-flex detail-left">
                                                    <p>Country</p>
                                                </div>
                                                <div class="col-md-8 detail-right">
                                                    <input type="text" class="form-control" id="country" value="Australia" placeholder="Country">
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
                            <input class="form-check-input" type="radio" name="exampleRadios" id="verify" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Verify
                            </label>
                        </div>
                        <div class="form-check mx-4">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="pending" value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                Pending
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="rejected" value="option3">
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
                                        <div class="profile-icon mr-2">
                                            <img src="{{url('admin/images/calendar-icon.png')}}" alt="">
                                        </div>
                                        <p>Expiry date of ID</p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" id="dob" name="birthday" class="w-100 form-control birthday-input">
                                    </div>
                                    <div class="col-md-4 detail-left">
                                        <a href="#" class="d-flex">
                                            <div class="profile-icon mr-2">
                                                <img src="{{url('admin/images/view-icon.png')}}" alt="">
                                            </div>
                                            <p>View Documents</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 d-flex detail-left">
                                        <div class="profile-icon mr-2">
                                            <img src="{{url('admin/images/calendar-icon.png')}}" alt="">
                                        </div>
                                        <p>Expiry date of Residency</p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" id="dob" name="birthday" class="w-100 form-control birthday-input">
                                    </div>
                                    <div class="col-md-4 detail-left">
                                        <a href="#" class="d-flex">
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
                                            <div class="slip-image mr-4">
                                                <img src="{{url('admin/images/payment-slip.png')}}" alt="">
                                            </div>
                                        </div>
                                    </div>
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
</script>

@endsection