@extends('frontend.frontend_dashboard')
@section('main')
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
                    $user = App\Models\User::find($id);
                @endphp

                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h4>User Profile </h4>
                            </div>
                            <div class="post-inner">
                                <div class="post d-flex align-items-center flex-column">
                                    <figure class="post-thumb"><a href="#">
                                            <img src="{{ (!empty($user->photo)) ? url('upload/user_images/'.$user->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
                                    <h5><a href="#">{{ $user->given_name . ' ' . $user->surname }} </a></h5>
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
                                    <form id="profile_form" action="{{route('user.profile.update')}}" method="post" class="default-form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="surname">Surname</label>
                                            <input id="surname" type="text" name="surname" value="{{$user->surname}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="given_name">Given Name</label>
                                            <input id="given_name" type="text" name="given_name" value="{{$user->given_name}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" name="email" value="{{$user->email}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input id="phone_number" type="text" name="phone_number" value="{{$user->phone_number}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input id="address" type="text" name="address" value="{{$user->address}}">
                                        </div>
                                        <div class="form-group message-btn d-flex justify-content-end mb-0">
                                            <button type="submit" class="btn btn-primary py-3"><i class="fab fa fa-save me-2"></i> Save Changes </button>
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
                $('#profile_form').validate({
                    rules: {
                        surname: {
                            required : true,
                        },
                        given_name: {
                            required : true,
                        },
                        email: {
                            required : true,
                        },
                        phone_number: {
                            required : true,
                        },
                        address:{
                            required: true,
                        }
                    },
                    messages :{
                        surname: {
                            required : 'Surname is required!',
                        },
                        given_name: {
                            required : 'Given Name is required!',
                        },
                        email: {
                            required : 'Email Address is required!',
                        },
                        phone_number: {
                            required : 'Phone Number is required!',
                        },
                        address:{
                            required: 'Address is required!',
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
