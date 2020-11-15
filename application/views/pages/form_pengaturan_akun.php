<form action="<?php echo (isset($my['is']))? site_url($my['is'].'/submit_pengaturan_akun') : '#';?>" method="post">
	<div class="form-group">
		<label>Password Baru</label>
		<input type="password" name="password" class="form-control" />
	</div>
	<div class="form-group">
		<label>Konfirmasi Password baru</label>
		<input type="password" name="cpassword" class="form-control" />
	</div>
	<button type="submit" class="btn btn-primary" >Simpan</button>
</form>