@extends('layouts.master')

@section('content')
<p>

</p>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Displaying <b> {{$activity->name}} </b>details </h3>

    
    
    <div style="float:right">
      <a href="{{ route('assign.index')}}">
        <button type="button" class="btn btn-primary btn-sm" >Back to assigning activities </button>
      </a>
      <a href="{{ route('assign.edit', $activity->id)}}">
        <button type="button" class="btn btn-success btn-sm">Edit details</button>
      </a>
      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-sm{{$activity->id}}">Delete</button>
      
    </div>
    
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
          <td><b>Collaborators</b></td>
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

      <!-- deleting activity -->
      <div class="modal fade" id="modal-sm{{$activity->id}}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Deleting {{$activity->name}} Activity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <b> {{$activity->name}} </b> activity permanently? </p>
            </div>
            <div class="modal-footer justify-content-between">
                
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <form action="{{ route('assign.destroy', $activity->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Yes</button>
              </form>
            </div>
          </div>
        </div>
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
