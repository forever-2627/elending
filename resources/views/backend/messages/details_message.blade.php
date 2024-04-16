@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <div class="row">
            <div class="col-md-8 offset-md-2 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Notification Detail </h6>

                        <div class="table-responsive">
                            <table class="table table-striped">

                                <tbody>
                                <tr>
                                    <td>Title </td>
                                    <td><code>{{ucfirst($message->title)}}</code></td>
                                </tr>
                                <tr>
                                    <td>Notification Type </td>
                                    <td><code>{{ucfirst($message->type)}} Message</code></td>
                                </tr>
                                <tr>
                                    <td>Username </td>
                                    <td><code>{{$message->username}}</code></td>
                                </tr>
                                <tr>
                                    <td>Email </td>
                                    <td><code>{{$message->email}}</code></td>
                                </tr>
                                <tr>
                                    <td>Phone Number </td>
                                    <td><code>{{$message->phone_number}}</code></td>
                                </tr>
                                <tr>
                                    <td>Message </td>
                                    <td>
                                        <code style="text-wrap: balance;">
                                            {{$message->message}}
                                        </code>
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