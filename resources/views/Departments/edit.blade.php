@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit selected Department</h3>
            <a href="{{ route('department.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to All Departments</button>
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

        <form role="form" method="post" action="{{ route('department.update', $departments->id) }}" id="departmentForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Department</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="driverId">Department Name</label>
                                            <input type="text" class="form-control" id="departmentId" placeholder="Enter Department Name" value="{{$departments->name}}" name="name">
                                        </div>

                                        

                                        
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="licenseId">Department abbreviation</label>
                                            <input type="text" class="form-control" id="departmentAbbId" placeholder="Enter Department abbreviation" value="{{$departments->name_abbreviation}}" name="name_abbreviation">
                                        </div>

                                        

                                        
                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-success">Edit Department</button>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
    </div>
@endsection
@section('pagescripts')

    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            setTimeout(function(){$("#success_element").hide();}, 5000);
        });     

        $(document).ready(function () {
            $.validator.setDefaults({
                // submitHandler: function () {
                // alert( "Form successful submitted!" );
                // }
            });
            $('#drivingForm').validate({
            rules: {
                    fullname: {
                        required: true,
                    },
                    license: {
                        required: true,
                    },
                    
            },
            messages: {
                fullname: {
                        required: "Please enter Driver Full Name",
                    },
                quantity: {
                        required: "Please enter Driving License",
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
