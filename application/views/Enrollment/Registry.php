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

        <div class="right_col" role="main">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel" style="background-image: url(<?php echo base_url();?>/assets/images/watermark.jpg); background-repeat: no-repeat;background-attachment: fixed;background-position: center;">
                            <div class="x_content" style="padding-top: 15px">
                                <?php $sectioncount=0;
                                foreach ($YLSData as $ylsData){
                                    $CYS = $ylsData->section;
                                    $sectioncount ++;
                                    $Course = '';
                                    $Major = 'N/A';
                                    $Section = '';
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

                                } ?>

                                <div class="col-md-10 col-md-offset-1" style="padding-bottom: 20px">
                                    <img class="img-responsive" src="<?php echo base_url();?>/assets/images/banner.png">
                                </div>

                                <div class="col-sm-12">
                                    <div class="table-reponsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th style="border-top-width: 0px; border-bottom-width: 0px" scope='row'>Student Number</th>
                                                <td style="border-top-width: 0px;" id=""><?php echo $this->session->student_id;?></td>

                                                <th style="border-top-width: 0px; border-bottom-width: 0px" scope='row'>School Year</th>
                                                <?php $nextSchoolyear = ''; if($this->session->semester == 'FIRST') {$nextSchoolyear = $this->session->schoolyear;} else {$nextSchoolyear = (intval(substr($this->session->schoolyear, 0, 4)) + 1) . "-" . (intval(substr($this->session->schoolyear, 5, 4)) + 1);}?>
                                                <td style="border-top-width: 0px;" id=""><?php echo $nextSchoolyear;?></td>

                                                <th style="border-top-width: 0px; border-bottom-width: 0px" scope='row'>Semester</th>
                                                <?php $nextSemester = ''; if($this->session->semester == 'FIRST') {$nextSemester = 'SECOND';} else {$nextSemester = 'FIRST';}?>
                                                <td style="border-top-width: 0px;" id=""><?php echo $nextSemester;?> SEMESTER</td>
                                            </tr>



                                            <tr>
                                                <th style="border-top-width: 0px; border-bottom-width: 0px" scope='row'>Student Name</th>
                                                <td style="border-top-width: 0px;" id=""><?php echo $this->session->student_fn;?> <?php if($this->session->student_mn!='N/A'){ echo $this->session->student_mn;}?> <?php echo $this->session->student_ln;?></td>
                                                <th style="border-top-width: 0px; border-bottom-width: 0px;" scope='row'>Date</th>
                                                <td style="border-top-width: 0px;" id=""><?php echo date('F d,Y'); ?></td>
                                                <th style="border-top-width: 0px; border-bottom-width: 0px;" scope='row'>Encoder</th>
                                                <td style="border-top-width: 0px;" id="">REGISTRAR</td>
                                            </tr>

                                            <tr>
                                                <th style="border-top-width: 0px; border-bottom-width: 0px;" scope='row'>Course</th>
                                                <td style="border-top-width: 0px;" id=""><?php echo $courseName; ?></td>

                                                <th style="border-top-width: 0px; border-bottom-width: 0px;" scope='row'>Major</th>
                                                <td style="border-top-width: 0px;" id=""><?php echo $Major; ?></td>

                                                <th style="border-top-width: 0px; border-bottom-width: 0px;" scope='row'>Year Level</th>
                                                <td style="border-top-width: 0px;" id=""><?php if($YL == 1){
                                                        echo "1ST";
                                                    }
                                                    elseif($YL == 2){
                                                        echo "2ND";
                                                    }
                                                    elseif($YL == 3){
                                                        echo "3RD";
                                                    }
                                                    elseif($YL == 4){
                                                        echo "4TH";
                                                    } ?> YEAR</td>
                                            </tr>
                                            <tr>
                                                <th style="border-top-width: 0px; border-bottom-width: 0px" scope='row'>Section</th>
                                                <td style="border-top-width: 0px;" id=""><?php echo $CYS;?> </td>

                                                <th style="border-top-width: 0px; border-bottom-width: 0px" scope='row'></th>
                                                <td style="border-top-width: 0px;" id=""></td>

                                                <th style="border-top-width: 0px; border-bottom-width: 0px" scope='row'></th>
                                                <td style="border-top-width: 0px;" id=""></td>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="table-bordered">
                                        <table id="subjectlist" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Schedule Code </th>
                                                <th>Course Code </th>
                                                <th>Course Description </th>
                                                <th>Units </th>
                                                <th>Time </th>
                                                <th>Day </th>
                                                <th>Room </th>
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
                                                        <td>
                                                            <?php echo $rs->timein1;?> - <?php echo $rs->timeout1;?>
                                                            <?php

                                                            if($rs->timein2!='N/A') {
                                                                echo " / ". $rs->timein2. " - ". $rs->timeout2;
                                                            }

                                                            if($rs->timein3!='N/A') {
                                                                echo " / ". $rs->timein3. " - ". $rs->timeout3;
                                                            }

                                                            if($rs->timein4!='N/A') {
                                                                echo " / ". $rs->timein4. " - ". $rs->timeout4;
                                                            }

                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $rs->day1;?>
                                                            <?php

                                                            if($rs->timein2!='N/A') {
                                                                echo " / ". $rs->day2;
                                                            }

                                                            if($rs->timein3!='N/A') {
                                                                echo " / ". $rs->day3;
                                                            }

                                                            if($rs->timein4!='N/A') {
                                                                echo " / ". $rs->day4;
                                                            }

                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $rs->room1;?>
                                                            <?php

                                                            if($rs->timein2!='N/A') {
                                                                echo " / ". $rs->room2;
                                                            }

                                                            if($rs->timein3!='N/A') {
                                                                echo " / ". $rs->room3;
                                                            }

                                                            if($rs->timein4!='N/A') {
                                                                echo " / ". $rs->room4;
                                                            }

                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } }  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <?php foreach ($feeData as $feeRow){ ?>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th scope='row'>Laboratory Fees</th>
                                                        <th scope='row'>Other Fees</th>
                                                        <th scope='row'>Assessment</th>
                                                        <th scope='row'></th>
                                                    </tr>

                                                    <tr>
                                                        <td class="parent">
                                                            <table class="table" style="background-color: transparent">
                                                                <?php if(intval($feeRow->labAnSci)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>AN. SCI</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->labAnSci); echo number_format($feeRow->labAnSci, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->labBioSci)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>BIO. SCI</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->labBioSci); echo number_format($feeRow->labBioSci, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->labCEMDS)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>CEMDS</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->labCEMDS); echo number_format($feeRow->labCEMDS, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->labHRM)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>HRM</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->labHRM) * intval($totalLabsUnits); echo number_format(intval($feeRow->labHRM) * intval($totalLabsUnits), 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->labCropSci)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>CROP. SCI.</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->labCropSci); echo number_format($feeRow->labCropSci, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->labEng)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>ENG.</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->labEng); echo number_format($feeRow->labEng, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->labPhySci)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>PHY. SCI.</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->labPhySci); echo number_format($feeRow->labPhySci, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->labVetMed)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>VET. MED.</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->labVetMed); echo number_format($feeRow->labVetMed, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->labSpeech)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>SPEECH LAB.</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->labSpeech); echo number_format($feeRow->labSpeech, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->labEnglish)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>ENGLISH LAB.</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->labEnglish); echo number_format($feeRow->labEnglish, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->labNursing)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>NURSING LAB.</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->labNursing); echo number_format($feeRow->labNursing, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->ccl)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>CCL</td>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->ccl) * intval($totalLabsUnits); echo number_format(intval($feeRow->ccl) * intval($totalLabsUnits), 2);?></td>
                                                                    </tr>

                                                                <?php } ?>

                                                                <?php if(intval($feeRow->rle)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>RLE</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->rle); echo number_format($feeRow->rle, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->psyc)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>CRIM.</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += 0; echo number_format(0, 2); ?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->psyc)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>PSYC.</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->psyc); echo number_format($feeRow->psyc, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                            </table>
                                                        </td>

                                                        <td class="parent" >
                                                            <table class="table" style="background-color: transparent">
                                                                <?php if(intval($totalInternet)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>INTERNET</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->internet) * intval($totalInternet); echo number_format(intval($feeRow->internet) * intval($totalInternet), 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($totalNSTP)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>NSTP</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->NSTP) * intval($totalNSTP); echo number_format(intval($feeRow->NSTP) * intval($totalNSTP), 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($totalOJT)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>OJT</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->ojt) * intval($totalOJT ); echo number_format(intval($feeRow->ojt) * intval($totalOJT ), 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($totalThesis)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>THESIS ADVISER</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->thesis) * intval($totalThesis); echo number_format(intval($feeRow->thesis) * intval($totalThesis), 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->studentTeaching)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>STUDENT TEACHING</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->studentTeaching); echo number_format($feeRow->studentTeaching, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->lateReg)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>LATE REGISTRATION</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->lateReg); echo number_format($feeRow->lateReg, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($totalResidency)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>RESIDENCY</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->residency) * intval($totalResidency); echo number_format(intval($feeRow->residency) * intval($totalResidency), 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->foreignStudent)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>FOREIGN STUDENT</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->foreignStudent); echo number_format($feeRow->foreignStudent, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->addedSubj)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>ADDED SUBJ.</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->addedSubj); echo number_format($feeRow->addedSubj, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($totalPetition)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>PETITION SUBJ.</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->petitionSubj) * intval($totalPetition); echo number_format(intval($feeRow->petitionSubj) * intval($totalPetition), 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->edfs)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>EDFS</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->edfs); echo number_format($feeRow->edfs, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->trm)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>TRM</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->trm); echo number_format($feeRow->trm, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->fishery)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>FISHERY</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->fishery); echo number_format($feeRow->fishery, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->labcspear)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"   scope='row'>LABORATORY FEE</th>
                                                                        <td style="border-top-width: 0px;"   class="text-right"><?php $genTotal += intval($feeRow->labcspear); echo number_format($feeRow->labcspear, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                        </td>

                                                        <td class="parent">
                                                            <table class="table" style="background-color: transparent">
                                                                <?php if(intval($feeRow->tuition)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>TUITION</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right" id="tbltotalTuition"><?php $genTotal += intval($feeRow->tuition) * intval($totalUnits); echo number_format(intval($feeRow->tuition) * intval($totalUnits), 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->miscLibrary)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>LIBRARY</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->miscLibrary); echo number_format($feeRow->miscLibrary, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->miscMedical)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>MED/DENTAL</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->miscMedical); echo number_format($feeRow->miscMedical, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->miscPublication)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>PUBLICATION</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->miscPublication); echo number_format($feeRow->miscPublication, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->miscRegistration)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>REGISTRATION FEE</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->miscRegistration); echo number_format($feeRow->miscRegistration, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->miscGuidance)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>GUIDANCE FEE</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->miscGuidance); echo number_format($feeRow->miscGuidance, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->identification)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>ID</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->identification); echo number_format($feeRow->identification, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->sfdf)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>SFDF</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right" id="tbltotalSFDF"><?php $genTotal += intval($feeRow->sfdf); echo number_format($feeRow->sfdf, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->srf)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>SRF</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right" id="tbltotalSRF"><?php $genTotal += intval($feeRow->srf); echo number_format($feeRow->srf, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->athletic)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>ATHLETIC</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->athletic); echo number_format($feeRow->athletic, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->scuaa)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>SCUAA</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->scuaa); echo number_format($feeRow->scuaa, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->deposit)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>DEPOSIT</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->deposit); echo number_format($feeRow->deposit, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <?php if(intval($feeRow->other)!=0){ ?>
                                                                    <tr>
                                                                        <th style="border-top-width: 0px;"  scope='row'>OTHER FEE</th>
                                                                        <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->other); echo number_format($feeRow->other, 2);?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                        </td>

                                                        <td class="parent">
                                                            <table class="table" style="background-color: transparent">
                                                                <tr>
                                                                    <th style="border-top-width: 0px;"  scope='row'>Total units</th>
                                                                    <td style="border-top-width: 0px;"  class="text-right"><?php echo$totalUnits; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="border-top-width: 0px;"  scope='row'>Total hours</th>
                                                                    <td style="border-top-width: 0px;"  class="text-right"><?php echo $totalHrs; ?></td>
                                                                </tr>
                                                            </table>

                                                            <table class="table" style="background-color: transparent">
                                                                <tr>
                                                                    <th style="border-top-width: 0px;"  scope='row'>Total amount</th>
                                                                    <td style="border-top-width: 0px;"  class="text-right"><?php echo number_format($genTotal, 2); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="border-top-width: 0px;"  scope='row'>Scholarship</th>
                                                                    <td style="border-top-width: 0px;"  class="text-right">RA 10931</td>
                                                                </tr>
                                                            </table>

                                                            <table class="table" style="background-color: transparent">
                                                                <tr>
                                                                    <th style="border-top-width: 0px;"  scope='row'>Tuition</th>
                                                                    <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->tuition) * intval($totalUnits); echo number_format(intval($feeRow->tuition) * intval($totalUnits), 2);?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="border-top-width: 0px;"  scope='row'>SFDF</th>
                                                                    <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->sfdf); echo number_format($feeRow->sfdf, 2);?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="border-top-width: 0px;"  scope='row'>SRF</th>
                                                                    <td style="border-top-width: 0px;"  class="text-right"><?php $genTotal += intval($feeRow->srf); echo number_format($feeRow->srf, 2);?></td>
                                                                </tr>
                                                            </table>

                                                            <table class="table" style="background-color: transparent">
                                                                <tr>
                                                                    <th style="border-top-width: 0px;"  scope='row'>Terms of payment</th scope='row'>
                                                                    <td style="border-top-width: 0px;"  class="text-right"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="border-top-width: 0px;"  scope='row'>First payment</th>
                                                                    <td style="border-top-width: 0px;"  class="text-right"><?php echo number_format(intval($genTotal) * 0.5, 2); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th style="border-top-width: 0px;" scope='row'>Second payment</th>
                                                                    <td style="border-top-width: 0px;" class="text-right"><?php echo number_format(intval($genTotal) * 0.25, 2); ?></td>
                                                                </tr>

                                                                <tr>
                                                                    <th style="border-top-width: 0px;" scope='row'>Third payment</th>
                                                                    <td style="border-top-width: 0px;" class="text-right"><?php echo number_format(intval($genTotal) * 0.25, 2); ?></td>
                                                                </tr>
                                                            </table>

                                                        </td>

                                                    </tr>

                                                    </thead>
                                                </table>
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



</script>



</body>
</html>