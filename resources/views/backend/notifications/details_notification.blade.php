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
                                    <td>No </td>
                                    <td><code>1</code></td>
                                </tr>
                                <tr>
                                    <td>Notification Type </td>
                                    <td><code>Guest Message</code></td>
                                </tr>
                                <tr>
                                    <td>Username </td>
                                    <td><code>Guest User</code></td>
                                </tr>
                                <tr>
                                    <td>Email </td>
                                    <td><code>guest@user.com</code></td>
                                </tr>
                                <tr>
                                    <td>Phone Number </td>
                                    <td><code>000-0000-0000</code></td>
                                </tr>
                                <tr>
                                    <td>Message </td>
                                    <td>
                                        <code style="text-wrap: balance;">
                                            Lorem Ipsum, sometimes referred to as 'lipsum', is the placeholder text used in design when creating content. It helps designers plan out where the content will sit, without needing to wait for the content to be written and approved. It originally comes from a Latin text, but to today's reader, it's seen as gibberish
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