<?php

/**
* 
*/
class Instruktur extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if (is_null($this->logged_in)) {
			redirect('auth','refresh');
		}
		$this->template->set_layout('dashboard_instruktur');
	}
	public function index()
	{
		$this->template->render('profile_instruktur');	
	}

	public function daftar_acara()
	{
		$data['kolom_tabel'] 	= $this->quis->set_kolom('kuesioner');
		$data['isi_tabel']  	= $this->kuesioner->get_many_by('jenis_kuesioner','acara');
		$data['hidden_kolom']	= array('kues_id','user_id','tautan_kuesioner','terbit_pada','jenis_kuesioner','deskripsi_kuesioner','judul_kuesioner','dibuat_pada');
		$this->template->render('datatables_page',$data);	
	}

	public function daftar_tanggapan()
	{
		$this->load->model('tanggapan_kuesioner');
		$data['kolom_tabel'] 	= $this->quis->set_kolom('tanggapan_kuesioner');
		$data['isi_tabel']  	= $this->tanggapan_kuesioner->get_all();
		$this->template->render('datatables_page',$data);	
	}

	public function pengaturan_akun()
	{
		$this->template->render('pengaturan_instruktur');
	}

}