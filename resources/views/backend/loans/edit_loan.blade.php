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

                            <form method="post" action="{{route('staff.loans.update')}}" id="myForm"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="loan_id" value="{{$loan->id}}">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="user_id">User</label>
                                            <select id="user_id" name="user_id" class="form-control">
                                                @php
                                                    $users = \App\Models\User::where(['role_id' => config('constants.roles.user_role_id')])->get();
                                                @endphp
                                                @foreach($users as $user)
                                                    <option
                                                        @if($selected_user->id == $user->id)
                                                            selected
                                                        @endif
                                                        value="{{$user->id}}">
                                                        {{$user->given_name . ' ' . $user->surname . ' (' . $user->email . ') '}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="loan_amount">Loan Amount</label>
                                            <input type="text" id="loan_amount" name="loan_amount" class="form-control" value="{{ $loan->loan_amount }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="loan_issued">Loan Issued</label>
                                            <input type="text" id="loan_issued" name="loan_issued" class="form-control" value="{{ $loan->loan_issued }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="payment_frequency" class="form-label">Payment Frequency</label>
                                            <select name="payment_frequency" class="form-control" id="payment_frequency">
                                                <option selected="" disabled="">Select Payment Frequency</option>
                                                <option value="weekly" @if($loan->payment_frequency == "weekly") selected @endif>Weekly</option>
                                                <option value="fortnightly" @if($loan->payment_frequency == "fortnightly") selected @endif>For Nightly</option>
                                                <option value="monthly" @if($loan->payment_frequency == "monthly") selected @endif>Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="nof_payments">Number of Payments</label>
                                            <input type="text" id="nof_payments" name="nof_payments" class="form-control" value="{{ $loan->nof_payments }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="payment_start_date">Payment Start Date</label>
                                            <input type="text" id="payment_start_date" name="payment_start_date" class="form-control" value="{{ $loan->payment_start_date }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="payment_amount">Payment Amount</label>
                                            <input type="text" id="payment_amount" name="payment_amount" class="form-control" value="{{ $loan->payment_amount }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="total_to_be_repaid">Total to be Repaid</label>
                                            <input type="text" id="total_to_be_repaid" name="total_to_be_repaid" class="form-control" value="{{ $loan->total_to_be_repaid }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="amount_repaid_to_date">Amount Repaid to Date</label>
                                            <input type="text" id="amount_repaid_to_date" name="amount_repaid_to_date" class="form-control" value="{{ $loan->amount_repaid_to_date }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="outstanding_balance">Outstanding Balance</label>
                                            <input type="text" id="outstanding_balance" name="outstanding_balance" class="form-control" value="{{ $loan->outstanding_balance }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-end"><i class="feather icon-save me-2"></i> Save Changes</button>
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
