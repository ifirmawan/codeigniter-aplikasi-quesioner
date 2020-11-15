<a style="margin-bottom: 5px;" href="javascript:history.back(1);" class="btn btn-default"><i class="fa fa-arrow-left"></i>&nbsp;Kembali </a>

<?php if(isset($my['is']) && $my['is'] == 'admin'): ?>

<form action="<?php echo site_url($my['is'].'/simpan_pakar');?>" method="post">
  <div class="row">
    <div class="col-xs-12">
      <div class="form-group">
    <label >Nama lengkap</label>
    <input type="text" name="real_name" class="form-control"  placeholder="Nama lengkap Pakar">
  </div>
  <div class="form-group">
    <label >Alamat Email</label>
    <input type="email" name="email" class="form-control"  placeholder="Alamat Email">
  </div>
  <?php if(isset($random_password)) :?>
  <div class="form-group">
    <h3>
      <small>Password acak</small><br/>
      <?php echo $random_password;?>
    </h3>
    <input type="hidden" name="random_password" class="form-control" value="<?php echo $random_password;?>" />
  </div>
<?php endif; ?>
          <div class="pull-right">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
  
  </div>

</form>

<?php endif; ?>