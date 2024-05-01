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
                    {{-- Active Loans Amount --}}
                    <div class="col-md-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <h6 class="card-title mb-0">Active Loans Amount</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <h3 class="mb-2">{{number_format($active_loan_amount ,2, '.', ',')}} PHP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Current Month New Loans --}}
                    <div class="col-md-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <h6 class="card-title mb-0">Current Month New Loans</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <h3 class="mb-2">{{number_format($current_month_new_loans,2, '.', ',')}} PHP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Current Month Repayments --}}
                    <div class="col-md-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <h6 class="card-title mb-0">Current Month Repayments</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <h3 class="mb-2">{{number_format($current_month_repayments,2, '.', ',')}} PHP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- All Outstanding Loans --}}
                    <div class="col-md-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <h6 class="card-title mb-0">All Outstanding Loans</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <h3 class="mb-2">{{number_format($all_outstanding_loans,2, '.', ',')}} PHP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Issued Loans --}}
                    <div class="col-md-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <h6 class="card-title mb-0">Issued Loans</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <h3 class="mb-2">{{number_format($issued_loan_amount,2, '.', ',')}} PHP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Repaid Loans Amount--}}
                    <div class="col-md-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <h6 class="card-title mb-0">Repaid Loans Amount</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex">
                                        <h3 class="mb-2">{{number_format($repaid_loans,2, '.', ',')}} PHP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Active Loans</h6>
                        </div>
                        <p class="text-muted">This graph shows activated loans according to month.</p>
                        <div id="active_loans"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(function() {
                'use strict';

                const colors = {
                    primary        : "#6571ff",
                    secondary      : "#7987a1",
                    success        : "#05a34a",
                    info           : "#66d1d1",
                    warning        : "#fbbc06",
                    danger         : "#ff3366",
                    light          : "#e9ecef",
                    dark           : "#060c17",
                    muted          : "#7987a1",
                    gridBorder     : "rgba(77, 138, 240, .15)",
                    bodyColor      : "#b8c3d9",
                    cardBg         : "#0c1427"
                };

                const fontFamily = "'Roboto', Helvetica, sans-serif"

                // Active Loan Amount - START
                if($('#active_loans').length) {
                    const options = {
                        chart: {
                            type: 'bar',
                            height: '560',
                            parentHeightOffset: 0,
                            foreColor: colors.bodyColor,
                            background: colors.cardBg,
                            toolbar: {
                                show: false
                            },
                        },
                        theme: {
                            mode: 'light'
                        },
                        tooltip: {
                            theme: 'light'
                        },
                        colors: [colors.primary],
                        fill: {
                            opacity: .9
                        } ,
                        grid: {
                            padding: {
                                bottom: -4
                            },
                            borderColor: colors.gridBorder,
                            xaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        },
                        series: [{
                            name: 'Sales',
                            data: {!! json_encode($loan_amount_graph['values']) !!}
                        }],
                        xaxis: {
                            // type: 'datetime',
                            categories: {!! json_encode($loan_amount_graph['labels']) !!},
                            axisBorder: {
                                color: colors.gridBorder,
                            },
                            axisTicks: {
                                color: colors.gridBorder,
                            },
                        },
                        yaxis: {
                            title: {
                                text: 'Monthly Loaned Amount',
                                style:{
                                    size: 9,
                                    color: colors.muted
                                }
                            },
                        },
                        legend: {
                            show: true,
                            position: "top",
                            horizontalAlign: 'center',
                            fontFamily: fontFamily,
                            itemMargin: {
                                horizontal: 8,
                                vertical: 0
                            },
                        },
                        stroke: {
                            width: 0
                        },
                        dataLabels: {
                            enabled: true,
                            style: {
                                fontSize: '10px',
                                fontFamily: fontFamily,
                            },
                            offsetY: -27
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "50%",
                                borderRadius: 4,
                                dataLabels: {
                                    position: 'top',
                                    orientation: 'vertical',
                                }
                            },
                        },
                    };

                    const apexBarChart = new ApexCharts(document.querySelector("#active_loans"), options);
                    apexBarChart.render();
                }
                // Active Loan Amount - END
            });
        </script>
    @endpush
@endsection