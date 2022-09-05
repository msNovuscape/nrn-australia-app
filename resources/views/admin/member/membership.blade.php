@extends('admin.layouts.app')
@section('style')
    {!! Html::style('admin/css/membership.css') !!}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header p-4">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-12" style="display: flex; justify-content: space-between">
                        <div class="membership-desc">
                            <h1>Membership</h1>
                            <p>Overview of membership. Click on each block to see specific members and details.</p>
                        </div>
                        <div class="membership-breadcrum">
                            <a href="/">Home</a>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="pending-card">
                            <div class="pending-top">
                                <div class="pending-icon">
                                    <img src="{{url('admin/icons/pending-user-icon.svg')}}" class="img-fluid">
                                </div>
                                <div class="pending-desc">
                                    <h2>373</h2>
                                    <h4>Pending</h4>
                                </div>
                            </div>
                            <p>Total numbers of pending member</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pending-card">
                            <div class="pending-top">
                                <div class="pending-icon">
                                    <img src="{{url('admin/icons/verified-icon.svg')}}" class="img-fluid">
                                </div>
                                <div class="verified-desc">
                                    <h2>1500</h2>
                                    <h4>Verified</h4>
                                </div>
                            </div>
                            <p>Total numbers of Verified member</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pending-card">
                            <div class="pending-top">
                                <div class="pending-icon">
                                    <img src="{{url('admin/icons/rejected-icon.svg')}}" class="img-fluid">
                                </div>
                                <div class="rejected-desc">
                                    <h2>200</h2>
                                    <h4>Rejected</h4>
                                </div>
                            </div>
                            <p>Total numbers of Rejected members</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pending-card">
                            <div class="pending-top">
                                <div class="pending-icon">
                                    <img src="{{url('admin/icons/associate-icon.svg')}}" class="img-fluid">
                                </div>
                                <div class="associate-desc">
                                    <h2>253</h2>
                                    <h4>Associate</h4>
                                </div>
                            </div>
                            <p>Total numbers of Associate members</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content-team p-4">
            <div class="team-header">
                <div class="team-desc">
                    <h1>Team</h1>
                    <p>NRNA Team Members. Click on view all to see team details.</p>
                </div>
                <div class="team-breadcrum">
                    <a href="/view-all">View all</a>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <div class="teams-image">
                    <img src="{{url('admin/images/nanda-gurung.jpg')}}" class="img-fluid"/>
                    <h5>Nanda</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/deb.jpg')}}" class="img-fluid"/>
                    <h5>Deb</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/ashok.jpg')}}" class="img-fluid"/>
                    <h5>Ashok</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/bishnu.jpg')}}" class="img-fluid"/>
                    <h5>Bishnu</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/binod.jpg')}}" class="img-fluid"/>
                    <h5>Binod</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/renuka.jpg')}}" class="img-fluid"/>
                    <h5>Renuka</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/ramhari.jpg')}}" class="img-fluid"/>
                    <h5>Ramhari</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/dipak.jpg')}}" class="img-fluid"/>
                    <h5>Ashok</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/rakesh-shakya.jpg')}}" class="img-fluid"/>
                    <h5>Bishnu</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/raju-babu-adhikari.jpg')}}" class="img-fluid"/>
                    <h5>Raju</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/sandhaya-shah.jpg')}}" class="img-fluid"/>
                    <h5>Sandhya</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/anil-pokhrel.jpg')}}" class="img-fluid"/>
                    <h5>Anil</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/raj-kumar-nagarkoti.jpg')}}" class="img-fluid"/>
                    <h5>Raju</h5>
                </div>
                <div class="teams-image">
                    <img src="{{url('admin/images/manu-khadka.jpg')}}" class="img-fluid"/>
                    <h5>Sandhya</h5>
                </div>
            </div>
        </section>
        <section class="news-section p-4">
            <div class="row gx-5">
                <div class="col-md-7">
                    <div class="news-section-left">
                        <div class="team-header">
                            <div class="team-desc">
                                <h1>News</h1>
                                <p>News from NRNA Australia.</p>
                            </div>
                            <div class="team-breadcrum">
                                <a href="/view-all">View all</a>
                            </div>
                        </div>
                        <div class="news-content d-flex justify-content-between">
                            <div class="left-news">
                                <div class="left-news-image">
                                    <img src="{{url('admin/images/left-news.jpg')}}" class="w-100"/>
                                </div>
                                <p>Seminar on citizenship, voting rights,  and investment..</p>
                                <h5>8 Aug 2022</h5>
                            </div>
                            <div class="news-right">
                                <div class="news-right-primary">
                                    <div class="news-right-img">
                                        <img src="{{url('admin/images/right-news.jpg')}}" class="w-100"/>
                                    </div>
                                    <p>Regional conference 2022</p>
                                </div>
                                <div class="news-right-primary">
                                    <div class="news-right-img">
                                        <img src="{{url('admin/images/job-placement.jpg')}}" class="w-100"/>
                                    </div>
                                    <p>Regional conference 2022</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="news-section-right">
                        <div class="notice-title">
                            <h1>Notices</h1>
                            <p>Notice and updates from NRNA - Australia</p>
                        </div>
                        <div class="notice-cards">
                            <div class="notice-card">
                                <div class="notice-img">
                                    <img src="{{url('admin/images/notice-one.jpg')}}" class="w-100"/>
                                </div>
                                <div class="notice-card-title">
                                    <h2>Cultural Parade - Nepal Festival Brisbane 2018</h2>
                                    <div class="notice-card-bottom">
                                        <h5>News</h5>
                                        <h5>8 Aug 2022</h5>
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