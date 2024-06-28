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
    <link href="{{ asset('frontend/assets/css/jquery-ui.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="icon" href="{{asset('upload/favicon.png')}}">
    <style>
        .auth-logo{
            width: 30%;
            background: white;
            padding: 1rem;
            border-radius: 1rem;
        }

        .learn-more{
            position: absolute;
            width: 360px;
            left: 24px;
            bottom: 50%;
            border: 0;
            font-weight: 900;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Best Loan</title>
</head>
<body  style="background-image: url({{ asset('frontend/assets/images/background/loan-request.jpg')}}); background-size: cover">
@php
    $setting = setting();
@endphp
<section>
    <input type="hidden" id="processing_fee" value="{{$setting['processing_fee']}}">
    <input type="hidden" id="interest_rate" value="{{$setting['interest_rate']}}">
    <div class="container position-relative z-3">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-lg pb-5 px-3 border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="{{asset('upload/logo.png')}}" class="auth-logo"/>
                        </div>
                        <form id="loan_request_form" action="{{route('user.request.loan.store')}}" method="post">
                            @csrf
                            <input type="hidden" id="email" name="email" value="{{$email}}">
                            <div class="row">
                                <div class="mb-4 col-md-6 form-group">
                                    <input
                                            id="first_name"
                                            name="first_name"
                                            type="text"
                                            class="form-control"
                                            placeholder="First Name"
                                            required>
                                </div>
                                <div class="mb-4 col-md-6 form-group">
                                    <input
                                            id="last_name"
                                            name="last_name"
                                            type="text"
                                            class="form-control"
                                            placeholder="Last Name"
                                            required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 col-md-6 form-group">
                                    <input
                                            id="employer_name"
                                            name="employer_name"
                                            type="text"
                                            class="form-control"
                                            placeholder="Employer Name"
                                            required>
                                </div>
                                <div class="mb-4 col-md-6 form-group">
                                    <input
                                            id="occupation"
                                            name="occupation"
                                            type="text"
                                            class="form-control"
                                            placeholder="Occupation"
                                            required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6 form-group">
                                    <input
                                            id="loan_amount"
                                            name="loan_amount"
                                            type="number"
                                            class="form-control"
                                            placeholder="Loan Amount"
                                            required>
                                </div>
                                <div class="mb-4 col-md-6 form-group">
                                    <input
                                            id="loan_period"
                                            name="loan_period"
                                            type="number"
                                            class="form-control"
                                            placeholder="Loan Period (Month)"
                                            required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6 form-group">
                                    <input
                                            id="address"
                                            name="address"
                                            type="text"
                                            class="form-control"
                                            placeholder="Address"
                                            required>
                                </div>
                                <div class="mb-4 col-md-6 form-group">
                                    <input
                                            id="phone_number"
                                            type="text"
                                            name="phone_number"
                                            class="form-control"
                                            placeholder="Phone Number"
                                            required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6 form-group">
                                    <input
                                            id="repayment_amount"
                                            name="repayment_amount"
                                            type="text"
                                            class="form-control"
                                            placeholder="Repayment Amount"
                                            required>
                                </div>
                                <div class="mb-4 col-md-6 form-group">
                                    <input
                                            id="payment_start_date"
                                            name="payment_start_date"
                                            type="text"
                                            class="form-control"
                                            placeholder="Payment Start Date"
                                            required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <select name="payment_frequency" class="form-control loan-input" id="payment_frequency">
                                            <option selected value="weekly">Weekly</option>
                                            <option value="fortnightly">For Nightly</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 form-group">
                                  <textarea
                                          id="loan_purpose"
                                          class="form-control"
                                          name="loan_purpose"
                                          placeholder="Purpose of Loan"
                                          rows="8"
                                          required
                                  ></textarea>
                            {{--</div><div class="row">--}}
                                {{--<div class="col d-flex justify-content-start">--}}
                                    {{--<!-- Checkbox -->--}}
                                    {{--<input type="hidden" id="is_first_loan" name="is_first_loan" value="0">--}}
                                    {{--<div class="form-check ms-1">--}}
                                        {{--<input class="form-check-input" type="checkbox" value="" id="first_loan" name="first_loan"/>--}}
                                        {{--<label class="form-check-label" for="first_loan">This is your first loan from us?</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="row mt-3">
                                <div class="col d-flex justify-content-start">
                                    <!-- Checkbox -->
                                    <div class="form-check ms-1">
                                        <input class="form-check-input" type="checkbox" value="" id="penalty_fee" />
                                        <label class="form-check-label d-flex" for="penalty_fee">Click here to confirm you are aware of the penalty fee.
                                            <a id="penalty_fee_help_link" href="#" title="Learn More..." class=" position-relative">
                                                <div id="penalty_fee_help" class="card learn-more shadow-lg" style="display: none">
                                                    <div class="card-body p-3">
                                                        <span>If you fail to repay the loan repayments due date, there will a Fee (the PENALTY FEE) OF P100.00 per day.</span>
                                                    </div>
                                                </div>
                                                <i class="ms-2 fa fa-question-circle" style="color: #f65038;"></i>
                                            </a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="row">--}}
                                {{--<div class="col d-flex justify-content-start">--}}
                                    {{--<!-- Checkbox -->--}}

                                    {{--<div class="form-check ms-1">--}}
                                        {{--<input class="form-check-input" type="checkbox" value="" id="processing_fee" />--}}
                                        {{--<label class="form-check-label d-flex" for="processing_fee">Are you able to agree 3% processing fee?--}}
                                            {{--<a class="position-relative" id="processing_fee_help_link" href="#" title="Learn More...">--}}
                                                {{--<div id="processing_fee_help" class="card learn-more shadow-lg" style="display: none">--}}
                                                    {{--<div class="card-body p-3">--}}
                                                        {{--<span>3% capital borrowed (LOAN AMOUNT).</span>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<i class="ms-2 fa fa-question-circle" style="color: #f65038;"></i>--}}
                                            {{--</a>--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="d-flex justify-content-center mt-2">
                                <button
                                        id="form_submit_button"
                                        type="submit"
                                        class="btn btn-secondary btn-block text-white signin-button w-100"
                                >Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="{{asset('guest/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('guest/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('guest/js/toastr.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/code/validate.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(() => {
        $('#payment_start_date').datepicker();
    });
</script>
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
    $('#penalty_fee_help_link').mouseenter(function() {
        $('#penalty_fee_help').show(100);
    }).mouseleave(function() {
        $('#penalty_fee_help').hide(100);
    });

    // $('#processing_fee_help_link').mouseenter(function() {
    //     $('#processing_fee_help').show(100);
    // }).mouseleave(function() {
    //     $('#processing_fee_help').hide(100);
    // });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $('#loan_request_form').validate({
            rules: {
                first_name: {
                    required : true,
                },
                last_name: {
                    required : true,
                },
                employer_name: {
                    required : true,
                },
                occupation: {
                    required : true,
                },
                loan_amount: {
                    required : true,
                },
                loan_period: {
                    required : true,
                },
                address: {
                    required : true,
                },
                phone_number: {
                    required : true,
                },
                repayment_amount: {
                    required : true,
                },
                payment_start_date:{
                    required: true,
                    date: true
                },
                payment_frequency: {
                    required : true,
                },
                loan_purpose: {
                    required : true,
                },
            },
            messages :{
                first_name: {
                    required: 'This field is required!',
                },
                last_name: {
                    required: 'This field is required!',
                },
                employer_name: {
                    required: 'This field is required!',
                },
                occupation: {
                    required: 'This field is required!',
                },
                loan_amount: {
                    required: 'This field is required!',
                },
                loan_period: {
                    required: 'This field is required!',
                },
                address: {
                    required: 'This field is required!',
                },
                phone_number: {
                    required: 'This field is required!',
                },
                repayment_amount: {
                    required: 'This field is required!',
                },
                payment_start_date:{
                    required: 'This field is required!',
                    date: 'Please input date type only'
                },
                payment_frequency: {
                    required: 'This field is required!',
                },
                loan_purpose: {
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
    });
</script>
<script>
    $('#form_submit_button').on('click', (e) => {
        e.preventDefault();
        // if(!$('#processing_fee').is(':checked')){
        //     toastr.warning('Please agree precessing fee to request loan.', 'Agree Terms');
        // }
        if(!$('#penalty_fee').is(':checked')){
            toastr.warning('Please agree penalty fee to request loan.', 'Agree Terms');
        }
        else{
            Swal.fire({
                title: 'Are you sure?',
                text: "Please check information you added is correct or not!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#loan_request_form').submit();
                }
            });
        }
    });

    $('#first_loan').on('click', (e) => {
        if($('#first_loan').is(':checked')){
            $('#is_first_loan').val(1);
        }else{
            $('#is_first_loan').val(0);
        }
    });

    const calcRepaymentAmount = () => {
        const value = parseFloat($('#loan_amount').val());
        const processingFeePercent = parseFloat($('#processing_fee').val());
        const interestRate = parseFloat($('#interest_rate').val());
        const loanPeriod = parseInt($('#loan_period').val());
        const paymentFrequency = $('#payment_frequency').val();
        let interval = 1;
        if(paymentFrequency === 'fortnightly') interval = 2;
        else if(paymentFrequency === 'monthly') interval = 4;
        const interests = interestRate * 0.01 * value * loanPeriod;
        const processingFee = processingFeePercent * 0.01 * value;
        const totalAmount = value + interests + processingFee;
        if(!isNaN(totalAmount)){
            $('#repayment_amount').val(Math.round(totalAmount / (4 * loanPeriod / interval)));
        }
        else{
            $('#repayment_amount').val('');
        }
    };

    $('#payment_frequency').on('change', () => {
        calcRepaymentAmount();
    });

    $('#loan_amount').on('input', (e) => {
        calcRepaymentAmount();
    });

    $('#loan_period').on('input', (e) => {
        calcRepaymentAmount();
    });

</script>
<script>

</script>
</body>
</html>
