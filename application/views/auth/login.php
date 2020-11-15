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
<!-- navigasi-->


<!-- content-->
<div class="container">
  <div class="row">    
     <div class="col-md-6 offset-md-3">
      <?php 
      
      echo (isset($alert))? $alert : '' ;?>
      <strong><?php echo lang('login_heading');?></strong>
      <?php echo lang('login_subheading');?>

<?php echo form_open("auth/login");?>

  <p>
    <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
  </p>
  <div class="form-check">
      <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
      <?php echo lang('login_remember_label', 'remember');?>
  </div>

      <?php echo form_submit('submit', lang('login_submit_btn'),array('class'=>'btn btn-primary'));?>
  <div class="pull-right">   
  <a href="<?php echo site_url('auth/forgot_password');?>"><?php echo lang('login_forgot_password');?></a>
  </div>
<?php echo form_close();?>

     </div>
     
</div>
</div>

</body>
</html>




