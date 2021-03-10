@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit selected Section</h3>
            <a href="{{ route('sectioning') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to All Sections</button>
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

        <form role="form" method="post" action="{{ route('section.update', $section->id) }}" id="sectionForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Section</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="driverId">Section Name</label>
                                            <input type="text" class="form-control" id="departmentId" placeholder="Enter Department Name" value="{{$section->name}}" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label>Select department</label>
                                            <select class="form-control select2" style="width: 100%;" name="department_id" placeholder="Select department...." value="{{$section->department_id}}">
                                                <option value="{{$section->department_id}}" selected="{{$section->department_id}}" disabled>
                                                    @foreach($departments as $dept)
                                                        @if($dept->id == $section->department_id)
                                                            {{$dept->name}}
                                                        @endif
                                                    @endforeach
                                                </option>
                                                @foreach($departments as $dept)
                                                    <option value="{{$dept->id}}">{{$dept->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="licenseId">Section abbreviation</label>
                                            <input type="text" class="form-control" id="departmentAbbId" placeholder="Enter Department abbreviation" value="{{$section->name_abbreviation}}" name="name_abbreviation">
                                        </div>
                                    </div>   
                                </div>    
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-success">Edit Section</button>
                            </div>
                        </div>
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
