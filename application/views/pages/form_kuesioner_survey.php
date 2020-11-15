<div class="container-fluid">
	<div class="page-header">
		<h3>
			Buat Kuesioner
			<br/><small >Berikan judul dan kuesioner yang mudah dipahami oleh peserta</small>
		</h3>
	</div>
<section class="card">
				<div class="card-block">
					<form action="<?php echo site_url('admin/simpan_kuesioner');?>" method="post">
					<div class="text-right">
						<a href="javascript:history.back(1);" class="btn btn-inline btn-warning-outline" style="margin-right: 0px;">Batal</a>
						<button type="submit" class="btn btn-inline btn-primary">Selanjutnya</button>
					</div>
					<fieldset class="form-group">
						<label>Judul Kuesioner</label>
						<input type="text" name="judul_kuesioner" class="form-control form-control-lg" style="height: auto;" id="" placeholder="Judul">
					</fieldset>
					<fieldset class="form-group">
						<label>Deskripsi Kuesioner</label>
						<textarea rows="4" class="form-control" name="deskripsi_kuesioner" placeholder="Berikan penjelasan singkat tentang kuesioner yang akan dipublikasikan"></textarea>
					</fieldset>
	
					</form>
				</div>
			</section>
</div>
	