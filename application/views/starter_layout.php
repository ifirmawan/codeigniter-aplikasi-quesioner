<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo (isset($judul))? $judul : '';?></title>


	<link href="<?php echo base_url('public/');?>img/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="<?php echo base_url('public/');?>css/lib/datatables-net/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url('public/');?>css/lib/datatables-net.min.css">
	

    <link rel="stylesheet" href="<?php echo base_url('public/');?>font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/');?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/');?>css/main.css">
</head>
<body >
	<?php echo (isset($pesan))? $pesan : '';?>
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<?php echo (isset($halaman))? $halaman : '';?>		
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url('public/');?>js/lib/tether/tether.min.js"></script>
	<script src="<?php echo base_url('public/');?>bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('public/');?>js/plugins.js"></script>
		<!-- datatables -->
	<script src="<?php echo base_url('public/');?>js/lib/datatables-net/datatables.min.js"></script>
	<script src="<?php echo base_url('public/');?>js/lib/datatables-net/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo base_url('public/');?>js/lib/datatables-net/moment.min.js"></script>
</body>
</html>