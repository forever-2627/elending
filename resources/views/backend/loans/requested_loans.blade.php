@extends('admin.admin_dashboard')
@section('admin')
    @push('styles')

    @endpush

    <div class="page-content">
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Requested Loans</h6>

                        <div class="table-responsive" style="overflow: hidden;">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>First<br/> Name</th>
                                    <th>Last<br/> Name</th>
                                    <th>Email</th>
                                    <th>Employer <br/>Name</th>
                                    <th>Occupation</th>
                                    <th>Loan <br/>Amount</th>
                                    <th>Loan<br/> Period</th>
                                    <th>Address</th>
                                    <th>Phone <br/>Number</th>
                                    <th>Repayment Amount</th>
                                    <th>Payment <br/>Frequency</th>
                                    <th>Loan <br/>Purpose</th>
                                    <th>User <br/>Created</th>
                                    <th>Loan <br/> Created</th>
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($loans as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ ucfirst($item->first_name) }}</td>
                                        <td>{{ ucfirst($item->last_name) }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->employer_name }}</td>
                                        <td>{{ $item->occupation }}</td>
                                        <td>{{ $item->loan_amount }}</td>
                                        <td>{{ $item->loan_period }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->phone_number }}</td>
                                        <td>{{ $item->repayment_amount }}</td>
                                        <td>{{ ucfirst($item->payment_frequency) }}</td>
                                        <td>{{ substr($item->loan_purpose, 0, 30) }}...</td>
                                        <td>
                                            @if($item->user_created == 1)
                                                <span class="badge bg-primary p-2">Yes</span>
                                            @else
                                                <span class="badge bg-danger p-2">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->loan_created == 1)
                                                <span class="badge bg-primary p-2">Yes</span>
                                            @else
                                                <span class="badge bg-danger p-2">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('staff.loans.requested.view', $item->id)}}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>
                                            {{--<a href="{{route('staff.loans.edit', $item->id)}}" class="btn btn-inverse-warning" title="Edit"> <i data-feather="edit"></i> </a>--}}
                                            {{--<a href="{{route('staff.loans.delete', $item->id)}}" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i></a>--}}
                                            {{--<a href="#" class="btn dropdown-toggle btn-inverse-success"  type="button" data-bs-toggle="dropdown" aria-expanded="false"> <i data-feather="tag"></i></a>--}}
                                            {{--<ul class="dropdown-menu">--}}
                                                {{--<li><a class="dropdown-item" href="{{route('staff.loans.state.change', [ $item->id, 1 ])}}">Make Active</a></li>--}}
                                                {{--<li><a class="dropdown-item" href="{{route('staff.loans.state.change', [ $item->id, 2 ])}}">Make Repaid</a></li>--}}
                                                {{--<li><a class="dropdown-item" href="{{route('staff.loans.state.change', [ $item->id, 3 ])}}">Make Bad</a></li>--}}
                                            {{--</ul>--}}
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