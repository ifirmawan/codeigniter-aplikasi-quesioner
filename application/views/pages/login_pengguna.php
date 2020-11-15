<form action="<?php echo site_url('formulir/submit_formulir/'.$tautan_unik);?>" method="post">
                  <div class="form-group">
                    <label for="">Alamat Email</label>
                    <input type="email" class="form-control" name="email_peserta" placeholder="Email Peserta" />
                  </div>
                  <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_peserta" placeholder="Nama lengkap">
                  </div>
                  <?php  if (isset($group_id)) { ?>
                      <input type="hidden" value="<?php echo $group_id;?>" name="group_id" />
                  <?php  } ?>
                  <div class="form-group">
                    <div class="text-right">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
      </form>