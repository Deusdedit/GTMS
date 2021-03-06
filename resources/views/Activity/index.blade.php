@extends('layouts.master')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Activities </h3>
                <a href="{{route('printReportActivity')}}" target="_blank">
                <button type="button" class="btn btn-success btn-sm" style="float:right" ><i class="fas fa-print"></i> Print </button>
              </a>
                <button type="button" class="btn btn-primary btn-sm" style="float:right; margin-right:10px;" data-toggle="modal" data-target="#modal-activity">Add new Activity</button>
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
                    <th>Name</th>
                    <th>Details</th> 
                    <th>Start date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action </th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($activities as $activity)
                  @if($activity->user_id == $logged_id )
                  <tr>
                    <td>
                        <a href="{{ route('activity.show', $activity->id)}}" >
                            {{$activity->name}}
                        </a>
                    </td>
                    <td>{{$activity->details}}</td>
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
                        @if($activity->end_date != Null )
                            {{$activity->end_date}}
                        @else
                        <center>
                            <i class="fas fa-spinner" style="color:green;"></i>
                        </center>
                        
                        @endif
                    </td>
                    <td>{{$activity->status}}</td>
                    <td>
                    @if($activity->status == "On going" )
                        @if($activity->activity_from_user_id != Null )
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-cancel{{$activity->id}}">Cancel</button>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-finish{{$activity->id}}">Finish</button>
                        @else
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-cancel{{$activity->id}}">Cancel</button>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-finish{{$activity->id}}">Finish</button>
                            <a href="{{ route('activity.edit', $activity->id) }}">
                                <button type="button" class="btn btn-success btn-sm" >Edit</button>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$activity->id}}">Delete</button>
                        @endif
                        

                    @elseif($activity->status == "Not Started")
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-start{{$activity->id}}">Start</button>
                    @else
                    <center>
                        <i class="fas fa-check" style="color:green;"></i>
                    </center>
                    
                    @endif
                    </td>
                  </tr>

                  <!-- deleting activity -->
                  <div class="modal fade" id="modal-sm{{$activity->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">Deleting {{$activity->name}} Activity</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete <b> {{$activity->name}} </b> activity permanently? </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('activity.destroy', $activity->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                  <!-- Finish activity -->
                <div class="modal fade" id="modal-finish{{$activity->id}}">
                    <form role="form" method="post" action="{{ route('finishActivity', $activity->id) }}" id="activityForm">
                        @csrf
                        @method('PATCH')
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            
                                <div class="modal-header bg-info">
                                    <h4 class="modal-title">Finish {{$activity->name}} activity</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="ledgerNumberId">Recommendations</label>
                                        <textarea class="form-control" rows="3" id="ledgerNumberId" placeholder="Enter recommendations..." name="recommendations"></textarea>
                                    </div>   
                                    
                                    <div class="form-group">
                                        <label for="ledgerNumberId">Feedback <sup><i class="fa fa-asterisk" style="font-size:6px;color:red"></i></sup></label>
                                        <textarea class="form-control" rows="3" id="ledgerNumberId" placeholder="Enter Feedbacks..." name="feedback"></textarea>
                                    </div> 

                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Finish activity</button>
                                </div>
                                
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </form>
                    <!-- /.modal-dialog -->
                </div>
                <!-- Cancel activity -->
                <div class="modal fade" id="modal-cancel{{$activity->id}}">
                    <form role="form" method="post" action="{{ route('cancelActivity', $activity->id) }}" id="activityForm">
                        @csrf
                        @method('PATCH')
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            
                            
                                <div class="modal-header bg-warning">
                                    <h4 class="modal-title">Cancel {{$activity->name}} activity</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="ledgerNumberId">Reason <sup><i class="fa fa-asterisk" style="font-size:6px;color:red"></i></sup></label>
                                        <textarea class="form-control" rows="3" id="ledgerNumberId" placeholder="Enter a reason..." name="recommendations"></textarea>
                                    </div>   
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Cancel activity</button>
                                </div>
                                
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </form>
                    <!-- /.modal-dialog -->
                </div>
                <!-- Start activity -->
                <div class="modal fade" id="modal-start{{$activity->id}}">
                    <form role="form" method="post" action="{{ route('startActivity', $activity->id) }}" id="activityForm">
                        @csrf
                        @method('PATCH')
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                            
                                <div class="modal-header bg-info">
                                    <h4 class="modal-title">Start {{$activity->name}} activity</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <p>Are you sure you want to start <b> {{$activity->name}} </b> activity assigned? </p>
                                </div>
                                
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Yes! start</button>
                                </div>
                                
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </form>
                    <!-- /.modal-dialog -->
                </div>
                    @endif
                  @endforeach
                  </tbody>
        </table>
              </div>
              <!-- /.card-body -->
            </div>
            
            <!-- add new activity -->
            <div class="modal fade" id="modal-activity">
                <form role="form" method="post" action="{{ route('activity.store') }}" id="activityForm">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header" style="background-color:#2396c4;color:#FFFFFF">
                                <h4 class="modal-title">Add new activity</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body"  >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ledgerNumberId">Name  <sup><i class="fa fa-asterisk" style="font-size:6px;color:red"></i></sup></label>
                                            <input type="text" class="form-control" id="ledgerNumberId" placeholder="Enter activity name" name="name" >
                                        </div>

                                        <div class="form-group">
                                            <label for="quantityId">Client</label>
                                            <input type="text" class="form-control" id="quantityId" placeholder="Enter Client name" name="client">
                                        </div>

                                        

                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="itemNameId">Collaborators</label>
                                            <input type="text" class="form-control" id="itemNameId" placeholder="Enter collaborators names" name="colaborators">
                                        </div>

                                       

                                        <div class="form-group">
                                            <label for="totalcostId">Resources <sup><i class="fa fa-asterisk" style="font-size:6px;color:red"></i></sup></label>
                                            <input type="text" class="form-control" id="totalcostId" placeholder="Enter resources" name="resources">
                                        </div>

                                    </div>   
                                </div>    
                                <div class="form-group">
                                            <label for="supplierId">Expected Output <sup><i class="fa fa-asterisk" style="font-size:6px;color:red"></i></sup></label>
                                            <input type="text" class="form-control" id="supplierId" placeholder="Enter expected output" name="output">
                                        </div>
                                        <div class="form-group">
                                            <label for="costId">Details <sup><i class="fa fa-asterisk" style="font-size:6px;color:red"></i></sup></label>
                                            <textarea rows="3" class="form-control" id="costId" placeholder="Enter activity details" name="details"></textarea>
                                        </div>
                            </div>
                            <div class="modal-footer justify-content-between" style="background-color:#2396c4;" >
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Add activity</button>
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
