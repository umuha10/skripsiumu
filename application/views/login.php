<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title><?= $judul; ?></title>

    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/template/img/favicon.png" rel="icon">
    <link href="<?= base_url() ?>assets/template/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url() ?>assets/template/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="<?= base_url() ?>assets/template/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?= base_url() ?>assets/template/css/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/template/css/style-responsive.css" rel="stylesheet">

    <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
    <div id="login-page">
        <div class="container">
            <form class="form-login" action="<?= site_url('auth/proses') ?>" method="post">
                <h2 class="form-login-heading">sign in now</h2>
                <div class="login-wrap">
                    <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                    <br>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <br>
                    <button class="btn btn-theme btn-block" href="index.html" type="submit" name="login"><i class="fa fa-lock"></i> SIGN IN</button>
            </form>
        </div>
    </div>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?= base_url() ?>assets/template/lib/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/template/lib/bootstrap/js/bootstrap.min.js"></script>
    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="<?= base_url() ?>assets/template/lib/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("img/login-bg.jpg", {
            speed: 500
        });
    </script>
</body>

</html>