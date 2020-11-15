<a style="margin-bottom: 5px;" href="javascript:history.back(1);" class="btn btn-default"><i class="fa fa-arrow-left"></i>&nbsp;Kembali </a>

<?php if(isset($my['is']) && $my['is'] == 'admin'): ?>

<form action="<?php echo site_url($my['is'].'/simpan_instruktur');?>" method="post">
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
    <label >Nama lengkap</label>
    <input type="text" name="real_name" class="form-control"  placeholder="Nama lengkap instruktur">
  </div>
  <div class="form-group">
    <label >Username</label>
    <input type="text" name="username" class="form-control"  placeholder="Username">
  </div>
  <div class="form-group">
    <label >Alamat Email</label>
    <input type="email" name="email" class="form-control"  placeholder="Alamat Email">
  </div>
  <div class="form-group">
    <label >Password</label>
    <input type="password" name="password" class="form-control"  placeholder="Password">
  </div>
  <div class="form-group">
    <label >Konfirmasi Password</label>
    <input type="password" name="c_password" class="form-control"  placeholder="Konfirmasi Password">
  </div>
  <div class="form-group">

<?php if (isset($group_id)) { ?>
      <input type="hidden" name="group" value="<?php echo $group_id;?>" />
<?php } ?>

  </div>
    </div>
    <div class="col-xs-12 col-md-6">
      
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
        <div class="pull-right">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
  </div>
</form>

<?php endif; ?>