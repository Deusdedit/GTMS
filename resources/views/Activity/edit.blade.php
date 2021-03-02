@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit selected activity</h3>
            <a href="{{ route('activity.index') }}">
                <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all activity</button>
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

        <form role="form" method="post" action="{{ route('activity.update', $activity->id) }}" id="receivingForm">
            @csrf
            @method('PATCH')
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Activity details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="AssetName">Activity name</label>
                                    <input type="text" class="form-control" id="assetNameId" value="{{$activity->name}}" name="name">
                                </div>

                                <div class="form-group">
                                    <label for="quantityId">Client</label>
                                    <input type="text" class="form-control" id="quantityId" value="{{$activity->client}}" name="client">
                                </div>
                                <div class="form-group">
                                    <label for="supplierId">Expected activity</label>
                                    <input type="text" class="form-control" id="activityId" value="{{$activity->output}}" name="output">
                                </div>


                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="itemNameId">Details</label>
                                    <input type="text" class="form-control" id="AssetSerialId" value="{{$activity->details}}" name="details">
                                </div>

                                <div class="form-group">
                                    <label for="supplierId">Resources</label>
                                    <input type="text" class="form-control" id="serialId" value="{{$activity->resources}}" name="resources">
                                </div>

                                <div class="form-group">
                                    <label for="supplierId">Colaborators</label>
                                    <input type="text" class="form-control" id="locationId" value="{{$activity->colaborators}}" name="colaborators">
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
    </div>
@endsection
@section('pagescripts')

    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">

    
    
        $(function () {
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
            $('#receivingForm').validate({
            rules: {
                    name: {
                        required: true,
                    },
                    purchased_date: {
                        required: true,
                    },
                    serial_number: {
                        required: true,
                    },
                    product_number: {
                        required: true,
                    },

                    location: {
                        required: true,
                    },

                    activity: {
                        required: true,
                    },
                
                    // password: {
                    //     required: true,
                    //     minlength: 5
                    // },
                    // terms: {
                    //     required: true
                    // },
            },
            messages: {
                name: {
                    required: "Please enter a Asset Name",
                },
                purchased_date: {
                        required: "Please enter purchased date",
                },
                serial_number: {
                    required: "Please enter serial number",
                },
                product_number: {
                    required: "Please enter product number",
                },

                location: {
                    required: "Please enter location",
                },

                activity: {
                    required: "Please enter activity",
                },
                
                // password: {
                //     required: "Please provide a password",
                //     minlength: "Your password must be at least 5 characters long"
                // },
                // terms: "Please accept our terms"
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
