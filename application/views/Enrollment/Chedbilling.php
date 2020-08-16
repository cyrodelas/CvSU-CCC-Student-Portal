<?php
if (!isset($_SESSION['student_id'])) {
    redirect('student', 'refresh');
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
                        <h2 style="font-weight: 600"><?php echo $this->session->student_fn;?><br><?php echo $this->session->student_ln;?></h2>
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
                                <img src="<?php echo base_url();?>/assets/admin/img/<?php echo $this->session->user_image;?>" alt=""><?php echo $this->session->user_fn;?> <?php echo $this->session->user_ln;?>
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
            <div id="notif_fade" class="col-md-12 col-sm-12 col-xs-12">
                <?php if(isset($_SESSION["error"])){echo '<div class="clearfix"></div><div class="alert alert-danger">'.$_SESSION["error"].'</div>';}?>
                <?php if(isset($_SESSION["success"])){echo '<div class="clearfix"></div><div class="alert alert-success">'.$_SESSION["success"].'</div>';}?>
                <?php echo validation_errors('<div class="clearfix"></div><div class="alert alert-danger">','</div>');?>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Ched Billing <small> Student Information</small></h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form method="post" id="frm_validation" action="<?php echo base_url();?>enrollment/ChedBilling" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

                                <?php foreach ($sfData as $sfRow){?>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <h2>STUDENTS PROFILE</h2>
                                            </div>
                                        </div>

                                        <?php
                                            if($this->session->semester=='FIRST') {
                                                $nextYear = $this->session->schoolyear;
                                                $nextSemester = 'SECOND';
                                            } else {
                                                $nextYear = (intval(substr($this->session->schoolyear, 0, 4)) + 1) . "-" . (intval(substr($this->session->schoolyear, 5, 4)) + 1);
                                                $nextSemester = 'FIRST';
                                            }

                                        ?>

                                        <input required="required" readonly style="display: none" type="text" id="schoolyear" name="schoolyear" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $nextYear;?>">
                                        <input required="required" readonly style="display: none" type="text" id="semester" name="semester" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $nextSemester;?>">
                                        <input required="required" readonly style="display: none" type="text" id="status" name="status" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $status;?>">
                                        <input required="required" readonly style="display: none" type="text" id="standingYear" name="standingYear" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $standingYear;?>">

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Student Number
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" readonly type="text" id="student_id" name="student_id" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $this->session->student_id;?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Year Level
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" readonly type="text" id="yearlevel" name="yearlevel" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $standingYear; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Program Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" readonly type="text" id="coursename" name="coursename" required="required" class="form-control col-md-12 col-xs-12" value="<?php foreach($courseData as $cRow){ if($cRow->courseCode == $this->session->student_course) {echo $cRow->courseTitle;}} ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 10px">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Last Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="student_ln" name="student_ln" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $sfRow->lastName; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 10px">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">First Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="student_fn" name="student_fn" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $sfRow->firstName; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 10px">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Middle Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="student_mn" name="student_mn" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $sfRow->middleName; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 10px">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Extension Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="suffix" name="suffix" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $sfRow->suffix; ?>">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row" style="padding-top: 10px">
                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Province
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <select required="required" id="province" name="province" class="form-control col-md-12 col-xs-12" onchange="ProvinceOnChange(this)">
                                                    <option hidden><?php echo $sfRow->province; ?></option>
                                                    <?php foreach ($provData as $provRow){?>
                                                        <option><?php echo $provRow->provDesc; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Municipality
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <select required="required" id="municipality" name="municipality" class="form-control col-md-12 col-xs-12" onchange="MunicipalityOnChange(this)">
                                                    <option hidden><?php echo $sfRow->municipality; ?></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Barangay
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <select required="required" id="barangay" name="barangay" class="form-control col-md-12 col-xs-12">
                                                    <option hidden><?php echo $sfRow->barangay; ?></option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Street Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="street" name="street" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $sfRow->street; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 10px">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">ZIP Code :
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="zip" name="zip" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 10px">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Date of Birth
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="dob" name="dob" data-provide="datepicker" class="datepicker form-control col-md-12 col-xs-12" value="<?php  $date=date_create($sfRow->dateOfBirth); echo date_format($date, 'm/d/Y'); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 10px">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Sex
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <select required="required" id="gender" name="gender" class="form-control col-md-12 col-xs-12">
                                                    <option hidden><?php echo $sfRow->gender; ?></option>
                                                    <option>MALE</option>
                                                    <option>FEMALE</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 10px">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Email Address :
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="email" name="email" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $sfRow->email; ?>">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row" style="padding-top: 10px">

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Contact Number :
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="mobilePhone" name="mobilePhone" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $sfRow->mobilePhone; ?>">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row" style="padding-top: 30px">

                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <h2>HOUSEHOLD INFORMATION</h2>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>FATHERS NAME</h5>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Last Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="flastname" name="flastname" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">First Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="ffirstname" name="ffirstname" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Middle Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="fmiddlename" name="fmiddlename" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Extension Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="fsuffix" name="fsuffix" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-12" STYLE="padding-top: 10px">
                                            <div class="col-md-12">
                                                <h5>MOTHERS MAIDEN NAME</h5>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Last Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="mlastname" name="mlastname" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">First Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="mfirstname" name="mfirstname" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Middle Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="mmiddlename" name="mmiddlename" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Extension Name
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="msuffix" name="msuffix" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="padding-top: 30px">

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Household Number
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="householdnum" name="householdnum" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Capita Per Income
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="householdincome" name="householdincome" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Disability
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="disability" name="disability" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="col-md-12 col-sm-12 col-xs-12" for="last-name">Total Assessment
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input required="required" type="text" id="totalassesstment" name="totalassesstment" required="required" class="form-control col-md-12 col-xs-12" value="">
                                            </div>
                                        </div>

                                    </div>


                                <?php } ?>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <button type="submit" class="pull-right btn btn-success">SUBMIT CHED BILLING FORM</button>
                                    </div>
                                </div>
                            </form>
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

    $('.datepicker').daterangepicker({
        format: 'mm/dd/yyyy',
        singleDatePicker: true,
    });

    function ProvinceOnChange(obj) {
        $('#municipality').empty()
        $('#barangay').empty()

        var dropDown = document.getElementById("province");
        var provCode = dropDown.options[dropDown.selectedIndex].value;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>student/getMunicipality",
            data: {'provCode': provCode},

            success: function (data) {
                console.log(data);
                var opts = $.parseJSON(data);
                $.each(opts, function (i, d) {
                    $('#municipality').append('<option>' + d.citymunDesc + '</option>');
                });
            }
        });
    }

    function MunicipalityOnChange(obj) {
        $('#barangay').empty()

        var dropDownProv = document.getElementById("province");
        var provCode = dropDownProv.options[dropDownProv.selectedIndex].value;

        var dropDown = document.getElementById("municipality");
        var munCode = dropDown.options[dropDown.selectedIndex].value;

        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>student/getBarangay",
            data: {'provCode': provCode, 'munCode': munCode},

            success: function (data) {
                console.log(data);
                var opts = $.parseJSON(data);
                $.each(opts, function (i, d) {
                    $('#barangay').append('<option>' + d.brgyDesc + '</option>');
                });
            }
        });
    }

</script>



</body>
</html>