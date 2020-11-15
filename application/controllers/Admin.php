<?php

/**
* 
*/
class Admin extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		//untuk mengatur template
		$this->template->set_layout('dashboard_admin_usability');
		
		if (!is_null($this->session->userdata('kues'))) {
			$kues = $this->session->userdata('kues');
			redirect('pertanyaan/index/'. $kues->kues_id);
		}
	}

	public function index()
	{
		$this->load->model('kuesioner');
		$data['primary_key'] 	='kues_id';
		$data['tombol_tindakan']= array(
			array('warna'=>'btn-primary','url'=>'detail_kuesioner','label'=>'lihat')
		);
		$data['kolom_tabel'] 	= $this->quis->set_kolom('kuesioner');
		$data['isi_tabel']  	= $this->kuesioner->get_all();
		$data['hidden_kolom']	= array(
			'kues_id','deskripsi_kuesioner'
			,'tautan_kuesioner','nama_acara'
			,'materi_acara','ruang_acara'
			,'kapasitas_acara','waktu_acara'
			,'instruktur_acara','jenis_kuesioner'
		);
		$data['toolbar_tabel']	= array('buat_kuesioner');
		$this->template->render('datatables_page',$data);
	}

	public function daftar_instruktur()
	{
		$this->daftar_user(3);
	}

	public function daftar_pakar()
	{
		$this->daftar_user(4);
	}


	public function daftar_user($group_id=false)
	{
		$this->load->model('users');
		$data['isi_tabel']  	= $this->users->get_all();
		$data['toolbar_tabel']	= array('tambah_user'); 
		if ($group_id && is_numeric($group_id)) {
			if ($group_id == 4) {
				$data['toolbar_tabel'] = array('tambah_pakar');
			}
			$data['isi_tabel']  = $this->users->get_by_group($group_id);
		}
		$data['kolom_tabel'] 	= $this->quis->set_kolom('users');
		$data['hidden_kolom']	= array('id','password','salt','activation_code','forgotten_password_code','forgotten_password_time','remember_code','company','phone','personal_address','	personal_phone','born');
		$this->template->render('datatables_page',$data);	
	}	


	public function daftar_tanggapan()
	{
		$this->load->model('tanggapan_kuesioner');
		$data['kolom_tabel'] 	= $this->quis->set_kolom('tanggapan_kuesioner');
		$data['isi_tabel']  	= $this->tanggapan_kuesioner->get_all();
		$data['hidden_kolom']	= array('tanggapan_id');
		$this->template->render('datatables_page',$data);	
	}


	public function buat_kuesioner()
	{
		$this->load->model('users');
		$this->template->set_layout('starter_layout');
		$this->template->render('form_kuesioner_survey');
	}

	public function simpan_kuesioner()
	{
		$kues_id = NULL;
		if ($this->form_validation->run('buat_kuesioner')) {
			$this->load->model('kuesioner');
			$data = $this->input->post(NULL,true);

			if (isset($data['group_id'])) {
				unset($data['group_id']);
			}

			$data['user_id']= $this->logged_in['user_id'];
			if ($kues_id 		= $this->kuesioner->insert($data)) {
				$kues 			= $this->kuesioner->get($kues_id);
				$kues->group_id = $this->input->post('group_id');
				$this->session->set_userdata('kues',$kues);
				redirect('pertanyaan/index/'.$kues_id,'refresh');
			}else{
				$this->quis->set_pesan('warning','gagal menyimpan kuesioner');
			}
		}else{
			$this->quis->set_pesan('warning',validation_errors());
		}
		$this->quis->kembali_ke('buat_kuesioner');
	}

	public function tambah_user()
	{
		$this->load->model('ion_auth_model');
		$query 			= $this->ion_auth_model->groups(); //ambil semua group user
		$data['groups'] = $query->result_array(); // data berformat array
		$this->template->render('form_user_baru',$data);
	}

	

	public function detail_kuesioner($kues_id=false)
	{
		$this->load->model(array('kuesioner','opsi_kuesioner'));
		$data = (array) $this->kuesioner->get($kues_id);
		if ($data) {
			
			$table['kolom_tabel']		= $this->quis->set_kolom('opsi_kuesioner');
			$table['isi_tabel'] 		= $this->opsi_kuesioner->get_by_kues($kues_id);
			$table['hidden_kolom']		=array('opsi_id','induk_opsi','kalimat_opsi','opsi_jawaban','kues_id');
			
			//$data['jenis_opsi'] 	= $this->opsi_kuesioner->get_enum_values('jenis_opsi');
			$data['datatables'] 		= $this->load->view('pages/datatables_page',$table,true);
			$this->template->render('detail_kuesioner',$data);
		}else{
			$this->index();
		}
	}

	



	public function edit_kuesioner($kues_id='')
	{
		$this->load->model('kuesioner');
		$detail_kuesioner = $this->kuesioner->get($kues_id);
		if (!is_null($detail_kuesioner) && !is_null($detail_kuesioner->jenis_kuesioner)) {
			$this->session->set_userdata('kues',$detail_kuesioner);
			redirect('pertanyaan/index/'.$detail_kuesioner->kues_id,'refresh');
		}else{
			$this->quis->set_pesan('warning','kuesioner tidak memiliki jenis yang sah (acara atau survey)');
			$this->quis->kembali_ke('index');
		}
	}
	

	public function tambah_pakar()
	{
		$data['random_password'] = rand();
		$this->template->render('form_pakar_baru',$data);
	}

	public function simpan_pakar()
	{
		if ($this->form_validation->run('simpan_pakar')) {
			//$this->load->library('ion_auth');
			$this->load->model(array('ion_auth_model','users'));
			$data 	 		  = $this->input->post(NULL,true);
			$explode_name 	  = explode(' ',$data['real_name']);
			$data['password'] = (isset($data['random_password']))? $data['random_password'] : 'jvm123';
			$data['username'] = $explode_name[0];
			$user_id = $this->ion_auth_model->register( // menambahkan user dengan register
					$data['username']
					, $data['password']
					, $data['email']
					, array('real_name'=>$data['real_name'])
					, array(4));
			if ($user_id) {
				$this->users->update($user_id,array('active'=>1));
				$this->quis->kembali_ke('daftar_pakar');
			}else{
				$this->quis->set_pesan('warning','gagal menyimpan pakar');
			}
		}else{
			$this->quis->set_pesan('warning',validation_errors());
		}
		$this->quis->kembali_ke('tambah_pakar');
	}

	public function tanggapan(){
		$this->load->model('tanggapan_kuesioner');
		$data['kolom_tabel'] 	= array('kues_id','judul_kuesioner','jumlah');
		$data['isi_tabel']   	= $this->tanggapan_kuesioner->jumlah_setiap_kuesioner();
		$data['primary_key'] 	='kues_id';
		$data['tombol_tindakan']= array(
			array('warna'=>'btn-primary','url'=>'detail_tanggapan_kuesioner','label'=>'semua')
			,array('warna'=>'btn-default','url'=>'detail_tanggapan_pengguna','label'=>'pengguna')
			,array('warna'=>'btn-success','url'=>'detail_tanggapan_pakar','label'=>'pakar')
		);
		$this->template->render('datatables_page',$data);	
	}

	public function detail_tanggapan_kuesioner($kues_id=''){
		$this->load->model(array('opsi_kuesioner','kuesioner'));
		$data['pertanyaan'] 		= $this->opsi_kuesioner->get_questions_by($kues_id);
		$data['detail_kuesioner'] 	= $this->kuesioner->get($kues_id);
		$data['konteks_tanggapan'] 	= 'dari sisi semua responder ';
		$this->template->render('detail_tanggapan_kuesioner',$data);
	}

	public function detail_tanggapan_pengguna($kues_id=''){
		$this->load->model(array('opsi_kuesioner','kuesioner'));
		$data['pertanyaan'] 	 	= $this->opsi_kuesioner->get_by_pengguna($kues_id);
		$data['detail_kuesioner'] 	= $this->kuesioner->get($kues_id);
		$data['konteks_tanggapan'] 	= 'dari responder pengguna'; 
		$this->template->render('detail_tanggapan_kuesioner',$data);
	}

	public function detail_tanggapan_pakar($kues_id=''){
		$this->load->model(array('opsi_kuesioner','kuesioner'));
		$data['pertanyaan'] 		= $this->opsi_kuesioner->get_by_pakar($kues_id);
		$data['detail_kuesioner'] 	= $this->kuesioner->get($kues_id);
		$data['konteks_tanggapan'] 	= 'dari responder pakar'; 
		$this->template->render('detail_tanggapan_kuesioner',$data);
	}

	public function hapus_kuesioner($kues_id=''){
		$this->load->model('kuesioner');
		if ($this->kuesioner->get($kues_id)) {
			$this->kuesioner->delete($kues_id);
		}else{
			$this->quis->set_pesan('danger','kuesioner tidak sah');
		}
		$this->quis->kembali_ke('detail_kuesioner/'.$kues_id);
	}
	

}	
