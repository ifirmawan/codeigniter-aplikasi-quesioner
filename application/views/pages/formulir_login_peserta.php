<div class="container-fluid">
  <div class="row" style="margin-top: 10px;">
	<div class="col-xs-12 col-md-6" >
		<div class="text-left">
<p>
	<small>Terbit pada</small><br/>
	<?php echo (isset($kuesioner) && !is_null($kuesioner->terbit_pada))? time_to_human_format($kuesioner->terbit_pada) : 'tidak tersedia';?>
</p>
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div class="text-right">
			<a href="#" class="btn btn-inline btn-primary-outline" >
			   <i class="fa fa-share"></i>&nbsp;Bagikan</a>  
		</div>
	</div>
  </div>
  <div class="row">
	<div class="col-xs-12">
		<div class="">
			<?php if (isset($kuesioner) && $kuesioner) { ?>
						<h3>
<?php echo (!is_null($kuesioner->judul_kuesioner))?  ucwords($kuesioner->judul_kuesioner) : '';?><br/>
<small><?php echo (!is_null($kuesioner->deskripsi_kuesioner))? $kuesioner->deskripsi_kuesioner : 'tidak tersedia';?></small><br/>
						</h3>
			<?php } ?>
		</div>
	</div>
  </div>

  <div class="row">
	<div class="col-xs-12">
	  <section class="card">
			<header class="card-header card-header-lg">
			  <nav class="nav nav-pills nav-justified">
<a class="nav-item nav-link <?php echo ((isset($group_id) && $group_id!=4) || $group_id == 5)? 'active': '' ;?>" 
 href="<?php echo site_url('formulir/index/'.$tautan_unik.'/5');?>">Pengguna</a>
<a class="nav-item nav-link <?php echo (isset($group_id) && $group_id == 4)? 'active':'' ;?>" 
 href="<?php echo site_url('formulir/index/'.$tautan_unik.'/4');?>">Pakar</a>
			  </nav>
			</header>
			<div class="card-block">
			  <?php echo (isset($form_login))? $form_login : '';?>
			</div>
	  </section>
	</div>
  </div>
</div>


