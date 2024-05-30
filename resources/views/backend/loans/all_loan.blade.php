@extends('admin.admin_dashboard')
@section('admin')
    @push('styles')

    @endpush

    <div class="page-content">
        @if($state == 'all')
            <nav class="page-breadcrumb">
                <ol class="breadcrumb justify-content-end">
                    <a href="{{route('staff.loans.create')}}" class="btn btn-inverse-info"> <i class="feather icon-plus"></i> Add Loan </a>
                </ol>
            </nav>
        @endif
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
                        <h6 class="card-title">{{ucfirst($state)}} Loans</h6>

                        <div class="table-responsive" style="overflow: hidden;">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sequence<br/> Number</th>
                                    <th>Surname</th>
                                    <th>Given<br/> Name</th>
                                    <th>Email</th>
                                    <th>Phone <br/>Number</th>
                                    <th>Address</th>
                                    <th>Loan <br/>Amount</th>
                                    <th>Payment<br/> Frequency</th>
                                    <th>Number<br/> of Payments</th>
                                    <th>Payment <br/>Start Date</th>
                                    <th>Repayment Number</th>
                                    <th>Recent <br/>Due Date</th>
                                    <th>Payment <br/>Amount</th>
                                    <th>Total <br/>To Be Repaid</th>
                                    <th>Amount <br/>Repaid <br/>To Date</th>
                                    <th>Due Amount</th>
                                    <th>Outstanding<br/> Balance</th>
                                    <th>Added By</th>
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($loans as $key => $item)
                                    @php
                                        $user = \App\Models\User::find($item->user_id);
                                        $due_detail = get_due_detail($item);
                                    @endphp
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ sprintf('%06d', $item->id) }}</td>
                                        <td>{{ $user->surname }}</td>
                                        <td>{{ $user->given_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ $item->loan_amount }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ ucfirst($item->payment_frequency) }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ $item->nof_payments }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ $item->payment_start_date }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ $due_detail->repayment_number }} of {{ $item->nof_payments }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ $due_detail->due_date }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ number_format($item->payment_amount, 2, '.', ',') }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ number_format($item->total_to_be_repaid, 2, '.', ',') }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ number_format($item->amount_repaid_to_date, 2, '.', ',') }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ number_format($due_detail->amount, 2, '.', ',') }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ number_format($item->outstanding_balance, 2, '.', ',') }}</td>
                                        <td title="{{ $user->given_name }} {{ $user->surname }}">{{ get_username($item->by_who) }}</td>
                                        <td>
                                            <a href="{{route('staff.loans.view', $item->id)}}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>
                                            <a href="{{route('staff.loans.edit', $item->id)}}" class="btn btn-inverse-warning" title="Edit"> <i data-feather="edit"></i> </a>
                                            <a href="{{route('staff.loans.delete', $item->id)}}" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i></a>
                                            <a href="#" class="btn dropdown-toggle btn-inverse-success"  type="button" data-bs-toggle="dropdown" aria-expanded="false"> <i data-feather="tag"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{route('staff.loans.state.change', [ $item->id, 1 ])}}">Make Active</a></li>
                                                <li><a class="dropdown-item" href="{{route('staff.loans.state.change', [ $item->id, 2 ])}}">Make Repaid</a></li>
                                                <li><a class="dropdown-item" href="{{route('staff.loans.state.change', [ $item->id, 3 ])}}">Make Bad</a></li>
                                            </ul>
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


        @if(auth()->user()->role_id == config('constants.roles.admin_role_id'))
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Loans Summary</h5>
                            <h6 class="text-success mb-2">Total Loan Amount: {{number_format(get_loan_amount($state)->loan_amount,2, '.', ',')}} PHP</h6>
                            <h6 class="text-success mb-2">Total Amount To Be Paid: {{number_format(get_loan_amount($state)->total_to_be_repaid,2, '.', ',')}} PHP</h6>
                            <h6 class="text-success mb-2">Total Amount Repaid To Date: {{number_format(get_loan_amount($state)->amount_repaid_to_date,2, '.', ',')}} PHP</h6>
                            <h6 class="text-success mb-2">Total Outstanding Balance: {{number_format(get_loan_amount($state)->outstanding_balance,2, '.', ',')}} PHP</h6>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('script')
        <script>
            $(document).ready(() => {
                $('#user_id').select2();
            });

            $('#user_id').on('change', function (e) {
                const value = e.target.value;
                if(value !== 0){
                    window.location.href = '{{route('staff.loans', $state)}}' + '?user_id=' + value;
                }
            })
        </script>
    @endpush

@endsection