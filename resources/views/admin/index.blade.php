@extends('admin.admin_dashboard')
@section('admin')

    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    {{--Total Amount of Loans--}}
                    <div class="col-md-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <h6 class="card-title mb-0">Total Loaned</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <h3 class="mb-2">389745 PHP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Delinquent of Loans--}}
                    <div class="col-md-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <h6 class="card-title mb-0">Delinquent Loans</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <h3 class="mb-2">253</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Total Outstanding Loans--}}
                    <div class="col-md-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <h6 class="card-title mb-0">Total Outstanding Loans</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <h3 class="mb-2">389745 PHP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Current Monthly Total Payment--}}
                    <div class="col-md-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <h6 class="card-title mb-0">Current Month Payment</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <h3 class="mb-2">389745 PHP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Current Total Loaned--}}
                    <div class="col-md-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <h6 class="card-title mb-0">Current Month Loaned</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <h3 class="mb-2">389745 PHP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->


        <div class="row">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Issued Loans</h6>
                        </div>
                        <p class="text-muted">This graph shows issued loans month by month.</p>
                        <div id="monthlySalesChart"></div>
                    </div>
                </div>
            </div>

        </div> <!-- row -->


    </div>

@endsection