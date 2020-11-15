<h3>Tentang saya</h3>
<div class="row">
    <div class="col-lg-4">
        
    </div>
    <div class="col-lg-8">
        <div class="profile-header-title">
            <h2><?php echo $data_user['real_name']; ?> <small>@<?php echo $data_user['username']; ?></small></h2>
            <p>Founder / CEO</p>
        </div>
        <table class="table table-hover">
            <tr>
                <th>Nama Lengkap</th>
                <td><?php echo $data_user['real_name']; ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><?php echo $data_user['personal_address']; ?></td>
            </tr>
            <tr>
                <th>No Handphone</th>
                <td><?php echo $data_user['personal_phone']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $data_user['email']; ?></td>
            </tr>
        </table>
    <button type="button" class="btn btn-warning margin-inline" data-toggle="modal" data-target="#editprofile">Edit Profile</button>
    </div>
</div>
                
                <div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                            </div>
                            <div class="modal-body">
                            <?php echo form_open('peserta/update_edit_peserta'); ?>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="form-control-label" for="l0">Nama Lengkap</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="real_name" placeholder="Nama lengkap" value="<?php echo $data_user['real_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="form-control-label" for="l0">Alamat</label>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea name="personal_address" class="form-control"><?php echo $data_user['personal_address']; ?></textarea>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="form-control-label" for="l0">No HP</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" name="personal_phone" placeholder="Nomor Handphone" value="<?php echo $data_user['personal_phone']; ?>">
                                    </div>
                                </div>                              
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="form-control-label" for="l0">Email</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" name="email" placeholder="email" value="<?php echo $data_user['email']; ?>">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Profil</button>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>

<script>
    $(function() {

        autosize($('#textarea'));

        $('#password').password({
            eyeClass: '',
            eyeOpenClass: 'icmn-eye',
            eyeCloseClass: 'icmn-eye-blocked'
        });

    });
</script>