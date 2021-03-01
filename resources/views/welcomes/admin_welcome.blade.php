@extends('layouts.master')

@section('content')

<br>
<section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-check"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Completed Tasks</span>
                                <span class="info-box-number">{{$fintask}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-spinner"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Ongoing Tasks</span>
                        <span class="info-box-number">{{$ongotask}}</span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-tasks"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Assigned Task</span>
                        <span class="info-box-number">++</span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        
         </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->


  


@stop