@extends('admin.admin_dashboard')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Notifications</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>No </th>
                                    <th>Type </th>
                                    <th>Status </th>
                                    <th>Received Time </th>
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Guest Message</td>
                                    <td><span class="badge bg-danger">Unread</span></td>
                                    <td>2023.04.07</td>
                                    <td>
                                        <a href="{{route('staff.notifications.view', 1)}}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>
                                        <a href="{{route('staff.notifications.check', 1)}}" class="btn btn-inverse-danger" id="delete" title="Check as Read"> <i data-feather="award"></i>  </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>User Message</td>
                                    <td><span class="badge bg-success">Read</span></td>
                                    <td>2023.04.07</td>
                                    <td>
                                        <a href="{{route('staff.notifications.view', 2)}}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>
                                        <a href="{{route('staff.notifications.check', 2)}}" class="btn btn-inverse-danger" id="delete" title="Check as Read"> <i data-feather="award"></i>  </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection