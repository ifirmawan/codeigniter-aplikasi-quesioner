<?php

/*if (isset($detail) && $detail) { 
	foreach ($detail as $key => $value) { ?>
		<h3>
			<small><?php echo set_label_form($key);?></small><br/>
			<?php  echo $value; ?>
		</h3>
<?php	}

}*/
?>
<form action="#" method="post">
<div class="row">
	<div class="col">
		<div class="text-right">
			<a href="#"><i class="fa fa-pencil"></i> &nbsp;Edit</a>
		</div>
	</div>
</div>
<div class="row" style="padding: 15px;">
	<div class="col-6">
			<h4>
				<small><?php echo set_label_form('real_name');?></small><br/>
				<?php echo (isset($detail['real_name']))? ucfirst($detail['real_name']) : '';?>
			</h4>
			<h4>
				<small><?php echo set_label_form('username');?></small><br/>
				<?php echo (isset($detail['username']))? ucfirst($detail['username']) : '';?>
			</h4>
	</div>
	<div class="col-6">
		<h4>
			<small><?php echo set_label_form('email');?></small><br/>
			<?php echo (isset($detail['email']))? ucfirst($detail['email']) : '';?>
		</h4>
		<h4>
			<small><?php echo set_label_form('personal_phone');?></small><br/>
			<?php echo (isset($detail['personal_phone']))? ucfirst($detail['personal_phone']) : '';?>
		</h4>
	</div>
</div>

</form>