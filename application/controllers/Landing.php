<?php
/**
* 
*/
class Landing extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if (!is_null($this->logged_in)) {
			if (isset($this->logged_in['is'])) {
				redirect($this->logged_in['is'],'refresh');
			}
		}
		if (!is_null($this->session->userdata('respons'))) {
			$this->session->unset_userdata('respons');
		}
		$this->template->set_layout('welcome_landing');
	}
	public function index()
	{
		$this->load->model('kuesioner');
		$data['kuesioner'] = $this->kuesioner->telah_terbit();
		$this->template->render('landing_home',$data);	
	}
	public function tentang_kami()
	{
		$this->template->render('landing_about');
	}
	public function benefit()
	{
		$this->template->render('landing_benefit');
	}
	public function member()
	{
		$data['link_register'] = site_url('landing/register');
		$this->template->render('form_peserta_masuk',$data);
	}
	public function register()
	{
		
		$data['aksi_daftar'] = site_url('landing/submit_registrasi');
		$this->template->set_layout('welcome_landing');
		$this->template->render('form_peserta_registrasi',$data);
	}

	public function submit_registrasi()
	{
		if ($this->form_validation->run('registrasi')) {
			$data		= $this->input->post(null,true);
			$this->load->library('ion_auth');
			$this->load->model(array('ion_auth_model','users','peserta'));
	
				$user_id 	= $this->ion_auth_model->register( 
					$data['username']
					, $data['password']
					, $data['email']
					, array('real_name'=>$data['real_name'])	
					, array(5)
				);
				if ($user_id) {
					$this->users->update($user_id,array('active'=>'1'));
					//$this->logged_in = $this->users->get($user_id);
					$this->quis->set_pesan('success','Silahkan login dengan email : '.$data['email']. ' dan password yang anda telah masukkan sebelumnya');
					redirect('landing/member','refresh');

				}else{
					$this->quis->set_pesan('warning','maaf register gagal dilakukan');
				}
		}else{
			$this->quis->set_pesan('warning',validation_errors());
		}
		if (isset($_SERVER['HTTP_REFERER'])) {
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit;
		}
		
	}
}