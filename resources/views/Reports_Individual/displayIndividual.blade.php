@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Departments </h3>
        <a href="{{route('printReportActivity')}}" target="_blank">
            <button type="button" class="btn btn-success btn-sm" style="float:right" ><i class="fas fa-print"></i> Print </button>
        </a>
        <button type="button" class="btn btn-primary btn-sm" style="float:right; margin-right:10px;" data-toggle="modal" data-target="#modal-department">Add new Department</button>
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
                    <tr>
                        <td>
                            <a href="{{ route('activity.show', $activity->id)}}" >
                                {{$activity->name}}
                            </a>
                        </td>
                        <td>{{$activity->details}}</td>
                        <td>{{$activity->start_date}}</td>
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
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-cancel{{$activity->id}}">Cancel</button>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-finish{{$activity->id}}">Finish</button>
                                <a href="{{ route('activity.edit', $activity->id) }}">
                                    <button type="button" class="btn btn-success btn-sm" >Edit</button>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$activity->id}}">Delete</button>
                            @else
                                <center>
                                    <i class="fas fa-check" style="color:green;"></i>
                                </center>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
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
            "print": true,
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
