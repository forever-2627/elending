@extends('admin.admin_dashboard')
@section('admin')
    @push('styles')
        <style>
            .dash-card{
                box-shadow: 2px 2px 10px 2px #1f2639!important;
                cursor: pointer;
            }

            .dash-card:hover{
                box-shadow: 4px 4px 10px 4px #1f2639!important;
                cursor: pointer;
            }
        </style>
    @endpush

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
                        <div class="card dash-card" data-name="active_loans_graph">
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
                            <div class="card-body dash-card" data-name="new_loans_graph">
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
                            <div class="card-body dash-card" data-name="repayments_graph">
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
                            <div class="card-body dash-card" data-name="outstanding_balance_graph">
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
                            <div class="card-body dash-card" data-name="issued_loans_graph">
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
                            <div class="card-body dash-card" data-name="repaid_loans_graph">
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
        {{--Active Loans Graph--}}
        <div class="row graph" data-name="active_loans_graph" id="default_graph">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Active Loans</h6>
                        </div>
                        <p class="text-muted">This graph shows activated loans according to month.</p>
                        <div id="active_loans_graph"></div>
                    </div>
                </div>
            </div>
        </div>

        {{--New Loans Graph--}}
        <div class="row graph" data-name="new_loans_graph" style="display: none;">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">New Loans</h6>
                        </div>
                        <p class="text-muted">This graph shows new loans according to month.</p>
                        <div id="new_loans_graph"></div>
                    </div>
                </div>
            </div>
        </div>

        {{--Repayments Graph--}}
        <div class="row graph" data-name="repayments_graph" style="display: none;">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Repayments</h6>
                        </div>
                        <p class="text-muted">This graph shows repayments according to month.</p>
                        <div id="repayments_graph"></div>
                    </div>
                </div>
            </div>
        </div>

        {{--Outstanding Balance Graph--}}
        <div class="row graph" data-name="outstanding_balance_graph" style="display: none;">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Outstanding Balance</h6>
                        </div>
                        <p class="text-muted">This graph shows outstanding balance according to month.</p>
                        <div id="outstanding_balance_graph"></div>
                    </div>
                </div>
            </div>
        </div>

        {{--Issued Loans Graph--}}
        <div class="row graph" data-name="issued_loans_graph" style="display: none;">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Issued Loans</h6>
                        </div>
                        <p class="text-muted">This graph shows issued loans according to month.</p>
                        <div id="issued_loans_graph"></div>
                    </div>
                </div>
            </div>
        </div>

        {{--Repaid Loans Graph--}}
        <div class="row graph" data-name="repaid_loans_graph" style="display: none;">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Repaid Loans</h6>
                        </div>
                        <p class="text-muted">This graph shows repaid loans according to month.</p>
                        <div id="repaid_loans_graph"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')

        <script>
            $('.dash-card').on('click', function () {
                const graphName = $(this).data('name');
                $('.graph').map(function (key, element) {
                    if($(element).data('name') === graphName) $(element).show(300);
                    else $(element).hide();
                });
            });
        </script>
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
                if($('#active_loans_graph').length) {
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
                            labels: {
                                formatter: function (value) {
                                    // Round value to two decimal places and format
                                    return new Intl.NumberFormat('en-US', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2,
                                    }).format(value);
                                }
                            }
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
                            offsetY: -27,
                            formatter: function (val) {
                                return new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                }).format(val);
                            }
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "50%",
                                borderRadius: 4,
                                dataLabels: {
                                    position: 'top',
                                    orientation: 'vertical',
                                    formatter: function (val) {
                                        return new Intl.NumberFormat('en-US', {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2,
                                        }).format(val);
                                    }
                                }
                            },
                        },
                    };

                    const apexBarChart = new ApexCharts(document.querySelector("#active_loans_graph"), options);
                    apexBarChart.render();
                }
                // Active Loan Amount - END

                // New Loan Amount - START
                if($('#new_loans_graph').length) {
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
                            data: {!! json_encode($new_loans_graph['values']) !!}
                        }],
                        xaxis: {
                            // type: 'datetime',
                            categories: {!! json_encode($new_loans_graph['labels']) !!},
                            axisBorder: {
                                color: colors.gridBorder,
                            },
                            axisTicks: {
                                color: colors.gridBorder,
                            },
                        },
                        yaxis: {
                            title: {
                                text: 'Monthly Loans',
                                style:{
                                    size: 9,
                                    color: colors.muted
                                }
                            },
                            labels: {
                                formatter: function (value) {
                                    // Round value to two decimal places and format
                                    return new Intl.NumberFormat('en-US', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2,
                                    }).format(value);
                                }
                            }
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
                            offsetY: -27,
                            formatter: function (val) {
                                return new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                }).format(val);
                            }
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "50%",
                                borderRadius: 4,
                                dataLabels: {
                                    position: 'top',
                                    orientation: 'vertical',
                                    formatter: function (val) {
                                        return new Intl.NumberFormat('en-US', {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2,
                                        }).format(val);
                                    }
                                }
                            },
                        },
                    };

                    const apexBarChart = new ApexCharts(document.querySelector("#new_loans_graph"), options);
                    apexBarChart.render();
                }
                // New Loan Amount - END

                // Repayment Amount - START
                if($('#repayments_graph').length) {
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
                            data: {!! json_encode($repayments_graph['values']) !!}
                        }],
                        xaxis: {
                            // type: 'datetime',
                            categories: {!! json_encode($repayments_graph['labels']) !!},
                            axisBorder: {
                                color: colors.gridBorder,
                            },
                            axisTicks: {
                                color: colors.gridBorder,
                            },
                        },
                        yaxis: {
                            title: {
                                text: 'Monthly Loans',
                                style:{
                                    size: 9,
                                    color: colors.muted
                                }
                            },
                            labels: {
                                formatter: function (value) {
                                    // Round value to two decimal places and format
                                    return new Intl.NumberFormat('en-US', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2,
                                    }).format(value);
                                }
                            }
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
                            offsetY: -27,
                            formatter: function (val) {
                                return new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                }).format(val);
                            }
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "50%",
                                borderRadius: 4,
                                dataLabels: {
                                    position: 'top',
                                    orientation: 'vertical',
                                    formatter: function (val) {
                                        return new Intl.NumberFormat('en-US', {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2,
                                        }).format(val);
                                    }
                                }
                            },
                        },
                    };

                    const apexBarChart = new ApexCharts(document.querySelector("#repayments_graph"), options);
                    apexBarChart.render();
                }
                // Repayment Amount - END

                // Outstanding Balance - START
                if($('#outstanding_balance_graph').length) {
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
                            data: {!! json_encode($outstanding_balance_graph['values']) !!}
                        }],
                        xaxis: {
                            // type: 'datetime',
                            categories: {!! json_encode($outstanding_balance_graph['labels']) !!},
                            axisBorder: {
                                color: colors.gridBorder,
                            },
                            axisTicks: {
                                color: colors.gridBorder,
                            },
                        },
                        yaxis: {
                            title: {
                                text: 'Monthly Loans',
                                style:{
                                    size: 9,
                                    color: colors.muted
                                }
                            },
                            labels: {
                                formatter: function (value) {
                                    // Round value to two decimal places and format
                                    return new Intl.NumberFormat('en-US', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2,
                                    }).format(value);
                                }
                            }
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
                            offsetY: -27,
                            formatter: function (val) {
                                return new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                }).format(val);;
                            }
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "50%",
                                borderRadius: 4,
                                dataLabels: {
                                    position: 'top',
                                    orientation: 'vertical',
                                    formatter: function (val) {
                                        return new Intl.NumberFormat('en-US', {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2,
                                        }).format(val);
                                    }
                                }
                            },
                        },
                    };

                    const apexBarChart = new ApexCharts(document.querySelector("#outstanding_balance_graph"), options);
                    apexBarChart.render();
                }
                // Outstanding Balance - END

                // Repaid Loans - START
                if($('#repaid_loans_graph').length) {
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
                            data: {!! json_encode($repaid_loans_graph['values']) !!}
                        }],
                        xaxis: {
                            // type: 'datetime',
                            categories: {!! json_encode($repaid_loans_graph['labels']) !!},
                            axisBorder: {
                                color: colors.gridBorder,
                            },
                            axisTicks: {
                                color: colors.gridBorder,
                            },
                        },
                        yaxis: {
                            title: {
                                text: 'Monthly Loans',
                                style:{
                                    size: 9,
                                    color: colors.muted
                                }
                            },
                            labels: {
                                formatter: function (value) {
                                    // Round value to two decimal places and format
                                    return new Intl.NumberFormat('en-US', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2,
                                    }).format(value);
                                }
                            }
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
                            offsetY: -27,
                            formatter: function (val) {
                                return new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                }).format(val);;
                            }
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "50%",
                                borderRadius: 4,
                                dataLabels: {
                                    position: 'top',
                                    orientation: 'vertical',
                                    formatter: function (val) {
                                        return new Intl.NumberFormat('en-US', {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2,
                                        }).format(val);
                                    }
                                }
                            },
                        },
                    };

                    const apexBarChart = new ApexCharts(document.querySelector("#repaid_loans_graph"), options);
                    apexBarChart.render();
                }
                // Repaid Loans - END
            });
        </script>
    @endpush
@endsection