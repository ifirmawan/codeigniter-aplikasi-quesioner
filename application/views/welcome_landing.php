<!DOCTYPE html>
<html>
<head>
	<title><?php echo (isset($judul))? $judul : '';?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/materialize/css/');?>material.css">
	<link rel="stylesheet" href="<?php echo base_url('public/materialize/css/icon.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/materialize/css/');?>rifqi.css">
	<link rel="stylesheet" href="<?php echo base_url('public/');?>font-awesome/css/font-awesome.min.css">
	<style type="text/css">
.demo-card-event.mdl-card {
  width: 286px;
  height: 286px;
  background: #3E4EB8;
  margin-right:  15px;
  margin-left: 25px;
  margin-bottom: 10px;
  margin-top: 15px;
}
.demo-card-event > .mdl-card__actions {
  border-color: rgba(255, 255, 255, 0.2);
}
.demo-card-event > .mdl-card__title {
  align-items: flex-start;
}
.demo-card-event > .mdl-card__title > h4 {
  margin-top: 0;
}
.demo-card-event > .mdl-card__actions {
  display: flex;
  box-sizing:border-box;
  align-items: center;
}
.demo-card-event > .mdl-card__actions > .material-icons {
  padding-right: 10px;
}
.demo-card-event > .mdl-card__title,
.demo-card-event > .mdl-card__actions,
.demo-card-event > .mdl-card__actions > .mdl-button {
  color: #fff;
}
	</style>
</head>
<body>

	<!-- navbar nya -->
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
	  <header class="mdl-layout__header navbar-1">
	    <div class="mdl-layout__header-row">
	      <!-- Title -->
	      <span class="mdl-layout-title mdl-cell--hide-phone">
	      	<img src="<?php echo base_url('public/img/logo.jpg');?>" class="img-responsive" style="max-width: 165px;" />
	      </span>
	      <!-- Add spacer, to align navigation to the right -->
	      <div class="mdl-layout-spacer"></div>
	      <!-- Navigation. We hide it in small screens. -->

	      <nav class="mdl-navigation mdl-layout--large-screen-only" style="position: absolute; left:350px;">
	        
		      <!--<form action="#">
				  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
				    <label class="mdl-button mdl-js-button mdl-button--icon" for="sample6" style="margin: 8px 0px;">
				      <i class="material-icons">search</i>
				    </label>
				    <div style="margin-left:40px;">
				      <input class="mdl-textfield__input css-1" type="text" id="sample6" placeholder="Enter your address to see how much you can save" style="width: 400px;">
				      <label class="mdl-textfield__label" for="sample-expandable" style="margin-left: 40px; width: 400px;"></label>
				    </div>
				  </div>
				</form>-->

	      </nav>

	      <nav class="mdl-navigation mdl-layout--large-screen-only">
	      	<a class="mdl-navigation__link nav-1" href="<?php echo site_url('landing/index');?>">Beranda</a>
			<a class="mdl-navigation__link nav-1" href="<?php echo site_url('landing/benefit');?>">Benefit</a>
	        <!--<a class="mdl-navigation__link nav-1" href="">FAQ</a>-->
	      </nav>
	  </header>
	  <div class="mdl-layout__drawer">
	    <span class="mdl-layout-title">
	      	Surveyukdist3
	    </span>
	    <nav class="mdl-navigation">
	        <a class="mdl-navigation__link" href="<?php echo site_url('landing/index');?>">Beranda</a>
			<a class="mdl-navigation__link" href="<?php echo site_url('landing/benefit');?>">Benefit</a>
	        <!--<a class="mdl-navigation__link" href="#">FAQ</a>-->
	    </nav>
	    <nav class="mdl-navigation mdl-cell--hide-desktop">
	        <a class="mdl-navigation__link" href="<?php echo site_url('landing/tentang_kami');?>">Tentang kami</a>
	        <a class="mdl-navigation__link" href="<?php echo site_url('landing/member');?>">Member</a>
	    </nav>
	  </div>
	  <main class="mdl-layout__content">
	    <div class="page-content"><!-- Your content goes here -->
	    	
	<!-- content 1 -->
	<div class="content-1">
		
	</div>
	<!-- / content 1 -->

	<!-- content 2 -->
	<div class="content-2">

		<div class="mdl-grid">
		  <div class="mdl-cell mdl-cell--3-col mdl-cell--hide-phone mdl-cell--hide-tablet">
			<ul class="demo-list-item mdl-list">
			  <li class="mdl-list__item">
			     <span class="mdl-list__item-primary-content">
			      <a href="<?php echo site_url('landing/index');?>">Beranda</a>
			    </span>
			  </li>
			  <li class="mdl-list__item">
			    <span class="mdl-list__item-primary-content">
			      <a href="<?php echo site_url('landing/tentang_kami');?>">Tentang Kami</a>
			    </span>
			  </li>
			  <li class="mdl-list__item">
			    <span class="mdl-list__item-primary-content">
			      <a href="<?php echo site_url('landing/member');?>">Member</a>
			    </span>
			  </li>
			  
			</ul>
		  </div>

		  <div class="mdl-cell mdl-cell--8-col mdl-cell--12-col-tablet mdl-cell--12-col-phone content-2-1">
			<div class="mdl-grid">
				<?php echo (isset($pesan))? $pesan : '';?>

			  	<?php echo (isset($halaman))? $halaman : '';?>
			  
			</div>
		  </div>

		</div>
	</div>
	<!-- / content 2 -->

	    </div>
	  </main>
	</div>
	<!-- / navbar -->

</body>

	<!-- JS -->
	<script type="text/javascript" src="<?php echo base_url('public/jquery/');?>jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('public/materialize/js/');?>material.min.js"></script>

</html>