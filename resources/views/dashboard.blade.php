@extends('frontend.frontend_dashboard')
@section('main')
    <section class="page-title centred" style="background-image: url({{ asset('frontend/assets/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Dashboard</h1>
            </div>
        </div>
    </section>
    <section class="sidebar-page-container blog-details sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">
                @php
                    $id = Auth::user()->id;
                    $userData = App\Models\User::find($id);
                @endphp
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h4>User Profile </h4>
                            </div>
                            <div class="post-inner">
                                <div class="post">
                                    <figure class="post-thumb"><a href="#">
                                            <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
                                    <h5><a href="#">{{ $userData->name }} </a></h5>
                                    <p>{{ $userData->email }} </p>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget category-widget">
                            <div class="widget-title">
                            </div>
                            @include('frontend.dashboard.dashboard_sidebar')
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <div class="lower-content">
                                    <h3>Dashboard</h3>
                                    <div class="row">
                                        {{--<div class="col-lg-4">--}}
                                            {{--<div class="card-body" style="background-color: #1baf65;">--}}
                                                {{--<h1 class="card-title" style="color: white; font-weight: bold;">0</h1>--}}
                                                {{--<h5 class="card-text" style="color: white;"> Approved properties</h5>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-4">--}}
                                            {{--<div class="card-body" style="background-color: #ffc107;">--}}
                                                {{--<h1 class="card-title" style="color: white; font-weight: bold; ">0</h1>--}}
                                                {{--<h5 class="card-text" style="color: white;"> Pending approve properties</h5>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-4">--}}
                                            {{--<div class="card-body" style="background-color: #002758;">--}}
                                                {{--<h1 class="card-title" style="color: white; font-weight: bold;">0</h1>--}}
                                                {{--<h5 class="card-text" style="color: white; "> Rejected properties</h5>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection