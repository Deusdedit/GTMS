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
         <center><h2><b>ACTIVITY REPORT</b></h2></center>
        <table width="100%" border='1' style="width:100%; border-collapse:collapse" >
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Activity Name</th>
                    <th>Details</th>
                    <th>Start date </th>
                    <th>End Date</th>
                    <th>Status</th>
                    
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
                <td>{{$activity->start_date}}</td>
                <td>{{$activity->end_date}}</td>
                <td>{{$activity->status}}</td>                  
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


