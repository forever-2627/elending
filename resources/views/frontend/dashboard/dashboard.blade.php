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
                                    <h5 class="fw-bold mb-3">Due Loans</h5>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Loan Start Date</th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Repayment Number</th>
                                            <th scope="col">Due Amount</th>
                                            <th scope="col">Outstanding Balance</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($loans as $key => $loan)
                                                @php
                                                    $due_detail = get_due_detail($loan);
                                                @endphp
                                                <tr>
                                                    <th scope="row">{{$key + 1}}</th>
                                                    <td>{{$loan->payment_start_date}}</td>
                                                    <td>{{$due_detail->due_date}}</td>
                                                    <td>{{$due_detail->repayment_number }} of {{ $loan->nof_payments }}</td>
                                                    <td>{{number_format($due_detail->amount, 2, '.', ',')}}</td>
                                                    <td>{{number_format($loan->outstanding_balance, 2, '.', ',')}}</td>
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
