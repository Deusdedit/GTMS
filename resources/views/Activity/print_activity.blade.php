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
        <center><h1><b>ACTIVITY MANAGEMENT SYSTEM</b></h1></center>
         <center><h2><b>ACTIVITY REPORT</b></h2></center>
         <br>
         <table width="100%" border='0' style="width:100%; border-collapse:collapse;font-size:11;" >
            <tr>
                <td><b>Name: </b> <u>{{$usern->first_name}} {{$usern->middle_name}} {{$usern->last_name}}</u></td>
                <td><b>Depertment: </b> <u>{{$depertment->name}} </u></td>
                <td><b>Section: </b> <u>{{$section->name}}</u></td>
            </tr>
         </table>
        <br>
        <table width="100%" border='1' style="width:100%; border-collapse:collapse;font-size:11;" >
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Activity Name</th>
                    <th>Details</th>
                    <th>Resources</th>
                    <th>Colaborators</th>
                    <th>Output</th>
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
            @if($activity->user_id == $logged_id ) 
            <tr>
                <td align="center"> 
                     {{++$i}}
                </td>
                <td>{{$activity->name}}</td>
                <td>{{$activity->details}}</td>
                <td>{{$activity->resources}}</td>
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


