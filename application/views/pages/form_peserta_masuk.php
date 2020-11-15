<div class="mdl-cell mdl-cell--12-col content-2-4 responsive-1">
  <div class="css-3">
    <h3 class="responsive-2 mdl-typography--text-center">Login ke Member area</h3>
      <form action="<?php echo site_url('auth/login'); ?>" method="post">
          <div class="mdl-textfield css-4 mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="email" id="user-email" name="identity">
            <label class="mdl-textfield__label" for="user-email"><?php echo ucfirst('alamat email');?></label>
          </div>
          <div class="mdl-textfield css-4 mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="password" id="user-pass" name="password">
            <label class="mdl-textfield__label" for="user-pass"><?php echo ucfirst('password');?></label>
          </div>
          <div class="mdl-textfield css-4 mdl-js-textfield mdl-textfield--floating-label">
            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
              <input type="checkbox" name="remember" value="1" id="remember" class="mdl-checkbox__input" />
              <span class="mdl-checkbox__label">Ingat saya</span> <!-- Checkbox Label -->
            </label>
          </div>
             
        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored css-2">
        Masuk
      </button>
      <div class="mdl-textfield css-4 mdl-js-textfield mdl-textfield--floating-label">
      <span>Belum memiliki akun?    
      <a href="<?php echo (isset($link_register)) ? $link_register : site_url('formulir/pendaftaran_peserta');?>">Daftar disini</a></span>
      </div>
    </form>
  </div>
</div>
