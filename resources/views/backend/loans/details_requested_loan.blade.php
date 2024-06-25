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
                                    <td>First Name </td>
                                    <td><code>{{ $loan->first_name  }}</code></td>
                                </tr>
                                <tr>
                                    <td>Last Name </td>
                                    <td><code>{{ $loan->last_name }}</code></td>
                                </tr>
                                <tr>
                                    <td>Email </td>
                                    <td><code>{{ $loan->email }}</code></td>
                                </tr>
                                <tr>
                                    <td>Employer Name </td>
                                    <td><code>{{ $loan->employer_name }}</code></td>
                                </tr>
                                <tr>
                                    <td>Occupation </td>
                                    <td><code>{{ $loan->occupation }}</code></td>
                                </tr>
                                <tr>
                                    <td>Loan Amount </td>
                                    <td><code>{{$loan->loan_amount}}</code></td>
                                </tr>
                                <tr>
                                    <td>Address </td>
                                    <td><code>{{$loan->address}}</code></td>
                                </tr>
                                <tr>
                                    <td>Phone Number </td>
                                    <td><code>{{$loan->phone_number}}</code></td>
                                </tr>
                                <tr>
                                    <td>Repayment Amount </td>
                                    <td><code>{{$loan->repayment_amount}}</code></td>
                                </tr>

                                <tr>
                                    <td>Payment Frequency </td>
                                    <td><code>{{$loan->payment_frequency}}</code></td>
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
                                    <td>Loan Purpose </td>
                                    <td><code style="text-wrap: balance;">
                                            {{$loan->loan_purpose}}

                                        </code></td>
                                </tr>
                                <tr>
                                    <td>User Created </td>
                                    <td>
                                        <code>
                                            @if($loan->user_created == 1)
                                                <span class="badge bg-primary p-2">Yes</span>
                                            @else
                                                <span class="badge bg-danger p-2">No</span>
                                            @endif
                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Loan Created</td>
                                    <td>
                                        <code>
                                            @if($loan->loan_created == 1)
                                                <span class="badge bg-primary p-2">Yes</span>
                                            @else
                                                <span class="badge bg-danger p-2">No</span>
                                            @endif
                                        </code>
                                    </td>
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