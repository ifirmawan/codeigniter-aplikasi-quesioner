<div class="container-fluid">
	<div class="page-header">
		<h3>
			Tambah acara
			<br/><small >Acara yang memerlukan kuesioner</small>
		</h3>
	</div>
<section class="card">
				<div class="card-block">
				<form action="<?php echo site_url('admin/simpan_acara');?>" method="post">
					<div class="text-right">
						<a href="" class="btn btn-inline btn-primary-outline" style="margin-right: 0px;">Batal</a>
						<button type="submit" class="btn btn-inline btn-primary">Selanjutnya</button>
					</div>
					<fieldset class="form-group">
						<label>Instruktur</label>
						<select name="instruktur_acara" class="form-control">
							<option value="0">Pilih instruktur</option>
							<?php 
							if(isset($instruktur)):
							foreach ($instruktur as $key => $value) { ?>
								<option value="<?php echo $key;?>"><?php echo $value;?></option>
							<?php } 
							endif; ?>
						</select>
					</fieldset>
					<fieldset class="form-group">
						<label>Nama acara</label>
						<input type="text" name="nama_acara" class="form-control form-control-lg" style="height: auto;" placeholder="Nama / Tema Acara">
					</fieldset>
					<fieldset class="form-group">
						<label>Deskripsi Kuesioner</label>
						<textarea rows="4" class="form-control" name="deskripsi_kuesioner" placeholder="Berikan penjelasan singkat tentang kuesioner yang akan dipublikasikan"></textarea>
					</fieldset>
					<fieldset class="form-group">
						<span class="col-md-6">
						<label>Waktu pelaksanaan</label>
						<input name="waktu_acara" type="date" class="form-control datepicker" placeholder="Waktu pelaksanaan acara" style="height: auto;"/>
						</span>
						<span class="col-md-6">
							<label>Materi Kuesioner</label>
							<input type="text" name="materi_acara" class="form-control form-control-lg" style="height: auto;" placeholder="Materi kuesioner" />	
						</span>
					</fieldset>
					<fieldset class="form-group">
						<span class="col-md-10">
							<label>Ruang kuesioner</label>
							<input type="text" name="ruang_acara" class="form-control form-control-lg" style="height: auto;" placeholder="Ruang kuesioner">	
						</span>
						<span class="col-md-2">
							<label>Kapasitas</label>
							<input type="number" name="kapasitas_acara" class="form-control form-control-lg" style="height: auto;" placeholder="Jumlah ">
						</span>
						
					</fieldset>
				</form>
				</div>
			</section>
</div>
	