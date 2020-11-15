            <div class="input-daterange">
              <div class="row">
                
                <div class="col-md-2">
                <!--<fieldset class="form-group">
                  <label class="form-label semibold" for="exampleInput">Dibuat dari tanggal</label>
                     <input type="text" id="min-date" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" placeholder="From:">

                </fieldset>-->
              </div>
                <div class="col-md-2">
                <!--<fieldset class="form-group">
                  <label class="form-label semibold" for="exampleInput">Sampai tanggal</label>
                     <input type="text" id="max-date" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" placeholder="To:" style="height: 35px;">
                </fieldset>-->
              </div>
                <div class="col-md-8 text-right" style="margin-top: 25px;">
                  <?php if(isset($toolbar_tabel) && $toolbar_tabel) : 
                    foreach ($toolbar_tabel as $key => $value) { ?>
<a href="<?php echo site_url($my['is'].'/'.$value);?>" class="btn btn-default btn-inline">
<?php $tombol=str_replace('_', ' ', $value);echo strtoupper($tombol);?></a>
                  <?php  }
                   endif;?>
              </div>              
            </div>
            </div>
<table id="my-table" class="display table table-striped table-bordered" cellspacing="0" width="100%">
  
    <?php if (isset($kolom_tabel) && $kolom_tabel) {
     ?>
    <thead><tr>
    <?php  foreach ($kolom_tabel as $key => $value) { ?>
            	<?php if(isset($hidden_kolom) && !in_array($key, $hidden_kolom)): ?>
              		<th><?php echo $value;?></th>
            	<?php elseif(!isset($hidden_kolom)) :  ?>
              		<th><?php echo $value;?></th>
            	<?php endif;  
            }
            if (isset($tombol_tindakan) && is_array($tombol_tindakan) && isset($primary_key)) { 
				echo '<th>'.strtoupper('Tindakan').'</th>';
            }
       ?>
          
    </tr></thead>
    <?php } ?>
  <?php if (isset($isi_tabel) && $isi_tabel) { ?>
    <tbody>
    <?php  

    foreach ($isi_tabel as $key => $value) {

     ?>
              <tr>
                <?php foreach ($kolom_tabel as $index => $column): ?>

                    <?php if (!is_object($value) && isset($value[$column])) : ?>
                        <td><?php echo $value[$column];?></td>
            <?php elseif(isset($hidden_kolom) && !in_array($index, $hidden_kolom)): ?>
                        <td><?php 
                          if (is_object($value)) {
                              if (!is_null($value->$index)) {
                                $output = '';
                                switch ($index) {
                                  case 'created_on':
                                  case 'submit_pada':
                                  case 'terbit_pada':
                                    $output  = time_to_human_format($value->$index);
                                    break;
                                  case 'kues_id':
                                    $output  = get_judul_kuesioner($value->$index);
                                    break;
                                  case 'peserta_id':
                                    $output  = get_nama_peserta($value->$index);
                                    break;
								 case 'group_id':
								 	$output  = get_group_name($value->$index);
								 	break;	
                                  default:
                                    $output  = ucfirst($value->$index);
                                    break;
                                }
                                echo $output;
                              }
                          }elseif (is_array($value)) {
                              echo (isset($value[$index]))? $value[$index] : '';
                          }
                        ?></td>
                    <?php 
                    elseif(!isset($hidden_kolom)) :  ?>
                        <td><?php 
                          if (is_object($value)) {
                              echo (!is_null($value->$index))? $value->$index : '';
                          }else if (is_array($value)) {
                              echo (isset($value[$index]))? $value[$index] : '';
                          }
                        ?></td>
                    
                      
                    <?php endif;  ?>
                    
                <?php endforeach; ?>
                    <?php
						/**
						* jika tombol tidak muncul maka controller tidak 
						* mengirimkan variable @param primary_key
						**/
                        if (isset($tombol_tindakan) && is_array($tombol_tindakan) && isset($primary_key)) { 
                          
                          $tombol = '<td><div class="btn-group btn-group-sm" role="group" aria-label="...">';
                          $primary_value = (is_object($value))? $value->$primary_key : $value[$primary_key];
                          foreach ($tombol_tindakan as $k => $act) {
                         	
                            $tombol .='<a class="btn '.$act['warna'].'" href="'.site_url($my['is'].'/'.$act['url'].'/'.$primary_value).'">'.$act['label'].'</a>';
                          }                      
                          $tombol .='</div></td>';
                          echo $tombol;
                        }
                    ?>
                  
              </tr>
    <?php   } ?>
    </thead>
    <?php } ?>
</table>