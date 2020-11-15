<div class="container-fluid">
	<div class="page-header">
		<h3>
			<small>Anda sedang membuat acara </small><br/>
			<?php echo (isset($nama_acara))? $nama_acara : '';?>
		</h3>
		<p>
			<?php echo (isset($deskripsi_kuesioner))? $deskripsi_kuesioner : '';?>
		</p>
		<?php if(isset($dibuat_pada)): ?>
		<h4>
			<small>Yang dibuat pada</small><br/>
			<?php echo show_date_human_format($dibuat_pada,true);?>
		</h4>
		<?php endif;?>
	</div>
	<section class="card">
		<div class="card-block">
			<div class="text-center">
		<a href="<?php echo site_url('admin/akhiri_acara');?>" class="btn btn-confirm-link btn-inline btn-danger-outline" >Akhiri</a>
<?php if(isset($kues_id)) : ?>
		<a href="<?php echo site_url('admin/buat_pertanyaan/'.$kues_id);?>" class="btn btn-inline btn-primary-outline" >Lanjutkan</a>
<?php endif; ?>
			</div>
		</div>
	</section>
</div>