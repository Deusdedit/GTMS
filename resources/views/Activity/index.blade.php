@extends('layouts.master')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Activities </h3>
                <button type="button" class="btn btn-primary btn-sm" style="float:right" data-toggle="modal" data-target="#modal-activity">Add new Activity</button>
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
                    <td>{{$activity->name}}</td>
                    <td>{{$activity->details}}</td>
                    <td>{{$activity->start_date}}</td>
                    <td>{{$activity->end_date}}</td>
                    <td>{{$activity->status}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-finish{{$activity->id}}">Finish</button>

                        <a href="{{ route('activity.edit', $activity->id) }}">
                            <button type="button" class="btn btn-success btn-sm" >Edit</button>
                        </a>
                        
                    
                        
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$activity->id}}">Delete</button>
                    </td>
                  </tr>

                  <!-- Finish activity -->
            <div class="modal fade" id="modal-finish{{$activity->id}}">
                <form role="form" method="post" action="{{ route('finishActivity') }}" id="activityForm">
                    @csrf
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header bg-info">
                                <h4 class="modal-title">Finish activity</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="ledgerNumberId">Recommendations</label>
                                    <textarea class="form-control" rows="3" id="ledgerNumberId" placeholder="Enter recommendations..." name="recommendations"></textarea>
                                </div>   
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add activity</button>
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
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Add new activity</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ledgerNumberId">Name</label>
                                            <input type="text" class="form-control" id="ledgerNumberId" placeholder="Enter activity name" name="name">
                                        </div>

                                        <div class="form-group">
                                            <label for="quantityId">Client</label>
                                            <input type="text" class="form-control" id="quantityId" placeholder="Enter Client name" name="client">
                                        </div>

                                        <div class="form-group">
                                            <label for="costId">Details</label>
                                            <input type="text" class="form-control" id="costId" placeholder="Enter activity details" name="details">
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

                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add activity</button>
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
