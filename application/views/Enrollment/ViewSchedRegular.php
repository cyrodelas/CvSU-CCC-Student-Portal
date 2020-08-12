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

    <link href='<?php echo base_url();?>assets/plugins/fullcalendar/dist/fullcalendar.min.css' rel='stylesheet' />
    <link href='<?php echo base_url();?>assets/plugins/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print' />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src='<?php echo base_url();?>assets/plugins/moment/min/moment.min.js'></script>
    <script src='<?php echo base_url();?>assets/plugins/jquery/dist/jquery.min.js'></script>
    <script src='<?php echo base_url();?>assets/plugins/fullcalendar/dist/fullcalendar.min.js'></script>

    <script src='<?php echo base_url();?>assets/js/initCalendar.js'></script> <!-- Script with all important stuff-->
    <style>
        body {
            margin: 40px 30px;
            padding: 0;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <input type='hidden' name ="loadschedule" id = "loadschedule" value="<?php echo base_url();?>enrollment/loadSchedules">
    <input type='hidden' name ="schoolyear" id = "schoolyear" value="<?php echo $schoolyear;?>">
    <input type='hidden' name ="semester" id = "semester" value="<?php echo $semester;?>">
    <input type='hidden' name ="studentid" id = "studentid" value="<?php echo $studentid;?>">
    <div style="width: 100%"  id='calendarsched' ></div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
