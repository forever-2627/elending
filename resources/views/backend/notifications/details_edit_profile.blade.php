@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Previous Profile Information </h6>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td>Surname </td>
                                    <td><code>{{$user->surname}}</code></td>
                                </tr>
                                <tr>
                                    <td>Given Name </td>
                                    <td><code>{{$user->given_name}}</code></td>
                                </tr>
                                <tr>
                                    <td>Email </td>
                                    <td><code>{{$user->email}}</code></td>
                                </tr>
                                <tr>
                                    <td>Phone Number </td>
                                    <td><code>{{$user->phone_number}}</code></td>
                                </tr>
                                <tr>
                                    <td>Address </td>
                                    <td>
                                        <code>{{$user->address}}</code>
                                    </td>
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
                        <h6 class="card-title">Requested Profile Information </h6>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td>Surname </td>
                                    <td><code>{{$content->surname}}</code></td>
                                </tr>
                                <tr>
                                    <td>Given Name </td>
                                    <td><code>{{$content->given_name}}</code></td>
                                </tr>
                                <tr>
                                    <td>Email </td>
                                    <td><code>{{$content->email}}</code></td>
                                </tr>
                                <tr>
                                    <td>Phone Number </td>
                                    <td><code>{{$content->phone_number}}</code></td>
                                </tr>
                                <tr>
                                    <td>Address </td>
                                    <td>
                                        <code>{{$content->address}}</code>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <a href="{{route('staff.notifications.approve.update.profile', $notification_id)}}" class="btn btn-primary"> <i class="fab fa fa-check me-2 me-2"></i> Approve</i> </a>
            </div>
        </div>
    </div>
@endsection