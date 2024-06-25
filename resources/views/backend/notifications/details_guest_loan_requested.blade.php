@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card flex-column">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Requested Loan Information </h6>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td>Email </td>
                                    <td><code>{{$content->email}}</code></td>
                                </tr>
                                <tr>
                                    <td>Loan Amount </td>
                                    <td><code>{{$content->loan_amount}}</code></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-end mt-4">
                    <a class="btn btn-primary" href="{{route('staff.email.create.user', $notification_id)}}">
                        <i class="fa fa-envelope me-3"></i> Send Directional Link
                    </a>
                </div>
            </div>
        </div>

        {{--<div class="row">--}}
            {{--<div class="col-md-12 d-flex justify-content-end">--}}
                {{--<a href="{{route('staff.notifications.approve.guest.loan', $notification_id)}}" class="btn btn-primary"> <i class="fab fa fa-check me-2 me-2"></i> Approve</i> </a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection