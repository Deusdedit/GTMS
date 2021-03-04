@extends('layouts.master')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Sections </h3>
        </div>

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
        
        <div class="card-body">
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
                   
                  
                
                        <!-- generate report modal   -->
                        <div class="modal fade" id="modal-individual{{$user->id}}">
                            <form role="form" method="post" action="{{ route('getIndividuals', ['id' => $user->id, 'days'=>'custom']) }}" target="_blank" id="vehicleForm">
                                @csrf
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" >
                                            <h4 class="modal-title">Generate Report for {{$user->first_name}} {{$user->last_name}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <ul class="nav nav-pills flex-column">
                                                        <li class="nav-item">
                                                        <a href="{{ route('getIndividual', ['id' => $user->id, 'days'=>'today']) }}" target="_blank" class="nav-link">
                                                            <i class="far fa-circle text-info"></i>
                                                            Today
                                                        </a>
                                                        </li>
                                                        <li class="nav-item">
                                                        <a href="{{ route('getIndividual', ['id' => $user->id, 'days'=>'yesterday']) }}" target="_blank" class="nav-link">
                                                            <i class="far fa-circle text-info"></i> Yesterday
                                                        </a>
                                                        </li>
                                                        <li class="nav-item">
                                                        <a href="{{ route('getIndividual', ['id' => $user->id, 'days'=>'thisweek']) }}" target="_blank" class="nav-link">
                                                            <i class="far fa-circle text-info"></i>
                                                            This Week
                                                        </a>
                                                        </li>
                                                        <li class="nav-item">
                                                        <a href="{{ route('getIndividual', ['id' => $user->id, 'days'=>'thismonth']) }}" target="_blank" class="nav-link">
                                                            <i class="far fa-circle text-info"></i>
                                                            This Month
                                                        </a>
                                                        </li>
                                                        <li class="nav-item">
                                                        <a href="{{ route('getIndividual', ['id' => $user->id, 'days'=>'thisyear']) }}" target="_blank" class="nav-link">
                                                            <i class="far fa-circle text-info"></i>
                                                            This Year
                                                        </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-9"> 
                                                    <div id="accordion">
                                                        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                                                        <div class="card card-primary">
                                                            <div class="card-header">
                                                                <h4 class="card-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                                    Custom Date
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <form role="form" method="post" action="" id="dateForm">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="dateId">Start Date</label>
                                                                                    <input type="date" class="form-control" id="dateId" placeholder="Enter start Date " name="start_date">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="dateId">End date Date</label>
                                                                                    <input type="date" class="form-control" id="dateId" placeholder="Enter end Date " name="end_date">
                                                                                </div>
                                                                            </div>
                                                                            <div class="justify-content-between" style="float:right;">
                                                                                <button type="submit" class="btn btn-primary">Generate</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between" style="float:right;">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
