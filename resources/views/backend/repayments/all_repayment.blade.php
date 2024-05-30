@extends('admin.admin_dashboard')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <a href="{{route('staff.repayments.create')}}" class="btn btn-inverse-info"> <i class="feather icon-plus"></i> Add Repayment </a>
            </ol>
        </nav>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <select id="user_id" name="user_id" class="form-control">
                        <option value="0">Select None</option>
                        @php
                            $users = \App\Models\User::where(['role_id' => config('constants.roles.user_role_id')])->get();
                        @endphp
                        @foreach($users as $user)
                            <option value="{{$user->id}}" @if($user_id == $user->id) selected @endif>{{$user->given_name . ' ' . $user->surname . ' (' . $user->email . ') '}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Repayment History</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>No </th>
                                    <th>Given Name </th>
                                    <th>Surname </th>
                                    <th>Email </th>
                                    <th>Loan Number </th>
                                    <th>Repaid Amount </th>
                                    <th>Repaid Date </th>
                                    <th>Added By</th>
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($repayments as $key => $repayment)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $repayment->user()->first()->given_name }}</td>
                                        <td>{{ $repayment->user()->first()->surname }}</td>
                                        <td>{{ $repayment->user()->first()->email }}</td>
                                        <td>{{ sprintf('%06d', $repayment->loan_id) }}</td>
                                        <td>{{ number_format($repayment->repaid_amount, 2, '.', ',') }}</td>
                                        <td>{{ $repayment->repaid_date }}</td>
                                        <td>{{ get_username($repayment->by_who) }}</td>
                                        <td>
                                            <a href="{{route('staff.repayments.edit', $repayment->id)}}" class="btn btn-inverse-warning me-2" title="Edit"> <i data-feather="edit"></i> </a>
                                            <a href="{{route('staff.repayments.delete', $repayment->id)}}" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i>  </a>
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

    @push('script')
        <script>
            $(document).ready(() => {
                $('#user_id').select2();
            });

            $('#user_id').on('change', function (e) {
                const value = e.target.value;
                if(value !== 0){
                    window.location.href = '{{route('staff.repayments')}}' + '?user_id=' + value;
                }
            })
        </script>
    @endpush

@endsection

