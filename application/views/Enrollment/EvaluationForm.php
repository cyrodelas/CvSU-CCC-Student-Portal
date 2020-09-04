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
                        <img src="<?php echo base_url();?>/assets/images/user.png" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <h2 style="font-weight: 600">Evaluator<br>Profile</h2>
                        <h2><?php echo $this->session->department;?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Navigation</h3>
                        <ul class="nav side-menu">
                            <li><a href="<?php echo base_url();?>student/evaluation"><i class="fa fa-dashboard"></i> Dashboard </a></li>
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
            <div class="row">
                <div class="col-md-5">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Student Information</h2>
                            <ul class="nav navbar-right panel_toolbox">

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="row">
                                <div id ="studentinformation" class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="table-reponsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope='row'>Student Number</th>
                                                        <td id=""><?php echo $studentNumber;?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope='row'>Student Name</th>
                                                        <td id=""><?php echo $studentName;?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope='row'>School Year</th>
                                                        <td id=""><?php echo $schoolyear;?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope='row'>Semester</th>
                                                        <td id=""><?php echo $semester;?> SEMESTER</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope='row'>Course</th>
                                                        <td id="tCourse"><?php echo $course;?></td>
                                                    </tr>

                                                    <tr>
                                                        <th scope='row'>Major</th>
                                                        <td id="tMajor"><?php echo $major;?> </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope='row'>Year Level</th>
                                                        <td id="">
                                                            <?php
                                                                if($yearLevel == 1){
                                                                    echo "1ST";
                                                                }
                                                                elseif($yearLevel == 2){
                                                                    echo "2ND";
                                                                }
                                                                elseif($yearLevel == 3){
                                                                    echo "3RD";
                                                                }
                                                                elseif($yearLevel == 4){
                                                                    echo "4TH";
                                                                }
                                                            ?> YEAR
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope='row'>Section</th>
                                                        <td id=""><?php echo $section;?></td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Subject Information</h2>
                            <ul class="nav navbar-right panel_toolbox">

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group input-group-sm">
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="inputsubjectcode" id="inputsubjectcode">
                                            <input style="display: none" type="text" class="form-control" name="dbtype" id="dbtype" value="<?php echo $dbtype; ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <input type='hidden' name ="searchsubjecturl" id = "searchsubjecturl" value="<?php echo base_url();?>enrollment/getSubjectInfo">
                                            <button id="searchsujectcode" class="btn btn-info btn-flat"> Search Subject  </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <div class="table-reponsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th scope='row'>Subject Code</th>
                                                    <td id="tblsubjectcode"></td>
                                                </tr>
                                                <tr>
                                                    <th scope='row'>Subject Name</th>
                                                    <td id="tblsubjectname"></td>
                                                </tr>
                                                <tr>
                                                    <th scope='row'>Units</th>
                                                    <td id="tblsubjectunit"></td>
                                                </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="padding-bottom:20px">
                                <div class="col-sm-12">
                                    <div class="item form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <button id="submitbutton" class="btn btn-success col-md-12">Add Subject</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Student Evaluation</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a href="<?php echo base_url();?>enrollment/eChecklist/<?php echo $studentNumber; ?>/<?php echo $dbtype; ?>" class="load_modal_details" target="_blank" > <i class="fa fa-list"></i> Student Checklist</i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php if($semester == 'FIRST') { ?>



                                    <?php } else {?>

                                        <div class="row" style="padding-bottom: 10px;">

                                            <div class="col-md-4">
                                                <label>School Year</label>
                                                <?php $nextYear = (intval(substr($schoolyear, 0, 4)) + 1) . "-" . (intval(substr($schoolyear, 5, 4)) + 1); ?>
                                                <input type="text" readonly="readonly" id="schoolyear" name="schoolyear" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $nextYear; ?>">
                                            </div>

                                            <div class="col-md-4">
                                                <label>Semester</label>
                                                <?php $nextSem = 'FIRST';?>
                                                <input type="text" readonly="readonly" id="semester" name="semester" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $nextSem; ?> SEMESTER">
                                                <input style="display: none" type="text" readonly="readonly" id="tsemester" name="tsemester" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $nextSem; ?>">
                                            </div>

                                        </div>

                                        <div class="row" style="padding-bottom: 20px;">
                                            <div class="col-md-4">
                                                <label>Year Level</label>
                                                <select id="yearlevel" name="yearlevel" class="form-control col-md-12 col-xs-12" <?php if($status=="REGULAR"){echo 'disabled';}?> onchange="YearLevelOnChange(this)">
                                                    <option hidden>
                                                        <?php
                                                            $yearLevel ++;
                                                            if($yearLevel == 1){
                                                                echo "1ST";
                                                            }
                                                            elseif($yearLevel == 2){
                                                                echo "2ND";
                                                            }
                                                            elseif($yearLevel == 3){
                                                                echo "3RD";
                                                            }
                                                            elseif($yearLevel == 4){
                                                                echo "4TH";
                                                            }
                                                        ?> YEAR
                                                    </option>
                                                    <option value="1">1ST YEAR</option>
                                                    <option value="2">2ND YEAR</option>
                                                    <option value="3">3RD YEAR</option>
                                                    <option value="4">4TH YEAR</option>
                                                </select>


                                            </div>

                                            <div class="col-md-4">
                                                <label>Section</label>
                                                <select id="section" name="section" class="form-control col-md-12 col-xs-12" disabled onchange="SectionOnChange(this)">
                                                        <option id="secDefault" hidden><?php if($status=="REGULAR"){echo $section;} else {echo "IRREGULAR";}  ?></option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Status</label>
                                                <select id="status" name="status" class="form-control col-md-12 col-xs-12" onchange="OnChangeStatus(this)">
                                                    <option hidden><?php echo $status; ?></option>
                                                    <option>REGULAR</option>
                                                    <option>IRREGULAR</option>
                                                </select>
                                            </div>

                                        </div>

                                    <?php } ?>

                                    <form method="post" id="frm_validation" action="<?php echo base_url();?>enrollment/evaluateStudent" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

                                        <table id="subjectlist" class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Schedule Code </th>
                                                <th>Course Code </th>
                                                <th>Course Description </th>
                                                <th>Units </th>
                                                <th>Option </th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <input type="text" style="display: none;" name="studentNumber" value="<?php echo $studentNumber;?>">
                                            <input type="text" style="display: none;" name="schoolyear" value="<?php echo $nextYear; ?>">
                                            <input type="text" style="display: none;" name="semester" value="<?php echo $nextSem; ?>">
                                            <input type="text" style="display: none;" id="fyearlevel" name="standingYear" value="<?php echo $yearLevel++; ?>">
                                            <input type="text" style="display: none;" id="fstatus" name="status" value="<?php echo $status; ?>">
                                            <input type="text" style="display: none;" id="databaseType" name="databaseType" value="<?php echo $dbtype; ?>">

                                            <?php
                                            if($sccData){
                                                foreach ($sccData as $rs) {
                                                    ?>
                                                    <tr id="<?php echo $rs->subjectCode;?>">
                                                        <td>
                                                            <?php echo $rs->schedcode;?>
                                                            <input type="text" style="display: none;" name="schedcode[]" value="<?php echo $rs->schedcode;?>">
                                                        </td>
                                                        <td><?php echo $rs->subjectCode;?></td>
                                                        <td><?php echo $rs->subjectTitle;?></td>
                                                        <td><?php echo number_format(intval($rs->units) + intval($rs->labunits), 2);?></td>
                                                        <th><a href="Javascript:deleteTableRow(<?php echo $rs->subjectCode;?>)"><i class="fa fa-trash"></i> remove</a></th>
                                                    </tr>
                                                <?php } }  ?>
                                            </tbody>
                                        </table>


                                        <button type="submit" style="margin-top: 15px" class="btn btn-success col-md-4 pull-right">Evaluate Student</button>

                                    </form>

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

        $('#subjectlist').dataTable( {
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "columnDefs": []
        } );



    });

    function YearLevelOnChange(obj){

        var dropDown = document.getElementById("yearlevel");
        yl = dropDown.options[dropDown.selectedIndex].value;
        coursecode = $('#tCourse').text();
        major = $('#tMajor').text();

        $('#fyearlevel').val(yl);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>enrollment/getSectionSchedule",
            data: {
                'coursecode': coursecode,
                'major': major,
                'yl': yl
            },

            success: function(data) {
                console.log(data);
                var opts = $.parseJSON(data);
                $('#section').empty();
                $.each(opts, function(i, d) {

                    var x;
                    for (x = 1; x <= d.sectioncount; x++) {
                        $('#section').append('<option>' + String.fromCharCode(64 + x) + '</option>');
                    }


                });
            }
        });
    }

    function SectionOnChange(obj){

        var table = $('#subjectlist').DataTable();
        table.clear().draw();
        table.destroy();

        var dropDown = document.getElementById("section");

        var schoolyear = $('#schoolyear').val();
        var semester = $('#tsemester').val();
        var coursecode = $('#tCourse').text();
        var major = $('#tMajor').text();
        var yearlevel = $("#yearlevel option:selected").val();
        var section = dropDown.options[dropDown.selectedIndex].value;
        var dbtype = $('#databaseType').val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>enrollment/getScheduleRegular",
            data: {
                'schoolyear': schoolyear,
                'semester': semester,
                'coursecode': coursecode,
                'major': major,
                'yearlevel': yearlevel,
                'section': section,
                'dbtype': dbtype
            },

            success: function(data) {
                console.log(data);
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {
                    var row =  $('#subjectlist').DataTable().row.add([d.schedcode + '<input type="text" style="display: none;" name="schedcode[]" value="'+ d.schedcode +'">', d.subjectCode, d.subjectTitle, d.units, '']).draw();
                });
            }
        });

    }


    function OnChangeStatus(obj) {
        var dropDown = document.getElementById("status");
        sVal = dropDown.options[dropDown.selectedIndex].value;

        if(sVal==='IRREGULAR'){
            $('#fstatus').val('IRREGULAR');
            var table = $('#subjectlist').DataTable();
            table.clear().draw();
            table.destroy();

            $('#yearlevel').prop("disabled", false);
            $("#section").html("<option>IRREGULAR</option>");
            $('#section').val('IRREGULAR');
            $('#section').prop("disabled", true);


        } else {
            $('#fstatus').val('REGULAR');
            $('#section').prop("disabled", false);
            $('#secDefault').text('');
        }
    }

    function deleteTableRow(subjectCode){
        $('#subjectlist').DataTable().row(subjectCode).remove().draw();
    }


    $('#searchsujectcode').click(function(){
        var searchsubj = $('#searchsubjecturl').val();
        var subjectcode = $('#inputsubjectcode').val();
        var databaseType = $('#dbtype').val();

        $.ajax({
            type: "POST",
            url  : searchsubj,
            dataType : "JSON",
            data : {subjectcode:subjectcode, databaseType:databaseType},
            success: function(data){
                console.log(data);
                $("#tblsubjectcode").text(data[0].subjectcode);
                $("#tblsubjectname").text(data[0].subjectTitle);
                var totalUnits = parseInt(data[0].lectUnits) + parseInt(data[0].labunits)
                var unitsDecimal = totalUnits.toFixed(2)
                $("#tblsubjectunit").text(unitsDecimal);
            }});
    });

    $('#submitbutton').click(function(){
        var subjectcode = $('#tblsubjectcode').text();
        var subjectname = $('#tblsubjectname').text();
        var subjectunit = $('#tblsubjectunit').text();

        var row =  $('#subjectlist').DataTable().row.add(['', subjectcode + '<input type="text" style="display: none;" name="subjectcode[]" value="'+ subjectcode +'">', subjectname, subjectunit, '<a href="Javascript:deleteTableRow('+subjectcode+')" style="font-weight: 600"><i class="fa fa-trash"></i> remove</a>']).draw();
        row.nodes().to$().attr('id', subjectcode)

        $('#inputsubjectcode').val("");
        $('#tblsubjectcode').text("");
        $('#tblsubjectname').text("");
        $('#tblsubjectunit').text("");

    });




</script>



</body>
</html>