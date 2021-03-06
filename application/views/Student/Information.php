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
                    <h2>Student Information</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a href="#" class="load_modal_details" data-toggle="modal" data-target=".update-student-information"  title="update student info"><i class="fa fa-list"></i> Update Student Information</i></a>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="card-body">
                    <div class="row" style="padding-top: 10px">
                        <?php foreach ($sfData as $sfRow){?>
                            <div class="col-md-3 col-xs-3">
                                <label>Student Number</label>
                                <p><?php echo $sfRow->studentNumber; ?></p>
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <label>Last Number</label>
                                <p><?php echo $sfRow->lastName; ?></p>
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <label>First Number</label>
                                <p><?php echo $sfRow->firstName; ?></p>
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <label>Middle Name</label>
                                <p><?php if($sfRow->middleName!='N/A'){ echo $sfRow->middleName;}?> </p>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="row" style="padding-top: 10px">

                        <?php $sectioncount=0;
                        foreach ($YLSData as $ylsData){
                            $sectioncount ++;
                            $Course = '';
                            $Major = 'N/A';
                            $Section = '';

                            $courseName = '';

                            if($this->session->dbtype == 1){
                                $Course = substr($ylsData->section, 0, 2);
                                if($Course == "SE"){

                                    $YL = substr($ylsData->section, 2, 1);
                                    $Section = substr($ylsData->section, 3, 1);

                                    $MI = $Course = substr($ylsData->section, 4, 1);
                                    if($MI == 'M'){
                                        $Major = " - MATHEMATICS";
                                    }else {
                                        $Major = " - ENGLISH";
                                    }


                                }

                                elseif($Course == "BE"){
                                    $courseName = substr($ylsData->section, 0, 5);
                                    $YL = substr($ylsData->section, 5, 1);
                                    $Section = substr($ylsData->section, 6, 1);
                                }

                                else{
                                    $courseName = 'BS'. $Course;
                                    $YL = substr($ylsData->section, 2, 1);
                                    $Section = substr($ylsData->section, 3, 1);
                                }
                            } else {
                                if($ylsData->section == 'IRREG') {
                                    $courseName = $this->session->student_course;
                                    $YL = $ylsData->section;
                                    $Section = $ylsData->section;
                                } else {
                                    $Course = substr($ylsData->section, 0, 2);
                                    if($Course == "SE"){

                                        $YL = substr($ylsData->section, 2, 1);
                                        $Section = substr($ylsData->section, 3, 1);

                                        $MI = $Course = substr($ylsData->section, 4, 1);
                                        if($MI == 'M'){
                                            $Major = " - MATHEMATICS";
                                        }else {
                                            $Major = " - ENGLISH";
                                        }


                                    }

                                    elseif($Course == "BE"){
                                        $courseName = substr($ylsData->section, 0, 5);
                                        $YL = substr($ylsData->section, 5, 1);
                                        $Section = substr($ylsData->section, 6, 1);
                                    }

                                    else{
                                        $courseName = 'BS'. $Course;
                                        $YL = substr($ylsData->section, 2, 1);
                                        $Section = substr($ylsData->section, 3, 1);
                                    }
                                }
                            }

                        } ?>


                        <div class="col-md-3 col-xs-3">
                            <label>Year Level</label>
                            <p>
                                <?php if($YL==1){ echo 'First Year'; } elseif ($YL==2) { echo 'Second Year'; } elseif ($YL==3) { echo 'Third Year'; } elseif ($YL==4) { echo 'Fourth Year'; } else { echo 'Irregular'; } ?>
                            </p>
                        </div>

                        <?php $courseN = ''; $majorN = '';  foreach ($currData as $cRow) { $courseN = $cRow->course; $majorN = $cRow->coursemajor;} ?>

                        <div class="col-md-3 col-xs-3">
                            <label>Course</label>
                            <p><?php echo $courseN; ?></p>
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <label>Major</label>
                            <p><?php echo $majorN; ?></p>
                        </div>

                    </div>
                </div>
            </div>




            <div class="x_panel">
                <div class="x_title">
                    <h2>Personal Information</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a href="#" class="load_modal_details" data-toggle="modal" data-target=".update-personal-information"  title="update student info"><i class="fa fa-list"></i> Update Personal Information</i></a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <?php foreach ($sfData as $sfRow){?>
                        <div class="row" style="padding-top: 10px">

                            <div class="col-md-3 col-xs-3">
                                <label>Street Name</label>
                                <p><?php echo $sfRow->street; ?></p>
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <label>Barangay</label>
                                <p><?php echo $sfRow->barangay; ?></p>
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <label>Municipaity</label>
                                <p><?php echo $sfRow->municipality; ?></p>
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <label>Province</label>
                                <p><?php echo $sfRow->province; ?></p>
                            </div>
                        </div>

                        <div class="row" style="padding-top: 10px">

                            <div class="col-md-3 col-xs-3">
                                <label>Date of Birth</label>
                                <p><?php echo $sfRow->dateOfBirth; ?></p>
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <label>Sex</label>
                                <p><?php echo $sfRow->gender; ?></p>
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <label>Civil Status</label>
                                <p><?php echo $sfRow->status; ?></p>
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <label>Citizenship</label>
                                <p><?php echo $sfRow->citizenship; ?></p>
                            </div>
                        </div>

                        <div class="row" style="padding-top: 10px">

                            <div class="col-md-3 col-xs-3">
                                <label>Religion</label>
                                <p><?php echo $sfRow->religion; ?></p>
                            </div>


                        </div>


                    <?php }?>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2>Guardian Information</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a href="#" class="load_modal_details" data-toggle="modal" data-target=".update-guardian-information"  title="update student info"><i class="fa fa-list"></i> Update Guardian Information</i></a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <?php foreach ($sfData as $sfRow){?>
                        <div class="row" style="padding-top: 10px">

                            <div class="col-md-3 col-xs-3">
                                <label>Guardian Name</label>
                                <p><?php echo $sfRow->guardian; ?></p>
                            </div>

                            <div class="col-md-3 col-xs-3">
                                <label>Guardian Contact Number</label>
                                <p><?php echo $sfRow->mobilePhone; ?></p>
                            </div>

                        </div>
                    <?php }?>
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

<div class="modal fade update-student-information" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="load_modal_fields_large">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Student Information <small>Update Record</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form method="post" id="frm_validation" action="<?php echo base_url();?>student/updateStudentInfo" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <?php foreach ($sfData as $sfRow){?>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">First Name :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="student_fn" name="student_fn" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $sfRow->firstName; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Middle Name :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="student_mn" name="student_mn" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $sfRow->middleName; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="student_ln" name="student_ln" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $sfRow->lastName; ?>">
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Request for information update</button>
                                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
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

<div class="modal fade update-personal-information" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="load_modal_fields_large">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Personal Information <small>Update Record</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form method="post" id="frm_validation" action="<?php echo base_url();?>student/updatePersonalInfo" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

                                <?php foreach ($sfData as $sfRow){?>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Province :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <select id="province" name="province" class="form-control col-md-7 col-xs-12" onchange="ProvinceOnChange(this)">
                                                <option hidden><?php echo $sfRow->province; ?></option>
                                                <?php foreach ($provData as $provRow){?>
                                                    <option><?php echo $provRow->provDesc; ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Municipality :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <select id="municipality" name="municipality" class="form-control col-md-7 col-xs-12" onchange="MunicipalityOnChange(this)">
                                                <option hidden><?php echo $sfRow->municipality; ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Barangay :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <select id="barangay" name="barangay" class="form-control col-md-7 col-xs-12">
                                                <option hidden><?php echo $sfRow->barangay; ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Street Name :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="street" name="street" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $sfRow->street; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date of Birth :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="dob" name="dob" data-provide="datepicker" class="datepicker form-control col-md-7 col-xs-12" value="<?php  $date=date_create($sfRow->dateOfBirth); echo date_format($date, 'm/d/Y'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sex :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <select id="gender" name="gender" class="form-control col-md-7 col-xs-12">
                                                <option hidden><?php echo $sfRow->gender; ?></option>
                                                <option>MALE</option>
                                                <option>FEMALE</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Civil Status :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <select id="status" name="status" class="form-control col-md-7 col-xs-12">
                                                <option hidden><?php echo $sfRow->status; ?></option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Separated">Separated</option>
                                                <option value="Divorced">Divorced</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Citizenship :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="citizenship" name="citizenship" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $sfRow->citizenship; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Religion :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <select id="religion" name="religion" class="form-control col-md-7 col-xs-12">
                                                <option hidden><?php echo $sfRow->religion; ?></option>
                                                <?php foreach ($religionData as $relRow){ ?>
                                                    <option><?php echo $relRow->religion; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                <?php } ?>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Request for information update</button>
                                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
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


<div class="modal fade update-guardian-information" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="load_modal_fields_large">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Guardian Information <small>Update Record</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form method="post" id="frm_validation" action="<?php echo base_url();?>student/updateGuardianInfo" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <?php foreach ($sfData as $sfRow){?>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Guardian Name :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="guardian" name="guardian" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $sfRow->guardian; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Guardian Contact Number :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="mobilePhone" name="mobilePhone" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $sfRow->mobilePhone; ?>">
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Request for information update</button>
                                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
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

    $('.datepicker').daterangepicker({
        format: 'mm/dd/yyyy',
        singleDatePicker: true,
    });


    $( document ).ready(function() {
        $("#notif_fade").fadeOut(5000);
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