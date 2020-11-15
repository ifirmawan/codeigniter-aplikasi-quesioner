<div class="container-fluid">
	<div class="page-header">
    <h3>
      <small>Buat opsi untuk pertanyaan</small><br/>
      <?php echo (isset($pertanyaan))? $pertanyaan : '';?>
    </h3>
	</div>
<?php if (isset($opsi_id)) { ?>
	<form action="<?php echo site_url('pertanyaan/simpan_opsi/'.$opsi_id);?>" method="post" >
<?php } ?>
  <div class="row" style="padding-bottom: 10px;">
    <div class="col-xs-9">
      <input type="text" name="kalimat_opsi" class="form-control col-xs-12" placeholder="Berikan kalimat opsi" />
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="text-right">
          <button type="submit" class="btn btn-inline btn-primary">Tambah</button>
          <?php if(isset($kues_id)): ?>
            <a href="<?php echo site_url('pertanyaan/index/'.$kues_id);?>" class="btn btn-inline btn-success-outline" style="margin-right: 0px;">
          <i class="glyphicon glyphicon-ok"></i>&nbsp;Cukup</a>
          <?php endif;?>
        </div>
    </div>
  </div>
</form>
<table id="my-table" class="display table table-striped table-bordered" cellspacing="0" width="100%">  
    <?php if (isset($kolom_tabel) && $kolom_tabel) {
     ?>
    <thead><tr>
            <?php 
            $icon ='';
            if(isset($jenis_opsi)):
                $icon_jenis['check']    ='fa fa-square-o';
                $icon_jenis['radio']    ='fa fa-circle-o';
                $icon_jenis['dropdown'] ='fa fa-chevron-right'; 
                $icon                   = (isset($icon_jenis[$jenis_opsi]))? $icon_jenis[$jenis_opsi] : ''; ?>
            <th>
              <i class="<?php echo $icon;?>"></i>
            </th>
          <?php endif; ?>
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
                <?php if(isset($icon)) :?>
                  <td>
                      <i class="<?php echo $icon;?>"></i>
                  </td>
                <?php endif; ?>
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
                            $tombol .='<a class="btn '.$value['warna'].'" href="'.site_url('pertanyaan/'.$value['url'].'/'.$value[$primary_key]).'">'.$value['label'].'</a>';
                          }
                          echo $tombol;
                        }
                    ?>




                  </div>
                </td>
              </tr>
    <?php   } ?>
    </thead>
    <?php } ?>
</table>