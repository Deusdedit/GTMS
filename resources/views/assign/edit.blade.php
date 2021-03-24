@extends('layouts.master')

@section('content')
<p>

</p>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit activity details</h3>
        <a href="{{ route('assign.index') }}">
            <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to All assigned activity</button>
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

    <form role="form" method="post" action="{{ route('assign.update', $activity->id) }}" id="receivingForm">
        @csrf
        @method('PATCH')
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title">Edit assigning Activity details</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select User</label>
                        <select class="form-control select2" style="width: 100%;" name="user_id" placeholder="Select a user....">
                            <option value="{{$activity->user_id}}" selected >
                                @foreach($users as $user)
                                    @if($user->id == $activity->user_id)
                                        @foreach($sections as $section)
                                            @if($section->id == $user->section_id)
                                                @foreach($departments as $department)
                                                    @if($department->id == $section->department_id)
                                                        {{$user->first_name}} {{$user->middle_name}} {{$user->last_name}} of <i> {{$department->name}} ({{$section->name}})</i>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </option>
                                @foreach($users as $user)
                                    @foreach($sections as $section)
                                        @if($section->id == $user->section_id)
                                            @foreach($departments as $department)
                                                @if($department->id == $section->department_id)
                                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}} of <i> {{$department->name}} ({{$section->name}}).</i> </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach
                        </select>
                    </div>
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
                                <label for="supplierId">Expected Output</label>
                                <input type="text" class="form-control" id="activityId" value="{{$activity->output}}" name="output">
                            </div>
                            <div class="form-group">
                                <label for="itemNameId">Date to start activity. Previous date was {{Carbon\Carbon::parse($activity->start_assign_date)->format('d-m-Y')}}</label>
                                <input type="date" class="form-control" id="itemNameId" value="{{$activity->start_assign_date}}" name="start_assign_date">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="itemNameId">Activity Details</label>
                                <input type="text" class="form-control" id="AssetSerialId" value="{{$activity->details}}" name="details">
                            </div>

                            <div class="form-group">
                                <label for="supplierId">Resources</label>
                                <input type="text" class="form-control" id="serialId" value="{{$activity->resources}}" name="resources">
                            </div>

                            <div class="form-group">
                                <label for="supplierId">Collaborators</label>
                                <input type="text" class="form-control" id="locationId" value="{{$activity->colaborators}}" name="colaborators">
                            </div>
                            <div class="form-group">
                                <label for="itemNameIdd">Duration in Days</label>
                                <input type="number" class="form-control" id="itemNameIdd" value="{{$activity->duration}}" name="duration">
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
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.select2').select2()
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
