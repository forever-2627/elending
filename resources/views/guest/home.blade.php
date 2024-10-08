<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" >
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin >
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('guest/vendor/aos/aos.css')}}">
    <link rel="stylesheet" href="{{asset('guest/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('guest/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('guest/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('guest/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('guest/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{ asset('guest/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="icon" href="{{asset('upload/favicon.png')}}">
    <style>
        #about{
            min-height: 842px;
        }

        .about-back{
            background: url('guest/images/about.jpg');
            background-size: cover;
        }

        #money_range_label{
            font-size: 32px;
            font-weight: 900;
        }

        #feature{
            background: linear-gradient(180deg, #e8e8e8, #ccc7f3);
            background-size: cover;
            border-top: 4px solid #e8e8e8;
            border-bottom: 4px solid #cbc6f1

            /*background: linear-gradient(180deg, #e8e8e8, #ffffff);*/
            /*background-size: cover;*/
            /*border-top: 4px solid #fbf3e5;*/
            /*border-bottom: 4px solid #f7f7f7;*/
        }

        .feature-img{
            width: 64px;
            height: 64px;
        }

        .feature-text{
            font-family: sans-serif;
        }

        .how-to-image{
            width: 100%;
            position: absolute;
            bottom: -50px;
        }

        .nav-link{
            font-size: 1rem;
        }

        .animated-2{
            animation: up-down 1.5s ease-in-out infinite alternate-reverse both;
        }
        .animated-3{
            animation: up-down 2s ease-in-out infinite alternate-reverse both;
        }

        .how-to-card{
            border: 0;
            box-shadow: 0 0 10px 4px #d7d2f5;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Best Loan</title>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top navbar-light py-3">
    <div class="container" data-aos="fade-down" data-aos-delay="200">
        <a class="navbar-brand p-0 fa fa-beat" href="#">
            <img src="{{asset('upload/logo.png')}}" width="96"/>
        </a>
        <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('home')}}"><i class="fa fa-home me-2"></i>    Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about"><i class="fa fa-user me-2"></i>    About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact"><i class="fa fa-envelope me-2"></i>    Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-secondary px-4 mx-4 text-white signin-button" href="{{route('login.get')}}"><i class="fa fa-sign-in me-2"></i>Sign In</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header -->
<header class="header position-relative py-md-6 overflow-hidden">
    <div class="container position-relative z-3">
        <div class="row">
            <div class="col-lg-7" data-aos="fade-right">
                <div class="mt-lg-6 mt-sm-2">
                    <h1 class="xl-text header-title header-text">
                        Quick and Easy Loans for Your Financial Needs.
                    </h1>
                    <p class="lead mb-4">
                        Our loan services offer a hassle-free and streamlined borrowing experience, providing you with the funds you need in a timely manner to meet your financial requirements.
                    </p>
                    <a href="{{route('login.get')}}" class="btn btn-outline-secondary btn-lg m-2">
                        <i class="fa fa-sign-in me-2"></i> Sign In
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-flex align-items-center">
                <div class="card shadow-md border-0 shadow-lg" data-aos="fade-left">
                    <div class="card-header border-0 px-5 pt-5 pb-4">
                        <h4 class="mt-2 text-center">How much money do you need?</h4>
                        <div class="w-100 d-flex justify-content-center">
                            <label id="money_range_label" for="money_range" class="form-label mt-2">₱ 1000</label>
                        </div>
                        <input type="range" min="1000" max="25000" step="100" id="money_range" value="1000" class="mt-2">
                    </div>
                    <div class="card-body mt-2 px-5 pb-5">
                        <form id="loan_amount_form" action="{{route('guest.loan.requested')}}" method="post" onsubmit="return validateCaptcha()">
                            @csrf
                            <div class="my-4">
                                <input
                                        id="loan_email"
                                        name="loan_email"
                                        type="email"
                                        class="form-control"
                                        placeholder="Email"
                                        required>
                            </div>
                            <div class="mb-4" id="custom_loan_amount" style="display: none;">
                                <input
                                        id="loan_amount"
                                        name="loan_amount"
                                        type="number"
                                        class="form-control"
                                        placeholder="Loan Amount"
                                        required>
                            </div>
                            <div class="row">
                                <div class="col d-flex justify-content-start">
                                    <!-- Checkbox -->
                                    <div class="form-check ms-1">
                                        <input class="form-check-input" type="checkbox" value="" id="higher_amount" />
                                        <label class="form-check-label" for="higher_amount">I need higher amount of loan.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-start">
                                    <!-- Checkbox -->
                                    <div class="form-check ms-1">
                                        <input class="form-check-input" type="checkbox" value="" id="privacy" />
                                        <label class="form-check-label" for="privacy">I have read and agreed with the <a href="{{url('privacy')}}" target="_blank"> Privacy policy,</a><a href="{{url('terms')}}" target="_blank"> Terms & Conditions</a> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button
                                        type="submit"
                                        class="g-recaptcha btn btn-secondary btn-block text-white signin-button w-100"
                                        data-sitekey="{{config('services.recaptcha.site_key')}}"
                                        data-callback='onSubmitLoanAmountForm'
                                        data-action='submit'
                                >Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
{{--  Features  --}}
<section id="feature" class="py-4" style="">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12 d-flex align-items-center mb-sm-3" data-aos="zoom-in" data-aos-delay="600">
                <h3 class="m-0 font-sans fw-bolder header-text">
                    Who is eligible to apply?
                </h3>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 d-flex align-items-center justify-content-start gap-3 py-2" data-aos="zoom-in" data-aos-delay="800">
                <img class="feature-img" src="{{url('guest/images/people.png')}}" />
                <span class="text-color fw-bolder fs-6 feature-text">21-70 Years Old</span>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 d-flex align-items-center justify-content-start gap-3 py-2" data-aos="zoom-in" data-aos-delay="1000">
                <img class="feature-img" src="{{url('guest/images/location.png')}}" />
                <span class="text-color fw-bolder fs-6 feature-text">Philippine Resident</span>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 d-flex align-items-center justify-content-start gap-3 py-2" data-aos="zoom-in" data-aos-delay="1200">
                <img class="feature-img" src="{{url('guest/images/staff.png')}}" />
                <span class="text-color fw-bolder fs-6 feature-text">Employed Individuals & Selected Professionals</span>
            </div>
        </div>
    </div>
</section>
<svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none" style="transform: rotate(180deg);">
    <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
    </defs>
    <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(204,199,243, .1)">
    </g>
    <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(204,199,243, .2)">
    </g>
    <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#ccc7f3">
    </g>
</svg>
{{--  How To Apply  --}}
<section id="how_to_apply" class="how_to_apply py-6" style="margin-top: -1px;">
    <div class="container position-relative z-3">
        <h1 class="xl-text text-primary header-text text-center mb-5" data-aos="fade-down" data-aos-delay="300">
            How To Apply To Get Money
        </h1>
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-xs-12 mt-4"  data-aos="fade-right" data-aos-delay="500">
                <div class="card p-4 how-to-card" style="min-height: 176px">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 col-xs-6 position-relative">
                            <img src="{{url('guest/images/loan-request.png')}}" class="how-to-image animated-2">
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-6 col-xs-6 ">
                            <h3 class="mb-0">1. Request Loan</h3>
                            <p class="text-dark mb-1">Fill in your details in the boxes provided on the website<br/>
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-xs-12 mt-4" data-aos="fade-down" data-aos-delay="700">
                <div class="card p-4 how-to-card" style="min-height: 176px">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 col-xs-6 position-relative">
                            <img src="{{url('guest/images/keep-contact.png')}}" class="how-to-image animated-3">
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-6 col-xs-6 ">
                            <h3 class="mb-0">2. Keep Contact</h3>
                            <p class="text-dark">The loan's administrator will contact you and ask you to fill in an online application form
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-xs-12 mt-4" data-aos="fade-left" data-aos-delay="900">
                <div class="card p-4 how-to-card" style="min-height: 176px">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 col-xs-6 position-relative">
                            <img src="{{url('guest/images/wait-money.png')}}" class="how-to-image animated-2">
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-6 col-xs-6 ">
                            <h3 class="mb-0">3. Wait Decision</h3>
                            <p class="text-dark">You will receive a quick decision from our administrator and the funds will be made available to you.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{--  Testimonials  --}}
<h1 class="xl-text text-primary header-text text-center mt-6 mb-5" data-aos="fade-down" data-aos-delay="300">
    What Our Clients Are Saying...
</h1>
<section id="testimonials" class="testimonials">
    <div class="container">

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{url('guest/images/testimonials-1.png')}}" class="testimonial-img" alt="">
                        <h3>Saul Goodman</h3>
                        <h4>Ceo &amp; Founder</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{url('guest/images/testimonials-1.png')}}" class="testimonial-img" alt="">
                        <h3>Sara Wilsson</h3>
                        <h4>Ceo &amp; Founder</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{url('guest/images/testimonials-1.png')}}" class="testimonial-img" alt="">
                        <h3>Jena Karlis</h3>
                        <h4>Ceo &amp; Founder</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{url('guest/images/testimonials-1.png')}}" class="testimonial-img" alt="">
                        <h3>Matt Brandon</h3>
                        <h4>Ceo &amp; Founder</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="{{url('guest/images/testimonials-1.png')}}" class="testimonial-img" alt="">
                        <h3>John Larson</h3>
                        <h4>Ceo &amp; Founder</h4>
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section><!-- End Testimonials Section -->


{{--  About US  --}}
<section id="about" class="contact pb-md-6 position-relative about-back" style="">
    <div class="container position-relative z-3">
        <div class="row">
            <div class="col-lg-6 col-sm-12 d-md-block position-relative mt-md-6 mt-sm-1" data-aos="fade-right" data-aos-delay="600">
                <div class="mt-6">
                    <h1 class="xl-text text-primary header-text">
                        About us
                    </h1>
                    <p class="lead mb-4">
                        ISBM Loans- Your trusted financial partner for loans. Quick approvals, competitive rates, and personalized solutions to meet your unique needs. Empowering you to achieve your financial goals. Apply online today!
                    </p>
                </div>

            </div>
            <div class="col-lg-6 col-sm-12 d-md-block position-relative mt-md-6 mt-sm-1" data-aos="fade-left" data-aos-delay="600">
                <div>
                    <h1 class="xl-text text-primary header-text">
                        Contact us
                    </h1>
                    <p class="lead mb-4">
                        To enquire About a loan, please send us your contact information below with a short message
                    </p>
                    <h6 class="text-muted"></h6>
                </div>

                <div class="card shadow-md py-5 px-3 border-5">
                    <div class="card-body">
                        <form id="contact_form" action="{{route('guest.message.store')}}" method="post">
                            @csrf
                            <div class="mb-4">
                                <input
                                        id="title"
                                        name="title"
                                        type="text"
                                        class="form-control"
                                        placeholder="Title"
                                        required>
                            </div>
                            <div class="mb-4">
                                <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        class="form-control"
                                        placeholder="Your Name"
                                        required>
                            </div>
                            <div class="mb-4">
                                <input
                                        id="phone_number"
                                        type="text"
                                        name="phone_number"
                                        class="form-control"
                                        placeholder="Phone Number"
                                        required>
                            </div>
                            <div class="mb-4">
                                <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="Email Address"
                                        required>
                            </div>
                            <div class="mb-4">
                          <textarea
                                  id="message"
                                  class="form-control"
                                  name="message"
                                  placeholder="Enter message"
                                  rows="8"
                                  required
                          ></textarea>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button
                                        type="submit"
                                        class="g-recaptcha btn btn-secondary btn-block text-white signin-button w-100"
                                        data-sitekey="{{config('services.recaptcha.site_key')}}"
                                        data-callback='onSubmit'
                                        data-action='submit'
                                >Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer bg-light py-lg-6 py-sm-2 px-sm-2">
    <div class="container">
        <div class="row">
            <div class="col-md-9 my-3">
                <span class="logo-quick">ISMB<span class="logo-funds">Loans</span></span>
                <p class="mt-3 text-white footer-desc">
                    Our mission is to empower individuals and businesses by <br>providing them with the financial resources they need to achieve their goals.
                </p>
                <div class="social-container">
                    <a href="https://www.facebook.com/profile.php?id=100054819007078" class="me-4">
                        <img src="{{asset('guest/images/facebook.svg')}}" alt="facebook">
                    </a>

                    <a href="#" class="me-4">
                        <img src="{{asset('guest/images/whatsapp.svg')}}" alt="whatsapp">
                    </a>

                    <a href="#" class="me-4">
                        <img src="{{asset('guest/images/instogram.svg')}}" alt="instogram">
                    </a>

                    <a href="#">
                        <img src="{{asset('guest/images/linkedin.svg')}}" alt="linkedin">
                    </a>
                </div>
            </div>
            <div class="col-md-3 my-3 d-flex align-items-start flex-column">
                <h4 class="text-white">CONTACT US</h4>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex gap-2">
                        <img src="{{asset('guest/images/phone.svg')}}" alt="phone number">
                        <span class="text-white fw-bold">+09633967802 </span>
                    </div>

                    <div class="d-flex gap-2">
                        <img src="{{asset('guest/images/mail.svg')}}" alt="email address">
                        <span class="text-white fw-bold">info@ismblending.com</span>
                    </div>

                    <div class="d-flex gap-2">
                        <img src="{{asset('guest/images/location.svg')}}" alt="location">
                        <span class="text-white fw-bold">city, state-pin code.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('guest/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('guest/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('guest/js/toastr.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/code/validate.min.js') }}"></script>
<script src="{{ asset('guest/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('guest/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script>
            @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
</script>

<script>
    function onSubmit(token) {
        document.getElementById("contact_form").submit();
    }

    function validateCaptcha() {
        var response = grecaptcha.getResponse();
        console.log(response);
        if (response.length === 0) {
            alert('Please complete the CAPTCHA.');
            return false;
        }
        return true;
    }

    function onSubmitLoanAmountForm() {
        const agreed = $('#privacy').is(':checked');
        if(agreed) document.getElementById("loan_amount_form").submit();
        else toastr.warning('You have to agree terms and conditions first!', 'Input Error');
    }
</script>

<script>
    $('#money_range').on('change', function (e) {
        const amount = e.target.value;
        $('#money_range_label').html(`₱ ${amount}`);
        $('#loan_amount').val(amount);
    });
    
    $('#higher_amount').on('change', function (e) {
        if($('#higher_amount').is(':checked')){
            $('#custom_loan_amount').show();
            $('#money_range').hide();
        }else{
            $('#custom_loan_amount').hide();
            $('#money_range').show();
        }
    });

    $('#loan_amount').on('input', function (e) {
        const amount = e.target.value;
        $('#money_range_label').html(`₱ ${amount}`);
    });

</script>

{{--Validation--}}
<script type="text/javascript">
    $(document).ready(function (){
        $('#contact_form').validate({
            rules: {
                title: {
                    required : true,
                },
                name: {
                    required : true,
                },
                phone_number: {
                    required : true,
                },
                email: {
                    required : true,
                },
                message:{
                    required: true,
                    date: true
                },
            },
            messages :{
                title: {
                    required : 'This field is required!',
                },
                name: {
                    required : 'This field is required!',
                },
                phone_number: {
                    required : 'This field is required!',
                },
                email: {
                    required : 'This field is required!',
                },
                message:{
                    required: 'This field is required!',
                },
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

        $('#loan_amount_form').validate({
            rules: {
                loan_email: {
                    required : true,
                },
                loan_amount:{
                    required: true,
                },
            },
            messages :{
                loan_email: {
                    required : 'This field is required!',
                },
                loan_amount: {
                    required : 'This field is required!',
                },
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
<script>
    AOS.init();

    new Swiper('.testimonials-slider', {
        speed: 600,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        slidesPerView: 'auto',
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        }
    });
</script>


</body>
</html>
