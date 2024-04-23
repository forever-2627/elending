@extends('layouts.auth')
@section('main')
    @push('title')
        <title>User Login</title>
    @endpush

    @push('styles')
        <style>
            .auth-back{
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                height: 100%;
            }

            .auth-overlay{
                background: #39508b9e;
            }

            .inner-box{
                background-color: #5276b270!important;
            }

            .btn-primary{
                background: #3f62cb!important;
                border: 0!important;
            }

            .auth-logo{
                width: 30%;
                background: white;
                padding: 1rem;
                border-radius: 1rem;
            }
        </style>
    @endpush

    <section class="ragister-section centred sec-pad position-relative">
        <img src="{{asset('guest/images/auth-back.jpg')}}" class="position-fixed auth-back">
        <div class="position-fixed auth-overlay auth-back"></div>
        <div class="auto-container">
            <div class="row clearfix mt-5">
                <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                    <div class="inner-box mt-5">
                        <img src="{{asset('upload/logo.png')}}" class="auth-logo"/>
                        <h4 class="text-white">Sign In</h4>
                        <form action="{{ route('login.post') }}" method="post" class="default-form">
                            @csrf
                            <div class="form-group">
                                <label class="text-white" for="email">Email</label>
                                <input type="text" name="email" id="email" required="">
                            </div>
                            <div class="form-group">
                                <label class="text-white" for="password">Password</label>
                                <input type="password" name="password" id="password" required="">
                            </div>
                            <div class="form-group message-btn">
                                <button type="submit" class="btn btn-primary w-100 py-3">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
