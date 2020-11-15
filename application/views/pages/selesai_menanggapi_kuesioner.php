<div class="container-fluid">
	<div class="page-header" style="margin-top: 75px;">
		<div class="text-center">
			<h1>
			Yuhu !!<br/>
				<small>Terima kasih,Atas partisipasnya</small>
			</h1>
			
			<p>Mau mendapat hasil survey dari <a href="<?php echo site_url('landing/tentang_kami');?>">St3 Kuesioner</a>. Cukup klik tombol daftar dibawah ini. Atau jika sudah memiliki akun maka silahkan masuk sebagai member.
			<a href="<?php echo site_url('landing/benefit');?>">Keuntungan menjadi user</a></p>
		</div>
	</div>
	<div class="text-center">
		<?php if(isset($tautan_registrasi) && $tautan_registrasi == 'ya') : ?>
		<a href="<?php echo site_url('formulir/pendaftaran_peserta');?>" class="btn btn-lg btn-inline btn-primary-outline" style="margin-right: 0px;">Daftar sekarang !</a>
		<?php else: ?>
			<a href="<?php echo site_url('landing/member');?>"
			class="btn btn-lg btn-inline btn-primary-outline" style="margin-right: 0px;"
			>Masuk sebagai member</a>
		<?php endif;?>
	</div>
	<div class="text-center">
		<a href="<?php echo site_url('landing/index');?>" class="btn btn-lg btn-inline btn-default-outline" style="margin-right: 0px;">Kembali ke beranda</a>
	</div>
</div>