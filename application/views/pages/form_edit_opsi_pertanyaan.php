<?php if (isset($opsi)) :  ?>

<form action="<?php echo site_url('pertanyaan/update_opsi/'.$opsi->opsi_id);?>" method="post" class="form">
	<div class="form-group">
		<label><?php echo ucfirst('pertanyaan');?></label>
		<input type="text" name="pertanyaan" class="form-control" value="<?php echo $opsi->pertanyaan;?>" >
	</div>
 	<div class="form-group">
		<label><?php echo ucfirst('Kategori usability');?></label>
		<input type="text" name="petunjuk_pertanyaan" class="form-control" value="<?php echo $opsi->petunjuk_pertanyaan;?>" >
	</div>
<?php
	
	$child_options = get_induk_opsi($opsi->opsi_id);
	if ($child_options) {
		echo '<h3>'.ucwords('opsi '.$opsi->jenis_opsi).'</h3>';
		foreach ($child_options as $key => $value) { ?>
			<?php if($opsi->jenis_opsi == 'check') : ?>
				<i class="fa fa-square-o " ></i>
			<?php else: ?>
				<i class="fa fa-circle-o" ></i>
			<?php endif; ?>
				<input type="text" name="<?php echo 'opsi_id['.$value->opsi_id.']';?>" 
			placeholder="<?php echo $value->kalimat_opsi;?>" class="form-control col-11" 
			value="<?php echo $value->kalimat_opsi;?>"
			 />
		<?php }
	}
	
?>
	<a href="javascript:history.back(1);" class="btn btn-inline btn-default-outline" style="margin-right: 0px;">Kembali</a>
<button type="submit" class="btn btn-primary" style="margin-right: 0px;"><?php echo ucfirst('simpan');?></button>
</form>
<?php endif;?>