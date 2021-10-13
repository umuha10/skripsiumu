<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard">
	<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<title><?php echo $judul ?></title>

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

	<!-- Data Table -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

	<!-- Material Icon -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

	<!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
	<section id="container">
		<!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
		<!--header start-->
		<header class="header black-bg">
			<div class="sidebar-toggle-box">
				<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
			</div>
			<!--logo start-->
			<a href="index.html" class="logo"><b>BLT-DD<span> PEKANDANGAN</span></b></a>
			<!--logo end-->

			<div class="top-menu">
				<ul class="nav pull-right top-menu">
					<li><a class="logout" href="<?= base_url(); ?>auth/logout">Logout</a></li>
				</ul>
			</div>
		</header>
		<!--header end-->
		<!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
		<!--sidebar start-->
		<aside>
			<div id="sidebar" class="nav-collapse ">
				<!-- sidebar menu start-->
				<ul class="sidebar-menu" id="nav-accordion">
					<p class="centered"><a href="#!"><img src="<?= base_url() ?>assets/user/user.jpg" class="img-circle" width="80"></a></p>
					<h5 class="centered"><?= $this->session->userdata('username') ?></h5>

					<!-- Mba umu ini sidebar yang ga ada dropdownnya, tinggal copy dan ubah nama di spannya -->
					<li class="mt">
						<a href="<?= site_url() ?>">
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
						</a>
					</li>

					<li class="sub-menu">
						<a href="<?= base_url(); ?>penduduk">
							<i class="fa fa-desktop"></i>
							<span>Data Penduduk</span>
						</a>
					</li>

					<!-- Mba umu ini sidebar yang  ada dropdownnya, tinggal copy dan ubah nama di spannya -->
					<li class="sub-menu">
						<a href="javascript:;">
							<i class="fa fa-desktop"></i>
							<span>Data Kriteria</span>
						</a>
						<ul class="sub">
							<li><a href="<?= base_url(); ?>kriteria">Input Data Kriteria</a></li>
							<li><a href="<?= base_url(); ?>subkriteria">Nilai Bobot Kriteria</a></li>
						</ul>
					</li>

					<!-- <li class="sub-menu">
						<a href="javascript:;">
							<i class="fa fa-database" aria-hidden="true"></i>
							<span>Data Alternatif</span>
						</a>
						<ul class="sub">
							<li><a href="<?= base_url(); ?>Alternatif/index">Input Data Alternatif</a></li>
							<li><a href="buttons.html">Nilai Bobot Alternatif</a></li>
						</ul>
					</li> -->

					<li class="sub-menu">
						<a href="<?= base_url(); ?>perhitungan">
							<i class="fa fa-calculator" aria-hidden="true"></i>
							<span>Perhitungan</span>
						</a>
					</li>

					<!-- <li class="sub-menu">
						<a href="javascript:;">
							<i class="fa fa-area-chart" aria-hidden="true"></i>
							<span>Hasil Perangkingan</span>
						</a>
					</li> -->

					<!-- <li class="sub-menu">
						<a href="javascript:;">
							<i class="fa fa-sun-o" aria-hidden="true"></i>
							<span>Pengaturan</span>
						</a>
					</li> -->

				</ul>
				<!-- sidebar menu end-->
			</div>
		</aside>
		<!--sidebar end-->
		<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
		<!--main content start-->
		<section id="main-content">
			<section class="wrapper site-min-height">
				<?= @$contents ?>
			</section>
			<!-- /wrapper -->
		</section>
		<!-- /MAIN CONTENT -->
		<!--main content end-->
		<!--footer start-->
		<footer class="site-footer">
			<div class="text-center">
				<p translate="no">
					&copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
				</p>
				<div class="credits">
					<!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
					Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
				</div>
				<a href="blank.html#" class="go-top">
					<i class="fa fa-angle-up"></i>
				</a>
			</div>
		</footer>
		<!--footer end-->
	</section>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

	<!-- js placed at the end of the document so the pages load faster -->
	<script src="<?= base_url() ?>assets/template/lib/jquery/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/template/lib/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/template/lib/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="<?= base_url() ?>assets/template/lib/jquery.ui.touch-punch.min.js"></script>
	<script class="include" type="text/javascript" src="<?= base_url() ?>assets/template/lib/jquery.dcjqaccordion.2.7.js"></script>
	<script src="<?= base_url() ?>assets/template/lib/jquery.scrollTo.min.js"></script>
	<script src="<?= base_url() ?>assets/template/lib/jquery.nicescroll.js" type="text/javascript"></script>
	<!--common script for all pages-->
	<script src="<?= base_url() ?>assets/template/lib/common-scripts.js"></script>
	<!--script for this page-->

	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

	<script>
		$(document).ready(function() {
			$('#myTable').DataTable();
		});
	</script>

</body>

</html>