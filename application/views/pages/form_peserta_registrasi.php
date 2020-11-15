<div class="mdl-cell mdl-cell--7-col content-2-4 responsive-1">
	<h3 class="responsive-2">Pendaftaran member baru</h3>
 	<form action="<?php echo (isset($aksi_daftar))? $aksi_daftar : site_url('formulir/submit_pendaftaran') ;?>" method="post">

      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="user-name" name="real_name"
        value="" 
        />
        <label class="mdl-textfield__label" for="user-name"><?php echo ucfirst('real name');?></label>
      </div>

  		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
  			<input class="mdl-textfield__input" type="text" id="user-name" name="username"
        value="<?php echo (isset($responder) && isset($responder['nama_peserta']))? $responder['nama_peserta'] : '';?>" 
        />
  			<label class="mdl-textfield__label" for="user-name"><?php echo ucfirst('username');?></label>
  		</div>

  		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
  			<input class="mdl-textfield__input" type="email" id="user-email" name="email" 
        value="<?php echo (isset($responder) && isset($responder['email_peserta']))? $responder['email_peserta'] : '';?>" 
        >
  			<label class="mdl-textfield__label" for="user-email"><?php echo ucfirst('alamat email');?></label>
  		</div>

  		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="password" id="user-pass" name="password">
			<label class="mdl-textfield__label" for="user-pass"><?php echo ucfirst('password');?></label>
  		</div>

  		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="password" id="user-cpass" name="c_password">
			<label class="mdl-textfield__label" for="user-cpass"><?php echo ucfirst('konfirmasi password');?></label>
  		</div>
		<div style="clear: both;"></div>
  		<a style="margin-bottom: 5px;" 
			href="javascript:history.back(1);" 
			class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  			<i class="fa fa-arrow-left"></i>
			Kembali 
		</a>
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
      Submit Pendaftaran
    </button>
      
  		
</form>
</div>

