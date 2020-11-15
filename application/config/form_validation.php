<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'registrasi'=>array(
		array('field'=>'username','label'=>'Username','rules'=>'trim|required|is_unique[users.username]')
		,array('field'=>'password','label'=>'Password','rules'=>'trim|required')
		,array('field'=>'c_password','label'=>'Konfirmasi Password','rules'=>'trim|required|matches[password]')
		,array('field'=>'email','label'=>'Email Verifikasi','rules'=>'trim|required|valid_email|is_unique[users.email]')
	)
	,'buat_kuesioner' => array(
		array('field'=>'judul_kuesioner','label'=>'Judul kuesioner','rules'=>'trim|required|is_unique[kuesioner.judul_kuesioner]')
		,array('field'=>'deskripsi_kuesioner','label'=>'Deskripsi kuesioner','rules'=>'trim|required')
	)
	,'set_opsi' => array(
		array('field'=>'kalimat_opsi','label'=>'kalimat opsi','rules'=>'trim|required')
	)
	,'set_pertanyaan' => array(
		array('field'=>'pertanyaan','label'=>'pertanyaan','rules'=>'trim|required|is_unique[opsi_kuesioner.pertanyaan]')
		,array('field'=>'jenis_opsi','label'=>'jenis opsi','rules'=>'trim|required')
		,array('field'=>'group_id','label'=>'Pertanyaan Untuk','rules'=>'trim|required|is_natural_no_zero')
	)
	,'kirim_tanggapan' => array(
		array('field'=>'isi_tanggapan','label'=>'isi tanggapan','rules'=>'trim|required')
	)
	,'simpan_peserta' => array(
		array('field'=>'nama_peserta','label'=>'Nama lengkap Peserta','rules'=>'trim|required'),
		array('field'=>'email_peserta','label'=>'Email Peserta','rules'=>'trim|required|valid_email|is_unique[peserta.email_peserta]')
	)
	,'simpan_acara' => array(
		array('field'=>'nama_acara','label'=>'Nama acara','rules'=>'trim|required'),
		array('field'=>'waktu_acara','label'=>'Waktu pelaksanaan acara','rules'=>'trim|required')
	)
	,'simpan_pakar' => array(
		array('field'=>'real_name','label'=>'Nama lengkap','rules'=>'trim|required'),
		array('field'=>'email','label'=>'Email pakar','rules'=>'trim|required|valid_email'),
		array('field'=>'random_password','label'=>'Password acak','rules'=>'trim|required|is_natural_no_zero')
	)
	,'login_pakar' => array(
		array('field'=>'email','label'=>'Alamat Email','rules'=>'trim|required|valid_email'),
		array('field'=>'password','label'=>'Password','rules'=>'trim|required')
	)
	,'login_pengguna' => array(
		array('field'=>'email_peserta','label'=>'Alamat Email','rules'=>'trim|required|valid_email'),
		array('field'=>'nama_peserta','label'=>'Nama lengkap','rules'=>'trim|required')
	),'update_edit_peserta' => array(
		array('field'=>'email','label'=>'isikan email dengan benar','rules'=>'valid_email|required|trim'),
		array('field'=>'real_name','label'=>'Nama lengkap','rules'=>'trim|required'),
		array('field'=>'personal_address','label'=>'Alamat','rules'=>'trim|required')
	),'update_pengaturan_peserta' => array(
		array('field'=>'username','label'=>'Username','rules'=>'trim|required'),
		array('field'=>'password','label'=>'Password','rules'=>'trim|required'),
		array('field'=>'c_password','label'=>'Konfirmasi Password','rules'=>'trim|required|matches[password]')
	),
	'reset_password' => array(
		array('field'=>'password','label'=>'password','rules'=>'trim|required')
		,array('field'=>'cpassword','label'=>'konfirmasi password','rules'=>'trim|required|matches[password]')
	),
	'update_pertanyaan' => array(
		array('field'=>'pertanyaan','label'=>'pertanyaan','rules'=>'trim|required')
	)
);