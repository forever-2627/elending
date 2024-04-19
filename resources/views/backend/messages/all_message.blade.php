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
                                    <th>Title </th>
                                    <th>Type </th>
                                    <th>Status </th>
                                    <th>Received Time </th>
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $key => $message)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$message->title}}</td>
                                        <td>{{ ucfirst($message->type) }} Message</td>
                                        @if($message->read == 0)
                                            <td><span class="badge bg-danger">Unread</span></td>
                                        @else
                                            <td><span class="badge bg-success">Read</span></td>
                                        @endif

                                        <td>{{$message->received_time}}</td>
                                        <td>
                                            <a href="{{route('staff.messages.view', $message->id)}}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>
                                            <a href="{{route('staff.messages.check', $message->id)}}" class="btn btn-inverse-danger" title="Check as Read"> <i data-feather="award"></i>  </a>
                                            <a href="{{route('staff.messages.delete', $message->id)}}" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i>  </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection