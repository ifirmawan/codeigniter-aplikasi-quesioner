<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<title><?php echo (isset($judul))? $judul : '';?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/font-awesome/css/font-awesome.min.css'); ?>">
	
	<link rel="icon" type="image/png" href="<?php echo base_url('public/');?>img/favicon.ico">

</head>
<body >
<div class="container">
  <div class="row">    
	 <div class="col-md-6 offset-md-3">
	 	<h1><?php echo lang('forgot_password_heading');?></h1>
  		<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>
		
		<div id="infoMessage"><?php echo $message;?></div>

		<?php echo form_open("auth/forgot_password");?>
		<p>
		<label for="identity">
		<?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?>
			
		</label> 
		<br />
		<?php echo form_input($identity);?>
	  	</p>

	  <p>
	  <a href="<?php echo site_url('auth/login');?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> kembali</a>
	  <?php echo form_submit('submit', lang('forgot_password_submit_btn'),array('class'=>'btn btn-primary'));?></p>

<?php echo form_close();?>


	 </div>
	 
</div>
</div>

</body>
</html>




