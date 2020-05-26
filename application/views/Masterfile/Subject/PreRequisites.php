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

                            <li class="active"><a href="<?php echo base_url();?>file_management/subject_information"><i class="fa fa-bar-chart"></i> Subject Management</a></li>
                            <li><a href="<?php echo base_url();?>file_management/curriculum"><i class="fa fa-pie-chart"></i> Curriculum Management </a></li>

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
                                <img src="<?php echo base_url();?>/assets/admin/img/<?php echo $this->session->user_image;?>" alt=""><?php echo $this->session->user_fn;?> <?php echo $this->session->user_ln;?>
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
            <div class="x_panel">
                <div class="x_title">

                    <h2>Subject Management <small> Pre Requisites</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">

                    <div class="row" style="padding: 10px 0">
                        <?php foreach ($prData as $prRow) { ?>
                            <div class="col-md-3 col-xs-3">
                                <label>Subject Code</label>
                                <input readonly id="subjectcode" name="subjectcode" class="form-control col-md-12 col-xs-12" value="<?php echo $prRow->subjectcode;?>">
                            </div>

                            <div class="col-md-6 col-xs-6">
                                <label>Subject Name</label>
                                <input readonly id="subjectTitle" name="subjectTitle" class="form-control col-md-12 col-xs-12" value="<?php echo $prRow->subjectTitle;?>">
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <div class="form-group">
                                    <a href="#" style="margin-top: 23px;" class="load_modal_details btn btn-success col-md-12 col-xs-12" data-toggle="modal" data-target=".update-pr"  title="update pre requisites">Update Pre-Requisites</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="x_panel" style="padding-top: 20px">
                <div class="card-body">

                    <table id="" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Code </th>
                            <th>Name </th>
                            <th>Description </th>
                            <th>Lecture Units </th>
                            <th>Lab Units </th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        if($prData){
                            foreach ($prData as $rs) {
                                ?>

                                <?php if($rs->pr1=='N/A') { ?>
                                    <tr>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    </tr>
                                <?php } else {
                                    foreach ($siData as $siRow) {
                                        if($siRow->subjectcode==$rs->pr1){ ?>
                                            <tr>
                                                <td><?php echo $siRow->subjectcode; ?></td>
                                                <td><?php echo $siRow->subjectTitle; ?></td>
                                                <td><?php echo $siRow->description; ?></td>
                                                <td><?php echo $siRow->lectUnits; ?></td>
                                                <td><?php echo $siRow->labunits; ?></td>
                                            </tr>
                                <?php } } }?>


                                <?php if($rs->pr2=='N/A') { ?>
                                    <tr>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    </tr>
                                <?php } else {
                                    foreach ($siData as $siRow) {
                                        if($siRow->subjectcode==$rs->pr2){ ?>
                                            <tr>
                                                <td><?php echo $siRow->subjectcode; ?></td>
                                                <td><?php echo $siRow->subjectTitle; ?></td>
                                                <td><?php echo $siRow->description; ?></td>
                                                <td><?php echo $siRow->lectUnits; ?></td>
                                                <td><?php echo $siRow->labunits; ?></td>
                                            </tr>
                                        <?php } } }?>

                                <?php if($rs->pr3=='N/A') { ?>
                                    <tr>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    </tr>
                                <?php } else {
                                    foreach ($siData as $siRow) {
                                        if($siRow->subjectcode==$rs->pr3){ ?>
                                            <tr>
                                                <td><?php echo $siRow->subjectcode; ?></td>
                                                <td><?php echo $siRow->subjectTitle; ?></td>
                                                <td><?php echo $siRow->description; ?></td>
                                                <td><?php echo $siRow->lectUnits; ?></td>
                                                <td><?php echo $siRow->labunits; ?></td>
                                            </tr>
                                        <?php } } }?>


                                <?php if($rs->pr4=='N/A') { ?>
                                    <tr>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    </tr>
                                <?php } else {
                                    foreach ($siData as $siRow) {
                                        if($siRow->subjectcode==$rs->pr4){ ?>
                                            <tr>
                                                <td><?php echo $siRow->subjectcode; ?></td>
                                                <td><?php echo $siRow->subjectTitle; ?></td>
                                                <td><?php echo $siRow->description; ?></td>
                                                <td><?php echo $siRow->lectUnits; ?></td>
                                                <td><?php echo $siRow->labunits; ?></td>
                                            </tr>
                                        <?php } } }?>


                                <?php if($rs->pr5=='N/A') { ?>
                                    <tr>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    </tr>
                                <?php } else {
                                    foreach ($siData as $siRow) {
                                        if($siRow->subjectcode==$rs->pr5){ ?>
                                            <tr>
                                                <td><?php echo $siRow->subjectcode; ?></td>
                                                <td><?php echo $siRow->subjectTitle; ?></td>
                                                <td><?php echo $siRow->description; ?></td>
                                                <td><?php echo $siRow->lectUnits; ?></td>
                                                <td><?php echo $siRow->labunits; ?></td>
                                            </tr>
                                        <?php } } }?>


                                <?php if($rs->pr6=='N/A') { ?>
                                    <tr>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    </tr>
                                <?php } else {
                                    foreach ($siData as $siRow) {
                                        if($siRow->subjectcode==$rs->pr6){ ?>
                                            <tr>
                                                <td><?php echo $siRow->subjectcode; ?></td>
                                                <td><?php echo $siRow->subjectTitle; ?></td>
                                                <td><?php echo $siRow->description; ?></td>
                                                <td><?php echo $siRow->lectUnits; ?></td>
                                                <td><?php echo $siRow->labunits; ?></td>
                                            </tr>
                                        <?php } } }?>


                                <?php if($rs->pr7=='N/A') { ?>
                                    <tr>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    </tr>
                                <?php } else {
                                    foreach ($siData as $siRow) {
                                        if($siRow->subjectcode==$rs->pr7){ ?>
                                            <tr>
                                                <td><?php echo $siRow->subjectcode; ?></td>
                                                <td><?php echo $siRow->subjectTitle; ?></td>
                                                <td><?php echo $siRow->description; ?></td>
                                                <td><?php echo $siRow->lectUnits; ?></td>
                                                <td><?php echo $siRow->labunits; ?></td>
                                            </tr>
                                        <?php } } }?>


                                <?php if($rs->pr8=='N/A') { ?>
                                    <tr>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    </tr>
                                <?php } else {
                                    foreach ($siData as $siRow) {
                                        if($siRow->subjectcode==$rs->pr8){ ?>
                                            <tr>
                                                <td><?php echo $siRow->subjectcode; ?></td>
                                                <td><?php echo $siRow->subjectTitle; ?></td>
                                                <td><?php echo $siRow->description; ?></td>
                                                <td><?php echo $siRow->lectUnits; ?></td>
                                                <td><?php echo $siRow->labunits; ?></td>
                                            </tr>
                                        <?php } } }?>


                                <?php if($rs->pr9=='N/A') { ?>
                                    <tr>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    </tr>
                                <?php } else {
                                    foreach ($siData as $siRow) {
                                        if($siRow->subjectcode==$rs->pr9){ ?>
                                            <tr>
                                                <td><?php echo $siRow->subjectcode; ?></td>
                                                <td><?php echo $siRow->subjectTitle; ?></td>
                                                <td><?php echo $siRow->description; ?></td>
                                                <td><?php echo $siRow->lectUnits; ?></td>
                                                <td><?php echo $siRow->labunits; ?></td>
                                            </tr>
                                        <?php } } }?>


                                <?php if($rs->pr10=='N/A') { ?>
                                    <tr>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    </tr>
                                <?php } else {
                                    foreach ($siData as $siRow) {
                                        if($siRow->subjectcode==$rs->pr10){ ?>
                                            <tr>
                                                <td><?php echo $siRow->subjectcode; ?></td>
                                                <td><?php echo $siRow->subjectTitle; ?></td>
                                                <td><?php echo $siRow->description; ?></td>
                                                <td><?php echo $siRow->lectUnits; ?></td>
                                                <td><?php echo $siRow->labunits; ?></td>
                                            </tr>
                                        <?php } } }?>

                            <?php } }?>
                        </tbody>
                    </table>
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


<!-- SYSTEM MODAL -->

<div class="modal fade update-pr"  role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="load_modal_fields_large">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Pre-Requisites <small>Update Record</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form method="post" id="frm_validation" action="<?php echo base_url();?>file_management/updatePreRequisite" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Subject Code</label>
                                    </div>
                                    <div class="col-md-9">
                                        <label>Subject Name</label>
                                    </div>
                                </div>

                                <?php foreach ($prData as $prRow) { ?>
                                    <input style="display: none" id="subjectcode" name="subjectcode" class="form-control col-md-12 col-xs-12" value="<?php echo $prRow->subjectcode;?>">
                                <?php } ?>

                                <?php foreach ($prData as $rs) { ?>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <input id="pr1" name="pr1" class="form-control col-md-12 col-xs-12" value="<?php echo $rs->pr1;?>">
                                        </div>
                                        <div class="col-md-9">
                                            <?php if($rs->pr1=='N/A') { ?>
                                                <input id="pr1-subjectname" name="pr1-subjectname" class="form-control col-md-12 col-xs-12" value="N/A">
                                            <?php } else { foreach ($siData as $siRow) {  if($siRow->subjectcode==$rs->pr1){ ?>
                                                <input id="pr1-subjectname" name="pr1-subjectname" class="form-control col-md-12 col-xs-12" value="<?php echo $siRow->subjectTitle;?>">
                                            <?php } } } ?>

                                        </div>
                                    </div>

                                    <div class="row" style="padding-top: 10px">
                                        <div class="col-md-3">
                                            <input id="pr2" name="pr2" class="form-control col-md-12 col-xs-12" value="<?php echo $rs->pr2;?>">
                                        </div>
                                        <div class="col-md-9">
                                            <?php if($rs->pr2=='N/A') { ?>
                                                <input id="pr2-subjectname" name="pr2-subjectname" class="form-control col-md-12 col-xs-12" value="N/A">
                                            <?php } else { foreach ($siData as $siRow) {  if($siRow->subjectcode==$rs->pr2){ ?>
                                                <input id="pr2-subjectname" name="pr2-subjectname" class="form-control col-md-12 col-xs-12" value="<?php echo $siRow->subjectTitle;?>">
                                            <?php } } } ?>
                                        </div>
                                    </div>



                                    <div class="row" style="padding-top: 10px">
                                        <div class="col-md-3">
                                            <input id="pr3" name="pr3" class="form-control col-md-12 col-xs-12" value="<?php echo $rs->pr3;?>">
                                        </div>
                                        <div class="col-md-9">
                                            <?php if($rs->pr3=='N/A') { ?>
                                                <input id="pr3-subjectname" name="pr3-subjectname" class="form-control col-md-12 col-xs-12" value="N/A">
                                            <?php } else { foreach ($siData as $siRow) {  if($siRow->subjectcode==$rs->pr3){ ?>
                                                <input id="pr3-subjectname" name="pr3-subjectname" class="form-control col-md-12 col-xs-12" value="<?php echo $siRow->subjectTitle;?>">
                                            <?php } } } ?>

                                        </div>
                                    </div>

                                    <div class="row" style="padding-top: 10px">
                                        <div class="col-md-3">
                                            <input id="pr4" name="pr4" class="form-control col-md-12 col-xs-12" value="<?php echo $rs->pr4;?>">
                                        </div>
                                        <div class="col-md-9">
                                            <?php if($rs->pr4=='N/A') { ?>
                                                <input id="pr4-subjectname" name="pr4-subjectname" class="form-control col-md-12 col-xs-12" value="N/A">
                                            <?php } else { foreach ($siData as $siRow) {  if($siRow->subjectcode==$rs->pr4){ ?>
                                                <input id="pr4-subjectname" name="pr4-subjectname" class="form-control col-md-12 col-xs-12" value="<?php echo $siRow->subjectTitle;?>">
                                            <?php } } } ?>

                                        </div>
                                    </div>

                                    <div class="row" style="padding-top: 10px">
                                        <div class="col-md-3">
                                            <input id="pr5" name="pr5" class="form-control col-md-12 col-xs-12" value="<?php echo $rs->pr5;?>">
                                        </div>
                                        <div class="col-md-9">
                                            <?php if($rs->pr5=='N/A') { ?>
                                                <input id="pr5-subjectname" name="pr5-subjectname" class="form-control col-md-12 col-xs-12" value="N/A">
                                            <?php } else { foreach ($siData as $siRow) {  if($siRow->subjectcode==$rs->pr5){ ?>
                                                <input id="pr5-subjectname" name="pr5-subjectname" class="form-control col-md-12 col-xs-12" value="<?php echo $siRow->subjectTitle;?>">
                                            <?php } } } ?>

                                        </div>
                                    </div>

                                    <div class="row" style="padding-top: 10px">
                                        <div class="col-md-3">
                                            <input id="pr6" name="pr6" class="form-control col-md-12 col-xs-12" value="<?php echo $rs->pr6;?>">
                                        </div>
                                        <div class="col-md-9">
                                            <?php if($rs->pr6=='N/A') { ?>
                                                <input id="pr6-subjectname" name="pr6-subjectname" class="form-control col-md-12 col-xs-12" value="N/A">
                                            <?php } else { foreach ($siData as $siRow) {  if($siRow->subjectcode==$rs->pr6){ ?>
                                                <input id="pr6-subjectname" name="pr6-subjectname" class="form-control col-md-12 col-xs-12" value="<?php echo $siRow->subjectTitle;?>">
                                            <?php } } } ?>

                                        </div>
                                    </div>

                                    <div class="row" style="padding-top: 10px">
                                        <div class="col-md-3">
                                            <input id="pr7" name="pr7" class="form-control col-md-12 col-xs-12" value="<?php echo $rs->pr7;?>">
                                        </div>
                                        <div class="col-md-9">
                                            <?php if($rs->pr7=='N/A') { ?>
                                                <input id="pr7-subjectname" name="pr7-subjectname" class="form-control col-md-12 col-xs-12" value="N/A">
                                            <?php } else { foreach ($siData as $siRow) {  if($siRow->subjectcode==$rs->pr7){ ?>
                                                <input id="pr7-subjectname" name="pr7-subjectname" class="form-control col-md-12 col-xs-12" value="<?php echo $siRow->subjectTitle;?>">
                                            <?php } } } ?>

                                        </div>
                                    </div>

                                    <div class="row" style="padding-top: 10px">
                                        <div class="col-md-3">
                                            <input id="pr8" name="pr8" class="form-control col-md-12 col-xs-12" value="<?php echo $rs->pr8;?>">
                                        </div>
                                        <div class="col-md-9">
                                            <?php if($rs->pr8=='N/A') { ?>
                                                <input id="pr8-subjectname" name="pr8-subjectname" class="form-control col-md-12 col-xs-12" value="N/A">
                                            <?php } else { foreach ($siData as $siRow) {  if($siRow->subjectcode==$rs->pr8){ ?>
                                                <input id="pr8-subjectname" name="pr8-subjectname" class="form-control col-md-12 col-xs-12" value="<?php echo $siRow->subjectTitle;?>">
                                            <?php } } } ?>

                                        </div>
                                    </div>

                                    <div class="row" style="padding-top: 10px">
                                        <div class="col-md-3">
                                            <input id="pr9" name="pr9" class="form-control col-md-12 col-xs-12" value="<?php echo $rs->pr9;?>">
                                        </div>
                                        <div class="col-md-9">
                                            <?php if($rs->pr9=='N/A') { ?>
                                                <input id="pr9-subjectname" name="pr9-subjectname" class="form-control col-md-12 col-xs-12" value="N/A">
                                            <?php } else { foreach ($siData as $siRow) {  if($siRow->subjectcode==$rs->pr9){ ?>
                                                <input id="pr9-subjectname" name="pr9-subjectname" class="form-control col-md-12 col-xs-12" value="<?php echo $siRow->subjectTitle;?>">
                                            <?php } } } ?>

                                        </div>
                                    </div>

                                    <div class="row" style="padding-top: 10px">
                                        <div class="col-md-3">
                                            <input id="pr10" name="pr10" class="form-control col-md-12 col-xs-12" value="<?php echo $rs->pr10;?>">
                                        </div>
                                        <div class="col-md-9">
                                            <?php if($rs->pr10=='N/A') { ?>
                                                <input id="pr10-subjectname" name="pr10-subjectname" class="form-control col-md-12 col-xs-12" value="N/A">
                                            <?php } else { foreach ($siData as $siRow) {  if($siRow->subjectcode==$rs->pr10){ ?>
                                                <input id="pr10-subjectname" name="pr10-subjectname" class="form-control col-md-12 col-xs-12" value="<?php echo $siRow->subjectTitle;?>">
                                            <?php } } } ?>

                                        </div>
                                    </div>


                                <?php } ?>


                                <div class="row" style="padding-top: 10px">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success col-md-12 col-xs-12">Save Subject Pre-requisites</button>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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

    $(document).on('input', '#pr1', function() {
        var preID = $(this).attr('id');
        var subjectcode = document.getElementById(preID).value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>file_management/getSubName",
            data: { 'subjectcode': subjectcode  },
            success: function(data){
                console.log(data);
                var opts = $.parseJSON(data);
                if(opts.length > 0){
                    $.each(opts, function(i, d) {
                        $("#pr1-subjectname").prop({"value":d.subjectTitle});
                    });
                } else {
                    $("#pr1-subjectname").prop({"value":"N/A"});
                }
            }
        });
    });

    $(document).on('input', '#pr2', function() {
        var preID = $(this).attr('id');
        var subjectcode = document.getElementById(preID).value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>file_management/getSubName",
            data: { 'subjectcode': subjectcode  },
            success: function(data){
                console.log(data);
                var opts = $.parseJSON(data);
                if(opts.length > 0){
                    $.each(opts, function(i, d) {
                        $("#pr2-subjectname").prop({"value":d.subjectTitle});
                    });
                } else {
                    $("#pr2-subjectname").prop({"value":"N/A"});
                }
            }
        });
    });

    $(document).on('input', '#pr3', function() {
        var preID = $(this).attr('id');
        var subjectcode = document.getElementById(preID).value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>file_management/getSubName",
            data: { 'subjectcode': subjectcode  },
            success: function(data){
                console.log(data);
                var opts = $.parseJSON(data);
                if(opts.length > 0){
                    $.each(opts, function(i, d) {
                        $("#pr3-subjectname").prop({"value":d.subjectTitle});
                    });
                } else {
                    $("#pr3-subjectname").prop({"value":"N/A"});
                }
            }
        });
    });

    $(document).on('input', '#pr4', function() {
        var preID = $(this).attr('id');
        var subjectcode = document.getElementById(preID).value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>file_management/getSubName",
            data: { 'subjectcode': subjectcode  },
            success: function(data){
                console.log(data);
                var opts = $.parseJSON(data);
                if(opts.length > 0){
                    $.each(opts, function(i, d) {
                        $("#pr4-subjectname").prop({"value":d.subjectTitle});
                    });
                } else {
                    $("#pr4-subjectname").prop({"value":"N/A"});
                }
            }
        });
    });

    $(document).on('input', '#pr5', function() {
        var preID = $(this).attr('id');
        var subjectcode = document.getElementById(preID).value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>file_management/getSubName",
            data: { 'subjectcode': subjectcode  },
            success: function(data){
                console.log(data);
                var opts = $.parseJSON(data);
                if(opts.length > 0){
                    $.each(opts, function(i, d) {
                        $("#pr5-subjectname").prop({"value":d.subjectTitle});
                    });
                } else {
                    $("#pr5-subjectname").prop({"value":"N/A"});
                }
            }
        });
    });

    $(document).on('input', '#pr6', function() {
        var preID = $(this).attr('id');
        var subjectcode = document.getElementById(preID).value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>file_management/getSubName",
            data: { 'subjectcode': subjectcode  },
            success: function(data){
                console.log(data);
                var opts = $.parseJSON(data);
                if(opts.length > 0){
                    $.each(opts, function(i, d) {
                        $("#pr6-subjectname").prop({"value":d.subjectTitle});
                    });
                } else {
                    $("#pr6-subjectname").prop({"value":"N/A"});
                }
            }
        });
    });

    $(document).on('input', '#pr7', function() {
        var preID = $(this).attr('id');
        var subjectcode = document.getElementById(preID).value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>file_management/getSubName",
            data: { 'subjectcode': subjectcode  },
            success: function(data){
                console.log(data);
                var opts = $.parseJSON(data);
                if(opts.length > 0){
                    $.each(opts, function(i, d) {
                        $("#pr7-subjectname").prop({"value":d.subjectTitle});
                    });
                } else {
                    $("#pr7-subjectname").prop({"value":"N/A"});
                }
            }
        });
    });

    $(document).on('input', '#pr8', function() {
        var preID = $(this).attr('id');
        var subjectcode = document.getElementById(preID).value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>file_management/getSubName",
            data: { 'subjectcode': subjectcode  },
            success: function(data){
                console.log(data);
                var opts = $.parseJSON(data);
                if(opts.length > 0){
                    $.each(opts, function(i, d) {
                        $("#pr8-subjectname").prop({"value":d.subjectTitle});
                    });
                } else {
                    $("#pr8-subjectname").prop({"value":"N/A"});
                }
            }
        });
    });

    $(document).on('input', '#pr9', function() {
        var preID = $(this).attr('id');
        var subjectcode = document.getElementById(preID).value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>file_management/getSubName",
            data: { 'subjectcode': subjectcode  },
            success: function(data){
                console.log(data);
                var opts = $.parseJSON(data);
                if(opts.length > 0){
                    $.each(opts, function(i, d) {
                        $("#pr9-subjectname").prop({"value":d.subjectTitle});
                    });
                } else {
                    $("#pr9-subjectname").prop({"value":"N/A"});
                }
            }
        });
    });

    $(document).on('input', '#pr10', function() {
        var preID = $(this).attr('id');
        var subjectcode = document.getElementById(preID).value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>file_management/getSubName",
            data: { 'subjectcode': subjectcode  },
            success: function(data){
                console.log(data);
                var opts = $.parseJSON(data);
                if(opts.length > 0){
                    $.each(opts, function(i, d) {
                        $("#pr10-subjectname").prop({"value":d.subjectTitle});
                    });
                } else {
                    $("#pr10-subjectname").prop({"value":"N/A"});
                }
            }
        });
    });


</script>



</body>
</html>