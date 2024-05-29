@extends('admin.admin_dashboard')
@section('admin')

    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Settings</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div id="calc_card" class="card">
                    <input id="calc_status" type="hidden" value="0">
                    <div class="card-body">
                        <h6 class="card-title">Payment Setting </h6>
                        <i class="fa fa-remove"></i>
                        <form method="post" action="{{route('admin.settings.post')}}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="interest_rate">Default Interest Rate</label>
                                        <input type="number" id="interest_rate" name="interest_rate" class="form-control calc-input" value="{{$setting->interest_rate}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="processing_fee">Default Processing Fee</label>
                                        <input type="number" id="processing_fee" name="processing_fee" class="form-control calc-input" value="{{$setting->processing_fee}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="processing_fee">Staff Viewable Days</label>
                                        <input type="number" id="staff_viewable_days" name="staff_viewable_days" class="form-control calc-input" value="{{$setting->staff_viewable_days}}">
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
            $(document).ready(function (){
                $('#myForm').validate({
                    rules: {
                        interest_rate: {
                            required : true,
                        },
                        processing_fee: {
                            required : true,
                        },
                    },
                    messages :{
                        interest_rate: {
                            required : 'This field is required!',
                        },
                        processing_fee: {
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
