@extends('admin.admin_dashboard')
@section('admin')
    @push('styles')

    @endpush

    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Due Loans</h6>
                        <div class="table-responsive" style="overflow: hidden;">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sequence Number</th>
                                    <th>Given Name</th>
                                    <th>Surname</th>
                                    <th>Due Date</th>
                                    <th>Amount Due</th>
                                    <th>Outstanding Balance</th>
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($due_loans as $key => $item)
                                        @php
                                            $loan = \App\Models\Loan::find($item->loan_id);
                                            $user = \App\Models\User::find($loan->user_id);
                                        @endphp
                                        <tr class="@if($item->is_paid == 0) text-danger @endif">
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ sprintf('%06d', $item->loan_id) }}</td>
                                            <td>{{ $user->given_name }}</td>
                                            <td>{{ $user->surname }}</td>
                                            <td>{{ $item->current_date }}</td>
                                            <td>{{ number_format($item->due_amount, 2, '.', ',') }}</td>
                                            <td>{{ number_format($loan->outstanding_balance, 2, '.', ',') }}</td>
                                           <td>
                                                <a href="{{route('staff.calendar.mark', $item->id)}}" class="btn btn-inverse-success fw-bold @if($item->is_paid == 1) disabled @endif" title="Details"> <i class="fal fa-check me-2"></i> Mark Paid </a>
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

    @endpush

@endsection