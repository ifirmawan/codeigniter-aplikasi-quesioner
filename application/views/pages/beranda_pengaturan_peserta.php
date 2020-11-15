<h3>Pengaturan</h3>
<div class="row">
    <div class="col-lg-12">
    	<div style="width: 50%; margin: 0 auto;">
    	<?php echo form_open('peserta/update_pengaturan_peserta'); ?>
        <div class="form-group row">
            <div class="col-md-4">
                <label class="form-control-label" for="l0">Username</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Nama lengkap" name="username" value="<?php echo $data_user['username']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label class="form-control-label" for="l0">Password baru</label>
            </div>
            <div class="col-md-8">
                <input type="password" class="form-control" placeholder="password" name="password">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label class="form-control-label" for="l0">Ulangi Password</label>
            </div>
            <div class="col-md-8">
                <input type="password" class="form-control" placeholder="password" name="c_password">
            </div>
        </div>
			<div class="form-actions">
			    <div class="form-group row">
			        <div class="col-md-8 col-md-offset-4">
			            <button type="submit" class="btn width-150 btn-primary">Update</button>
			        </div>
			    </div>
			</div> 
			<?php echo form_close(); ?>
		</div>
    </div>
</div>