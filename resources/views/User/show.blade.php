@extends('layouts.master')

@section('content')
<p>

</p>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Displaying {{$user->first_name}} {{$user->last_name}} informations </h3>
                <a href="{{ route('user.index')}}">
                    <button type="button" class="btn btn-primary btn-sm" style="float:right">Back to all users </button>
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
                      <td><b>First name</b></td>
                      <td>{{$user->first_name}}</td>
                    </tr>
                    <tr>
                      <td><b>Middle name </b></td>
                      <td>{{$user->middle_name}}</td>
                    </tr>
                    <tr>
                      <td><b>Last Name </b></td>
                      <td>{{$user->last_name}}</td>
                    </tr>
                    <tr>
                      <td><b>Email</b></td>
                      <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                      <td><b>Status</b></td>
                        @if( ($user->status) == 0 )
                          <td style="color:green">
                            User is active
                          </td>
                        @else
                          <td style="color:red">
                            User was disabled
                          </td>
                        @endif
                    </tr>
                  
                    @foreach($roles as $role)
                        @if(($role->id) == ($user->role_id) )
                            <tr>
                                <td><b>User Role</b></td>
                                <td>{{$role->name}} ({{$role->name_abbreviation}})</td>
                            </tr>
                        @endif
                    @endforeach
                    
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
