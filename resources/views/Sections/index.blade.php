@extends('layouts.master')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Sections </h3>
                <a href="{{route('printReportActivity')}}" target="_blank">
                <button type="button" class="btn btn-success btn-sm" style="float:right" ><i class="fas fa-print"></i> Print </button>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Section Name</th>
                    <th>Department Name</th>
                    <th>Section Name Abbreviation</th> 
                    <th>Action</th> 
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($sections as $section)
                
                  <tr>
                    <td> {{$section->name}} </td>

                    @foreach($departments as $dept)
                        @if ($dept->id == $section->department_id)
                            <td>
                                
                                    <u> {{$dept->name}} </u>
                                
                            </td>   
                            
                        @endif
                    @endforeach

                    <td>{{$section->name_abbreviation}}</td>

                    <td>
                        
                        <a href="{{ route('section.edit', $section->id) }}">
                             <button type="button" class="btn btn-success btn-sm" >Edit</button>
                        </a>
                            
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$section->id}}">Delete</button>
                                
                            
                    </td>
                  </tr>

                  <!-- deleting section -->
                  <div class="modal fade" id="modal-sm{{$section->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h4 class="modal-title">Deleting {{$section->name}} Section</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete <b> {{$section->name}} </b> section permanently? </p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <form action="{{ route('section.destroy', $section->id)}}" method="post">
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
