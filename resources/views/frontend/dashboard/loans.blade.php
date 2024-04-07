@extends('frontend.frontend_dashboard')
@section('main')

    @push('styles')
        <style>
            .lower-content{
                overflow-x: auto!important;
            }
        </style>
    @endpush
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


    <!--Page Title-->
    <section class="page-title centred" style="background-image: url({{ asset('frontend/assets/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>User Profile </h1>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <!-- sidebar-page-container -->
    <section class="sidebar-page-container blog-details sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">
                @php

                    $id = Auth::user()->id;
                    $userData = App\Models\User::find($id);
                @endphp
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side mb-5">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h4>User Profile </h4>
                            </div>
                            <div class="post-inner">
                                <div class="post">
                                    <figure class="post-thumb"><a href="blog-details.html">
                                            <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
                                    <h5><a href="blog-details.html">{{ $userData->name }} </a></h5>
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
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Loan Start Date</th>
                                            <th scope="col">Payment Frequency</th>
                                            <th scope="col">Loan Amount</th>
                                            <th scope="col">Repayment Amount</th>
                                            <th scope="col">Outstanding Balance</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>2024.04.07</td>
                                            <td>Weekly</td>
                                            <td>54000PHP</td>
                                            <td>30000PHP</td>
                                            <td>24000PHP</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>2024.04.01</td>
                                            <td>Weekly</td>
                                            <td>34000PHP</td>
                                            <td>21000PHP</td>
                                            <td>13000PHP</td>
                                        </tr>
                                        @php
                                            $srequest = [];
                                        @endphp
                                        @foreach($srequest as $key => $item)
                                            <tr>
                                                <th scope="row">{{ $key+1 }}</th>
                                                <td>{{ $item['property']['property_name'] }}</td>
                                                <td>{{ $item->tour_date }}</td>
                                                <td>{{ $item->tour_time }}</td>
                                                <td>
                                                    @if($item->status == 1)
                                                        <span class="badge rounded-pill bg-success">Confirm</span>

                                                    @else
                                                        <span class="badge rounded-pill bg-danger">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
