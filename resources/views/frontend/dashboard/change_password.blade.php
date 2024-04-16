@extends('frontend.frontend_dashboard')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


    <!--Page Title-->
    <section class="page-title centred" style="background-image: url({{ asset('frontend/assets/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Change Password  </h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="#">Home</a></li>
                    <li>Change Password</li>
                </ul>
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
                    $user = App\Models\User::find($id);
                @endphp
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h4>User Profile </h4>
                            </div>
                            <div class="post-inner">
                                <div class="post">
                                    <figure class="post-thumb"><a href="blog-details.html">
                                            <img src="{{ (!empty($user->photo)) ? url('upload/user_images/'.$user->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
                                    <h5><a href="blog-details.html">{{ $user->name }} </a></h5>
                                    <p>{{ $user->email }} </p>
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
                                    <form id="change_password_form" action="{{route('user.password.update')}}" method="post" class="default-form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" name="old_password" class="form-control" id="old_password">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password </label>
                                            <input type="password" name="new_password" class="form-control" id="new_password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm New Password</label>
                                            <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation">
                                        </div>
                                        <div class="form-group message-btn d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary py-3"><i class="fa fa-save"></i> Save Changes </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script type="text/javascript">
            $(document).ready(function (){
                $('#change_password_form').validate({
                    rules: {
                        old_password:{
                            required : true,
                        },
                        new_password: {
                            required : true,
                            minlength: 5
                        },
                        new_password_confirmation:{
                            required: true,
                            equalTo: '#new_password'
                        }
                    },
                    messages :{
                        old_password:{
                            required : 'Password is required!',
                        },
                        new_password: {
                            required : 'Password is required!',
                            minlength: 'Password length must be at least 5 characters!'
                        },
                        new_password_confirmation:{
                            required: 'Please input this field!',
                            equalTo: 'This field must be same as password!'
                        }
                    },
                    errorElement : 'span',
                    errorPlacement: function (error,element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight : function(element, errorClass, validClass){
                        $(element).addClass('is-invalid');
                    },
                    unhighlight : function(element, errorClass, validClass){
                        $(element).removeClass('is-invalid');
                    },
                });
            });
        </script>
    @endpush
@endsection
