@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">
            <!-- left wrapper start -->

            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">

                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Loan </h6>

                            <form method="post" action="" id="myForm"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="surname">Surname</label>
                                            <input type="text" id="surname" name="surname" class="form-control" value="{{ old('property_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="given_name">Given Name</label>
                                            <input type="text" id="given_name" name="given_name" class="form-control" value="{{ old('given_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="phone_number">Phone Number</label>
                                            <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="address">Address</label>
                                            <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="loan_amount">Loan Amount</label>
                                            <input type="text" id="loan_amount" name="loan_amount" class="form-control" value="{{ old('loan_amount') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="loan_issued">Loan Issued</label>
                                            <input type="text" id="loan_issued" name="loan_issued" class="form-control" value="{{ old('loan_issued') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="payment_frequency" class="form-label">Payment Frequency</label>
                                            <select name="payment_frequency" class="form-control" id="payment_frequency">
                                                <option selected="" disabled="">Select Payment Frequency</option>
                                                <option value="weekly">Weekly</option>
                                                <option value="fortnightly">For Nightly</option>
                                                <option value="monthly">Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="nof_payments">Number of Payments</label>
                                            <input type="text" id="nof_payments" name="nof_payments" class="form-control" value="{{ old('nof_payments') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="payment_start_date">Payment Start Date</label>
                                            <input type="text" id="payment_start_date" name="payment_start_date" class="form-control" value="{{ old('payment_start_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="payment_amount">Payment Amount</label>
                                            <input type="text" id="payment_amount" name="payment_amount" class="form-control" value="{{ old('payment_amount') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="total_to_be_repaid">Total to be Repaid</label>
                                            <input type="text" id="total_to_be_repaid" name="total_to_be_repaid" class="form-control" value="{{ old('total_to_be_repaid') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="amount_repaid_to_date">Amount Repaid to Date</label>
                                            <input type="text" id="amount_repaid_to_date" name="amount_repaid_to_date" class="form-control" value="{{ old('amount_repaid_to_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="outstanding_balance">Outstanding Balance</label>
                                            <input type="text" id="outstanding_balance" name="outstanding_balance" class="form-control" value="{{ old('outstanding_balance') }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')

    @endpush
@endsection
