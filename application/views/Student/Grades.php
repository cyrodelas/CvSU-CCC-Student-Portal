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
                        <h2 style="font-weight: 600"><?php echo $this->session->student_fn;?> <?php echo $this->session->student_ln;?></h2 style="font-weight: 600">
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
                            <li><a href="<?php echo base_url();?>student/dashboard"><i class="fa fa-dashboard"></i> Dashboard </a></li>
                            <li><a href="<?php echo base_url();?>student/information"><i class="fa fa-user"></i> Student Information </a></li>
                            <li><a href="<?php echo base_url();?>student/subject"><i class="fa fa-folder"></i> Enrolled Subjects </a></li>
                            <li><a href="<?php echo base_url();?>student/"><i class="fa fa-line-chart"></i> Class Schedule </a></li>
                            <li><a href="<?php echo base_url();?>student/grades"><i class="fa fa-bar-chart"></i> Student Grades </a></li>
                            <li><a><i class="fa fa-tasks"></i> Enrollment <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="<?php echo base_url();?>student/evaluation">Evaluation</a>
                                    </li>
                                    <li><a href="<?php echo base_url();?>student/assessment">Assessment</a>
                                    </li>
                                    <li><a href="<?php echo base_url();?>student/payment">Payment</a>
                                    </li>
                                    <li><a href="<?php echo base_url();?>student/regform">Registration Form</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
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

            <div id="notif_fade" class="col-md-12 col-sm-12 col-xs-12">
                <?php if(isset($_SESSION["error"])){echo '<div class="clearfix"></div><div class="alert alert-danger">'.$_SESSION["error"].'</div>';}?>
                <?php if(isset($_SESSION["success"])){echo '<div class="clearfix"></div><div class="alert alert-success">'.$_SESSION["success"].'</div>';}?>
                <?php echo validation_errors('<div class="clearfix"></div><div class="alert alert-danger">','</div>');?>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Student Grades<small>  </small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="card-body">
                            <form method="post" id="frm_validation" action="<?php echo base_url();?>student/view_grades" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-2 col-2">
                                        <div class="form-group">
                                            <label >Schoolyear </label>
                                            <select id="schoolyear" name="schoolyear" class="form-control" onchange="myFunction(this)">
                                                <option hidden>--------------</option>
                                                <?php foreach ($syData as $syRow) { ?>
                                                    <option><?php echo $syRow->schoolyear; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-3">
                                        <div class="form-group">
                                            <label >Semester</label>
                                            <select id="semester" name="semester" class="form-control">
                                                <option hidden>--------------</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-3">
                                        <div class="form-group">
                                            <button style="margin-top: 23px;" type="submit" class="btn btn-success">Display Grades</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="card">

                                <div class="col-md-12" style="padding: 20px 0 10px">
                                    <div class="col-md-2">
                                        <label>Student Number</label>
                                        <p><?php echo $this->session->student_id;?></p>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Student Name</label>
                                        <p><?php echo $this->session->student_fn;?> <?php if($this->session->student_mn!='N/A'){ echo $this->session->student_mn;}?> <?php echo $this->session->student_ln;?></p>
                                    </div>

                                    <div class="col-md-3">
                                        <label>School Year</label>
                                        <p><?php echo $SY;?></p>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Semester</label>
                                        <p><?php echo $Sem;?> Semester</p>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table id="gradetable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>SchedCode</th>
                                            <th>CourseCode</th>
                                            <th>Units</th>
                                            <th>Grade</th>
                                            <th>CreditUnits</th>
                                            <th>Remarks</th>
                                        </tr>
                                        </thead>
                                        <tbody id="gradetablebody">
                                        <?php
                                        $row=0;
                                        if($gradesData){
                                            foreach ($gradesData as $rs) {
                                                $row+=1;
                                                ?>
                                                <tr>
                                                    <td><?php echo $rs->schedcode;?></td>
                                                    <td><?php echo $rs->subjectcode;?></td>
                                                    <td><?php echo $rs->units;?></td>
                                                    <td><?php echo $rs->mygrade;?></td>
                                                    <td>
                                                        <?php
                                                        switch($rs->mygrade){
                                                            case '1.00':{echo $rs->units;}break;
                                                            case '1.25':{echo $rs->units;}break;
                                                            case '1.50':{echo $rs->units;}break;
                                                            case '1.75':{echo $rs->units;}break;
                                                            case '2.00':{echo $rs->units;}break;
                                                            case '2.25':{echo $rs->units;}break;
                                                            case '2.50':{echo $rs->units;}break;
                                                            case '2.75':{echo $rs->units;}break;
                                                            case '3.00':{echo $rs->units;}break;
                                                            case '4.00':{echo '0.00';}break;
                                                            case '5.00':{echo '0.00';}break;
                                                            case '6.00':{echo '0.00';}break;
                                                            case '8.00':{echo '0.00';}break;
                                                            case 'DRP':{echo '0.00';}break;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            switch($rs->mygrade){
                                                                case '1.00':{echo 'PASSED';}break;
                                                                case '1.25':{echo 'PASSED';}break;
                                                                case '1.50':{echo 'PASSED';}break;
                                                                case '1.75':{echo 'PASSED';}break;
                                                                case '2.00':{echo 'PASSED';}break;
                                                                case '2.25':{echo 'PASSED';}break;
                                                                case '2.50':{echo 'PASSED';}break;
                                                                case '2.75':{echo 'PASSED';}break;
                                                                case '3.00':{echo 'PASSED';}break;
                                                                case '4.00':{echo 'Incomplete';}break;
                                                                case '5.00':{echo 'FAILED';}break;
                                                                case '6.00':{echo 'DROPPED';}break;
                                                                case '8.00':{echo 'WITHHELD';}break;
                                                                case 'DRP':{echo 'DROPPED';}break;
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                        <?php }}?>
                                        </tbody>

                                    </table>
                                    <?php if($row!=0){ ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success pull-right">Print Student Grades</button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>
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


<!-- Custom Theme Scripts -->
<script src="<?php echo base_url();?>assets/plugins/build/js/custom.js"></script>

<script type="text/javascript">

    $( document ).ready(function() {
        $("#notif_fade").fadeOut(5000);
    });


    function myFunction(obj)
    {
        $('#semester').empty()

        var dropDown = document.getElementById("schoolyear");
        var schoolyear = dropDown.options[dropDown.selectedIndex].value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>student/getSemester",
            data: { 'schoolyear': schoolyear  },

            success: function(data){
                console.log(data);
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {
                    $('#semester').append('<option value='+ d.semester +'>' + d.semester + ' SEMESTER</option>');
                });
            }
        });
    }

</script>



</body>
</html>