@extends('admin.layouts.app')
@section('content')

    <!-- <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Members</h1>
                    </div>
                </div>
            </div>
        </section>

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
                                                <a href="{{url('admin/members/edit/')}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
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
                    </div>
                </div>
            </div>
        </section>
    </div> -->
    <div class="main-panel">
        <div class="content-wrapper content-wrapper-bg">
            <div class="row">
                <div class="col-sm-12 col-md-12 stretch-card">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div class="card-heading">
                                    <h4>Members</h4>
                                    <p class="mb-0">All members list. Please, select from filters to see membership type  and state.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 filter-btnwrap mt-4">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span>
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <input type="text" class="form-control" id="inputText" placeholder="Search" name="name">
                                    </div>
                                </div>
                                <div class="col-md-3 w-100">
                                    <div class="input-group w-100">
                                        <div class="row w-100">
                                            <div class="col-md-1">
                                                <span>
                                                    <i class="far fa-user"></i>
                                                </span>
                                            </div>
                                            <div class="col-md-10">
                                                <select class="form-select w-100" aria-label="Default select example" name="course_id">
                                                    <option selected="" disabled="">Search member type</option>
                                                    <option value="1">Member 1</option>
                                                    <option value="2">Member 2</option>
                                                    <option value="2">Member 3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="d-flex justify-content-end">
                                                    <i class="fas fa-sort-down"></i>
                                                </span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-md-3 w-100">
                                    <div class="input-group w-100">
                                        <div class="row w-100">
                                            <div class="col-md-1">
                                                <span>
                                                    <i class="far fa-user"></i>
                                                </span>
                                            </div>
                                            <div class="col-md-10">
                                                <select class="form-select w-100" aria-label="Default select example" name="course_id">
                                                    <option selected="" disabled="">Select State</option>
                                                    <option value="1">State 1</option>
                                                    <option value="2">State 2</option>
                                                    <option value="3">State 3</option>
                                                    <option value="4">State 4</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="d-flex justify-content-end">
                                                    <i class="fas fa-sort-down"></i>
                                                </span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex">
                                    <!-- <div class="d-flex align-items-center">
                                        <p class="m-0">
                                            Show
                                        </p>
                                        <div class="d-flex input-field-show">
                                            <select class="form-select ml-1 show-select" aria-label="Default select example">
                                                <option selected="">10</option>
                                                <option value="1">10</option>
                                                <option value="2">20</option>
                                                <option value="3">30</option>
                                            </select>
                                            <span class="d-flex justify-content-end">
                                                <i class="fas fa-sort-down"></i>
                                            </span>
                                        </div>
                                    </div> -->
                                    <div class="d-flex align-items-center">
                                        <p class="m-0">
                                            Show
                                        </p>
                                        <div class="show-select d-flex">
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected="">10</option>
                                                <option value="1">10</option>
                                                <option value="2">20</option>
                                                <option value="3">30</option>
                                            </select>
                                            <span class="d-flex justify-content-end">
                                                <i class="fas fa-sort-down"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="export-button">
                                        <div class="dropdown-export">
                                            <button type="submit" name="submit" onclick="submit;" class="student-btn d-flex">
                                                Filter<img src="{{url('admin/images/filter-icon.png')}}" alt="" class="ml-1 mt-1">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="export-button">
                                        <div class="dropdown-export">
                                            <button type="submit" name="submit" onclick="submit;" class="student-btn d-flex">
                                                <img src="{{url('admin/images/export-icon.png')}}" alt="" class="mt-1 mr-1">Export
                                            </button>
                                            <div class="dropdown-content-export">
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            Export.csv
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            Export.pdf
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 stretch-card mt-4">
                            <div class="card-wrap form-block p-0">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 stretch-card sl-stretch-card">
                                        <div class="card-wrap card-wrap-bs-none form-block">
                                            <div class="row">
                                                <div class="col-12 table-responsive table-details" id="mytable">
                                                    <table class="table mb-0" id="attendance_table">
                                                        <thead>
                                                            <tr>
                                                                <!-- <th class="d-flex">
                                                                    <div class="tblform-check">
                                                                        <input class="form-check-input-master" type="checkbox" value="" id="select_all">
                                                                        <label class="form-check-label ml-1" for="flexCheckDefault">
                                                                        <div class="dropdown p-0">
                                                                            <button class="btn dropdown-toggle p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            </button>
                                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                <a class="dropdown-item" href="#">Select All</a>
                                                                                <a class="dropdown-item" href="#">Deselect All</a>
                                                                            </div>
                                                                        </div>
                                                                        </label>
                                                                    </div>
                                                                </th> -->
                                                                <th>S.N.</th>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>State</th>
                                                                <th>Type</th>
                                                                <th>Status</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="student_list">
                                                            <tr>
                                                                <!-- <td>
                                                                    <div class="tblform-check ml-1">
                                                                        <input class="checkbox" type="checkbox" value="5" id="form-check-input1">
                                                                    </div>
                                                                </td> -->
                                                                <td class="pl-2">1</td>
                                                                <td class="d-flex">
                                                                    <img src="{{url('admin/images/image-profile.png')}}" alt="">
                                                                    <div class="d-flex flex-column name-table">
                                                                        <p>Suman Tamang</p>
                                                                        <p>NRNA-2022601</p>
                                                                    </div>
                                                                </td>
                                                                <td>suman@extratechs.com.au</td>
                                                                <td>Sydney, NSW</td>
                                                                <td>Associate Member</td>
                                                                <td class="verified status"><i class="fas fa-check"></i>Verified</td>
                                                                <td class="action-icons">
                                                                    <ul class="icon-button d-flex">
                                                                        <li>
                                                                            <a href="members/edit/" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                                                <i class="fas fa-pencil-alt"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="members/1/show" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="show">
                                                                                <i class="fas fa-eye"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="delete">
                                                                                <i class="fas fa-trash"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <!-- <tr>
                                                              
                                                                <td class="pl-2">2</td>
                                                                <td class="d-flex">
                                                                    <img src="{{url('admin/images/image-profile.png')}}" alt="">
                                                                    <div class="d-flex flex-column name-table">
                                                                        <p>Suman Tamang</p>
                                                                        <p>NRNA-2022601</p>
                                                                    </div>
                                                                </td>
                                                                <td>suman@extratechs.com.au</td>
                                                                <td>Sydney, NSW</td>
                                                                <td>Associate Member</td>
                                                                <td class="pending status"><i class="fas fa-ellipsis-h"></i>Pending</td>
                                                                <td class="action-icons">
                                                                    <ul class="icon-button d-flex">
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                                                <i class="fas fa-pencil-alt"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="show">
                                                                                <i class="fas fa-eye"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="delete">
                                                                                <i class="fas fa-trash"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                              
                                                                <td class="pl-2">3</td>
                                                                <td class="d-flex">
                                                                    <img src="{{url('admin/images/image-profile.png')}}" alt="">
                                                                    <div class="d-flex flex-column name-table">
                                                                        <p>Suman Tamang</p>
                                                                        <p>NRNA-2022601</p>
                                                                    </div>
                                                                </td>
                                                                <td>suman@extratechs.com.au</td>
                                                                <td>Sydney, NSW</td>
                                                                <td>Associate Member</td>
                                                                <td class="rejected status"><i class="fas fa-times"></i>Rejected</td>
                                                                <td class="action-icons">
                                                                    <ul class="icon-button d-flex">
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                                                <i class="fas fa-pencil-alt"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="show">
                                                                                <i class="fas fa-eye"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="delete">
                                                                                <i class="fas fa-trash"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr> -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
