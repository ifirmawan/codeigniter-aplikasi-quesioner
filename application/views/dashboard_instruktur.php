<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo (isset($judul))? $judul : '';?></title>

	<link href="<?php echo base_url('public/');?>img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="<?php echo base_url('public/');?>img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="<?php echo base_url('public/');?>img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="<?php echo base_url('public/');?>img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="<?php echo base_url('public/');?>img/favicon.png" rel="icon" type="image/png">
	<link href="<?php echo base_url('public/');?>img/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="<?php echo base_url('public/');?>css/lib/datatables-net/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url('public/');?>css/separate/vendor/datatables-net.min.css">
	<link rel="stylesheet" href="<?php echo base_url('public/');?>css/lib/datatables-net/datatables.min1.css">

    <link rel="stylesheet" href="<?php echo base_url('public/');?>css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/');?>css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/');?>css/main.css">
</head>
<body class="with-side-menu">

	<header class="site-header">
	    <div class="container-fluid">
	
	        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span>toggle menu</span>
	        </button>
	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>

	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	                    <div class="dropdown dropdown-notification notif">
	                        <a href="#"
	                           class="header-alarm dropdown-toggle active"
	                           id="dd-notification"
	                           data-toggle="dropdown"
	                           aria-haspopup="true"
	                           aria-expanded="false">
	                            <i class="font-icon-alarm"></i>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-notif" aria-labelledby="dd-notification">
	                            <div class="dropdown-menu-notif-header">
	                                Notifications
	                                <span class="label label-pill label-danger">4</span>
	                            </div>
	                            <div class="dropdown-menu-notif-list">
	                                <div class="dropdown-menu-notif-item">
	                                    <div class="photo">
	                                        <img src="<?php echo base_url('public/');?>img/photo-64-1.jpg" alt="">
	                                    </div>
	                                    <div class="dot"></div>
	                                    <a href="#">Morgan</a> was bothering about something
	                                    <div class="color-blue-grey-lighter">7 hours ago</div>
	                                </div>
	                            </div>
	                            <div class="dropdown-menu-notif-more">
	                                <a href="#">See more</a>
	                            </div>
	                        </div>
	                    </div>
   						<div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="<?php echo base_url();?>public/img/avatar-2-64.png" alt="">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-user"></span>Tentang saya</a>
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-cog"></span>Pengaturan</a>
	                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Bantuan</a>
	                            <div class="dropdown-divider"></div>
<a class="dropdown-item" href="<?php echo (isset($my))? site_url($my['is'].'/keluar') : site_url('admin/keluar');?>">
	                            <span class="font-icon glyphicon glyphicon-log-out"></span>Keluar</a>
	                        </div>
	                    </div>
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>
	                <div class="site-header-collapsed">
	                    <div class="site-header-collapsed-in">
	                        <div class="dropdown dropdown-typical">
	                            <div class="dropdown-menu" aria-labelledby="dd-header-sales">
	                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
	                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
	                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
	                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
	                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
	                            </div>
	                        </div>
	                    </div><!--.site-header-collapsed-in-->
	                </div><!--.site-header-collapsed-->
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->

	<div class="mobile-menu-left-overlay"></div>
	<nav class="side-menu">
	    <ul class="side-menu-list">
	    	<li class="blue">
	            <a href="<?php echo site_url($my['is'].'/index');?>">
	                <i class="font-icon fa fa-user"></i>
	                <span class="lbl">Data pribadi</span>
	            </a>
	        </li>
	        <li class="blue">
	            <a href="<?php echo site_url($my['is'].'/daftar_acara');?>">
	                <i class="font-icon fa fa-calendar"></i>
	                <span class="lbl">Acara</span>
	            </a>
	        </li>	
	        <li class="blue">
	            <a href="<?php echo site_url($my['is'].'/daftar_tanggapan');?>">
	                <i class="font-icon fa fa-reply"></i>
	                <span class="lbl">Tanggapan</span>
	            </a>
	        </li>
	        <li class="blue">
	            <a href="<?php echo site_url($my['is'].'/pengaturan_akun');?>">
	                <i class="font-icon fa fa-gear"></i>
	                <span class="lbl">Pengaturan Akun</span>
	            </a>
	        </li>
	        </ul>
	    </section>
	</nav><!--.side-menu-->
	<?php echo (isset($pesan))? $pesan : '';?>
	<div class="page-content">
	<div class="container-fluid">
			<section class="card">
				<div class="card-block">
<?php echo (isset($halaman))? $halaman : '';?>
				</div>
			</section>
		</div><!--.container-fluid-->
		
		
	</div><!--.page-content-->

	<script src="<?php echo base_url('public/');?>js/lib/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url('public/');?>js/lib/tether/tether.min.js"></script>
	<script src="<?php echo base_url('public/');?>js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="<?php echo base_url('public/');?>js/plugins.js"></script>

	<!-- datatables -->
	<script src="<?php echo base_url('public/');?>js/lib/datatables-net/datatables.min.js"></script>
	<script src="<?php echo base_url('public/');?>js/lib/datatables-net/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo base_url('public/');?>js/lib/datatables-net/moment.min.js"></script>
	<script>

// Bootstrap datepicker
$('.input-daterange input').each(function() {
  $(this).datepicker('clearDates');
});

// Set up your table
table = $('#my-table').DataTable({
});

// Extend dataTables search
$.fn.dataTable.ext.search.push(
  function(settings, data, dataIndex) {
    var min = $('#min-date').val();
    var max = $('#max-date').val();
    var createdAt = data[2] || 0; // Our date column in the table

    if (
      (min == "" || max == "") ||
      (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
    ) {
      return true;
    }
    return false;
  }
);

// Re-draw the table when the a date range filter changes
$('.date-range-filter').change(function() {
  table.draw();
});
	</script>
<script src="<?php echo base_url('public/');?>custom/js/custom.program.js"></script>

<script src="<?php echo base_url('public/');?>js/app.js"></script>
</body>
</html>