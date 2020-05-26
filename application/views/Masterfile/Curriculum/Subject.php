<?php if (!isset($_SESSION['student_id'])) {
    redirect('student', 'refresh');
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/x-icon">

    <title>Cavite State University CCC</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/plugins/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>assets/plugins/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url();?>assets/plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url();?>assets/plugins/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- alertify -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/alertify/css/alertify.core.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/alertify/css/alertify.bootstrap.css" id="toggleCSS" />

    <!-- Datatables -->
    <link href="<?php echo base_url();?>assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Switchery -->
    <link href="<?php echo base_url();?>assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet">

    <!-- select2 -->
    <link href="<?php echo base_url();?>assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/plugins/multi_select/multi_select.css" rel="stylesheet" type="text/css" />

    <!-- loading Progress -->
    <link href="<?php echo base_url();?>assets/plugins/loading_progress/loading_progress.css" rel="stylesheet" type="text/css" />

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/plugins/build/css/custom.css" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/calendar/fullcalendar.min.css">
    <link rel="stylesheet" media='print' href="<?php echo base_url();?>/assets/plugins/calendar/fullcalendar.print.css">


</head>


<body class="nav-md">

<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" >
                    <a href="#" class="site_title"><span style="font-size: 25px; color:green; ">CvSU</span> <span style="font-size: 15px">Cavite City Campus</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="<?php echo base_url();?>/assets/images/<?php echo $this->session->student_image;?>" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <h2 style="font-weight: 600"><?php echo $this->session->student_fn;?> <?php echo $this->session->student_ln;?></h2>
                        <h2><?php echo $this->session->student_course;?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Navigation</h3>
                        <ul class="nav side-menu">

                            <li><a href="<?php echo base_url();?>file_management/subject_information"><i class="fa fa-bar-chart"></i> Subject Management</a></li>
                            <li class="active"><a href="<?php echo base_url();?>file_management/curriculum"><i class="fa fa-pie-chart"></i> Curriculum Management </a></li>

                        </ul>

                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">

                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>


        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo base_url();?>assets/admin/img/<?php echo $this->session->user_image;?>" alt=""><?php echo $this->session->user_fn;?> <?php echo $this->session->user_ln;?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="<?php echo base_url();?>"><i class="fa fa-cogs pull-right"></i> Account Settings</a></li>
                                <li><a href="<?php echo base_url();?>student/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>


                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">

            <div id="notif_fade" class="col-md-12 col-sm-12 col-xs-12">
                <?php if(isset($_SESSION["error"])){echo '<div class="clearfix"></div><div class="alert alert-danger">'.$_SESSION["error"].'</div>';}?>
                <?php if(isset($_SESSION["success"])){echo '<div class="clearfix"></div><div class="alert alert-success">'.$_SESSION["success"].'</div>';}?>
                <?php echo validation_errors('<div class="clearfix"></div><div class="alert alert-danger">','</div>');?>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2>Curriculum Checklist <small><?php echo $schoolyear;?> Curriculum</small> <small><?php echo $course;?> <?php if($major!='N/A'){echo ' ( '.$major.' )';}?></small> </h2>
                    <ul class="nav navbar-right panel_toolbox">

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <form method="post" id="frm_validation" action="<?php echo base_url();?>file_management/add_subject" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <input style="display:none" id="schoolyear" name="schoolyear" class="form-control col-md-7 col-xs-12" value="<?php echo $schoolyear;?>">
                        <input style="display:none" id="course" name="course" class="form-control col-md-7 col-xs-12" value="<?php echo $code;?>">
                        <input style="display:none" id="coursemajor" name="coursemajor" class="form-control col-md-7 col-xs-12" value="<?php echo $major;?>">
                        <input style="display:none" id="curriculumnid" name="curriculumnid" class="form-control col-md-7 col-xs-12" value="<?php echo $cID;?>">
                        <div class="row" style="margin: 20px 0 20px -10px">
                            <div class="col-md-3">
                                <label>Student Year</label>
                                <select id="yearlevel" name="yearlevel" class="form-control col-md-7 col-xs-12">
                                    <option value="1">First Year</option>
                                    <option value="2">Second Year</option>
                                    <option value="3">Third Year</option>
                                    <option value="4">Fourth Year</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Semester</label>
                                <select id="semester" name="semester" class="form-control col-md-7 col-xs-12">
                                    <option value="FIRST">First Semester</option>
                                    <option value="SECOND">Second Semester</option>
                                    <option value="SUMMER">Summer</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-7">
                                    <label>Subject</label>
                                    <input id="subjectcode" name="subjectcode" class="form-control col-md-12 col-xs-12">
                                </div>
                                <div class="col-md-5" style="margin-top: 30px;">
                                    <input type="checkbox" name="major" id="major" value="1" class="flat col-md-12 col-xs-12" /> Major Subject
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button style="margin-top: 23px;" type="submit" class="btn btn-success col-md-12 col-xs-12">Add subject</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="x_panel" style="padding-top: 20px">
                <div class="card-body">

                    <?php foreach ($ysData as $ysRow) {?>
                        <h2><?php if($ysRow->yearlevel==1){echo 'First';}elseif($ysRow->yearlevel==2){echo 'Second';}elseif($ysRow->yearlevel==3){echo 'Third';}else{echo 'Fourth';}?> Year <small><?php echo $ysRow->semester;?> SEMESTER</small></h2>
                        <table id="" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Subject Code </th>
                                <th>Subject Name </th>
                                <th>Lecture Units </th>
                                <th>Lab Units </th>
                                <th>Pre-requisites </th>
                                <th>Option</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            if($sData){
                                foreach ($sData as $rs) { if(($rs->yearlevel==$ysRow->yearlevel)&&($rs->semester==$ysRow->semester)){
                                    ?>
                                    <tr>
                                        <td><?php echo $rs->subjectcode;?></td>
                                        <td><?php echo $rs->subjectTitle;?></td>
                                        <td><?php echo $rs->lectUnits;?></td>
                                        <td><?php echo $rs->labunits;?></td>
                                        <td>
                                            <?php
                                            if($rs->pr1!='N/A'){echo $rs->pr1;};
                                            if($rs->pr2!='N/A'){echo ' / '.$rs->pr2;};
                                            if($rs->pr3!='N/A'){echo ' / '.$rs->pr3;};
                                            if($rs->pr4!='N/A'){echo ' / '.$rs->pr4;};
                                            if($rs->pr5!='N/A'){echo ' / '.$rs->pr5;};
                                            if($rs->pr6!='N/A'){echo ' / '.$rs->pr6;};
                                            if($rs->pr7!='N/A'){echo ' / '.$rs->pr7;};
                                            if($rs->pr8!='N/A'){echo ' / '.$rs->pr8;};
                                            if($rs->pr9!='N/A'){echo ' / '.$rs->pr9;};
                                            if($rs->pr10!='N/A'){echo ' / '.$rs->pr10;};
                                            ?>
                                        </td>
                                        <th>
                                            <a href="" ><i class="fa fa-trash"></i> remove </a>
                                        </th>

                                    </tr>
                                <?php } } }?>
                            </tbody>
                        </table>
                    <?php } ?>



                </div>
            </div>

        </div>


        <!-- footer content -->
        <footer>
            <div class="pull-right">
                STUDENT PORTAL - CAVITE STATE UNIVERSITY CAVITE CITY CAMPUS
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->


    </div>
</div>




<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo base_url();?>assets/plugins/nprogress/nprogress.js"></script>


<!-- bootstrap-progressbar -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>


<!-- Chart.js -->
<script src="<?php echo base_url();?>assets/plugins/Chart.js/dist/Chart.min.js"></script>
<!-- Flot -->
<script src="<?php echo base_url();?>assets/plugins/Flot/jquery.flot.js"></script>
<script src="<?php echo base_url();?>assets/plugins/Flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url();?>assets/plugins/Flot/jquery.flot.time.js"></script>
<script src="<?php echo base_url();?>assets/plugins/Flot/jquery.flot.stack.js"></script>
<script src="<?php echo base_url();?>assets/plugins/Flot/jquery.flot.resize.js"></script>

<!-- DateJS -->
<script src="<?php echo base_url();?>assets/plugins/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url();?>assets/plugins/jqvmap/dist/jquery.vmap.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo base_url();?>assets/plugins/moment/min/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Alertify -->
<script src="<?php echo base_url();?>assets/plugins/alertify/js/alertify.js"></script>

<!-- Datatables -->
<script src="<?php echo base_url();?>assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables.net-scroller/js/dataTables.scroller.min.js"></script>


<script src="<?php echo base_url();?>assets1/plugins/autocomplete/jquery.autocomplete.min.js" type="ca1d3ec21eff1817fac33fb5-text/javascript"></script>

<!-- Switchery -->
<script src="<?php echo base_url();?>assets/plugins/switchery/dist/switchery.min.js"></script>

<!-- select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/select2.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/multi_select/multi_select.js" type="text/javascript"></script>


<link href="<?php echo base_url();?>assets/plugins/autocomplete/jquery-ui.css" rel="stylesheet">
<script src="<?php echo base_url();?>assets/plugins/autocomplete/jquery-ui.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo base_url();?>assets/plugins/build/js/custom.js"></script>

<script type="text/javascript">


    $( document ).ready(function() {
        $("#notif_fade").fadeOut(5000);


    });



</script>

<script>
    $( function() {
        var availableTags = [

            <?php foreach ($scData as $scRow) { echo '"'. $scRow->subjectcode .'", ';}?>
        ];
        $( "#subjectcode" ).autocomplete({
            source: availableTags
        });
    } );
</script>




</body>
</html>