

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
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="card-body">
                <div class="col-sm-12">
                    <table id="datatable" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Student Number </th>
                            <th>School Year </th>
                            <th>Semester </th>
                            <th>Subject Code </th>
                            <th>Subject Title </th>
                            <th>Grade</th>
                            <th>Section </th>

                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        if($missingData){
                            foreach ($missingData as $rs) {
                                ?>
                                <tr>
                                    <td><?php echo $rs->studentNumber;?></td>
                                    <td><?php echo $rs->schoolyear;?></td>
                                    <td><?php echo $rs->semester;?></td>
                                    <td>
                                        <?php echo strtoupper($rs->subjectCode);?>
                                    </td>
                                    <td><?php echo $rs->subjectTitle;?></td>
                                    <td>
                                      <?php foreach($gradesNew as $gN){
                                          if(($rs->studentNumber==$gN->studentnumber)&&($rs->schoolyear==$gN->schoolyear)&&($rs->semester==$gN->semester)&&(strtoupper($rs->subjectCode)==strtoupper($gN->subjectcode))){
                                              echo $gN->mygrade;
                                          }
                                      }?>
                                    </td>
                                    <td><?php echo $rs->section;?></td>

                                </tr>
                            <?php } }?>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-4">
                    <div class="col-sm-12">
                        <div class="row">
                            <input type="text" class="form-control" name="inputstudentnumber" id="inputstudentnumber" value="">
                            <input type="text" class="form-control" name="inputschoolyear" id="inputschoolyear" value="">
                            <input type="text" class="form-control" name="inputsemester" id="inputsemester" value="">
                            <input type="text" class="form-control" name="inputsubjectcode" id="inputsubjectcode" value="">
                            <input type='hidden' name ="searchsubjecturl" id = "searchsubjecturl" value="<?php echo base_url();?>student/searchGradesToOld">
                            <button id="searchsujectcode" class="btn btn-success" type="submit">Search</button>
                        </div>

                        <div class="table-reponsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope='row'>Student Number</th>
                                    <td id="tblstudentnumber"></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Schoolyear</th>
                                    <td id="tblschoolyear"></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Semester</th>
                                    <td id="tblsemester"></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Schedule Code</th>
                                    <td id="tblschedulecode"></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Subject Code</th>
                                    <td id="tblsubjectcode"></td>
                                </tr>
                                <tr>
                                    <th scope='row'>Units</th>
                                    <td id="tblsubjectunit"></td>
                                </tr>

                                <tr>
                                    <th scope='row'>Grade</th>
                                    <td id="tblsubjectgrade"></td>
                                </tr>
                                </thead>
                            </table>
                            <form method="post" id="frm_validation" action="<?php echo base_url();?>student/addGradesCvSUdatabase" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <input type="text" style="display: none;" id="studentNumber" name="studentNumber" value="">
                                <input type="text" style="display: none;" id="schoolyear" name="schoolyear" value="">
                                <input type="text" style="display: none;" id="semester" name="semester" value="">
                                <input type="text" style="display: none;" id="subjectcode" name="subjectcode" value="">
                                <input type="text" style="display: none;" id="schedulecode" name="schedulecode" value="">
                                <input type="text" style="display: none;" id="grade" name="grade" value="">
                                <input type="text" style="display: none;" id="unit" name="unit" value="">
                                <button type="submit" class="btn btn-info btn-flat"> Update Grades  </button>
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

    $( document ).ready(function() {
        $("#notif_fade").fadeOut(5000);
    });

    $('#searchsujectcode').click(function(){
        var searchsubj = $('#searchsubjecturl').val();
        var studentnumber = $('#inputstudentnumber').val();
        var schoolyear = $('#inputschoolyear').val();
        var semester = $('#inputsemester').val();
        var subjectcode =$('#inputsubjectcode').val();
        console.log(studentnumber)
        console.log(schoolyear)
        console.log(semester)
        console.log(subjectcode)

        $.ajax({
            type: "POST",
            url  : searchsubj,
            dataType : "JSON",
            data : {
                'studentnumber':studentnumber,
                'schoolyear':schoolyear,
                'semester':semester,
                'subjectcode':subjectcode,
            },
            success: function(data){
                console.log(data);
                $("#tblstudentnumber").text(data[0].StudentNumber);
                $("#tblschoolyear").text(data[0].Schoolyear);
                $("#tblsemester").text(data[0].Semester);
                $("#tblsubjectcode").text(data[0].CourseCode);
                $("#tblsubjectgrade").text(data[0].Grade);
                $("#tblschedulecode").text(data[0].SchedCode);
                $("#tblsubjectunit").text(data[0].CreditUnits);

                $("#studentNumber").val(data[0].StudentNumber);
                $("#schoolyear").val(data[0].Schoolyear);
                $("#semester").val(data[0].Semester);
                $("#subjectcode").val(data[0].CourseCode);
                $("#grade").val(data[0].Grade);
                $("#schedulecode").val(data[0].SchedCode);
                $("#unit").val(data[0].CreditUnits);
            }});
    });

</script>



</body>
</html>