<?php
/**
* 
*/
class Formulir extends MY_Controller
{
	protected $respons;
	function __construct()
	{
		parent::__construct();
		$this->template->set_layout('starter_layout');

		if (!is_null($this->session->userdata('respons'))) {
			$this->respons = $this->session->userdata('respons');
		}

	}
	
	public function index($tautan_unik='',$group_id='')
	{
		$real_data 		= decrypt_url($tautan_unik);
		$pecah_tautan 	= explode('-', $real_data);
		$kues_id		= $pecah_tautan[0];
		$kues_id 		= trim($kues_id);
		if (!empty($kues_id)) {
			$this->load->model(array('kuesioner','opsi_kuesioner','users'));
			$kues_id 				= $pecah_tautan[0];
			$data['tautan_unik']	= $tautan_unik;
			$data['kuesioner'] 		= $this->kuesioner->get($kues_id);
			$data['group_id']		= 5;
			$data['form_login'] 	= $this->load->view('pages/login_pengguna',$data,true);
			$data['opsi_kuesioner']	= $this->opsi_kuesioner->get_by_pengguna($kues_id);

			if (is_numeric($group_id) && $group_id == 4) {
				$data['group_id']	= $group_id;
				$data['form_login'] = $this->load->view('pages/login_pakar',$data,true);
			}

			if (!is_null($this->logged_in) && isset($this->logged_in['group_id']))
			{ 
				$data['group_id'] = $this->logged_in['group_id'];
			}elseif (!is_null($this->respons) && isset($this->respons['group_id'])) {
				$data['group_id'] = $this->respons['group_id'];
			}
			switch ($data['group_id']) {
				case '4':
					$data['opsi_kuesioner']	= $this->opsi_kuesioner->get_by_pakar($kues_id);
				break;
				case '1':
					$data['opsi_kuesioner'] = $this->opsi_kuesioner->get_by_kues($kues_id);
				break;
			}
			if (is_null($this->respons) && isset($data['opsi_kuesioner'])) {
				unset($data['opsi_kuesioner']);
			}

			if (!is_null($this->logged_in['is']) && $this->logged_in['is'] == 'admin') {
				$this->template->render('formulir_kuesioner',$data);
			}else if (!is_null($this->respons)) {
				$data['respons'] = $this->respons;
				$this->template->render('formulir_kuesioner',$data);
			}else{
				$this->template->render('formulir_login_peserta',$data);
			}

		}else{
			$this->halaman_tidak_ditemukan();
		}
	}
	public function simpan_tanggapan($tautan_unik='')
	{

			$this->load->model(array('opsi_kuesioner','isi_tanggapan','tanggapan_kuesioner'));
			$data 			= $this->input->post(NULL,true);
			$success 		= 0;
			$isi_tanggapan 	='';
			if (isset($data['isi_tanggapan']) && is_array($data['isi_tanggapan'])) {
				$jumlah_data = count($data['isi_tanggapan']);
				
foreach ($data['isi_tanggapan'] as $key => $value) {
					$isi_tanggapan 	= $value;
					$data['opsi_id']= $key;
					if (is_numeric($value)) {
						$jml_value 			= count($value);
						
						$opsi_kuesioner = $this->opsi_kuesioner->get($value);
						if (!is_null($opsi_kuesioner)) {
							$data['opsi_id'] = $opsi_kuesioner->induk_opsi;
							$isi_tanggapan 	 = $opsi_kuesioner->opsi_id;
						}

						if ($jml_value < 0 && $opsi_kuesioner->opsi_wajib == 'ya') {
							$success--;
						}
					
					}elseif (is_array($value)) {
						$jml_value 			= count($value);
						$data['opsi_id'] 	= $key;
						$isi_tanggapan 		= implode(';', $value);

						if ($jml_value < 0 && $opsi_kuesioner->opsi_wajib == 'ya') {
							$success--;
						}
					}else if ($opsi_kuesioner  	= $this->opsi_kuesioner->get($key)) {
						$value				= trim($value);
						$data['opsi_id'] 	= $opsi_kuesioner->opsi_id;
						$isi_tanggapan 		= $value;
						
						if (empty($value) && $opsi_kuesioner->opsi_wajib == 'ya') {
							$success--;
						}
					}

				/** success count section **/

				if (!is_null($this->respons) && !is_null($this->respons['tanggapan_id'])) {
							$data['tanggapan_id']  = $this->respons['tanggapan_id'];					
							$data['isi_tanggapan'] = trim($isi_tanggapan);
							
if (!is_null($data['isi_tanggapan']) || !empty($data['isi_tanggapan'])) {
								
								$detail_tanggapan = $this->isi_tanggapan->has_been_answered(
									$data['tanggapan_id']
									,$data['opsi_id']
								);
								
								if ($detail_tanggapan) {
									if (!is_null($detail_tanggapan->id)) {
										if ($this->isi_tanggapan->update($detail_tanggapan->id,$data)) {
											$success++;
											
										}
									}
								}else{
									if ($this->isi_tanggapan->insert($data)) {
										$success++;
									}
								}
							}
				}

				/** end succcess count section */



}

				if ($success == $jumlah_data && $success > 0) {
					$this->tanggapan_kuesioner->update(
						$this->respons['tanggapan_id'],
						array(
							'jumlah_tanggapan' => $jumlah_data,
							'submit_pada'=>time()
						)
					);
					$this->quis->kembali_ke('akhiri_respons');
				}else{
					$this->quis->set_pesan('warning','Mohon perhatikan ulang pengisian kuesioner yang diminta');
				}
				
			}else if (is_null($this->respons)) {
				$this->quis->set_pesan('warning','Maaf anda tidak memiliki session');
			}else{
				$this->quis->set_pesan('warning','Mohon jawab salah satu pertanyaan');
			}
			$this->quis->kembali_ke('index/'.$tautan_unik);
	}

	public function akhiri_respons()
	{
		if ($this->session->userdata('respons')) {
			$data['tautan_registrasi'] ='ya';
			if (isset($this->respons['user_id']) && 
				(intval($this->respons['user_id']) > 0)) {
				$this->session->unset_userdata('respons');
					$this->respons = NULL;	
				$data['tautan_registrasi'] ='tidak';
			}
			$this->template->render('selesai_menanggapi_kuesioner',$data);
		}else{
			$this->halaman_tidak_ditemukan();
		}
	}
	public function submit_formulir($tautan_unik='')
	{
		$this->load->library('ion_auth');
		$data 			 	 = $this->input->post(NULL,true);
		$real_data 			 = decrypt_url($tautan_unik);
		$pecah_tautan		 = explode('-', $real_data);
		$run 				 = 'login_pengguna';
		$validation['4'] 	 = 'login_pakar';
		$validation['5'] 	 = $run;

		if (isset($data['group_id']) && isset($validation[$data['group_id']])) {
			$run 			= $validation[$data['group_id']];
		}

		if ($this->form_validation->run($run)) {
			$data 			= $this->input->post(NULL,true);
			if ($data['group_id'] == 4) {
				
				$this->set_respons_pakar($pecah_tautan[0],$data);

			}elseif ($data['group_id'] == 5) {
				
				$this->set_respons_pengguna($pecah_tautan[0],$data);

			}else{
				$this->quis->set_pesan('warning','maaf, grup pengguna tidak dikenali');	
			}
			
		}else{
			$this->quis->set_pesan('warning',validation_errors());
		}
		$this->quis->kembali_ke('index/'.$tautan_unik);
	}


	protected function set_respons_pakar($kues_id,$data = array())
	{
		$this->load->model(array('peserta','tanggapan_kuesioner','users'));
		if (isset($data['email']) && isset($data['password'])) {
			$detail_user 		= NULL;
			if ($this->ion_auth->login($data['email'], $data['password'], NULL)) {
				$cookie_name 				= $this->config->item('identity_cookie_name','ion_auth');
				$userdata 	 				= $this->session->userdata($cookie_name);
				$detail_user 				= $this->users->get($userdata['user_id']);
			
				if ($detail_user) {
					$peserta = array();
					if (is_array($detail_user)) {
						$peserta['user_id'] 		= $detail_user['id'];
						$peserta['email_peserta'] 	= $detail_user['email'];
						$peserta['nama_peserta'] 	= $detail_user['real_name'];
						$peserta['group_id']		= 4;
					}elseif (is_object($detail_user)) {
						$peserta['user_id'] 		= $detail_user->id;
						$peserta['email_peserta'] 	= $detail_user->email;
						$peserta['nama_peserta'] 	= $detail_user->real_name;
						$peserta['group_id']		= 4;
					}
					if ($detail_peserta = $this->peserta->get_by(
							'user_id'
							,$peserta['user_id']
						)) 
					{
							$peserta 				= (array) $detail_peserta;
							$peserta['peserta_id'] 	= $detail_peserta->peserta_id;

					}elseif ($peserta_id 		= $this->peserta->insert($peserta)) {
							
							$peserta['peserta_id']	= $peserta_id;
					}
					
					if ($peserta) {
						$this->set_respons($kues_id,$peserta);
					}

				}else{
					$this->quis->set_pesan('warning','Maaf, pakar belum terdaftar !');			
				}
			}else{
				$this->quis->set_pesan('warning','Maaf, anda bukan pakar yang sah !');		
				$this->quis->kembali_ke('index/');
			}
		}
	}

	protected function set_respons_pengguna($kues_id,$data=array())
	{
		$this->load->model(array('peserta','tanggapan_kuesioner','users'));
		if (isset($data['email_peserta'])) { 
			
			$peserta = $this->peserta->get_by('email_peserta',$data['email_peserta']);
			
			if (!is_null($peserta)) {
				
				if (!is_null($peserta->group_id) && $peserta->group_id == 0) {
					$this->peserta->update($peserta->peserta_id,array('group_id'=>5));
				}

				$data = (array) $peserta;

				$this->set_respons($kues_id,$data);

			}elseif ($peserta_id 	= $this->peserta->insert($data)) { //not exist
				$data['peserta_id'] = $peserta_id;
				$this->set_respons($kues_id,$data);		
			}	
			
		}
	}

	public function set_respons($kues_id,$peserta=array())
	{
		if ($peserta && isset($peserta['peserta_id'])) {
			$tanggapan['peserta_id']  	= $peserta['peserta_id'];
			$tanggapan['kues_id']		= $kues_id;
			$exiting_tanggapan 		= $this->tanggapan_kuesioner->telah_disubmit(
				$tanggapan['peserta_id']
				,$tanggapan['kues_id']
			);

			if (!is_null($exiting_tanggapan) && !is_null($exiting_tanggapan->tanggapan_id)) {
				

				if (!is_null($exiting_tanggapan->tanggapan_id)) {

					$tanggapan['tanggapan_id'] 			= $exiting_tanggapan->tanggapan_id;
					$tanggapan 				 			= array_merge($tanggapan,$peserta);
					$data_tanggapan['tanggapan_pada'] 	= date('Y-m-d h:i:s');
					$this->tanggapan_kuesioner->update(
						$exiting_tanggapan->tanggapan_id
						,$data_tanggapan
					);
					$this->session->set_userdata('respons',$tanggapan);
				}else {
					$this->quis->set_pesan('warning','tidak ada id tanggapan  !');				
				}

			}elseif ($tanggapan_id = $this->tanggapan_kuesioner->insert($tanggapan)) {
				$tanggapan['tanggapan_id'] = $tanggapan_id;
				$tanggapan 				   = array_merge($tanggapan,$peserta);
				$this->session->set_userdata('respons',$tanggapan);
			}else{
				$this->quis->set_pesan('warning','gagal membuat sesi tanggapan :( !');				
			}
		}
	}

	public function pendaftaran_peserta()
	{
		$data['responder'] = $this->respons;
		$this->template->set_layout('welcome_landing');
		$this->template->render('form_peserta_registrasi',$data);
	}

	public function submit_pendaftaran()
	{
		if ($this->form_validation->run('registrasi')) {
			$data		= $this->input->post(null,true);
			$this->load->library('ion_auth');
			$this->load->model(array('ion_auth_model','users','peserta'));
			if (!is_null($this->respons)) {
				$responder = $this->respons;
				
				$user_id 	= $this->ion_auth_model->register( 
					$data['username']
					, $data['password']
					, $data['email']
					, array('real_name'=>$responder['nama_peserta'])	
					, array(5)
				);
				if ($user_id) {
					$this->users->update($user_id,array('active'=>'1'));
					
					if (isset($responder['peserta_id'])) {
						$peserta_id = $responder['peserta_id'];
						$this->peserta->update($peserta_id,array(
							'user_id'=>$user_id
						));
						$this->session->unset_userdata('respons');
						$this->respons 	= NULL;
						$this->quis->set_pesan('success','silahkan login dengan email : '.$data['email'].' dan password yang telah ditentukan.');
							
					}
				}
				//$this->quis->set_pesan('info','anda sudah terdaftar sebagai member,namun mohon bersabar untuk menunggu konfirmasi dari admin.');	
				redirect('landing/member','refresh');
			}else{
				$this->quis->set_pesan('danger','anda belum mengisikan quesioner');
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