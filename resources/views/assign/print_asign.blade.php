<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body style="font-size:10;">    
        <img  style="width:100%;" src="{{ public_path('assets/img/barner.png')}}"></img>
         <br>
        <!--  <br> -->
        <center><h1><b>TASK MANAGEMENT SYSTEM</b></h1></center>
         <center><h2><b>ASSIGNED ACTIVITY REPORT</b></h2></center>
         <table width="100%" border='1' style="width:100%; border-collapse:collapse;font-size:11;">
        <thead>
        <tr>
        <th>Assigned to </th>
        <th>Activity Name</th>
        <th>Assigned Date</th>
        <th>Date assigned to start </th>
        <th>Days</th>
        <th>Start Date </th>
        <th>Status </th>
        <th>End Date </th>
        </tr>
        </thead>
        <tbody>
        @foreach($activities as $activity)
        @if($activity->activity_from_user_id == $logged_id )
            <tr>
                <td>
                    
                        @foreach($users as $user)
                            @if($user->id == $activity->user_id)
                                @foreach($sections as $section)
                                    @if($section->id == $user->section_id)
                                        @foreach($departments as $department)
                                            @if($department->id == $section->department_id)
                                                {{$user->first_name}}  {{$user->last_name}} (<i>{{$section->name}}).</i>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    
                </td>
                <td>
                    {{$activity->name}} 
                    
                </td>   
                <td>{{$activity->assigned_date}}</td>
                <td>{{ Carbon\Carbon::parse($activity->start_assign_date) ->format('d-m-Y') }}</td>
                <td>{{$activity->duration}}</td>
                <td>
                    @if($activity->start_date != Null )
                            {{$activity->start_date}}
                        @else
                        <center>
                            <i class="fas fa-minus-circle" style="color:green;"></i>
                        </center>
                        
                        @endif
                </td>
                <td>
                    {{$activity->status}} 
                    
                </td>
                <td>
                    @if($activity->end_date != Null )
                        {{$activity->end_date}}
                    @else
                    <center>
                        <i class="fas fa-spinner" style="color:green;"></i>
                    </center>
                    
                    @endif                            
            </tr>

        @endif
        @endforeach
        </tbody>
    </table>
        <!-- <footer style="background-color:#F5B041;">
            <strong>Copyright &copy; 2021 <a href="https://www.gst.go.tz/">GST</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
            </div>
        </footer> -->
    </body>
</html>


