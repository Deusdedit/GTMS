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
        <center><h2><b>ACTIVITY MANAGEMENT SYSTEM</b></h2>
        <h3><u>ACTIVITY REPORT FROM {{Carbon\Carbon::parse($weekStartDate )->toFormattedDateString()}} TO {{Carbon\Carbon::parse($weekEndDate )->toFormattedDateString()}} PRINTED {{Carbon\Carbon::parse($today )->toFormattedDateString()}}.</u></h3></center>
        
        <table width="100%" border='0' style="width:100%; border-collapse:collapse;font-size:11;" >
            <tr>
                <td> 
                    Department: 
                    @foreach($departments as $department)
                        @if($department->id == $section->department_id)
                            <u>{{$department->name}}</u>
                        @endif
                    @endforeach
                </td>
                <td> 
                    Section: 
                    <u>{{$section->name}}</u>
                </td>
            </tr>
        </table>

        <center><h3><b> ASSIGNED ACTIVITIES</b></h3></center>
        <table width="100%" border='1' style="width:100%; border-collapse:collapse;font-size:11;" >
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Employee name</th>
                    <th>Activity Name</th>
                    <th>Activity From</th>
                    <th>Details</th>
                    <th>Resources</th>
                    <th>Client</th>
                    <th>Colaborators</th>
                    <th>Expected Output</th>
                    <th>Assigned date</th>
                    <th>Duration</th>
                    <th>Start date </th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Recommendation</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=0;
                @endphp
                @foreach($activitiesTo as $activity)
                    <tr>
                        <td align="center"> 
                            {{++$i}}
                        </td>
                        <td>
                            @foreach($users as $user)
                                @if($user->id == $activity->user_id)
                                    {{$user->first_name}} {{$user->last_name}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$activity->name}}</td>
                        <td>
                            @foreach($users as $userr)
                                @if($userr->id == $activity->activity_from_user_id)
                                    {{$userr->first_name}} {{$userr->last_name}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$activity->details}}</td>
                        <td>{{$activity->resources}}</td>
                        <td>{{$activity->client}}</td>
                        <td>{{$activity->colaborators}}</td>
                        <td>{{$activity->output}}</td>
                        <td>{{$activity->assigned_date}}</td>
                        <td>{{$activity->duration}}</td>
                        <td>{{$activity->start_date}}</td>
                        <td>
                            @if($activity->end_date != Null )
                                {{$activity->end_date}}
                            @else
                            <center> 
                                <i class="fas fa-spinner" style="color:green;"> -- </i>
                            </center>
                            
                            @endif
                        </td>
                        <td>{{$activity->status}}</td>
                        <td>
                            @if($activity->recommendations != Null )
                                {{$activity->recommendations}}
                            @else
                            <center> 
                                <i class="fas fa-spinner" style="color:green;"> -- </i>
                            </center>
                            
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>
            
        <center><h3><b> PERSONAL ASSIGNED ACTIVITIES</b></h3></center>
        <table width="100%" border='1' style="width:100%; border-collapse:collapse;font-size:11;" >
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Employee Name</th>
                    <th>Activity Name</th>
                    <th>Details</th>
                    <th>Resources</th>
                    <th>Client</th>
                    <th>Colaborators</th>
                    <th>Expected Output</th>
                    <th>Start date </th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Recommendation</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=0;
                @endphp
                @foreach($activities as $activity)
                    <tr>
                        <td align="center"> 
                            {{++$i}}
                        </td>
                        <td>
                            @foreach($users as $user)
                                @if($user->id == $activity->user_id)
                                    {{$user->first_name}} {{$user->last_name}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$activity->name}}</td>
                        <td>{{$activity->details}}</td>
                        <td>{{$activity->resources}}</td>
                        <td>{{$activity->client}}</td>
                        <td>{{$activity->colaborators}}</td>
                        <td>{{$activity->output}}</td>
                        <td>{{$activity->start_date}}</td>
                        <td>
                            @if($activity->end_date != Null )
                                {{$activity->end_date}}
                            @else
                            <center> 
                                <i class="fas fa-spinner" style="color:green;"> -- </i>
                            </center>
                            
                            @endif
                        </td>
                        <td>{{$activity->status}}</td>
                        <td>
                            @if($activity->recommendations != Null )
                                {{$activity->recommendations}}
                            @else
                            <center> 
                                <i class="fas fa-spinner" style="color:green;"> -- </i>
                            </center>
                            
                            @endif
                        </td>
                    </tr>
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


