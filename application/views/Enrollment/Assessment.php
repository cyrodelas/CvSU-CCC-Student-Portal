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
                        <h2 style="font-weight: 600"><?php echo $this->session->student_fn;?><br><?php echo $this->session->student_ln;?></h2 style="font-weight: 600">
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
                                <img src="<?php echo base_url();?>/assets/image/<?php echo $this->session->user_image;?>" alt=""><?php echo $this->session->user_fn;?> <?php echo $this->session->user_ln;?>
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

        <div class="right_col" role="main">
            <div class="">
                <div class="row">
                    <div class="col-md-7">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Student Information</h2>
                                <ul class="nav navbar-right panel_toolbox">

                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

                                <?php $sectioncount=0;
                                foreach ($YLSData as $ylsData){
                                    $CYS = $ylsData->section;
                                    $sectioncount ++;
                                    $Course = '';
                                    $Major = 'N/A';
                                    $Section = '';
                                    $Course = substr($ylsData->section, 0, 2);

                                    if($Course == "SE"){

                                        $courseName = 'B'. $Course;

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

                                    elseif($Course == "EC"){

                                        $courseName = 'B'. substr($ylsData->section, 0, 4);
                                        $YL = substr($ylsData->section, 4, 1);
                                        $Section = substr($ylsData->section, 5, 1);

                                    }

                                    else{
                                        $courseName = 'BS'. $Course;
                                        $YL = substr($ylsData->section, 2, 1);
                                        $Section = substr($ylsData->section, 3, 1);
                                    }

                                } ?>

                                <div class="table-reponsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope='row'>Student Number</th>
                                            <td id=""><?php echo $this->session->student_id;?></td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>Student Name</th>
                                            <td id=""><?php echo $this->session->student_fn;?> <?php if($this->session->student_mn!='N/A'){ echo $this->session->student_mn;}?> <?php echo $this->session->student_ln;?></td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>Admitted Year</th>
                                            <td id=""><?php
                                                if(strlen($this->session->yearAdmitted)==4){
                                                    echo $this->session->yearAdmitted. '-' . (intval($this->session->yearAdmitted) + 1);
                                                } else{
                                                    echo $this->session->yearAdmitted;
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>Admitted Semester</th>
                                            <td id=""><?php echo $this->session->semesterAdmitted;?></td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>School Year</th>
                                            <?php $nextSchoolyear = ''; if($this->session->semester == 'FIRST') {$nextSchoolyear = $this->session->schoolyear;} else {$nextSchoolyear = (intval(substr($this->session->schoolyear, 0, 4)) + 1) . "-" . (intval(substr($this->session->schoolyear, 5, 4)) + 1);}?>
                                            <td id=""><?php echo $nextSchoolyear;?></td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>Semester</th>
                                            <?php $nextSemester = ''; if($this->session->semester == 'FIRST') {$nextSemester = 'SECOND';} else {$nextSemester = 'FIRST';}?>
                                            <td id=""><?php echo $nextSemester;?> SEMESTER</td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>Course</th>
                                            <td id=""><?php echo $courseName; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>Major</th>
                                            <td id=""><?php echo $Major; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>Year Level</th>
                                            <td id=""><?php
                                                if($status=='IRREGULAR') {
                                                    echo $standingYear;
                                                } else {
                                                    echo $YL;
                                                }
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>Section</th>
                                            <td id=""><?php
                                                if($status=='IRREGULAR') {
                                                    echo 'IRREGULAR';
                                                } else {
                                                    echo $Section;
                                                }

                                                ?></td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Evaluated Subjects</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-12">
                                            <div class="table-reponsive">
                                                <table id="subjectlist" class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Schedule Code </th>
                                                        <th>Course Code </th>
                                                        <th>Course Description </th>
                                                        <th>Units </th>
                                                        <th>Instructor </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php

                                                    $totalUnits = 0;
                                                    $totalHrs = 0;
                                                    $totalLabsUnits = 0;

                                                    $totalInternet = 0;
                                                    $totalNSTP = 0;
                                                    $totalOJT = 0;
                                                    $totalThesis = 0;
                                                    $totalPetition = 0;
                                                    $totalResidency = 0;
                                                    $genTotal = 0;

                                                    if($seData){
                                                        foreach ($seData as $rs) {
                                                            $totalUnits += intval($rs->units) + intval($rs->labunits);
                                                            $totalHrs += intval($rs->oras);
                                                            $totalLabsUnits += intval($rs->labunits);

                                                            if($rs->internet=='Y'){$totalInternet += 1;}
                                                            if($rs->ojt=='Y'){$totalOJT += 1;}
                                                            if($rs->thesis=='Y'){$totalThesis += 1;}
                                                            if($rs->petition=='Y'){$totalPetition += 1;}
                                                            if($rs->residency=='Y'){$totalResidency += 1;}

                                                            if(($rs->subjectCode=='NSTP1')||($rs->subjectCode=='NSTP2')){$totalNSTP += 1;}


                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $rs->schedcode;?>
                                                                </td>
                                                                <td><?php echo $rs->subjectCode;?></td>
                                                                <td><?php echo $rs->subjectTitle;?></td>
                                                                <td><?php echo number_format(intval($rs->units) + intval($rs->labunits), 2);?></td>
                                                                <td><?php echo $rs->instructor;?></td>
                                                            </tr>
                                                        <?php } }  ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-5">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Fees</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

                                <?php foreach ($feeData as $feeRow){ ?>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                <?php if(intval($feeRow->labAnSci)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>AN. SCI</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labAnSci); echo number_format($feeRow->labAnSci, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->labBioSci)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>BIO. SCI</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labBioSci); echo number_format($feeRow->labBioSci, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->labCEMDS)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>CEMDS</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labCEMDS); echo number_format($feeRow->labCEMDS, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->labHRM)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>HRM</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labHRM) * intval($totalLabsUnits); echo number_format(intval($feeRow->labHRM) * intval($totalLabsUnits), 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->labCropSci)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>CROP. SCI.</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labCropSci); echo number_format($feeRow->labCropSci, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->labEng)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>ENG.</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labEng); echo number_format($feeRow->labEng, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->labPhySci)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>PHY. SCI.</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labPhySci); echo number_format($feeRow->labPhySci, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->labVetMed)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>VET. MED.</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labVetMed); echo number_format($feeRow->labVetMed, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->labSpeech)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>SPEECH LAB.</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labSpeech); echo number_format($feeRow->labSpeech, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->labEnglish)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>ENGLISH LAB.</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labEnglish); echo number_format($feeRow->labEnglish, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->labNursing)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>NURSING LAB.</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labNursing); echo number_format($feeRow->labNursing, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->ccl)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>CCL</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->ccl) * intval($totalLabsUnits); echo number_format(intval($feeRow->ccl) * intval($totalLabsUnits), 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->rle)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>RLE</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->rle); echo number_format($feeRow->rle, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->psyc)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>CRIM.</th>
                                                        <td class="text-right"><?php $genTotal += 0; echo number_format(0, 2); ?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->psyc)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>PSYC.</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->psyc); echo number_format($feeRow->psyc, 2);?></td>
                                                    </tr>
                                                <?php } ?>



                                                <?php if(intval($totalInternet)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>INTERNET</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->internet) * intval($totalInternet); echo number_format(intval($feeRow->internet) * intval($totalInternet), 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($totalNSTP)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>NSTP</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->NSTP) * intval($totalNSTP); echo number_format(intval($feeRow->NSTP) * intval($totalNSTP), 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($totalOJT)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>OJT</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->ojt) * intval($totalOJT ); echo number_format(intval($feeRow->ojt) * intval($totalOJT ), 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($totalThesis)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>THESIS ADVISER</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->thesis) * intval($totalThesis); echo number_format(intval($feeRow->thesis) * intval($totalThesis), 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->studentTeaching)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>STUDENT TEACHING</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->studentTeaching); echo number_format($feeRow->studentTeaching, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->lateReg)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>LATE REGISTRATION</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->lateReg); echo number_format($feeRow->lateReg, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($totalResidency)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>RESIDENCY</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->residency) * intval($totalResidency); echo number_format(intval($feeRow->residency) * intval($totalResidency), 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->foreignStudent)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>FOREIGN STUDENT</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->foreignStudent); echo number_format($feeRow->foreignStudent, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->addedSubj)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>ADDED SUBJ.</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->addedSubj); echo number_format($feeRow->addedSubj, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($totalPetition)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>PETITION SUBJ.</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->petitionSubj) * intval($totalPetition); echo number_format(intval($feeRow->petitionSubj) * intval($totalPetition), 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->edfs)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>EDFS</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->edfs); echo number_format($feeRow->edfs, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->trm)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>TRM</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->trm); echo number_format($feeRow->trm, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->fishery)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>FISHERY</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->fishery); echo number_format($feeRow->fishery, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->labcspear)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>LABORATORY FEE</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->labcspear); echo number_format($feeRow->labcspear, 2);?></td>
                                                    </tr>
                                                <?php } ?>



                                                <?php if(intval($feeRow->tuition)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>TUITION</th>
                                                        <td class="text-right" id="tbltotalTuition"><?php $genTotal += intval($feeRow->tuition) * intval($totalUnits); echo number_format(intval($feeRow->tuition) * intval($totalUnits), 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->miscLibrary)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>LIBRARY</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->miscLibrary); echo number_format($feeRow->miscLibrary, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->miscMedical)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>MED/DENTAL</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->miscMedical); echo number_format($feeRow->miscMedical, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->miscPublication)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>PUBLICATION</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->miscPublication); echo number_format($feeRow->miscPublication, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->miscRegistration)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>REGISTRATION FEE</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->miscRegistration); echo number_format($feeRow->miscRegistration, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->miscGuidance)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>GUIDANCE FEE</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->miscGuidance); echo number_format($feeRow->miscGuidance, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->identification)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>ID</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->identification); echo number_format($feeRow->identification, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->sfdf)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>SFDF</th>
                                                        <td class="text-right" id="tbltotalSFDF"><?php $genTotal += intval($feeRow->sfdf); echo number_format($feeRow->sfdf, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->srf)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>SRF</th>
                                                        <td class="text-right" id="tbltotalSRF"><?php $genTotal += intval($feeRow->srf); echo number_format($feeRow->srf, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->athletic)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>ATHLETIC</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->athletic); echo number_format($feeRow->athletic, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->scuaa)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>SCUAA</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->scuaa); echo number_format($feeRow->scuaa, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->deposit)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>DEPOSIT</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->deposit); echo number_format($feeRow->deposit, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if(intval($feeRow->other)!=0){ ?>
                                                    <tr>
                                                        <th scope='row'>OTHER FEE</th>
                                                        <td class="text-right"><?php $genTotal += intval($feeRow->other); echo number_format($feeRow->other, 2);?></td>
                                                    </tr>
                                                <?php } ?>

                                                </thead>
                                            </table>
                                        </div>

                                        <div class="col-sm-12">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th scope='row'>Total units</th>
                                                            <td class="text-right"><?php echo number_format($totalUnits, 2); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>Total hours</th>
                                                            <td class="text-right"><?php echo number_format($totalHrs, 2); ?></td>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th scope='row'>Total</th>
                                                            <td class="text-right"><?php echo number_format($genTotal, 2); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>First payment</th>
                                                            <td class="text-right"><?php echo number_format(intval($genTotal) * 0.5, 2); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>Second payment</th>
                                                            <td class="text-right"><?php echo number_format(intval($genTotal) * 0.25, 2); ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope='row'>Third payment</th>
                                                            <td class="text-right"><?php echo number_format(intval($genTotal) * 0.25, 2); ?></td>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Scholarship</label>
                                                    <select id="scholarship" name="scholarship" class="form-control col-md-12 col-xs-12" onchange="ScholarshipChange(this)">
                                                        <option hidden>No Discount</option>
                                                        <?php foreach ($schData as $schData) {?>
                                                            <option value="<?php echo $schData->id;?>"><?php echo $schData->scholarship;?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="col-md-12" style="padding-top: 10px">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th scope='row'>Tuition %</th>
                                                            <td class="text-right" id="tbltuitionPer"></td>
                                                            <td class="text-right" id="tbltuitionVal"></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope='row'>SFDF %</th>
                                                            <td class="text-right" id="tblsfdfPer"></td>
                                                            <td class="text-right" id="tblsfdfVal"></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope='row'>SRF %</th>
                                                            <td class="text-right" id="tblsrfPer"></td>
                                                            <td class="text-right" id="tblsrfVal"></td>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>


                                                <div class="col-md-12" style="margin-top:-10px">

                                                    <form method="post" id="frm_validation" action="<?php echo base_url();?>enrollment/studentFees" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

                                                        <input type="text" style="display: none;" name="studentNumber" value="<?php echo $this->session->student_id;?>">
                                                        <input type="text" style="display: none;" name="schoolyear" value="<?php echo $nextSchoolyear; ?>">
                                                        <input type="text" style="display: none;" name="semester" value="<?php echo $nextSemester; ?>">
                                                        <input type="text" style="display: none;" name="status" value="<?php echo $status; ?>">
                                                        <input type="text" style="display: none;" name="standingYear" value="<?php echo $standingYear; ?>">

                                                        <input type="text" style="display: none;" id="tscholarship" name="tscholarship" value="">
                                                        <input type="text" style="display: none;" name="majorCourse" value="<?php echo $Major; ?>">
                                                        <input type="text" style="display: none;" name="yearLevel" value="<?php echo $YL; ?>">
                                                        <input type="text" style="display: none;" name="coursenow" value="<?php echo $this->session->student_course;?>">

                                                        <?php foreach ($seData as $rs) { ?>
                                                            <input type="text" style="display: none;" name="schedcodes[]" value="<?php echo $rs->schedcode; ?>">
                                                        <?php }?>

                                                        <input type="text" style="display: none;" name="labAnSci" value="<?php echo $feeRow->labAnSci; ?>">
                                                        <input type="text" style="display: none;" name="labBioSci" value="<?php echo $feeRow->labBioSci; ?>">
                                                        <input type="text" style="display: none;" name="labCEMDS" value="<?php echo $feeRow->labCEMDS; ?>">
                                                        <input type="text" style="display: none;" name="labCropSci" value="<?php echo $feeRow->labCropSci; ?>">
                                                        <input type="text" style="display: none;" name="labHRM" value="<?php $tlHRM=intval($feeRow->labHRM) * intval($totalLabsUnits); echo $tlHRM; ?>">
                                                        <input type="text" style="display: none;" name="labEng" value="<?php echo $feeRow->labEng; ?>">
                                                        <input type="text" style="display: none;" name="labPhySci" value="<?php echo $feeRow->labPhySci; ?>">
                                                        <input type="text" style="display: none;" name="labVetMed" value="<?php echo $feeRow->labVetMed; ?>">
                                                        <input type="text" style="display: none;" name="labSpeech" value="<?php echo $feeRow->labSpeech; ?>">
                                                        <input type="text" style="display: none;" name="labEnglish" value="<?php echo $feeRow->labEnglish; ?>">
                                                        <input type="text" style="display: none;" name="labNursing" value="<?php echo $feeRow->labNursing; ?>">
                                                        <input type="text" style="display: none;" name="ccl" value="<?php $tCCL=intval($feeRow->ccl) * intval($totalLabsUnits); echo $tCCL; ?>">
                                                        <input type="text" style="display: none;" name="internet" value="<?php $tInternet=intval($feeRow->internet) * intval($totalInternet); echo $tInternet; ?>">
                                                        <input type="text" style="display: none;" name="NSTP" value="<?php $tNSTP=intval($feeRow->NSTP) * intval($totalNSTP); echo $tNSTP; ?>">
                                                        <input type="text" style="display: none;" name="ojt" value="<?php $tOJT=intval($feeRow->ojt) * intval($totalOJT); echo $tOJT; ?>">
                                                        <input type="text" style="display: none;" name="thesis" value="<?php $tThesis=intval($feeRow->thesis) * intval($totalThesis); echo $tThesis; ?>">
                                                        <input type="text" style="display: none;" name="studentTeaching" value="<?php echo $feeRow->studentTeaching; ?>">
                                                        <input type="text" style="display: none;" name="lateReg" value="<?php echo $feeRow->lateReg; ?>">
                                                        <input type="text" style="display: none;" name="residency" value="<?php $tResidency=intval($feeRow->residency) * intval($totalResidency); echo $tResidency; ?>">
                                                        <input type="text" style="display: none;" name="foreignStudent" value="<?php echo $feeRow->foreignStudent; ?>">
                                                        <input type="text" style="display: none;" name="addedSubj" value="<?php echo $feeRow->addedSubj; ?>">
                                                        <input type="text" style="display: none;" name="petitionSubj" value="<?php $tPetition=intval($feeRow->petitionSubj) * intval($totalPetition); echo $tPetition; ?>">
                                                        <input type="text" style="display: none;" name="tuition" value="<?php $tTuition=intval($feeRow->tuition) * intval($totalUnits); echo $tTuition; ?>">
                                                        <input type="text" style="display: none;" name="identification" value="<?php echo $feeRow->identification; ?>">
                                                        <input type="text" style="display: none;" name="sfdf" value="<?php echo $feeRow->sfdf; ?>">
                                                        <input type="text" style="display: none;" name="srf" value="<?php echo $feeRow->srf; ?>">
                                                        <input type="text" style="display: none;" name="athletic" value="<?php echo $feeRow->athletic; ?>">
                                                        <input type="text" style="display: none;" name="scuaa" value="<?php echo $feeRow->scuaa; ?>">
                                                        <input type="text" style="display: none;" name="deposit" value="<?php echo $feeRow->deposit; ?>">
                                                        <input type="text" style="display: none;" name="other" value="<?php echo $feeRow->other; ?>">
                                                        <input type="text" style="display: none;" name="miscLibrary" value="<?php echo $feeRow->miscLibrary; ?>">
                                                        <input type="text" style="display: none;" name="miscMedical" value="<?php echo $feeRow->miscMedical; ?>">
                                                        <input type="text" style="display: none;" name="miscPublication" value="<?php echo $feeRow->miscPublication; ?>">
                                                        <input type="text" style="display: none;" name="miscRegistration" value="<?php echo $feeRow->miscRegistration; ?>">
                                                        <input type="text" style="display: none;" name="miscGuidance" value="<?php echo $feeRow->miscGuidance; ?>">
                                                        <input type="text" style="display: none;" name="rle" value="<?php echo $feeRow->rle; ?>">
                                                        <input type="text" style="display: none;" name="labcspear" value="<?php echo $feeRow->labcspear; ?>">
                                                        <input type="text" style="display: none;" name="edfs" value="<?php echo $feeRow->edfs; ?>">
                                                        <input type="text" style="display: none;" name="psyc" value="<?php echo $feeRow->psyc; ?>">
                                                        <input type="text" style="display: none;" name="trm" value="<?php echo $feeRow->trm; ?>">
                                                        <input type="text" style="display: none;" name="fishery" value="<?php echo $feeRow->fishery; ?>">


                                                        <input type="text" style="display: none;" name="mwRLE" value="<?php echo $status; ?>">
                                                        <input type="text" style="display: none;" name="rletwo" value="<?php echo $status; ?>">
                                                        <input type="text" style="display: none;" name="rlethree" value="<?php echo $status; ?>">
                                                        <input type="text" style="display: none;" name="mwrletwo" value="<?php echo $status; ?>">
                                                        <input type="text" style="display: none;" name="mwrlethree" value="<?php echo $status; ?>">


                                                        <button type="submit" class="btn btn-success col-md-12 ">CONFIRM ASSESSMENT</button>
                                                    </form>

                                                </div>

                                            </div>


                                        </div>

                                    </div>
                                <?php } ?>
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

    function myFunction() {
        var myWindow = window.open("<?php echo base_url();?>enrollment/viewschedSection/<?php echo $nextSchoolyear; ?>/<?php echo $nextSemester; ?>/<?php echo $this->session->student_id;?>", "Class Schedule", "width=865,height=700");
    }

    function ScholarshipChange(obj) {

        var dropDown = document.getElementById("scholarship");

        scholarshipID = dropDown.options[dropDown.selectedIndex].value;

        var subtotalTuition = $("#tbltotalTuition").text();
        var subtotalSFDF = $("#tbltotalSFDF").text();
        var subtotalSRF = $("#tbltotalSRF").text();

        var newTuition = subtotalTuition.replace(',', '');
        var newSFDF = subtotalSFDF.replace(',', '');
        var newSRF = subtotalSRF.replace(',', '');


        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>enrollment/getScholarship",
            data: {
                'scholarshipID': scholarshipID
            },

            success: function(data) {
                console.log(data);
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {
                    $("#tbltuitionPer").text(d.tuition + ' %');
                    $("#tblsfdfPer").text(d.sfdf + ' %');
                    $("#tblsrfPer").text(d.srf + ' %');

                    $("#tscholarship").val(d.scholarship);


                    var totalTuition = (parseInt(d.tuition)/100) * parseFloat(newTuition);
                    var totalSFDF = (parseInt(d.sfdf)/100) * parseFloat(newSFDF);
                    var totalSRF = (parseInt(d.srf)/100) * parseFloat(newSRF);

                    $("#tbltuitionVal").text(totalTuition.toFixed(2));
                    $("#tblsfdfVal").text(totalSFDF.toFixed(2));
                    $("#tblsrfVal").text(totalSRF.toFixed(2));
                });
            }
        });
    }


</script>



</body>
</html>