<?php
if (!isset($_SESSION['student_id'])) {
    redirect('student', 'refresh');
}

if($this->session->defaultPass==1){
    redirect('student/password', 'refresh');
}

?>

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

    <!-- P-Notify -->
    <link href="<?php echo base_url();?>assets/plugins/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

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
                        <h2 style="font-weight: 600"><?php echo $this->session->student_fn;?> <br><?php echo $this->session->student_ln;?></h2>
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
                            <li><a href="<?php echo base_url();?>student/schedule"><i class="fa fa-line-chart"></i> Class Schedule </a></li>
                            <li><a href="<?php echo base_url();?>student/grades"><i class="fa fa-bar-chart"></i> Student Grades </a></li>
                            <?php if ($this->session->enrollment == "OPEN") {?>
                                <li><a href="<?php echo base_url();?>enrollment/process"><i class="fa fa-graduation-cap"></i> Enrollment Module </a></li>
                            <?php } ?>
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
                                <img src="<?php echo base_url();?>/assets/images/<?php echo $this->session->student_image;?>" alt=""><?php echo $this->session->user_fn;?> <?php echo $this->session->user_ln;?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="<?php echo base_url();?>student/password"><i class="fa fa-cogs pull-right"></i> Change Password</a></li>
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
                    <h2>Dashboard</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="col-md-7">

                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>School Calendar</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="card-body">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5" style="padding-top: 8px">
                            <div class="col-md-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Announcements</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <article class="media event">

                                            <?php
                                                $email='';
                                                $pass='';
                                                foreach ($lmsData as $rs) {
                                                    $email = $rs->email;
                                                    $pass = $rs->password;
                                                }
                                            ?>

                                            <div class="media-body">
                                                <a class="title" href="https://elearning.cvsu.edu.ph/" target="_blank">Learning Management System</a>
                                                <br>
                                                <br>
                                                <p style="font-weight: 600">Student CvSU Email</p><br>
                                                <p style="font-weight: 600">Email Address:</p>
                                                <?php echo $email; ?>
                                                <p style="font-weight: 600">Password:</p>
                                                <?php echo $pass; ?>
                                                <br><br>
                                                <a style="font-weight: 600" href="https://mail.google.com/" target="_blank">Link for Google Mail</a>
                                                <a style="font-weight: 600" class="pull-right" href="https://elearning.cvsu.edu.ph/" target="_blank">Link for CvSU LMS</a>
                                            </div>
                                        </article>

<!--                                        <article class="media event">-->
<!--                                            <a class="pull-left date">-->
<!--                                                <p class="month">April</p>-->
<!--                                                <p class="day">23</p>-->
<!--                                            </a>-->
<!--                                            <div class="media-body">-->
<!--                                                <a class="title" href="#">Item Two Title</a>-->
<!--                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
<!--                                            </div>-->
<!--                                        </article>-->
<!--                                        <article class="media event">-->
<!--                                            <a class="pull-left date">-->
<!--                                                <p class="month">April</p>-->
<!--                                                <p class="day">23</p>-->
<!--                                            </a>-->
<!--                                            <div class="media-body">-->
<!--                                                <a class="title" href="#">Item Two Title</a>-->
<!--                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
<!--                                            </div>-->
<!--                                        </article>-->
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>News</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
<!--                                        <article class="media event">-->
<!--                                            <a class="pull-left date">-->
<!--                                                <p class="month">April</p>-->
<!--                                                <p class="day">23</p>-->
<!--                                            </a>-->
<!--                                            <div class="media-body">-->
<!--                                                <a class="title" href="#">Item One Title</a>-->
<!--                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
<!--                                            </div>-->
<!--                                        </article>-->
<!--                                        <article class="media event">-->
<!--                                            <a class="pull-left date">-->
<!--                                                <p class="month">April</p>-->
<!--                                                <p class="day">23</p>-->
<!--                                            </a>-->
<!--                                            <div class="media-body">-->
<!--                                                <a class="title" href="#">Item Two Title</a>-->
<!--                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>-->
<!--                                            </div>-->
<!--                                        </article>-->
                                    </div>
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

<!-- gauge.js -->
<script src="<?php echo base_url();?>assets/plugins/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?php echo base_url();?>assets/plugins/skycons/skycons.js"></script>

<!-- Chart.js -->
<script src="<?php echo base_url();?>assets/plugins/Chart.js/dist/Chart.min.js"></script>
<!-- Flot -->
<script src="<?php echo base_url();?>assets/plugins/Flot/jquery.flot.js"></script>
<script src="<?php echo base_url();?>assets/plugins/Flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url();?>assets/plugins/Flot/jquery.flot.time.js"></script>
<script src="<?php echo base_url();?>assets/plugins/Flot/jquery.flot.stack.js"></script>
<script src="<?php echo base_url();?>assets/plugins/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?php echo base_url();?>assets/plugins/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo base_url();?>assets/plugins/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/flot.curvedlines/curvedLines.js"></script>

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


<!-- PNotify -->
<script src="<?php echo base_url();?>assets/plugins/pnotify/dist/pnotify.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pnotify/dist/pnotify.buttons.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pnotify/dist/pnotify.nonblock.js"></script>

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

</script>


<script src='<?php echo base_url();?>/assets/plugins/calendar/moment.min.js'></script>
<script src='<?php echo base_url();?>/assets/plugins/calendar/fullcalendar.min.js'></script>

<script>

    $(function() {

        $('#calendar').fullCalendar({
            defaultView: 'month',

        });

    });

    $('#calendar').fullCalendar({
        viewRender: function(currentView) {
            var minDate = moment();
            var navigationContainer = currentView.el.parent().prev()
            var cantGoBefore = currentView.start <= minDate;

            $(".fc-prev-button", navigationContainer).prop('disabled', cantGoBefore);
            $(".fc-prev-button", navigationContainer).toggleClass('fc-state-disabled', cantGoBefore);
        },

        events: [

        ]
    });

</script>



</body>
</html>