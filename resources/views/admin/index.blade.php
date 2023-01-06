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
                            <a href="{{url('admin/index')}}">Home</a>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-3">

                        <div class="pending-card">
                            <a href="{{url('admin/members/pending')}}">
                                <div class="pending-top">
                                    <div class="pending-icon">
                                        <img src="{{url('admin/icons/pending-user-icon.svg')}}" class="img-fluid">
                                    </div>
                                    <div class="pending-desc">
                                        <h2>{{$pendingMembers}}</h2>
                                        <h4>Pending</h4>
                                    </div>
                                </div>
                                <hr>
                                <p>Total numbers of Pending member</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pending-card">
                            <a href="{{url('admin/members/verified')}}">
                                <div class="pending-top">
                                    <div class="pending-icon">
                                        <img src="{{url('admin/icons/verified-icon.svg')}}" class="img-fluid">
                                    </div>
                                    <div class="verified-desc">
                                        <h2>{{$verifiedMembers}}</h2>
                                        <h4>Verified</h4>
                                    </div>
                                </div>
                                <hr>
                                <p>Total numbers of Verified member</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pending-card">
                            <a href="{{url('admin/members/rejected')}}">
                                <div class="pending-top">
                                    <div class="pending-icon">
                                        <img src="{{url('admin/icons/rejected-icon.svg')}}" class="img-fluid">
                                    </div>
                                    <div class="rejected-desc">
                                        <h2>{{$rejectedMembers}}</h2>
                                        <h4>Rejected</h4>
                                    </div>
                                </div>
                                <hr>
                                <p>Total numbers of Rejected members</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pending-card">
                            <a href="{{url('admin/members/reapply')}}">
                                <div class="pending-top">
                                    <div class="pending-icon">
                                        <img src="{{url('admin/icons/associate-icon.svg')}}" class="img-fluid">
                                    </div>
                                    <div class="associate-desc">
                                        <h2>{{$reapplyMembers}}</h2>
                                        <h4>Reapply</h4>
                                    </div>
                                </div>
                                <hr>
                                <p>Total numbers of members for reapply</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <section class="content-team p-4">
            <div class="team-header">
                <div class="team-desc">
                    <h1>Team</h1>
                    <p>NRNA Team Members. Click on view all to see team details.</p>
                </div>
                <div class="team-breadcrum">
                    <a href="{{url('admin/team')}}">View all</a>
                </div>
            </div>
            <div class="members-display d-flex justify-content-between mt-2">
                <a href="/" class="teams-image">
                    <img src="{{url('admin/images/nanda-gurung.jpg')}}" class="img-fluid"/>
                    <h5>Nanda</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/deb.jpg')}}" class="img-fluid"/>
                    <h5>Deb</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/ashok.jpg')}}" class="img-fluid"/>
                    <h5>Ashok</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/bishnu.jpg')}}" class="img-fluid"/>
                    <h5>Bishnu</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/binod.jpg')}}" class="img-fluid"/>
                    <h5>Binod</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/renuka.jpg')}}" class="img-fluid"/>
                    <h5>Renuka</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/ramhari.jpg')}}" class="img-fluid"/>
                    <h5>Ramhari</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/dipak.jpg')}}" class="img-fluid"/>
                    <h5>Ashok</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/rakesh-shakya.jpg')}}" class="img-fluid"/>
                    <h5>Bishnu</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/raju-babu-adhikari.jpg')}}" class="img-fluid"/>
                    <h5>Raju</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/sandhaya-shah.jpg')}}" class="img-fluid"/>
                    <h5>Sandhya</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/anil-pokhrel.jpg')}}" class="img-fluid"/>
                    <h5>Anil</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/raj-kumar-nagarkoti.jpg')}}" class="img-fluid"/>
                    <h5>Raju</h5>
                </a>
                <a href="/"  class="teams-image">
                    <img src="{{url('admin/images/manu-khadka.jpg')}}" class="img-fluid"/>
                    <h5>Sandhya</h5>
                </a>
            </div>
        </section> -->
        <section class="news-section">
            <div class="row gx-5">
                <div class="col-md-7 col-sm-12">
                    <div class="news-section-left">
                        <div class="team-header">
                            <div class="team-desc">
                                <h1>News</h1>
                                <p>News from NRNA Australia.</p>
                            </div>
                            <div class="team-breadcrum">
                                <a href="{{url('admin/news')}}">View all</a>
                            </div>
                        </div>
                        <div class="news-content d-flex justify-content-between">
                            @php $featured_news = $news->where('type',1);
                                $newtime = strtotime($news->first()->created_at ?? '');
                                $date_time = date('M d, Y',$newtime);
                            @endphp
                            @if($featured_news->isNotEmpty())
                            <a href="/" class="left-news">
                                <div class="left-news-image">
                                    <img src="{{url($featured_news->first()->image ?? '')}}" class="w-100"/>
                                </div>
                                <p>{{$featured_news->first()->title}}</p>
                                <h5>{{$date_time}}</h5>
                            </a>
                            @endif
                            <div class="news-right">
                                @foreach($news->where('type','!=',1)->take(2) as $single_news)
                                <a href="/" class="news-right-primary">
                                    <div class="news-right-img">
                                        <img src="{{url($single_news->image)}}" class="w-100"/>
                                    </div>
                                    <p>{{$single_news->title}}</p>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="news-section-right">
                        <div class="notices-header">
                            <div class="notice-title">
                                <h1>Notices</h1>
                                <p>Notice and updates from NRNA - Australia</p>
                            </div>
                            <div class="team-breadcrum">
                                <a href="{{url('admin/notices')}}">View all</a>
                            </div>
                        </div>
                        <div class="notice-cards">
                            @foreach($notices as $notice)
                            <a href="/" class="notice-card">
                                <div class="notice-img">
                                    <img src="{{url($notice->image)}}" class="w-100"/>
                                </div>
                                <div class="notice-card-title">
                                    <h2>Cultural Parade - Nepal Festival Brisbane 2018</h2>
                                    <div class="notice-card-bottom">
                                    @php
                                        $time = strtotime($notice->first()->created_at);
                                        $created_at = date('M d, Y',$time);
                                    @endphp
                                        <!-- <h5>Notice</h5> -->
                                        <h5>{{$created_at}}</h5>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                       
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        var $slider = $('.members-display');
        $slider.slick({
            slidesToShow: 10,
            slidesToScroll: 1,
            autoplay: true,
            arrows: false,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 8,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 6,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
@endsection
