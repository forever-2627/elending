@extends('admin.admin_dashboard')
@section('admin')
    @push('styles')
        <style>
            tr{
                vertical-align: middle;
            }
        </style>
    @endpush

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="" class="btn btn-inverse-info"> Add Loan </a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Loans</h6>

                        <div class="table-responsive">
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
                                    <th>Loan <br/>Issued</th>
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
                                <tr>
                                    <td>1</td>
                                    <td>000013</td>
                                    <td>User1</td>
                                    <td>user1123</td>
                                    <td>user1@outlook.com</td>
                                    <td>111-111-1111</td>
                                    <td>User1 Address</td>
                                    <td>54000PHP</td>
                                    <td>2024.04.07</td>
                                    <td>Weekly</td>
                                    <td>4</td>
                                    <td>2024.04.07</td>
                                    <td>56000PHP</td>
                                    <td>58000PHP</td>
                                    <td>26000PHP</td>
                                    <td>32000PHP</td>
                                    <td>

                                        <a href="" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>

                                        <a href="" class="btn btn-inverse-warning" title="Edit"> <i data-feather="edit"></i> </a>

                                        <a href="" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i>  </a>
                                    </td>
                                </tr>
                                @php
                                 $property = [];
                                @endphp
                                @foreach($property as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><img src="{{ asset($item->property_thambnail) }}" style="width:70px; height:40px;"> </td>
                                        <td>{{ $item->property_name }}</td>
                                        <td>{{ $item['type']['type_name'] }}</td>
                                        <td>{{ $item->property_status }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>{{ $item->property_code }}</td>
                                        <td>
                                            @if($item->status == 1)
                                                <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">InActive</span>
                                            @endif

                                        </td>
                                        <td>

                                            <a href="" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>

                                            <a href="" class="btn btn-inverse-warning" title="Edit"> <i data-feather="edit"></i> </a>

                                            <a href="" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i>  </a>
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
                localStorage.setItem('nav-item', 'agent-propertloans
        </script>
    @endpush






@endsection