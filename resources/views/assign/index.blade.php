@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header"> 
    <h3 class="card-title">All assigned Activities </h3>
    <a href="{{route('printReportActivityAssigned')}}" target="_blank">
    <button type="button" class="btn btn-success btn-sm" style="float:right" ><i class="fas fa-print"></i> Print </button>
    </a>
    <button type="button" class="btn btn-primary btn-sm" style="float:right; margin-right:10px;" data-toggle="modal" data-target="#modal-activity">Assign Activity</button>
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
        <th>Assigned to </th>
        <th>Activity Name</th>
        <th>Assigned Date</th>
        <th>Date assigned to start </th>
        <th>Days</th>
        <th>Start Date </th>
        <th>Status </th>
        <th>End Date </th>
        </tr>
        </thead>
        <tbody>
        @foreach($activities as $activity)
        @if($activity->activity_from_user_id == $logged_id )
            <tr>
                <td>
                    <a href="{{ route('assign.show', $activity->id)}}">
                        @foreach($users as $user)
                            @if($user->id == $activity->user_id)
                                @foreach($sections as $section)
                                    @if($section->id == $user->section_id)
                                        @foreach($departments as $department)
                                            @if($department->id == $section->department_id)
                                                {{$user->first_name}}  {{$user->last_name}} (<i>{{$section->name}}).</i>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </a>
                </td>
                <td>
                    {{$activity->name}} 
                    
                </td>   
                <td>{{$activity->assigned_date}}</td>
                <td>{{ Carbon\Carbon::parse($activity->start_assign_date) ->format('d-m-Y') }}</td>
                <td>{{$activity->duration}}</td>
                <td>
                    @if($activity->start_date != Null )
                            {{$activity->start_date}}
                        @else
                        <center>
                            <i class="fas fa-minus-circle" style="color:green;"></i>
                        </center>
                        
                        @endif
                </td>
                <td>
                    {{$activity->status}} 
                    
                </td>
                <td>
                    @if($activity->end_date != Null )
                        {{$activity->end_date}}
                    @else
                    <center>
                        <i class="fas fa-spinner" style="color:green;"></i>
                    </center>
                    
                    @endif                            
            </tr>

        @endif
        @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
</div>

<!-- add new activity -->
<div class="modal fade" id="modal-activity">
    <form role="form" method="post" action="{{ route('assign.store') }}" id="activityForm">
        @csrf
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title">Assign activity</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select User</label>
                        <select class="form-control select2" style="width: 100%;" name="user_id" placeholder="Select a user....">
                            <option selected="selected" disabled>Full name of Department (Section)...</option>
                                @foreach($users as $user)
                                    @foreach($sections as $section)
                                        @if($section->id == $user->section_id)
                                            @foreach($departments as $department)
                                                @if($department->id == $section->department_id)
                                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}} of <i> {{$department->name}} ({{$section->name}}).</i> </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach
                        </select>
                    </div>
                    <div class="row">
                        
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="ledgerNumberId">Activity Name</label>
                                <input type="text" class="form-control" id="ledgerNumberId" placeholder="Enter activity name" name="name">
                            </div>

                            <div class="form-group">
                                <label for="quantityId">Client</label>
                                <input type="text" class="form-control" id="quantityId" placeholder="Enter Client name" name="client">
                            </div>

                            <div class="form-group">
                                <label for="costId">Activity Details</label>
                                <input type="text" class="form-control" id="costId" placeholder="Enter activity details" name="details">
                            </div>

                            <div class="form-group">
                                <label for="itemNameId">Date to start activity</label>
                                <input type="date" class="form-control" id="itemNameId" placeholder="Enter Date to start " name="start_assign_date">
                            </div>

                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="itemNameId">Colaborators</label>
                                <input type="text" class="form-control" id="itemNameId" placeholder="Enter colaborators names" name="colaborators">
                            </div>

                            <div class="form-group">
                                <label for="supplierId">Expected Output</label>
                                <input type="text" class="form-control" id="supplierId" placeholder="Enter expected output" name="output">
                            </div>

                            <div class="form-group">
                                <label for="totalcostId">Resources</label>
                                <input type="text" class="form-control" id="totalcostId" placeholder="Enter resources" name="resources">
                            </div>
                            <div class="form-group">
                                <label for="itemNameIdd">Duration in Days</label>
                                <input type="number" class="form-control" id="itemNameIdd" placeholder="Enter activity duration " name="duration">
                            </div>

                        </div>   
                    </div>    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign activity</button>
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
