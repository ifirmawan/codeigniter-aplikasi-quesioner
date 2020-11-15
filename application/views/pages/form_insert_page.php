<form action="<?php echo (isset($property['aksi_form']))? $property['aksi_form'] : '';?>" method="post">
<aside class="profile-side">
		<section class="box-typical">
							<header class="box-typical-header-sm bordered">
								<div class="row">
									<div class="col-md-6">
									<h4 style="margin: 0px; padding-top:8px;">
<?php echo (isset($property['judul_form']))? $property['judul_form'] : '';?>
									</h4>
									</div>
									<div class="col-md-6 text-right">
									<button type="submit" class="btn btn-inline btn-primary" style="margin: 0px;">Simpan</button>
									</div>
								</div>
							</header>
						
	<div class="container-fluid" style="margin: 20px 0px;">
<?php if(isset($bidang) && $bidang) : 
	foreach ($bidang as $key => $value) { ?>
		<fieldset class="form-group">
			<label class="form-label semibold" for=""><?php $label = str_replace('_', '', $value); echo $label;?></label>
			<input type="text" class="form-control" name="<?php echo $value;?>">
		</fieldset>
<?php } ?>
<?php endif; ?>

	</div>
</section>

</aside><!--.profile-side-->
</form>