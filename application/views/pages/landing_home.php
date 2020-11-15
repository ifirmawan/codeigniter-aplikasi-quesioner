<?php
	if (isset($kuesioner) && $kuesioner) :
		foreach ($kuesioner as $key => $value) : ?>
		<div class="demo-card-event mdl-card mdl-shadow--2dp">
  		<div class="mdl-card__title mdl-card--expand">
    		<h4>
      			<?php echo (!is_null($value->judul_kuesioner))? ucwords($value->judul_kuesioner) : 'Tidak ada judul';?><br>
      			<p>
      			<?php echo (!is_null($value->deskripsi_kuesioner))? substr($value->deskripsi_kuesioner, 0,125) : '';?></p> ...
      			<br/>
      			<small>
      				<?php echo (!is_null($value->terbit_pada))? time_to_human_format($value->terbit_pada) : '' ;?>
      			</small>

    		</h4>
    		
  			</div>
  			<div class="mdl-card__actions mdl-card--border">
  				<?php if (isset($value->tautan_kuesioner)) : ?>
    			<a href="<?php echo $value->tautan_kuesioner;?>" 
    				class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" target="_blank">
      				Tanggapi
    			</a>
    			<?php endif; ?>
    <!--			<div class="mdl-layout-spacer"></div>
    			<i class="material-icons" id="event-reminder">event</i>
    <div class="mdl-tooltip" data-mdl-for="event-reminder">
		Jadi Jadwal <strong>file.zip</strong>
	</div>-->
  			</div >
		</div>
		
<?php	endforeach;
	
	else :

	endif;
?>

