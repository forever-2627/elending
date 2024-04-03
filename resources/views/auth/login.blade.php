
@extends('layouts.auth')
@section('main')
    @push('title')
        <title>User Login</title>
    @endpush

    <section class="ragister-section centred sec-pad">
        <div class="auto-container">
            <div class="row clearfix mt-5">
                <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                    <div class="inner-box mt-5">
                        <h4>Sign in</h4>
                        <form action="{{ route('login.post') }}" method="post" class="default-form">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" required="">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" required="">
                            </div>

                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn btn-one">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
