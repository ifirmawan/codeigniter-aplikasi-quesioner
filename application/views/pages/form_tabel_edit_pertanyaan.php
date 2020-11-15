<div class="container" style="margin-top:25px;">
  	<div class="page-header">
		<h3>
			<?php echo (isset($judul_kuesioner))? $judul_kuesioner : '';?> <br/>
			<small >
				<?php echo (isset($deskripsi_kuesioner))? $deskripsi_kuesioner : '';?>
	  		</small>
		</h3>
	</div>
	<?php if (isset($kues_id)) { ?>
		<form action="<?php echo site_url('pertanyaan/update_pertanyaan/'.$pertanyaan->opsi_id);?>" method="post" >
	<?php } ?>
	<div class="row" style="padding-bottom: 10px;">
		<div class="col-xs-12">
	  		<label>Kalimat pertanyaan</label>
	  		<input type="text" name="pertanyaan" class="form-control col-xs-12" placeholder="Pertanyaan" value="<?php echo $pertanyaan->pertanyaan ?>" name="pertanyaan" />
		</div>
  	</div>
  	<div class="row">
	
	<div class="col-xs-12 col-md-3" style="padding-bottom: 5px;">
	  	<label>Jenis opsi</label>
	  	<select name="jenis_opsi" class="form-control col-xs-12">             
		<?php if(isset($jenis_opsi) && $jenis_opsi):
			foreach ($jenis_opsi as $key => $value) { 
				if($value == $pertanyaan->jenis_opsi){ ?>
				<option value="<?php echo $value;?>" selected="selected"><?php echo $value;?></option>
				<?php }else{ ?>
				<option value="<?php echo $value;?>"><?php echo $value;?></option>
				<?php } ?>	
		<?php
			} endif;
	  	 ?>
	  	</select>
	</div>

	<div class="col-xs-12 col-md-1">
		<label>Wajib?</label>&nbsp;
		<?php if($pertanyaan->opsi_wajib == "ya"){ ?>
		<input type="checkbox" name="opsi_wajib" value="ya" checked="checked">
		<?php }else{ ?>
		<input type="checkbox" name="opsi_wajib" value="ya">
		<?php } ?>
	</div>
  	</div>
  		<div class="text-right" style="margin-top: 5px;">  
	  		<button type="submit" class="btn btn-inline btn-success-outline" style="margin-right: 0px;">
	  		<i class="fa fa-cloud-upload"></i>&nbsp;Perbaharui Pertanyaan
	  		</button>
		</div>
</form>