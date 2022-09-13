@extends('admin.layouts.app')
@section('content')

   
    <div class="main-panel">
        <div class="content-wrapper content-wrapper-bg">
            <div class="row">
                <div class="col-sm-12 col-md-12 stretch-card">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div class="card-heading">
                                    <h4>{{ucfirst($membership_status)}} Members</h4>
                                    <p class="mb-0">All {{($membership_status)}} members list. Please, select from filters from membership type  and state.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 filter-btnwrap mt-4">
                        @include('success.success')
                                @include('errors.error')
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span>
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <input type="text" class="form-control" id="search" placeholder="Search" name="search_key" onchange="filterList()">
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
                                                <select class="form-select w-100" aria-label="Default select example" id="membership_type" name="membership_type_id">
                                                    <option selected="" value = "" disabled="">Search member type</option>
                                                    @foreach($membership_types as $membership_type)
                                                        <option value="{{$membership_type->id}}">{{$membership_type->name}}</option>
                                                    @endforeach
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
                                                <select class="form-select w-100" aria-label="Default select example" id="state">
                                                    <option selected="" value = "" disabled="">Select State</option>
                                                    @foreach(config('custom.states') as $in => $val)
                                                        <option value="{{$in}}" @if(old('states') == $in) selected @endif >{{$val}}</option>
                                                    @endforeach
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
                                <!-- <div class="col-md-1 d-flex">
       
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
                                </div> -->
                                <div class="col-md-1">
                                    <div class="export-button">
                                        <div class="dropdown-export">
                                            <button type="submit" onclick="submitFilter();" class="student-btn d-flex">
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
                                                                <th>Full Name</th>
                                                                <th>Email</th>
                                                                <th>State</th>
                                                                <th>Membership Type</th>
                                                                <th>Status</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="student_list">
                                                            @forelse($settings as $member)
                                                            <tr>
                                                                <!-- <td>
                                                                    <div class="tblform-check ml-1">
                                                                        <input class="checkbox" type="checkbox" value="5" id="form-check-input1">
                                                                    </div>
                                                                </td> -->
                                                                <td class="pl-2">{{$loop->iteration}}</td>
                                                                <td class="d-flex">
                                                                    <img src="{{url($member->image)}}" alt="">
                                                                    <div class="d-flex flex-column name-table">
                                                                        <p>{{$member->first_name. ($member->middle_name ? ' '.$member->middle_name.' '.$member->last_name : ' '.$member->last_name)}}</p>
                                                                        <p>{{$member->nrna_code}}</p>
                                                                    </div>
                                                                </td>
                                                                <td>{{$member->email}}</td>
                                                                <td>{{config('custom.states')[$member->state_id]}}</td>
                                                                <td>{{$member->membership_type->name}}</td>
                                                                <td class="{{$membership_status}} status"><i class="fas fa-@if($membership_status == 'verified')check @elseif ($membership_status == 'rejected')times @elseif($membership_status == 'pending')ellipsis-h @elsereapply  @endif  "></i>{{config('custom.membership_status')[$member->membership_status_id]}}</td>
                                                                <td class="action-icons">
                                                                    <ul class="icon-button d-flex">
                                                                        <li>
                                                                            <a href="{{url('admin/members/edit/'.$member->id)}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="edit">
                                                                                <i class="fas fa-pencil-alt"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{url('admin/members/show/'.$member->id)}}" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="show">
                                                                                <i class="fas fa-eye"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{url('admin/members/delete/'.$member->id)}}" onclick = "confirm('Are you sure want to delete the member permanently?')" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="delete">
                                                                                <i class="fas fa-trash"></i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td>No any {{($membership_status)}} members as per request.</td>
                                                            </tr>
                                                            @endforelse
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

@section('script')
    <script>
        function submitFilter(){

        
        var state = document.getElementById("state");
        var state_id = state.value ;

        var membership_type = document.getElementById("membership_type");
        var membership_type_id = membership_type.value ;
        // var text = e.options[e.selectedIndex].text;

        debugger;

        var baseurl = window.location.origin+window.location.pathname;
        // var data = $('state').serialize();
        // alert(data);
        window.location = baseurl+'?state_id='+state_id+'&membership_type_id='+membership_type_id;

        }

    </script>
@endsection
