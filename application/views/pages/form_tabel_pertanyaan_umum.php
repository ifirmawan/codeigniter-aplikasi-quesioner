<div class="container-fluid">
<div class="text-right" style="margin-top: 5px;">
  
<?php 
    $url_simpan_dulu    = 'akhiri_kuesioner';
    if(isset($nama_acara)){
      $url_simpan_dulu  = 'akhiri_acara';
    }?>
  <a href="<?php echo (isset($url_simpan_dulu))? site_url($my['is'].'/'.$url_simpan_dulu) : '#';?>" class="btn btn-inline btn-primary-outline" style="margin-right: 0px;">
  <i class="fa fa-save"></i>&nbsp;Simpan dulu</a>  
  <a href="<?php echo site_url('admin/menerbitkan_kuesioner');?>" class="btn btn-inline btn-success-outline" style="margin-right: 0px;">
  <i class="fa fa-cloud-upload"></i>&nbsp;Terbitkan</a>
</div>
	
<?php if(isset($materi_acara) && isset($instruktur_acara) && isset($ruang_acara) && isset($kapasitas_acara)) : ?>
  <div class="row">
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
  </div>
    
<?php else: ?>
  <div class="page-header">
    <h3>
        <?php echo (isset($judul_kuesioner))? $judul_kuesioner : '';?>
        <br/><small >
        <?php echo (isset($deskripsi_kuesioner))? $deskripsi_kuesioner : '';?>
      </small>
    </h3>
    </div>
<?php endif;?>
	
<?php if (isset($kues_id)) { ?>
	<form action="<?php echo site_url('admin/simpan_pertanyaan/'.$kues_id);?>" method="post" >
<?php } ?>

  <div class="row" style="padding-bottom: 10px;">
    <div class="col-xs-12">
      <input type="text" name="pertanyaan" class="form-control col-xs-12" placeholder="Pertanyaan" />
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-md-6 " style="padding-left:15px;">
        <input type="text" name="petunjuk_pertanyaan" class="form-control" placeholder="petunjuk pertanyaan">
    </div>
    <div class="col-xs-12 col-md-3" style="padding-bottom: 5px;">
      <select name="jenis_opsi" class="form-control col-xs-12">             
    <?php if(isset($jenis_opsi) && $jenis_opsi):
        foreach ($jenis_opsi as $key => $value) { ?>
        <option value="<?php echo $value;?>"><?php echo $value;?></option>
    <?php 
        }
      endif; ?>
      </select>
    </div>
    <div class="col-xs-12 col-md-1">Wajib&nbsp;<input type="checkbox" name="opsi_wajib" value="ya"></div>
    <div class="col-xs-12 col-md-2">
        <div class="text-right">
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </div>
  </div>
</form>
<div class="table-responsive">

<table class="display table table-striped table-bordered" cellspacing="0" width="100%">  
    <?php if (isset($kolom_tabel) && $kolom_tabel) {
     ?>
    <thead><tr>
    <?php  foreach ($kolom_tabel as $key => $value) { ?>
            <?php if(isset($hidden_kolom) && !in_array($key, $hidden_kolom)): ?>
              <th><?php echo $value;?></th>
            <?php elseif(!isset($hidden_kolom)) :  ?>
              <th><?php echo $value;?></th>
            <?php endif;  ?>
    <?php  } ?>
          <th><?php echo strtoupper('Tindakan');?></th>
    </tr></thead>
    <?php } ?>
  <?php if (isset($isi_tabel) && $isi_tabel) { ?>
    <tbody>
    <?php  foreach ($isi_tabel as $key => $value) { ?>
              <tr>
                <?php foreach ($kolom_tabel as $index => $column): ?>
                    <?php if(isset($hidden_kolom) && !in_array($index, $hidden_kolom)): ?>
                        <td><?php 
                          if (is_object($value)) {
                              echo (!is_null($value->$index))? $value->$index : '';
                          }elseif (is_array($value)) {
                              echo (isset($value[$index]))? $value[$index] : '';
                          }
                        ?></td>
                    <?php elseif(!isset($hidden_kolom)) :  ?>
                        <td><?php 
                          if (is_object($value)) {
                              echo (!is_null($value->$index))? $value->$index : '';
                          }else if (is_array($value)) {
                              echo (isset($value[$index]))? $value[$index] : '';
                          }
                        ?></td>
                    <?php endif;  ?>
                <?php endforeach; ?>
                <td>
                  <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <?php
                        if (isset($tombol_tindakan) && $tombol_tindakan) {
                          $tombol = '';
                          foreach ($tombol_tindakan as $key => $value) { 
                            $tombol .='<a class="btn '.$value['warna'].'" href="'.site_url($my['is'].'/'.$value['url'].'/'.$value[$primary_key]).'">'.$value['label'].'</a>';
                          }
                          echo $tombol;
                        }
                    ?>
                  </div>
                  <!-- Button trigger modal -->
<?php 
    if (!is_null($value->opsi_id)) {
          if ($opsi_pertanyaan  = get_induk_opsi($value->opsi_id)) {
           ?>
              <a class="btn btn-primary" role="button" data-toggle="collapse" 
              href="#collapse-<?php echo (!is_null($value->opsi_id))? $value->opsi_id : '0';?>" aria-expanded="false" aria-controls="collapse-<?php echo (!is_null($value->opsi_id))? $value->opsi_id : '0';?>">
              Lihat opsi
              </a>
<?php    }elseif ($value->jenis_opsi != 'teks') {
            echo  anchor($my['is'].'/buat_opsi/'.$value->opsi_id,'Buat opsi',array('class'=>'btn btn-primary'));
         }
    }
?>
                </td>
              </tr>    
              <?php  if (!is_null($value->opsi_id)) { 
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
              } ?>
    <?php   } ?>      
    </tbody>

    <?php } ?>
</table>  

</div>