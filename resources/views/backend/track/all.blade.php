@extends('admin.admin_dashboard')
@section('admin')
    @push('styles')
        <style>
            .badge{
                width: 100%;
                min-width: 56px;
            }

            .td-border{
                border-right: 0.2px solid #172340;
            }
        </style>

    @endpush

    <div class="page-content">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="user_id" class="form-label">Select User</label>
                    <select id="user_id" name="user_id" class="form-control loan-filter">
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
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="loan_frequency" class="form-label">Select Frequency</label>
                    <select id="loan_frequency" name="loan_frequency" class="form-control loan-filter">
                        <option value="all" @if($loan_frequency == 'all') selected @endif>All</option>
                        <option value="weekly" @if($loan_frequency == 'weekly') selected @endif>Weekly</option>
                        <option value="fortnightly" @if($loan_frequency == 'fortnightly') selected @endif>Fortnightly</option>
                        <option value="monthly" @if($loan_frequency == 'monthly') selected @endif>Monthly</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"> Payments</h6>
                        <div class="table-responsive" style="overflow: hidden;">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-center">Sequence<br/> Number</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Before</th>
                                    <th class="text-center">{{Carbon\Carbon::now()->subMonth()->format('F')}}</th>
                                    <th class="text-center">{{Carbon\Carbon::now()->format('F')}}</th>
                                    <th class="text-center">{{Carbon\Carbon::now()->addMonth()->format('F')}}</th>
                                    <th class="text-center">After</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                {{-- WEEKLY PAYMENT--}}
                                @foreach($loans as $key => $item)
                                    @php $item = (object) $item; @endphp
                                    @if($item->payment_frequency == 'weekly')
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{ sprintf('%06d', $item->loan_number) }}</td>
                                            <td>
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <span>{{$item->total_to_be_repaid}}</span>
                                                    <span class="{{$item->total_to_be_repaid > $item->repayment['total'] ? 'text-danger' : 'text-success' }}">{{$item->repayment['total']}}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <span>{{$item->plan['before']}}</span>
                                                    <span class="{{$item->plan['before'] > $item->repayment['before'] ? 'text-danger' : 'text-success' }}">{{$item->repayment['before']}}</span>
                                                </div>
                                            </td>
                                            <td class="td-border">
                                                <div class="d-flex justify-content-between gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-dark">{{$item->plan['previous']['values'][0]}}</span>
                                                        <span class="badge {{$item->plan['previous']['values'][0] <= $item->repayment['previous']['values'][0] ? 'bg-success' : 'bg-warning'}}">{{$item->repayment['previous']['values'][0]}}</span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-dark">{{$item->plan['previous']['values'][1]}}</span>
                                                        <span class="badge {{$item->plan['previous']['values'][1] <= $item->repayment['previous']['values'][1] ? 'bg-success' : 'bg-warning'}}">{{$item->repayment['previous']['values'][1]}}</span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-dark">{{$item->plan['previous']['values'][2]}}</span>
                                                        <span class="badge {{$item->plan['previous']['values'][2] <= $item->repayment['previous']['values'][2] ? 'bg-success' : 'bg-warning'}}">{{$item->repayment['previous']['values'][2]}}</span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-dark">{{$item->plan['previous']['values'][3]}}</span>
                                                        <span class="badge {{$item->plan['previous']['values'][3] <= $item->repayment['previous']['values'][3] ? 'bg-success' : 'bg-warning'}}">{{$item->repayment['previous']['values'][3]}}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="td-border">
                                                <div class="d-flex justify-content-between gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge {{check_weekly_plan_badge(0, $item->plan['current']['current_index'])}}">{{$item->plan['current']['values'][0]}}</span>
                                                        <span class="badge {{$item->plan['current']['values'][0] >= $item->repayment['current']['values'][0] ? 'bg-warning' : 'bg-success'}}">{{$item->repayment['current']['values'][0]}}</span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge {{check_weekly_plan_badge(1, $item->plan['current']['current_index'])}}">{{$item->plan['current']['values'][1]}}</span>
                                                        @if($item->plan['current']['current_index'] >= 1)
                                                            <span class="badge {{$item->plan['current']['values'][1] >= $item->repayment['current']['values'][1] ? 'bg-warning' : 'bg-success'}}">{{$item->repayment['current']['values'][1]}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge {{check_weekly_plan_badge(2, $item->plan['current']['current_index'])}}">{{$item->plan['current']['values'][2]}}</span>
                                                        @if($item->plan['current']['current_index'] >= 2)
                                                            <span class="badge {{$item->plan['current']['values'][2] >= $item->repayment['current']['values'][2] ? 'bg-warning' : 'bg-success'}}">{{$item->repayment['current']['values'][1]}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge {{check_weekly_plan_badge(3, $item->plan['current']['current_index'])}}">{{$item->plan['current']['values'][3]}}</span>
                                                        @if($item->plan['current']['current_index'] >= 3)
                                                            <span class="badge {{$item->plan['current']['values'][3] >= $item->repayment['current']['values'][3] ? 'bg-warning' : 'bg-success'}}">{{$item->repayment['current']['values'][1]}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-between gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-secondary">{{$item->plan['next']['values'][0]}}</span>
                                                        <span class="badge bg-warning"></span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-secondary">{{$item->plan['next']['values'][1]}}</span>
                                                        <span class="badge bg-warning"></span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-secondary">{{$item->plan['next']['values'][2]}}</span>
                                                        <span class="badge bg-warning"></span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-secondary">{{$item->plan['next']['values'][3]}}</span>
                                                        <span class="badge bg-warning"></span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span>{{$item->plan['after']}}</span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-primary">{{$item->plan['total']}}</span>
                                                        <span class="badge bg-danger">{{$item->repayment['total']}}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                {{--<a href="{{route('staff.loans.view', 1)}}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>--}}
                                            </td>
                                        </tr>
                                    @elseif($item->payment_frequency == 'fortnightly')
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{ sprintf('%06d', $item->loan_number) }}</td>
                                            <td>
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <span>{{$item->total_to_be_repaid}}</span>
                                                    <span class="{{$item->total_to_be_repaid > $item->repayment['total'] ? 'text-danger' : 'text-success' }}">{{$item->repayment['total']}}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <span>{{$item->plan['before']}}</span>
                                                    <span class="{{$item->plan['before'] > $item->repayment['before'] ? 'text-danger' : 'text-success' }}">{{$item->repayment['before']}}</span>
                                                </div>
                                            </td>
                                            <td class="td-border">
                                                <div class="d-flex justify-content-between gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-dark"></span>
                                                        <span class="badge bg-success"></span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-dark">{{$item->plan['previous']['values'][0] + $item->plan['previous']['values'][1]}}</span>
                                                        <span class="badge {{$item->plan['previous']['values'][0] + $item->plan['previous']['values'][1] > $item->repayment['previous']['values'][0] + $item->repayment['previous']['values'][1] ? 'bg-warning' : 'bg-success'}}">{{$item->repayment['previous']['values'][0] + $item->repayment['previous']['values'][1]}}</span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-dark">{{$item->plan['previous']['values'][2] + $item->plan['previous']['values'][3]}}</span>
                                                        <span class="badge {{$item->plan['previous']['values'][2] + $item->plan['previous']['values'][3] > $item->repayment['previous']['values'][2] + $item->repayment['previous']['values'][3] ? 'bg-warning' : 'bg-success'}}">{{$item->repayment['previous']['values'][2] + $item->repayment['previous']['values'][3]}}</span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-dark"></span>
                                                        <span class="badge bg-success"></span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="td-border">
                                                <div class="d-flex justify-content-between gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-primary"></span>
                                                        <span class="badge bg-danger"></span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge {{check_fortnightly_plan_badge([0, 1], $item->plan['current']['current_index'])}}">{{$item->plan['current']['values'][0] + $item->plan['current']['values'][1]}}</span>
                                                        <span class="badge {{$item->plan['current']['values'][0] + $item->plan['current']['values'][1] > $item->repayment['current']['values'][0] + $item->repayment['current']['values'][1] ? 'bg-warning' : 'bg-success'}}">{{$item->repayment['current']['values'][0] + $item->repayment['current']['values'][1]}}</span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge {{check_fortnightly_plan_badge([2, 3], $item->plan['current']['current_index'])}}">{{$item->plan['current']['values'][2] + $item->plan['current']['values'][3]}}</span>
                                                        @if($item->plan['current']['current_index'] >=2)
                                                            <span class="badge {{$item->plan['current']['values'][2] + $item->plan['current']['values'][3] > $item->repayment['current']['values'][2] + $item->repayment['current']['values'][3] ? 'bg-warning' : 'bg-success'}}">{{$item->repayment['current']['values'][2] + $item->repayment['current']['values'][3]}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-secondary"></span>
                                                        <span class="badge bg-warning"></span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-between gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-secondary"></span>
                                                        <span class="badge bg-warning"></span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-secondary">{{$item->plan['next']['values'][0] + $item->plan['next']['values'][1]}}</span>
                                                        <span class="badge bg-warning"></span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-secondary">{{$item->plan['next']['values'][2] + $item->plan['next']['values'][3]}}</span>
                                                        <span class="badge bg-warning"></span>
                                                    </div>
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-secondary"></span>
                                                        <span class="badge bg-warning"></span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span>{{$item->plan['after']}}</span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-primary">{{$item->plan['total']}}</span>
                                                        <span class="badge {{ $item->plan['total'] <= $item->repayment['total'] ? 'bg-success' : 'bg-danger' }}">{{$item->repayment['total']}}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                {{--<a href="{{route('staff.loans.view', 1)}}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>--}}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{ sprintf('%06d', $item->loan_number) }}</td>
                                            <td>
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <span>{{$item->total_to_be_repaid}}</span>
                                                    <span class="{{$item->total_to_be_repaid > $item->repayment['total'] ? 'text-danger' : 'text-success' }}">{{$item->repayment['total']}}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <span>{{$item->plan['before']}}</span>
                                                    <span class="{{$item->plan['before'] > $item->repayment['before'] ? 'text-danger' : 'text-success' }}">{{$item->repayment['before']}}</span>
                                                </div>
                                            </td>
                                            <td class="td-border">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-dark">{{array_sum($item->plan['previous']['values'])}}</span>
                                                        <span class="badge {{array_sum($item->plan['previous']['values']) > array_sum($item->repayment['previous']['values']) ? 'bg-warning' : 'bg-success'}}">{{array_sum($item->repayment['previous']['values'])}}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="td-border">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-primary">{{array_sum($item->plan['current']['values'])}}</span>
                                                        <span class="badge {{array_sum($item->plan['current']['values']) > array_sum($item->repayment['current']['values']) ? 'bg-warning' : 'bg-success'}}">{{array_sum($item->repayment['current']['values'])}}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-secondary">{{array_sum($item->plan['next']['values'])}}</span>
                                                        <span class="badge bg-warning"></span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span>{{$item->plan['after']}}</span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge bg-primary">{{$item->plan['total']}}</span>
                                                        <span class="badge bg-danger">{{$item->repayment['total']}}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                {{--                                                <a href="{{route('staff.loans.view', 1)}}" class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i> </a>--}}
                                            </td>
                                        </tr>
                                    @endif
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


            $('.loan-filter').on('change', function (e) {
                const userId = $('#user_id').val();
                const loanFrequency = $('#loan_frequency').val();
                if(userId !== 0){
                    window.location.href = '{{route('staff.track')}}' + '?user_id=' + userId + '&loan_frequency=' + loanFrequency;
                }
            })
        </script>
    @endpush

@endsection