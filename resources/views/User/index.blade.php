@extends('layouts.master')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">All User </h3>
                <button type="button" class="btn btn-primary btn-sm" style="float:right" data-toggle="modal" data-target="#modal-NewUser"><i class="fas fa-plus"></i>  Add new user </button>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Last name</th>
                    <th>First name</th>
                    <th>Email</th>
                    <th>Section</th>
                    <th>Action </th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>
                        <a href="{{ route('user.show', $user->id)}}" >
                            <u> {{$user->last_name}} </u>
                        </a>
                    </td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @foreach($sections as $section)
                            @if($section->id == $user->section_id)
                                {{$section->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ route('user.edit', $user->id) }}">
                                    <button type="button" class="btn btn-success btn-sm" >Edit</button>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$user->id}}">Delete</button>
                                
                            </div>
                            @if($user->status == 0)
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-deactivate{{$user->id}}">Deactivate </button>
                                </div>
                            @else
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-activate{{$user->id}}">Activate </button>
                                </div>
                            @endif
                            
                        </div>
                    </td>
                  </tr>
                    <!-- delete modal -->
                    <div class="modal fade" id="modal-sm{{$user->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">Deleting {{$user->first_name}} {{$user->last_name}} </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete <b> {{$user->first_name}} {{$user->middle_name}} {{$user->last_name}} </b> permanently? </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('user.destroy', $user->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- activate modal -->
                    <div class="modal fade" id="modal-activate{{$user->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title">Activating {{$user->first_name}} {{$user->last_name}} </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to activate <b> {{$user->first_name}} {{$user->middle_name}} {{$user->last_name}} </b> </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('activate', $user->id )}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" class="form-control" id="assetNameId" placeholder="Enter Last name" value="1" name="getvalue" hidden>
                                        <button type="submit" class="btn btn-success">Yes</button>
                                    </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- deactivate modal -->
                    <div class="modal fade" id="modal-deactivate{{$user->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h4 class="modal-title">Deactivating {{$user->first_name}} {{$user->last_name}} </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to deactivate <b> {{$user->first_name}} {{$user->middle_name}} {{$user->last_name}} </b> </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('activate', $user->id )}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" class="form-control" id="assetNameId" placeholder="Enter Last name" value="2" name="getvalue" hidden>
                                        <button type="submit" class="btn btn-warning">Yes</button>
                                    </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    

                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <!-- create new User modal -->
            <div class="modal fade" id="modal-NewUser">
                <form role="form" method="post" action="{{ route('user.store') }}" id="vehicleForm">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Add new user</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="assetNameId">First Name <sup><i class="fa fa-asterisk" style="font-size:6px;color:red"></i></sup></label>
                                            <input type="text" class="form-control" id="assetNameId" placeholder="Enter First name" name="first_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="productionId">Last Name <sup><i class="fa fa-asterisk" style="font-size:6px;color:red"></i></sup></label>
                                            <input type="text" class="form-control" id="serialId" placeholder="Enter last name" name="last_name">
                                        </div>
                                        <div class="form-group">
                                            <label>Select user role <sup><i class="fa fa-asterisk" style="font-size:6px;color:red"></i></sup></label>
                                            <select class="form-control select2" style="width: 100%;" name="role_id">
                                                <option selected="selected" disabled>Select a user role...</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}"> 
                                                        {{$role->name}} 
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="productionId">Middle Name</label>
                                            <input type="text" class="form-control" id="serialId" placeholder="Enter middle name" name="middle_name">

                                        <div class="form-group">
                                            <label for="AssetSerialId">Email <sup><i class="fa fa-asterisk" style="font-size:6px;color:red"></i></sup></label>
                                            <input type="email" class="form-control" id="AssetSerialId" placeholder="Enter user email" name="email">
                                        </div>

                                        <div class="form-group">
                                            <label>Select user section <sup><i class="fa fa-asterisk" style="font-size:6px;color:red"></i></sup></label>
                                            <select class="form-control select2" style="width: 100%;" name="section_id">
                                                <option selected="selected" disabled>Select a user section...</option>
                                                @foreach($sections as $section)
                                                    <option value="{{$section->id}}"> 
                                                        {{$section->name}} 
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        

                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add user</button>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
                <!-- /.modal-dialog -->
            </div>
            

@endsection

@section('pagescripts')

<!-- DataTables -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">

        $(function () {
            $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
            });
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });

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
            $('#receivingForm').validate({
            rules: {
                name: {
                        required: true,
                    },
                    purchased_date: {
                        required: true,
                    },
                    condition: {
                        required: true,
                    },
                    serial_number: {
                        required: true,
                    },
                    product_number: {
                        required: true,
                    },
                    location: {
                        required: true,
                    },
                    activity: {
                        required: true,
                    },
            },
            messages: {
                name: {
                    required: "Please enter asset name",
                    
                },
                purchased_date: {
                        required: "Please enter date bought",
                },
                condition: {
                    required: "Please enter condition",
                },
                serial_number: {
                    required: "Please enter serial number",
                },
                product_number: {
                    required: "Please enter production number",
                },
                location: {
                    required: "Please select a condition",
                },
                activity: {
                    required: "Please select a activity",
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

        $(document).ready(function () {
            $.validator.setDefaults({
                // submitHandler: function () {
                // alert( "Form successful submitted!" );
                // }
            });
            $('#disposingForm').validate({
                rules: {
                    reason: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                },
                messages: {
                    reason: {
                        required: "Please specify a reason",
                    },
                    date: {
                        required: "Please enter a date",
                    },
                    price: {
                        required: "Please enter a price",
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
