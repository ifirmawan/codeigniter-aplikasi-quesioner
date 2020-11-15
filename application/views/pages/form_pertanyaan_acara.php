<div class="container-fluid">
	<div class="page-header">
		<h3>
			Lorem ipsum dolor sit amet
			<br/><small >Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</small>
		</h3>
	</div>

<div class="text-right">
	<a href="" class="btn btn-inline btn-default-outline" style="margin-right: 0px;">
	<i class="fa fa-chevron-left"></i>&nbsp;Sebelumnya</a>
	<a href="" class="btn btn-inline btn-primary-outline" style="margin-right: 0px;">
	<i class="fa fa-chevron-right"></i>&nbsp;Selanjutnya</a>	
	<a href="" class="btn btn-inline btn-success-outline" style="margin-right: 0px;">
	<i class="glyphicon glyphicon-ok"></i>&nbsp;Cukup</a>
</div>
<section class="card">
				<header class="card-header">
					<div class="row">
					<span class="col-md-8" >
						<p > Pertanyaan ke-1</p>
					</span>
					<span class="col-md-4">
						<select name="jenis_opsi" class="form-control">
							
							<?php if(isset($jenis_opsi) && $jenis_opsi):
							foreach ($jenis_opsi as $key => $value) { ?>
								<option value="<?php echo $value;?>"><?php echo $value;?></option>
							<?php 
								}
							endif;?>
						</select>
					</span>
					</div>
				</header>
				<div class="card-block">
					<div id="example-basic">
						<div class="row">
							<span class="col-xs-12">	
							<fieldset class="form-group">
								<input type="text" class="form-control form-control-lg" style="height: auto;" id="" placeholder="Berikan Pertanyaan">	
							</fieldset>
							</span>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<span class="col-xs-1">
								<div class="text-center"  style="padding: 10px 10px 10px 15px;">
									<i class="fa fa-circle-o"></i>
								</div>
							</span>
							<span class="col-xs-11">	
								<input type="text" class="form-control form-control-lg" style="height: auto;" id="" placeholder="Berikan Pertanyaan">	
							</span>
						</div>
							</span>
						</div>
					</div>
				</div>
</section>
</div>