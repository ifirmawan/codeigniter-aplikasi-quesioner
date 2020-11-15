<a style="margin-bottom: 5px;" href="javascript:history.back(1);" class="btn btn-default"><i class="fa fa-arrow-left"></i>&nbsp;Kembali </a>
<?php
  if (isset($konteks_tanggapan) && isset($detail_kuesioner)) {
      if (!is_null($detail_kuesioner->judul_kuesioner)) {  ?>
         <h3>
           <?php echo $detail_kuesioner->judul_kuesioner;?><br/>
           <small><?php echo ucwords($konteks_tanggapan);?></small>
         </h3> 
  <?php  }
  }
?>
	<?php

if (isset($pertanyaan) && $pertanyaan)
{
	foreach ($pertanyaan as $key => $value) {
		if (is_object($value)) { ?>
		<div class="card">
  <div class="card-header">
    <h3><?php echo (!is_null($value->pertanyaan))? $value->pertanyaan : '';?></h3>
  </div>
  <div class="card-block">
     <p>
      <?php echo (!is_null($value->petunjuk_pertanyaan))? $value->petunjuk_pertanyaan : '';?>
      </p>
<div class="ques-pie" id="<?php echo (!is_null($value->opsi_id))? 'p-'.$value->opsi_id : '';?>" 
      >
        
</div>

  </div>
  <div class="card-footer text-muted">
    <div class="text-right" style="padding: 10px;">
    	<a href="#" class="btn btn-primary">Lihat Rincian</a>
    </div>
  </div>
</div>

		<?php }
	}
} ?>
