<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" >
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin >
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('guest/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('guest/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('guest/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('guest/css/toastr.min.css')}}">
    <link rel="icon" href="{{asset('upload/favicon.png')}}">
    <title>Best Loan</title>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top navbar-light">
    <div class="container">
        <a class="navbar-brand p-0" href="#">
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
                    <a class="nav-link" aria-current="page" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-secondary px-4 mx-4 text-white signin-button" href="{{route('login.get')}}">Sign In</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header -->
<header class="header position-relative py-md-6 overflow-hidden">
    <div class="container position-relative z-3">
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-lg-6 mt-sm-2">
                    <h1 class="xl-text header-title">
                        Quick and Easy Loans for Your Financial Needs.
                    </h1>
                    <p class="lead mb-4">
                        Our loan services offer a hassle-free and streamlined borrowing experience, providing you with the funds you need in a timely manner to meet your financial requirements.
                    </p>
                    <a href="{{route('login.get')}}" class="btn btn-outline-secondary btn-lg m-2">
                        Sign In
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center">
                <div class="image-container">
                    <img src="{{asset('guest/images/header.png')}}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</header>
<section id="contact" class="contact py-6 position-relative">
    <div class="container position-relative z-3">
        <div class="row">
            <div class="col-lg-6 d-none d-md-block">
                <div class="mt-6">
                    <h1 class="xl-text text-primary">
                        About us
                    </h1>
                    <p class="lead mb-4">
                        QuickFunds- Your trusted financial partner for loans. Quick approvals, competitive rates, and personalized solutions to meet your unique needs. Empowering you to achieve your financial goals. Apply online today!
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 px-lg-6 px-sm-2">
                <div class="card shadow-md py-5 px-3 border-5">
                    <div class="card-body">
                        <form action="{{route('guest.message.store')}}" method="post">
                            @csrf
                            <div class="mb-4">
                                <input
                                        name="title"
                                        type="text"
                                        class="form-control"
                                        placeholder="Title"
                                        required>
                            </div>
                            <div class="mb-4">
                                <input
                                        name="name"
                                        type="text"
                                        class="form-control"
                                        placeholder="Your Name"
                                        required>
                            </div>
                            <div class="mb-4">
                                <input
                                        type="text"
                                        name="phone_number"
                                        class="form-control"
                                        placeholder="Phone Number"
                                        required>
                            </div>
                            <div class="mb-4">
                                <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="Email Address"
                                        required>
                            </div>
                            <div class="mb-4">
                          <textarea
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
                                        class="btn btn-secondary btn-block text-white signin-button"
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
                <span class="logo-quick">Quick<span class="logo-funds">Funds</span></span>
                <p class="mt-3 text-white footer-desc">
                    Our mission is to empower individuals and businesses by <br>providing them with the financial resources they need to achieve their goals.
                </p>
                <div class="social-container">
                    <a href="#" class="me-4">
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
                        <span class="text-white fw-bold">+91 99999 99999</span>
                    </div>

                    <div class="d-flex gap-2">
                        <img src="{{asset('guest/images/mail.svg')}}" alt="email address">
                        <span class="text-white fw-bold">xyzfh5@gmail.com</span>
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
</body>
</html>
