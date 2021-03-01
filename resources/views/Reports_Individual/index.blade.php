@extends('layouts.master')

@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">Individuals Reports </h3>
                
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
                  
              </div>
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
