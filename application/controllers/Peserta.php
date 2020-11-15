<?php

/**
* 
*/
class Peserta extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if (is_null($this->logged_in)) {
			redirect('auth','refresh');
		}
		$this->template->set_layout('dashboard_peserta');
	}
	public function index()
	{
		$this->template->render('beranda_peserta');
	}
	public function edit_peserta()
	{
		$this->load->model(array('users'));
		$cookie_name 		= $this->config->item('identity_cookie_name','ion_auth');
		$userdata 	 		= $this->session->userdata($cookie_name);
		$data['data_user'] 	= $this->users->get($userdata['user_id']);
		$this->template->render('beranda_edit_peserta', $data);
	}
	public function update_edit_peserta()
	{
		
		if($this->form_validation->run('update_edit_peserta')){
			$this->load->model('users');
			$data = $this->input->post(NULL,true);
			if ($this->users->update($this->logged_in['user_id'], $data)) {
				$this->quis->set_pesan('success','data biodata berhasil di update');
				redirect('peserta/edit_peserta','refresh');				
			}
		}else{
			$this->quis->set_pesan('warning',validation_errors());
		}
		$this->quis->kembali_ke('edit_peserta');
	}
	public function pengaturan_peserta()
	{
		$this->load->model(array('users'));
		$cookie_name 		= $this->config->item('identity_cookie_name','ion_auth');
		$userdata 	 		= $this->session->userdata($cookie_name);
		$data['data_user'] 	= $this->users->get($userdata['user_id']);
		$this->template->render('beranda_pengaturan_peserta', $data);
	}
	public function update_pengaturan_peserta()
	{
		
		if($this->form_validation->run('update_pengaturan_peserta')){
			$this->load->model('users');
			$this->load->library('ion_auth');
			$data = $this->input->post(NULL,true);

			$identity = $this->logged_in['email'];
			$change = $this->ion_auth->reset_password($identity, $data['password']);

			if (!$change)
			{
				$this->quis->set_pesan('warning','Password gagal diperbaharui');
			}
			if (isset($data['c_password'])) {
				unset($data['c_password']);
			}

			if ($this->users->update($this->logged_in['user_id'], $data)) {
				$this->quis->set_pesan('success','data pengaturan berhasil di update');
				redirect('peserta/pengaturan_peserta','refresh');				
			}
		}else{
			$this->quis->set_pesan('warning',validation_errors());
		}
		$this->quis->kembali_ke('pengaturan_peserta');
	}
}