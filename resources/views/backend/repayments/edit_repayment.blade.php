@extends('admin.admin_dashboard')
@section('admin')

    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Repayments</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div id="calc_card" class="card">
                    <input id="calc_status" type="hidden" value="0">
                    <div class="card-body">
                        <h6 class="card-title">Repayments Edit Form</h6>
                        <i class="fa fa-remove"></i>
                        <form method="post" action="{{ route('staff.repayments.update') }}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="repayment_id" value="{{ $repayment->id }}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="loan_id">Loans</label>
                                        <select id="loan_id" name="loan_id" class="form-control">
                                            @php
                                                $loans = \App\Models\Loan::where(['fully_repaid' => 0])->get();
                                            @endphp
                                            @foreach($loans as $loan)
                                                <option value="{{$loan->id}}" @if($repayment->loan_id == $loan->id) selected @endif>{{ sprintf('%06d', $loan->id) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="repaid_date">Repaid Date</label>
                                        <input type="text" id="repaid_date" name="repaid_date" class="form-control" value="{{ $repayment->repaid_date }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="repaid_amount">Repaid Amount</label>
                                        <input type="number" id="repaid_amount" name="repaid_amount" class="form-control" value="{{ $repayment->repaid_amount }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end"><i class="feather icon-save me-2"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
    </div>

    @push('script')
        <script>
            $(document).ready(() => {
                $('#loan_id').select2();
                $('#repaid_date').datepicker();
            });
        </script>

        {{--Validation--}}
        <script type="text/javascript">
            $(document).ready(function (){
                $('#myForm').validate({
                    rules: {
                        loan_id: {
                            required : true,
                        },
                        repaid_date: {
                            required : true,
                        },
                        repaid_amount: {
                            required : true,
                        },
                    },
                    messages :{
                        loan_id: {
                            required : 'This field is required!',
                        },
                        repaid_date: {
                            required : 'This field is required!',
                        },
                        repaid_amount: {
                            required : 'This field is required!',
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
    @endpush
@endsection
