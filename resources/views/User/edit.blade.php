@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit User information</h3>
            <a href="{{ route('user.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all users</button>
            </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success" id="success_element">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" >
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form role="form" method="post" action="{{ route('user.update', $user->id) }}" id="editUserForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Edit user item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="AssetName">First name</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter First name" value="{{$user->first_name}}" name="first_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="AssetName">Last name</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter Last name" value="{{$user->last_name}}" name="last_name">
                                        </div>

                                        <div class="form-group">
                                            <label>User role </label>
                                            <select class="form-control select2" style="width: 100%;" name="role_id">
                                                <option value="{{$user->role_id}}" selected="{{$user->role_id}}" disabled>
                                                @foreach($roles as $role)
                                                    @if ($role->id == $user->role_id)
                                                        {{$role->name}} ({{$role->name_abbreviation}}) 
                                                    @endif
                                                @endforeach
                                                </option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="AssetName">Middle name</label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter middle name" value="{{$user->middle_name}}" name="middle_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="itemNameId">Email</label>
                                            <input type="text" class="form-control" id="AssetSerialId" placeholder="Enter email" value="{{$user->email}}" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label>Select user section</label>
                                            <select class="form-control select2" style="width: 100%;" name="section_id">
                                                <option value="{{$user->section_id}}" selected="{{$user->section_id}}" disabled>
                                                @foreach($sections as $section)
                                                    @if ($section->id == $user->section_id)
                                                        {{$section->name}} ({{$section->name_abbreviation}}) 
                                                    @endif
                                                @endforeach
                                                </option>
                                                @foreach($sections as $section)
                                                    <option value="{{$section->id}}">{{$section->name}} </option>
                                                @endforeach

                                            </select>
                                        </div>

                                        
                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$user->id}}">Reset Password</button>
                                <button type="submit" class="btn btn-success">Edit item</button>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
    </div>
    <!-- delete modal -->
    <div class="modal fade" id="modal-sm{{$user->id}}">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Reseting {{$user->first_name}} {{$user->last_name}} password </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to reset <b> {{$user->first_name}} {{$user->middle_name}} {{$user->last_name}} </b> passsword? </p>
                </div>
                <div class="modal-footer justify-content-between">
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <form action="{{ route('reset', $user->id )}}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="text" class="form-control" id="assetNameId" placeholder="Enter Last name" value="{{$user->last_name}}" name="last_name" hidden>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('pagescripts')

    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">

    
    
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            setTimeout(function(){$("#success_element").hide();}, 5000);
        });     

        $(document).ready(function () {
            $.validator.setDefaults({
                // submitHandler: function () {
                // alert( "Form successful submitted!" );
                // }
            });
            $('#editUserForm').validate({
            rules: {
                    first_name: {
                        required: true,
                    },
                    middle_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    role_id: {
                        required: true,
                    },

                    email: {
                        required: true,
                    },

            },
            messages: {
                first_name: {
                    required: "Please enter first Name",
                },
                middle_name: {
                        required: "Please enter middle name",
                },
                last_name: {
                    required: "Please enter last name",
                },
                role_id: {
                    required: "Please select role",
                },

                email: {
                    required: "Please enter email address",
                },
            },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }
        });
    });
    </script>
    
@endsection
