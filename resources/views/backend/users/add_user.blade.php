@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">
        <div class="row profile-body mt-md-5">
            <div class="col-md-8 col-xl-8 middle-wrapper offset-md-2">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Add User</h6>
                            <form id="myForm" method="POST" action="{{ route('staff.users.store') }}" class="forms-sample">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="surname" class="form-label">Surname</label>
                                    <input id="surname" type="text" name="surname" class="form-control" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="given_name" class="form-label">Given Name</label>
                                    <input id="given_name" type="text" name="given_name" class="form-control" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" name="email" class="form-control" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input id="phone_number" type="text" name="phone_number" class="form-control" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address" class="form-label">Address   </label>
                                    <input id="address" type="text" name="address" class="form-control" >
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->role_id == config('constants.roles.admin_role_id'))
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="role_id">Role</label>
                                            <select id="role_id" name="role_id" class="form-control">
                                                @php
                                                    $roles = \App\Models\Role::all();
                                                @endphp
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="text" name="password" class="form-control" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password_confirm" class="form-label">Password Confirmation</label>
                                    <input id="password_confirm" type="text" name="password_confirm" class="form-control" >
                                </div>
                                <button type="submit" class="btn btn-primary float-end"><i class="feather icon-save me-2"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('script')
        <script type="text/javascript">
            $(document).ready(function (){
                $('#myForm').validate({
                    rules: {
                        surname: {
                            required : true,
                        },
                        given_name: {
                            required : true,
                        },
                        email: {
                            required : true,
                        },
                        phone_number: {
                            required : true,
                        },
                        address:{
                          required: true,
                        },
                        password: {
                            required : true,
                            minlength: 5
                        },
                        password_confirm:{
                            required: true,
                            equalTo: '#password'
                        }
                    },
                    messages :{
                        surname: {
                            required : 'Surname is required!',
                        },
                        given_name: {
                            required : 'Given Name is required!',
                        },
                        email: {
                            required : 'Email Address is required!',
                        },
                        phone_number: {
                            required : 'Phone Number is required!',
                        },
                        address:{
                            required: 'Address is required!',
                        },
                        password: {
                            required : 'Password is required!',
                            minlength: 'Password length must be at least 5 characters!'
                        },
                        password_confirm:{
                            required: 'Please input this field!',
                            equalTo: 'This field must be same as password!'
                        }
                    },
                    errorElement : 'span',
                    errorPlacement: function (error,element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight : function(element, errorClass, validClass){
                        $(element).addClass('is-invalid');
                    },
                    unhighlight : function(element, errorClass, validClass){
                        $(element).removeClass('is-invalid');
                    },
                });
            });
        </script>
    @endpush
@endsection