<div class="container" style="margin-top:25px;">



	<div class="text-left" style="float: left;">
		 <h3 style="margin-bottom: 35px;">
			<?php echo (isset($judul_kuesioner))? $judul_kuesioner : '';?> <br/>
			<small style="font-size: 0.6em;">
				<?php echo (isset($deskripsi_kuesioner))? $deskripsi_kuesioner : '';?>
				</small>
		</h3>
    </div>
	<div class="text-right">
  		<a class="btn btn-primary margin-inline" data-toggle="modal" data-target="#tambah_pertanyaan">
            Tambah Pertanyaan
        </a>
  		<a href="<?php echo site_url('pertanyaan/akhiri_kuesioner');?>" class="btn btn-primary-outline margin-inline"
  			<i class="fa fa-save"></i>&nbsp;Simpan dulu
  		</a>  
  		<a href="<?php echo site_url('pertanyaan/di_terbitkan');?>" class="btn btn-success-outline margin-inline">
  		<i class="fa fa-cloud-upload"></i>&nbsp;Terbitkan
  		</a> 		
	</div>

    <div class="modal fade" id="tambah_pertanyaan" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Pertanyaan</h4>
                </div>
                <div class="modal-body">
					<?php if (isset($kues_id)) { ?>
						<form action="<?php echo site_url('pertanyaan/di_simpan/'.$kues_id);?>" method="post" >
					<?php } ?>
					<div class="row" style="padding-bottom: 10px;">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="form-group">
							  		<label>Kalimat pertanyaan</label>
							  		<input type="text" name="pertanyaan" class="form-control" placeholder="Pertanyaan" />
							  	</div>
							</div>

					  	<?php if(isset($user_group) && is_array($user_group)) : ?>
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
								<label>Pertanyaan Untuk</label>
								<select class="form-control" name="group_id">
								<?php
									$option ='<option value="0">'.ucfirst('pilih salah satu').'</option>';
									foreach ($user_group as $key => $value) { 
											$option .='<option value="'.$value['id'].'">'.ucfirst($value['name']).'</option>';
									}
									echo $option;
								?>
								</select>
								</div>
							</div>
					  	<?php endif; ?>

						<div class="col-xs-12 col-md-6" style="padding-bottom: 5px;">
							<div class="form-group">
						  	<label>Jenis opsi</label>
						  	<select name="jenis_opsi" class="form-control">             
							<?php if(isset($jenis_opsi) && $jenis_opsi):
								foreach ($jenis_opsi as $key => $value) { ?>
									<option value="<?php echo $value;?>"><?php echo $value;?></option>
							<?php 
								}
						  	endif; ?>
						  	</select>
						  	</div>
						</div>

						<div class="col-xs-6 col-md-6">
							<div class="form-group">
				  
				                    <label>
				                        <input type="checkbox" name="opsi_wajib" value="ya">
				                        Pertanyaan wajib diisi ?
				                    </label>
				          
				            </div>
						</div>

					  	</div>
				  	</div>
				</form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn">Tambah Pertanyaan</button>
                </div>
            </div>
        </div>
    </div>

<div class="table-responsive">
	<table class="display table table-striped table-bordered" cellspacing="0" width="100%">  
	<?php if (isset($kolom_tabel) && $kolom_tabel) { ?>
  		<thead>
	  	<tr>
			<?php  
				foreach ($kolom_tabel as $key => $value) { 
					if (isset($hidden_kolom) && !in_array($key, $hidden_kolom)) {
						echo '<th style="text-align:center;">'.$value.'</th>';
					}elseif (!isset($hidden_kolom)) {
						echo '<th style="text-align:center;">'.$value.'</th>';
					}
				} 
				echo '<th style="text-align:center;">'.strtoupper('Tindakan').'</th>';
			?>
		</tr>
		</thead>
	<?php } ?>

	<?php if (isset($isi_tabel) && $isi_tabel) { ?>
		<tbody>
			<?php  foreach ($isi_tabel as $key => $value) {
					echo '<tr class="text-center">';
						foreach ($kolom_tabel as $key_kolom => $value_kolom) {
							if (isset($hidden_kolom) && !in_array($key_kolom, $hidden_kolom)) {
								echo '<td>'.$value->$key_kolom.'</td>';
							}elseif (!isset($hidden_kolom)) {
								echo '<td>'.$value->$key_kolom.'</td>';
							}
						}
						echo '<td>';
						echo '<div class="btn-group btn-group-sm" role="group" >';
							if (isset($tombol_tindakan) && $tombol_tindakan) {
						  		$tombol = '';
						  		foreach ($tombol_tindakan as $key_tindakan => $value_tindakan) { 
						  			$tombol .= anchor(
						  					'pertanyaan/'.$value_tindakan['url'].'/'.$value->opsi_id,
						  					$value_tindakan['label'],
						  					array(
						  						'class'=>'btn '.$value_tindakan['warna']
						  					)
						  				);
						  		}
						  		echo $tombol;
						  	}

						  	if (!is_null($value->opsi_id)) {
									if ($opsi_pertanyaan  = get_induk_opsi($value->opsi_id)) {
										$collapse_button  = '<a class="btn btn-default" ';
										$collapse_button .='role="button" data-toggle="collapse" ';
 										$collapse_button .='href="#collapse-'.$value->opsi_id.'" ';
 										$collapse_button .='aria-expanded="false" '; 
 										$collapse_button .='aria-controls="collapse-'.$value->opsi_id.'">';
 										$collapse_button .=ucwords('lihat opsi').'</a>';
 										echo $collapse_button;
									}

								if (!in_array($value->jenis_opsi, array('teks','deskriptif','level'))) {
									echo anchor(
										'pertanyaan/buat_opsi/'.$value->opsi_id,
										'Buat opsi',
										array('class'=>'btn btn-primary')
									);
		 						}
		 					}
						echo '</div>';	
						echo '</td>';
					echo '</tr>';	
					if (!is_null($value->opsi_id)) { 
						if ($opsi_pertanyaan  = get_induk_opsi($value->opsi_id)) {
							$collapse ='<tr class="collapse" id="collapse-'.$value->opsi_id.'">';
		 					$icon_jenis['check']    ='fa fa-check-square';
		 					$icon_jenis['radio']    ='fa fa-circle-o';
		 					$icon_jenis['dropdown'] ='fa fa-chevron-right'; 
		 					$collapse .='<td></td><td colspan="4">';
		 				foreach ($opsi_pertanyaan as $key_opsi => $value_opsi) { 
		 					$collapse .='<i class="'.$icon_jenis[$value->jenis_opsi].'"></i>&nbsp;';
		 					$collapse .=$value_opsi->kalimat_opsi.'<br/>';
		 				}
		 				$collapse .='</td></tr>';
		 				echo $collapse;
						}
					} 
				} ?>      
		</tbody>
	<?php } ?>

</table>  

</div>
</div>