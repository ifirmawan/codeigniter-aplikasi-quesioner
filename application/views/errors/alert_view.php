<div class="alert alert-<?php echo (isset($status))? $status : '';?> 
alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  	<span aria-hidden="true">&times;</span></button>
  	<?php echo (isset($pesan))? $pesan : '';?>
</div>