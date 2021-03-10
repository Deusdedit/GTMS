@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Departments </h3>
            <button type="button" class="btn btn-primary btn-sm" style="float:right; margin-right:10px;" data-toggle="modal" data-target="#modal-department">Add new Department</button>
        </div>
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
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Department name</th>
                        <th>Department Abbreviation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $dept)
                        <tr>
                            <td>
                                <!-- <a href="#" data-toggle="modal" data-target="#modal-department"> -->
                                    {{$dept->name}}
                                <!-- </a> -->
                            </td>
                            <td>
                                {{$dept->name_abbreviation}}
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$dept->id}}">Delete</button>
                                <a href="{{ route('department.edit', $dept->id) }}">
                                    <button type="button" class="btn btn-success btn-sm">Edit</button>
                                </a>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-sec{{$dept->id}}">Add section</button>
                            </td>
                            <td hidden></td>
                        </tr>
                        <!-- add new department -->
                        <div class="modal fade" id="modal-department">
                            <form role="form" method="post" action="{{ route('department.store') }}" id="departmentForm">
                                @csrf
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add new department</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="ledgerNumberId">Department Name</label>
                                                        <input type="text" class="form-control" id="ledgerNumberId" placeholder="Enter department name" name="name">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="itemNameId">Department abbreviation name</label>
                                                        <input type="text" class="form-control" id="itemNameId" placeholder="Enter department abbrevation names" name="name_abbreviation">
                                                    </div>
                                                </div>   
                                            </div>    
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add department</button>
                                        </div>
                                        
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </form>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- add new section -->
                        <div class="modal fade" id="modal-sec{{$dept->id}}">
                            <form role="form" method="post" action="{{ route('section.store') }}" id="sectionForm">
                                @csrf
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title">Add new section</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="assetNameId">Department </label>
                                                        <input type="text" class="form-control" id="assetNameId" placeholder="Enter Department name" name="department_id" value="{{$dept->id}}" hidden >
                                                        <input type="text" class="form-control" id="assetNameId" value="{{$dept->name}} " disabled >
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="ledgerNumberId">Section Name</label>
                                                        <input type="text" class="form-control" id="ledgerNumberId" placeholder="Enter section name" name="name">
                                                    </div>
                                                </div>   
                                            </div>    
                                            <div class="form-group">
                                                        <label for="itemNameId">Section abbreviation name</label>
                                                        <input type="text" class="form-control" id="itemNameId" placeholder="Enter section abbrevation names" name="name_abbreviation">
                                                    </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add section</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                            </form>
                            <!-- /.modal-dialog -->
                        </div>

                        <!-- deleting department -->
                        <div class="modal fade" id="modal-sm{{$dept->id}}">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h4 class="modal-title">Deleting {{$dept->name}} Department</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete <b> {{$dept->name}} </b> department permanently? </p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <form action="{{ route('department.destroy', $dept->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Yes</button>
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
