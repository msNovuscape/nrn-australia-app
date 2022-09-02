<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{url('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('admin/index')}}" class="brand-link">
            <span class="brand-text font-weight-light">
{{--                <img class="extratech-logo" src="{{url(\App\Models\Setting::where('slug','logo')->first()->value)}}" alt="">--}}
            </span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar sb">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{url('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{url('admin/settings')}}" class="nav-link {{(Request::segment(2) == 'settings') ? 'active' : ''}}">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            <p>
                                Settings
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('admin/sliders')}}" class="nav-link {{(Request::segment(2) == 'sliders') ? 'active' : ''}}">
                            <i class="fas fa-sliders-h"></i>
                            <p>
                                Sliders
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('admin/eligibility_types')}}" class="nav-link {{(Request::segment(2) == 'membership_types') ? 'active' : ''}}">
                            <i class="fas fa-sliders-h"></i>
                            <p>
                                Eligibility Type
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('admin/membership_types')}}" class="nav-link {{(Request::segment(2) == 'membership_types') ? 'active' : ''}}">
                            <i class="fas fa-sliders-h"></i>
                            <p>
                                Membership Type
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('admin/members')}}" class="nav-link {{(Request::segment(2) == 'members') ? 'active' : ''}}">
                            <i class="fas fa-sliders-h"></i>
                            <p>
                                Members
                            </p>
                        </a>
                    </li>

                    

                   

                    <li class="nav-item">
                        <a href="{{url('admin/news')}}" class="nav-link  {{(Request::segment(2) == 'news') ? 'active' : ''}}">
                            <i class="fas fa-blog"></i>
                            <p>
                                News
                            </p>
                        </a>
                    </li>

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


    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
