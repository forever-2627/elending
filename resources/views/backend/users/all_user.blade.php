@extends('admin.admin_dashboard')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <a href="{{route('staff.users.create')}}" class="btn btn-inverse-info"> <i class="feather icon-plus"></i> Add User </a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Users</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>No </th>
                                    <th>Given Name </th>
                                    <th>Surname </th>
                                    <th>Email </th>
                                    <th>Address </th>
                                    <th>Phone Number </th>
                                    <th>Role </th>
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->given_name }}</td>
                                        <td>{{ $user->surname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>
                                            {{ ucfirst(\App\Models\Role::where(['id' => $user->role_id])->first()->name) }}
                                        </td>
                                        <td>
                                            <a href="{{route('staff.users.edit', $user->id)}}" class="btn btn-inverse-warning me-2" title="Edit"> <i data-feather="edit"></i> </a>
                                            <a href="{{route('staff.users.delete', $user->id)}}" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i>  </a>
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