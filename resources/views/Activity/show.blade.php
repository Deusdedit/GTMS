@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Displaying <b> {{$activity->name}} </b>details </h3>
                <a href="{{ route('activity.index')}}">
                    <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all activities </button>
                </a>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Column name</th>
                      <th>Detailed Information</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><b>Name</b></td>
                      <td>{{$activity->name}}</td>
                    </tr>
                    <tr>
                      <td><b>Client </b></td>
                      <td>{{$activity->client}}</td>
                    </tr>
                    <tr>
                      <td><b>Details </b></td>
                      <td>{{$activity->details}}</td>
                    </tr>
                    <tr>
                      <td><b>Resources</b></td>
                      <td>{{$activity->resources}}</td>
                    </tr>
                    <tr>
                      <td><b>Colaborators</b></td>
                      <td>{{$activity->colaborators}}</td>
                    </tr>
                    <tr>
                      <td><b>Expected output</b></td>
                      <td>{{$activity->output}}</td>
                    </tr>
                    <tr>
                      <td><b>Activity from</b></td>
                      <td>
                          @if($activity->activity_from_user_id == Null)
                            Personal Assignment
                          @else
                            @foreach($users as $user)
                              @if($activity->activity_from_user_id == $user->id)
                                {{$user->first_name}} {{$user->last_name}} 
                              @endif
                            @endforeach
                          @endif
                      </td>
                    </tr>
                    <tr>
                      <td><b>Date assigned</b></td>
                      <td>{{$activity->assigned_date}}</td>
                    </tr>
                    <tr>
                      <td><b>Date assigned to start</b></td>
                      <td>{{ Carbon\Carbon::parse($activity->start_assign_date)->toDateString()}}</td>
                    </tr>
                    <tr>
                      <td><b>Duration in days</b></td>
                      <td>
                        @if($activity->duration == 0)
                          -
                        @else
                          {{$activity->duration}}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td><b>Start date</b></td>
                      <td>{{$activity->start_date}}</td>
                    </tr>
                    <tr>
                      <td><b>End date</b></td>
                      <td>{{$activity->end_date}}</td>
                    </tr>
                    <tr>
                      <td><b>Status</b></td>
                      <td>{{$activity->status}}</td>
                    </tr>
                    <tr>
                      <td><b>Recommendations</b></td>
                      <td>{{$activity->recommendations}}</td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
@endsection
@section('pagescripts')

    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">

    </script>
    
@endsection
