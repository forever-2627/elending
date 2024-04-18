@extends('admin.admin_dashboard')
@section('admin')

    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Loan Calculator</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div id="calc_card" class="card">
                    <input id="calc_status" type="hidden" value="0">
                    <div class="card-body">
                        <h6 class="card-title">Calculator </h6>
                        <i class="fa fa-remove"></i>
                        <form method="post" action="" id="myForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="loan_amount">Loan Amount</label>
                                        <input type="number" id="loan_amount" name="loan_amount" class="form-control calc-input" value="0">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="loan_period">Loan Period (months)</label>
                                        <input type="number" id="loan_period" name="loan_period" class="form-control calc-input" value="0">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="interest_rate">Interest Rate</label>
                                        <input type="number" id="interest_rate" name="interest_rate" class="form-control calc-input" value="0">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="processing_fee">Processing Fee</label>
                                        <input type="number" id="processing_fee" name="processing_fee" class="form-control calc-input" value="3">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="payment_frequency" class="form-label">Payment Frequency</label>
                                        <select name="payment_frequency" class="form-control calc-input" id="payment_frequency">
                                            <option selected value="1">Every Week</option>
                                            <option value="2">Every Two Weeks</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="result">Result</label>
                                        <input type="text" id="result" name="result" disabled class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
    </div>

    @push('script')
        <script>

            $('.calc-input').on('change', () => {
                let loan_amount = parseFloat($('#loan_amount').val());
                let loan_period = parseFloat($('#loan_period').val());
                let interest_rate = parseFloat($('#interest_rate').val());
                let processing_fee_percent = parseFloat($('#processing_fee').val());
                let payment_frequency = parseFloat($('#payment_frequency').val());
                const interests = interest_rate * 0.01 * loan_amount * loan_period;
                const processing_fee = processing_fee_percent * 0.01 * loan_amount;
                const total_amount = loan_amount + interests + processing_fee;
                const repayment_amount = total_amount / ( loan_period * 4 / payment_frequency);
                $('#result').val(`Total: ${total_amount}PHP, One Time: ${repayment_amount}PHP `);
            });
        </script>
    @endpush
@endsection
