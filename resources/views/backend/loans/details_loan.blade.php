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
                                    <td>No </td>
                                    <td><code>1</code></td>
                                </tr>

                                <tr>
                                    <td>Sequence Number </td>
                                    <td><code>000023</code></td>
                                </tr>
                                <tr>
                                    <td>Surname </td>
                                    <td><code>User1</code></td>
                                </tr>

                                <tr>
                                    <td>Given Name </td>
                                    <td><code>User1234</code></td>
                                </tr>
                                <tr>
                                    <td>Email Address </td>
                                    <td><code>user1@user.com</code></td>
                                </tr>

                                <tr>
                                    <td>Phone Number </td>
                                    <td><code>111-1111-1111</code></td>
                                </tr>
                                <tr>
                                    <td>Address </td>
                                    <td><code>User1 Address</code></td>
                                </tr>
                                <tr>
                                    <td>Loan Amount </td>
                                    <td><code>56000 PHP</code></td>
                                </tr>
                                <tr>
                                    <td>Loan Issued </td>
                                    <td><code>2024.04.03</code></td>
                                </tr>
                                <tr>
                                    <td>Payment Frequency </td>
                                    <td><code>Weekly</code></td>
                                </tr>
                                <tr>
                                    <td>Number of Payments </td>
                                    <td><code>4</code></td>
                                </tr>

                                <tr>
                                    <td>Payment Start Date </td>
                                    <td><code>2024.04.07</code></td>
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
                                    <td><code>56000 PHP</code></td>
                                </tr>

                                <tr>
                                    <td>Total to be Repaid </td>
                                    <td><code>56000 PHP</code></td>
                                </tr>


                                <tr>
                                    <td>Amount Repaid to Date</td>
                                    <td><code>56000 PHP</code></td>
                                </tr>

                                <tr>
                                    <td>Outstanding Balance </td>
                                    <td><code>56000 PHP</code></td>
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