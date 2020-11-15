  <form action="<?php echo site_url('formulir/submit_formulir/'.$tautan_unik);?>" method="post">
                  <div class="form-group">
                    <label for="">Alamat Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email Peserta" />
                  </div>
                  <div class="form-group kode-pakar" >
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" />
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