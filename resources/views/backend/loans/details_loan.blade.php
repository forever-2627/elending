@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property Details </h6>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td>Sequence Number </td>
                                    <td><code>{{ sprintf('%06d', $loan->id)  }}</code></td>
                                </tr>
                                <tr>
                                    <td>Surname </td>
                                    <td><code>{{$user->surname}}</code></td>
                                </tr>
                                <tr>
                                    <td>Given Name </td>
                                    <td><code>{{$user->given_name}}</code></td>
                                </tr>
                                <tr>
                                    <td>Email Address </td>
                                    <td><code>{{$user->email}}</code></td>
                                </tr>
                                <tr>
                                    <td>Phone Number </td>
                                    <td><code>{{$user->phone_number}}</code></td>
                                </tr>
                                <tr>
                                    <td>Address </td>
                                    <td><code>{{$user->address}}</code></td>
                                </tr>
                                <tr>
                                    <td>Loan Amount </td>
                                    <td><code>{{$loan->loan_amount}}</code></td>
                                </tr>
                                <tr>
                                    <td>Payment Frequency </td>
                                    <td><code>{{$loan->payment_frequency}}</code></td>
                                </tr>
                                <tr>
                                    <td>Number of Payments </td>
                                    <td><code>{{$loan->nof_payments}}</code></td>
                                </tr>

                                <tr>
                                    <td>Payment Start Date </td>
                                    <td><code>{{$loan->payment_start_date}}</code></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td>Payment Amount </td>
                                    <td><code>{{$loan->payment_amount}}</code></td>
                                </tr>
                                <tr>
                                    <td>Total to be Repaid </td>
                                    <td><code>{{$loan->total_to_be_repaid}}</code></td>
                                </tr>
                                <tr>
                                    <td>Amount Repaid to Date</td>
                                    <td><code>{{$loan->amount_repaid_to_date}}</code></td>
                                </tr>
                                <tr>
                                    <td>Outstanding Balance </td>
                                    <td><code>{{$loan->outstanding_balance}}</code></td>
                                </tr>
                                <tr>
                                    <td>Initial Total To Be Repaid </td>
                                    <td><code>{{$loan->initial_total_to_be_repaid}}</code></td>
                                </tr>
                                </tbody>
                            </table>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection