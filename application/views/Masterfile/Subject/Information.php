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
                    <h2>Subject Management <small>Subject Information</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">

                    <form method="post" id="frm_validation" action="<?php echo base_url();?>file_management/add_subject_information" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <div class="row" style="margin: 20px 0 20px -10px">
                            <div class="col-md-2">
                                <label>Subject Code</label>
                                <input id="subjectcode" name="subjectcode" class="form-control col-md-12 col-xs-12">
                            </div>

                            <div class="col-md-6">
                                <label>Subject Name</label>
                                <input id="subjectTitle" name="subjectTitle" class="form-control col-md-12 col-xs-12">
                            </div>

                            <div class="col-md-2">
                                <label>Lecture Units</label>
                                <input id="lectUnits" name="lectUnits" class="form-control col-md-12 col-xs-12">
                            </div>

                            <div class="col-md-2">
                                <label>Laboratory Units</label>
                                <input id="labunits" name="labunits" class="form-control col-md-12 col-xs-12">
                            </div>

                        </div>

                        <div class="row" style="margin: 20px 0 20px -10px">
                            <div class="col-md-10">
                                <label>Subject Description</label>
                                <input id="description" name="description" class="form-control col-md-12 col-xs-12">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button style="margin-top: 23px;" type="submit" class="btn btn-success col-md-12 col-xs-12">Add subject</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>


            <div class="x_panel">
                <div class="card-body" style="margin-top: 10px">
                    <table id="datatable" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Code </th>
                            <th>Name </th>
                            <th>Description </th>
                            <th>Lecture Units </th>
                            <th>Lab Units </th>
                            <th>Pre-requisites </th>
                            <th>Option </th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        if($siData){
                            foreach ($siData as $rs) {
                                ?>
                                <tr>
                                    <td><?php echo $rs->subjectcode; ?></td>
                                    <td><?php echo $rs->subjectTitle; ?></td>
                                    <td><?php echo $rs->description; ?></td>
                                    <td><?php echo $rs->lectUnits; ?></td>
                                    <td><?php echo $rs->labunits; ?></td>
                                    <th>
                                        <?php
                                        if(($rs->pr1=='N/A')&&($rs->pr2=='N/A')&&($rs->pr3=='N/A')&&($rs->pr4=='N/A')&&($rs->pr5=='N/A')&&($rs->pr6=='N/A')&&($rs->pr7=='N/A')&&($rs->pr8=='N/A')&&($rs->pr9=='N/A')&&($rs->pr10=='N/A')) { ?>
                                            <a href="<?php echo base_url();?>file_management/pre_requisites/<?php echo $rs->subjectcode; ?>" ><i class="fa fa-eye"></i> view data </a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url();?>file_management/pre_requisites/<?php echo $rs->subjectcode; ?>" ><i class="fa fa-eye"></i> view data </a>
                                        <?php } ?>
                                    </th>
                                    <th>
                                        <a href="" class="load_modal_details" data-toggle="modal" data-target=".update-subject-<?php echo $rs->subjectcode;?>"><i class="fa fa-pencil"></i> update</a>
                                        <br>
                                        <a href="Javascript:DeleteData('<?php echo $rs->subjectcode;?>')"><i class="fa fa-trash-o"></i> remove</a>
                                    </th>
                                </tr>
                            <?php }}?>
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




<?php foreach ($siData as $rs){ ?>

    <div class="modal fade update-subject-<?php echo $rs->subjectcode;?>"  role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="load_modal_fields_large">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Subject Information<small>Modify Record</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a data-dismiss="modal"><i class="fa fa-close"></i> close</a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <form method="post" id="frm_validation" action="<?php echo base_url();?>file_management/edit_subject_information" data-toggle="validator" class="form-horizontal form-label-left" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Subject Code :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" readonly="readonly" id="subjectcode" name="subjectcode" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rs->subjectcode;?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Subject Name :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="subjectTitle" name="subjectTitle" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rs->subjectTitle;?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <textarea required="required" id="description" name="description" class="form-control" rows="6" placeholder='' ><?php echo $rs->description;?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Lecture Unit :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="lectUnits" name="lectUnits" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rs->lectUnits;?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Laboratory Unit :
                                        </label>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" id="labunits" name="labunits" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $rs->labunits;?>">
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success col-md-12 col-sm-12 col-xs-12">Update Subject Information</button>
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

<?php } ?>


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


<!-- Custom Theme Scripts -->
<script src="<?php echo base_url();?>assets/plugins/build/js/custom.js"></script>

<script type="text/javascript">

    $( document ).ready(function() {
        $("#notif_fade").fadeOut(5000);
    });


    $("#update-subject").on('click', function() {
        alert("inside onclick");
    });


    function DeleteData(cid)
    {
        if (confirm("Delete selected subject?"))
        {
            location.href = "<?php echo base_url();?>file_management/delete_subject_information/"+cid;
        }
    }

</script>



</body>
</html>