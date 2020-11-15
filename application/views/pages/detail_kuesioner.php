<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<?php
				$label['konsep']  = 'label-primary';
				$label['terbit']  = 'label-success';
				$label['tutup']   = 'label-danger';
				$label_status     = 'label-default';
				if (isset($status_kuesioner)) {
						$label_status = $label[$status_kuesioner];
				}
			?>
			<strong>Status Kuesioner</strong>
			<h4 class="label <?php echo $label_status;?> col-xs-12 text-left">
				<?php echo (isset($status_kuesioner))? ucfirst($status_kuesioner) : '';?>
			</h4>
		</div>
		<div class="col-xs-12 col-md-6">
		<div class="text-right">
		<a href="javascript:history.back(1);" class="btn btn-inline btn-default-outline" style="margin-right: 0px;">Kembali</a>
		<a href="<?php echo site_url('admin/hapus_kuesioner/'.$kues_id);?>" class="btn btn-inline btn-danger-outline btn-confirm" >
		<i class="fa fa-trash"></i>
		Hapus</a>
		<a href="<?php echo site_url('admin/edit_kuesioner/'.$kues_id);?>" class="btn btn-inline btn-primary-outline" >Edit</a>
<?php 
	if(isset($kues_id) && isset($status_kuesioner)) :

		if ($status_kuesioner == 'terbit' && isset($tautan_kuesioner)) {
			$opsi_terbit = anchor('#','<i class="fa fa-copy"></i>&nbsp;Salin tautan',array('class'=>'btn btn-inline btn-default-outline'));
			$opsi_terbit .= anchor($tautan_kuesioner,'<i class="fa fa-eye"></i>&nbsp;Pratinjau',array('class'=>'btn btn-inline btn-primary'));
			echo $opsi_terbit;
		}
	endif;
 ?>
</div>
		</div>
	</div>
	<div class="row">
		<?php if(!is_null($materi_acara) && !empty($materi_acara)): ?>
		 <div class="col-xs-12 col-md-4">
				<h4>
					<small>Judul Kuesioner acara</small><br/>
				<?php echo (isset($judul_kuesioner))? $judul_kuesioner : '';?><br/>
				<small>Deskripsi</small><br/>
				<?php echo (isset($deskripsi_kuesioner))? $deskripsi_kuesioner : '';?>
				</h4>
		</div>
		<div class="col-xs-12 col-md-4">
			<h4>
			<small>Materi</small><br/><?php echo $materi_acara;?><br/>
			<small>Instruktur</small><br/>&nbsp;<?php echo $instruktur_acara;?><br/>
		</h4>  
		</div>
		<div class="col-xs-12 col-md-4">
				 <h4><?php echo '<small>Ruang</small><br/>'.$ruang_acara.'<br/><small>Kapasitas</small><br/>'.$kapasitas_acara;?></h4>
		</div>
		<?php else: ?>
<div class="col-xs-12">
		<h4>
			<small>Judul Kuesioner </small><br/>
			<?php echo (isset($judul_kuesioner))? $judul_kuesioner : '';?><br/>
			<small><i>"<?php echo (isset($deskripsi_kuesioner))? $deskripsi_kuesioner : '';?>"</i></small>
		</h4>
					<p>
				
			</p>
		<h5>
			<small>Dibuat pada</small><br/>
			<?php echo (isset($dibuat_pada))? show_date_human_format($dibuat_pada,true) : '';?>
		</h5>
</div>
		<?php endif; ?>
	</div>
	<?php echo (isset($datatables))? $datatables : '';?>
</div>
