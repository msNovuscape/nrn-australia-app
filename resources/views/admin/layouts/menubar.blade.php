<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{url('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light d-flex justify-content-between">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <div class="navbar-right d-flex">
            <ul class="navbar-nav d-flex align-items-center">
                <li class="dropdown-export-menu">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle"  href="#" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{url('admin/images/bell-icon.png')}}" alt="image-notification">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Notification 1</a>
                            <a class="dropdown-item" href="#">Notification 2</a>
                            <a class="dropdown-item" href="#">Notification 3</a>
                        </div>
                    </div>
                </li>
                <li class="nav-profile d-flex dropdown-export-menu mx-3">
                    <a class="d-flex" href="#">
                        <div class="nav-profile-img">
                            <img src="http://localhost/ams/public/images/profile.jpg" alt="image">
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1">Admin</p>
                        </div>
                    </a>
                    <div class="">
                        <a class="" href="#">
                            <button>
                                <i class="fas fa-sort-down"></i>
                            </button>
                        </a>
                        <div class="dropdown-content-export-menu">
                            <a class="" href="#"></a>
                            <ul>
                                <a class="" href="#"></a>
                                <li>
                                    <a class="" href="#"></a>
                                    <a href="http://localhost/ams/public/logout">Logout</a>
                                </li>
                                <li>
                                    <a href="#">Change Password</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary">
        <!-- Brand Logo -->
        <a href="{{url('admin/index')}}" class="brand-link w-100">
            <div class="nrna-logo d-flex">
                <div>
                    <img class="" src="{{url('admin/images/logo-nrna.png')}}" alt="">
                </div>
                <span class="brand-text font-weight-light">
                    <p>NRNA - Australia </p>
                    <p>Non-Resident Nepali Association</p>
                </span>
            </div>
            
        </a>

        <!-- Sidebar -->
        <div class="sidebar sb">

            <!-- Sidebar Menu -->
            <nav class="">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item sidebar-nav-item">
                        <a href="{{url('admin/settings')}}" class="nav-link {{(Request::segment(2) == 'settings') ? 'active' : ''}} p-3 mb-0 sidebar-nav-link w-100">
                            <i class="fa fa-cog pl-4" aria-hidden="true"></i>
                            <p id="accordion">
                                <button class="btn btn-link p-2 w-80">
                                 Settings
                                </button>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('admin/sliders')}}" class="nav-link {{(Request::segment(2) == 'sliders') ? 'active' : ''}} p-3 mb-0 sidebar-nav-link w-100">
                            <i class="fas fa-sliders-h pl-4" aria-hidden="true"></i>
                            <p id="accordion">
                                <button class="btn btn-link p-2 w-80">
                                Sliders
                                </button>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item sidebar-nav-item">
                        <a href="{{url('admin/eligibility_types')}}" class="nav-link {{(Request::segment(2) == 'eligibility_types') ? 'active' : ''}} p-3 mb-0 sidebar-nav-link w-100">
                            <i class="fas fa-user-check pl-4" aria-hidden="true"></i>
                            <!-- <i class="bi bi-speedometer"></i> -->
                            <p id="accordion">
                                <button class="btn btn-link p-2 w-80">
                                    Eligibility Type
                                </button>
                            </p>
                        </a>
                    </li>
                
                    <li class="nav-item sidebar-nav-item">
                        <a href="{{url('admin/membership_types')}}" class="nav-link {{(Request::segment(2) == 'membership_types') ? 'active' : ''}} p-3 mb-0 sidebar-nav-link w-100">
                            <i class="fas fa-user-tag pl-4" aria-hidden="true"></i>
                            <p id="accordion">
                                <button class="btn btn-link p-2 w-80">
                                    Membership Type
                                </button>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item sidebar-nav-item">
                        <a href="{{url('admin/news')}}" class="nav-link {{(Request::segment(2) == 'news') ? 'active' : ''}} p-3 mb-0 sidebar-nav-link w-100">
                            <i class="fas fa-newspaper pl-4" aria-hidden="true"></i>
                            <p id="accordion">
                                <!-- <button class="btn btn-link p-2 w-80" data-toggle="collapse" data-target="#collapseNews" aria-expanded="true" aria-controls="collapseNews" id="headingNews">
                                    News
                                </button> -->
                                <button class="btn btn-link p-2 w-80">
                                    News
                                </button>
                            </p>
                            <!-- <div id="collapseNews" class="collapse collapse-sidebar mt-2" aria-labelledby="headingNews" data-parent="#accordion">
                                <div>
                                    <ul>
                                        <li><a href="{{url('admin/members')}}"><i class="fas fa-ellipsis-h collapse-icon"></i>Pending Members</a></li>
                                        <li><a href="{{url('admin/members')}}"><i class="fas fa-check collapse-icon"></i>Approved Members</a></li>
                                        <li><a href="{{url('admin/members')}}"><i class="fas fa-times collapse-icon"></i>Rejected Members</a></li>
                                    </ul>
                                </div>
                            </div> -->
                        </a>
                    </li>

                    <li class="nav-item sidebar-nav-item" >
                        <a href="#" class="nav-link {{(Request::segment(2) == 'members') ? 'active' : ''}} p-3 mb-0 sidebar-nav-link w-100" id="mySettingsBtn" onclick=iconClick()>
                            <i class="fas fa-users pl-4" aria-hidden="true"></i>
                            <p id="accordion">
                                <button class="btn btn-link p-2 w-80" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="headingOne">
                                    Members<i class="fas fa-angle-down float-right" id="icon-toggle-settings"></i>
                                </button>
                                <div id="collapseOne" class="collapse collapse-sidebar" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div>
                                        <ul>
                                            <li><a href="{{url('admin/members')}}"><i class="fas fa-ellipsis-h collapse-icon"></i>Pending Members</a></li>
                                            <li><a href="{{url('admin/members')}}"><i class="fas fa-check collapse-icon"></i>Approved Members</a></li>
                                            <li><a href="{{url('admin/members')}}"><i class="fas fa-times collapse-icon"></i>Rejected Members</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </p>
                        </a>
                    </li>

                    <!-- <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Collapsible Group Item #1
                                </button>
                            </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- <li class="nav-item">
                        <a href="{{url('admin/projects')}}" class="nav-link {{(Request::segment(2) == 'projects') ? 'active' : ''}}">
                            <i class='fas fa-project-diagram'></i>
                            <p>
                                Projects
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('admin/clients')}}" class="nav-link {{(Request::segment(2) == 'clients') ? 'active' : ''}}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <p>
                                Client
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('admin/testimonials')}}" class="nav-link {{(Request::segment(2) == 'testimonials') ? 'active' : ''}}">
                            <i class="fa fa-quote-right" aria-hidden="true" style="backround-color:#fff;"></i>
                            <p>
                                Testimonials
                            </p>
                        </a>
                    </li> -->

                    <!-- <li class="nav-item nav-item-dropdown">
                        <div class="dropdown">
                        <i class="fa fa-book" aria-hidden="true"></i>
                            <button class="dropbtn">Office</button>
                                <div class="dropdown-content">
                                    <a href="{{url('admin/sub_offices')}}" class="nav-link {{(Request::segment(2) == 'sub_offices') ? 'active' : ''}}">Office</a>
                                    <a href="{{url('admin/departments')}}" class="nav-link {{(Request::segment(2) == 'departments') ? 'active' : ''}}">Department</a>
                                </div>
                        </div>
                    </li> -->

                    <!-- <li class="nav-item nav-item-dropdown">
                        <div class="accordion" id="accordionExample">
                            <div class="card acc-card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            <i class="fa fa-book" aria-hidden="true"></i>Office
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="dropdown-content">
                                            <a href="{{url('admin/sub_offices')}}" class="nav-link {{(Request::segment(2) == 'sub_offices') ? 'active' : ''}}">Office</a>
                                            <a href="{{url('admin/departments')}}" class="nav-link {{(Request::segment(2) == 'departments') ? 'active' : ''}}">Department</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <a href="{{url('admin/seo_titles')}}" class="nav-link {{(Request::segment(2) == 'departments') ? 'active' : ''}}">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <p>
                                Seo Titles
                            </p>
                        </a>
                    </li> -->

                    <!-- <li class="nav-item nav-item-dropdown">
                        <div class="dropdown">
                            <i class="fas fa-question-circle" aria-hidden="true"></i>
                            <button class="dropbtn">FAQ</button>
                                <div class="dropdown-content">
                                    <a href="{{url('admin/course_faqs')}}" class="nav-link {{(Request::segment(2) == 'course_faqs') ? 'active' : ''}}">CourseFAQ</a>
                                    <a href="{{url('admin/service_faqs')}}" class="nav-link {{(Request::segment(2) == 'service_faqs') ? 'active' : ''}}">ServiceFAQ</a>
                                </div>
                        </div>
                    </li> -->
<!-- 
                    <li class="nav-item nav-item-dropdown">
                        <div class="accordion" id="accordionExample">
                            <div class="card acc-card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                            <i class="fas fa-question-circle" aria-hidden="true"></i>FAQ
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="dropdown-content">
                                            <a href="{{url('admin/course_faqs')}}" class="nav-link {{(Request::segment(2) == 'course_faqs') ? 'active' : ''}}">CourseFAQ</a>
                                            <a href="{{url('admin/service_faqs')}}" class="nav-link {{(Request::segment(2) == 'service_faqs') ? 'active' : ''}}">ServiceFAQ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('admin/placements')}}" class="nav-link {{(Request::segment(2) == 'placements') ? 'active' : ''}}">
                            <i class="fas fa-hands-helping"></i>
                            <p>
                                Placements
                            </p>
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/teams')}}" class="nav-link {{(Request::segment(2) == 'teams') ? 'active' : ''}}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <p>
                                Teams
                            </p>
                        </a>
                    </li> -->

                    <!-- <li>
                        <a href="{{url('admin/seo_titles')}}" class="nav-link {{(Request::segment(2) == 'seo_titles') ? 'active' : ''}}">
                            <i class="fas fa-globe" aria-hidden="true"></i>
                            <p>
                                ServiceFAQ
                            </p>
                        </a>
                    </li> -->

                    <!-- <li>
                        <a href="{{url('admin/contacts')}}" class="nav-link">
                            <i class="fas fa-question-circle" aria-hidden="true"></i>
                            <p>
                                Contact/Enquiry
                            </p>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('admin/enrollments')}}" class="nav-link">
                            <i class="fas fa-question-circle" aria-hidden="true"></i>
                            <p>
                                Enrollment
                            </p>
                        </a>
                    </li> -->
                    
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <script>
        $(document).ready(function(){
            $("#mySettingsBtn").click(function(){
                console.log('clicked');
            });
        });
        function iconClick() {
            console.log('click')
             var x = document.getElementById('icon-toggle-settings');    
            x.classList.toggle("fa-angle-right");
        }
    </script>

    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


    



