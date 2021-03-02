@extends('layouts.master')

@section('content')

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
                <br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Last name</th>
                    <th>First name</th>
                    <th>Email</th>
                    <th>Department </th>
                    <th>Section </th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#modal-individual{{$user->id}}">
                            <u> {{$user->last_name}} </u>
                        </a>
                    </td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->email}}</td>
                    
                    @foreach($sections as $section)
                        @if($section->id == $user->section_id)
                            @foreach($departments as $department)
                                @if($department->id == $section->department_id)
                                    <td>
                                        {{$department->name}}
                                    </td>

                                    <td>
                                        {{$section->name}}
                                    </td>
                                        
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                  </tr>

                  <!-- create new vehicle modal -->
            <div class="modal fade" id="modal-individual{{$user->id}}">
                <form role="form" method="post" action="" id="vehicleForm">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title">Add Vehicle</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle text-info"></i>
                                        Today
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle text-info"></i> Yesterday
                                    </a>
                                    </li>
                                </ul>
                                 
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add item</button>
                            </div>
                            </div>
                                </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>

                <!-- /.modal-dialog -->
            </div>
                  @endforeach

                  </tbody>
                </table>

            <form role="form" method="post" action="{{ route('getIndividual') }}" id="receivingForm">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Generate individuals reports</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Select User</label>
                                            <select class="form-control select2" style="width: 100%;" name="user_id" placeholder="Select a user....">
                                                <option selected="selected" disabled>Select a User...</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}} </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Select a date</label>
                                            <select class="form-control select1" style="width: 100%;" name="dates">
                                                <option selected="selected" disabled>Select a date...</option>
                                                <option value="today">Today</option>
                                                <option value="yesterday">Yesterday</option>
                                                <option value="Refurbished">Refurbished</option>
                                            </select>
                                        </div>
                                        
                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-success">Edit details</button>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
            </form>


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
            "order": [[ 2, "desc" ]],
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
            $('#activityForm').validate({
            rules: {
                    name: {
                        required: true,
                    },
                    details: {
                        required: true,
                    },
                    resources: {
                        required: true,
                    },
                    
            },
            messages: {
                name: {
                    required: "Please enter activity name",
                },
                details: {
                        required: "Please enter details",
                },
                resources: {
                    required: "Please enter resources",
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
