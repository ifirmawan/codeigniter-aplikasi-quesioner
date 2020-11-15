<?php if(isset($tautan_unik)) : ?>
	<form action="<?php echo site_url('formulir/simpan_tanggapan/'.$tautan_unik);?>" method="post">
<?php endif; ?>
	<div class="container-fluid">
  	<div class="row" style="margin-top: 10px;">
		<div class="col-xs-12 col-md-4" >
		<div class="text-left">
		<p>
			<small>Terbit pada</small><br/>
			<?php if (!is_null($kuesioner->terbit_pada)) {
				echo time_to_human_format($kuesioner->terbit_pada);
			} ?>
		</p>
		</div>
	</div>
	<div class="col-xs-12 col-md-3">
		<?php if (isset($my['is']) && $my['is'] == 'admin'): ?>
			<div class="btn-group btn-group-sm col-xs-12" role="group">
				<a href="<?php echo site_url('formulir/index/'.$tautan_unik);?>"
				class="btn btn-warning-outline">
					Semua
				</a>
				<a href="<?php echo site_url('formulir/index/'.$tautan_unik.'/5');?>"
				class="btn btn-primary-outline">
					Pengguna
				</a>
				<a href="<?php echo site_url('formulir/index/'.$tautan_unik.'/4');?>"
				 class="btn btn-default-outline">
					Pakar
				</a>
  			</div>
  		<?php elseif(isset($respons) && $respons) : ?>
  			<div class="pull-right" style="margin-right: 10px;">
  			<h4 class="text-left">
				Hai <?php echo $respons['nama_peserta'];?>
				<br/><small><?php echo $respons['email_peserta'];?></small>
			</h4>
		</div>
		<?php endif; ?>
	</div>
	<div class="col-xs-12 col-md-5">
		<div class="text-right">

<?php if(isset($my['is']) && $my['is'] == 'admin' && !is_null($kuesioner->kues_id)) : ?>
			<a href="<?php echo site_url($my['is']);?>" class="btn btn-inline btn-default">Kembali</a>

   			<a href="<?php echo site_url('admin/edit_kuesioner/'.$kuesioner->kues_id);?>" class="btn 	btn-inline btn-default-outline" ><i class="fa fa-pencil"></i>&nbsp;Edit </a>
<?php else :?>
		<a href="<?php echo site_url('formulir/akhiri_respons');?>" class="pull-right btn-confirm btn btn-inline btn-danger" >
	  		<i class="fa fa-remove"></i>&nbsp;Batal
	  	</a>
<?php endif; ?>
 		<button type="submit" class="pull-right btn btn-inline btn-primary" >
	  		<i class="fa fa-send"></i>&nbsp;Kirim
	  	</button> 


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
  <?php 
  if (isset($group_id)) {
	  $konteks ='semua';
	  switch ($group_id) {
		case '4':
		  $konteks ='pakar';
		  break;
		case '5':
		  $konteks ='pengguna';
		  break;
	  }
	  echo '<h4>'.ucwords('pertanyaan untuk '.$konteks).'</h4>';
  }
?>
  <div class="row">
	<div class="col-xs-12">
		
<?php if(isset($opsi_kuesioner) && $opsi_kuesioner) : ?>
			<?php 
			$no =1;
foreach ($opsi_kuesioner as $key => $value) : ?>
	<section class="card">
		<header class="card-header card-header-lg">
					<?php echo $no.'. '.$value->pertanyaan;?>
					<br/><small><?php echo $value->petunjuk_pertanyaan;?></small>
		</header>
				<div class="card-block">
						<strong style="color: #FF0000">
			<?php 
			if (!is_null($value->opsi_wajib) && $value->opsi_wajib == 'ya') {
				echo ucfirst('* wajib dijawab<br/>');
			} ?>
			</strong>
			<?php
			  $data   = get_induk_opsi($value->opsi_id);

			  switch ($value->jenis_opsi) {
				case 'check':
				case 'radio':
				  render_opsi_radio_check_html($data,$value->jenis_opsi,$value->opsi_id);
				  break;
				case 'dropdown':
				  render_opsi_dropdown_html($data,$value->opsi_id);
				  break;
				case 'deskriptif':
				  echo '<textarea rows="5" name="isi_tanggapan['.$value->opsi_id.']" class="form-control col-xs-12" placeholder="'.$value->petunjuk_pertanyaan.'"></textarea>';
				  break;
				case 'level':
				  render_opsi_level_html($value->opsi_id);
				  break;
				default:
				  echo '<input type="text" name="isi_tanggapan['.$value->opsi_id.']" class="form-control col-xs-12" placeholder="'.$value->petunjuk_pertanyaan.'" />';
				  break;
			  }
			  $no++;
			?>
				</div>
		</section>
			
<?php endforeach; ?>
<?php else: ?>
	<h3>Maaf, pertanyaan belum tersedia. silahkan hubungi admin <a href="mailto:firmawaneiwan@gmail.com">disini</h3>
<?php endif; ?>
		
	</div>
  </div>
</div>
</form>