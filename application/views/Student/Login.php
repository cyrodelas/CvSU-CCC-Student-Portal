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
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/plugins/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url(); ?>assets/plugins/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/plugins/build/css/custom.css" rel="stylesheet">
</head>

<body class="login">
    <div>

        <div class="login_wrapper">



            <section class="login_content">
                <form action="<?php echo base_url(); ?>student/validate_login" method="post" data-toggle="validator" id="frm_validation" enctype="multipart/form-data">
                    <h1>Student Portal</h1>

                    <div id="notif_fade" class="col-md-12">
                        <?php if(isset($_SESSION["error"])){echo '<div class="alert alert-danger">'.$_SESSION["error"].'</div>';}?>
                        <?php if(isset($_SESSION["success"])){echo '<div class="alert alert-success">'.$_SESSION["success"].'</div>';}?>
                        <?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
                    </div>


                    <div>
                        <input id="username" name="username" type="text" class="form-control" placeholder="Student Identification Number" required="" />
                    </div>
                    <div>
                        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <button style="width: 100%" type="submit" class="btn btn-success submit">Login</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                    </div>

                </form>
            </section>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/themes/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#notif_fade").fadeOut(5000);
        });
    </script>


</body>

</html>