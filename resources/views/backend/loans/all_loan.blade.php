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

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Loans</h6>

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
                                    <th>Payment <br/>Amount</th>
                                    <th>Total <br/>To Be Repaid</th>
                                    <th>Amount <br/>Repaid <br/>To Date</th>
                                    <th>Outstanding<br/> Balance</th>
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($loans as $key => $item)
                                    @php
                                        $user = \App\Models\User::find($item->user_id);
                                    @endphp
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ sprintf('%06d', $item->id) }}</td>
                                        <td>{{ $user->surname }}</td>
                                        <td>{{ $user->given_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $item->loan_amount }}</td>
                                        <td>{{ ucfirst($item->payment_frequency) }}</td>
                                        <td>{{ $item->nof_payments }}</td>
                                        <td>{{ $item->payment_start_date }}</td>
                                        <td>{{ $item->payment_amount }}</td>
                                        <td>{{ $item->total_to_be_repaid }}</td>
                                        <td>{{ $item->amount_repaid_to_date }}</td>
                                        <td>{{ $item->outstanding_balance }}</td>
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
                            <h6 class="text-success mb-2">Total To be Repaid: {{number_format(get_loan_amount($state)->total_to_be_repaid)}} PHP</h6>
                            <h6 class="text-success mb-2">Total Amount Repaid To Date: {{number_format(get_loan_amount($state)->amount_repaid_to_date)}} PHP</h6>
                            <h6 class="text-success mb-2">Total Outstanding Balance: {{number_format(get_loan_amount($state)->outstanding_balance)}} PHP</h6>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>



    @push('script')

    @endpush

@endsection