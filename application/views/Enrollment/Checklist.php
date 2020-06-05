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


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Enrollment<small> Student Evaluation </small></h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="card-body">
                <?php foreach ($ysData as $ysRow) {?>
                    <h2><?php if($ysRow->yearlevel==1){echo 'First';}elseif($ysRow->yearlevel==2){echo 'Second';}elseif($ysRow->yearlevel==3){echo 'Third';}else{echo 'Fourth';}?> Year <small><?php echo $ysRow->semester;?> SEMESTER</small></h2>
                    <table id="" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Course Code </th>
                            <th>Course Description </th>
                            <th>Lecture Units </th>
                            <th>Lab Units </th>
                            <th>Pre-requisites </th>
                            <th>SY/Sem Taken</th>
                            <th>Instructor</th>
                            <th>Final Grade</th>
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
                                    <?php  ?>
                                    <td>
                                        <?php foreach ($sgData as $sgRow) { if($rs->subjectcode==$sgRow->subjectcode) { echo $sgRow->schoolyear;   ?> / <?php echo $sgRow->semester; }} ?>
                                    </td>
                                    <td>
                                        <?php foreach ($sgData as $sgRow) { if($rs->subjectcode==$sgRow->subjectcode) { echo $sgRow->instructor; }} ?>
                                    </td>

                                    <th>
                                        <?php foreach ($sgData as $sgRow) { if($rs->subjectcode==$sgRow->subjectcode) { echo $sgRow->mygrade; }} ?>
                                    </th>

                                </tr>
                            <?php } } }?>
                        </tbody>
                    </table>
                <?php } ?>
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

    $( document ).ready(function() {
        $("#notif_fade").fadeOut(5000);
    });



</script>



</body>
</html>