<?php
/**
* 
*/
class Pertanyaan extends MY_Controller
{
	protected $kues;
	function __construct()
	{
		parent::__construct();
		if (!is_null($this->session->userdata('kues'))) {
			$this->kues 	= $this->session->userdata('kues');
		}
		$this->set_kondisi_redirect();

	}
	protected function set_kondisi_redirect()
	{
		$akses_method 		= $this->router->fetch_method();
		$full_segment 		= $this->uri->segment_array();
		$jumlah_segment 	= count($full_segment);
		$key_url 			= 0;
		$kues_id 			= false;
		if ($this->logged_in['is']!='admin') {
			redirect($this->logged_in['is'],'refresh');
		}
		if ($key_url = array_search($akses_method, $full_segment)) {
			$key_url++;
		}
		if ($key_url == $jumlah_segment && $jumlah_segment >= $key_url) {
			$kues_id = $full_segment[$key_url];
		}
		if ($kues_id && !is_numeric($kues_id)) {
			$this->quis->kembali_ke('halaman_tidak_ditemukan');
		}
	}

	public function index($kues_id='')
	{
		$this->load->model(array('opsi_kuesioner','users'));
		$page = '404';
		if (!is_null($this->kues)) {
			if (empty($kues_id)) {
				$kues_id 		= $this->kues->kues_id;
			}
			$page 				= 'form_tabel_pertanyaan';
			$data 				= (array) $this->kues;
			$data['jenis_opsi'] = $this->opsi_kuesioner->get_enum_values('jenis_opsi');
		}
		$data['kolom_tabel']	= $this->quis->set_kolom('opsi_kuesioner');
		$data['isi_tabel'] 		= $this->opsi_kuesioner->get_by_kues($kues_id);
		$data['user_group'] 	= $this->users->get_usability_group();
		$data['hidden_kolom']	= array('opsi_id','induk_opsi','kalimat_opsi','opsi_jawaban','kues_id','petunjuk_pertanyaan');
		$data['tombol_tindakan']= array(
			array('warna'=>'btn btn-danger btn-confirm','url'=>'hapus_opsi/','label'=>'<i class="fa fa-trash"></i>'),
				array('warna'=>'btn btn-primary','url'=>'edit_opsi/','label'=>'<i class="fa fa-pencil"></i>')
		);
		$data['primary_key']	= 'opsi_id';
		$this->template->set_layout('starter_layout');
		$this->template->render($page,$data);
	}

	public function di_simpan($kues_id=false)
	{
		if (!is_null($this->kues)) {
			
			$kues_id   = $this->kues->kues_id;
			if ($this->form_validation->run('set_pertanyaan')) {
				$this->load->model('opsi_kuesioner');
				$data 			= $this->input->post(NULL,true);
				$data['kues_id']= $kues_id;
				if (!isset($data['petunjuk_pertanyaan']) && isset($data['jenis_opsi'])) {
					if ($data['jenis_opsi'] == 'check') {
						$data['petunjuk_pertanyaan'] = 'lebih dari satu jawaban';
					}elseif ($data['jenis_opsi'] == 'radio') {
						$data['petunjuk_pertanyaan'] = 'hanya satu jawaban';
					}else{
						$data['petunjuk_pertanyaan'] = 'jawaban singkat dan jelas';
					}
				}
				if ($opsi_id = $this->opsi_kuesioner->insert($data)) {
					if (!in_array($data['jenis_opsi'],array('teks','level','deskriptif'))) {
						$this->quis->kembali_ke('buat_opsi/'.$opsi_id);
					}
				}else{
					$this->quis->set_pesan('warning','gagal menyimpan kuesioner');
				}
			}else{
				$this->quis->set_pesan('warning',validation_errors());
			}
		}
		$this->quis->kembali_ke('index/'.$kues_id);
	}

	public function buat_opsi($opsi_id=false)
	{
		if ($opsi_id && !is_null($this->kues)) {
			$this->load->model('opsi_kuesioner');
			$data = (array) $this->kues;
			$opsi = (array) $this->opsi_kuesioner->get($opsi_id);
			$data = array_merge($data,$opsi);
			$data['kolom_tabel']= $this->quis->set_kolom('opsi_kuesioner');
			$data['isi_tabel'] 	= $this->opsi_kuesioner->get_by_kues($data['kues_id'],$opsi_id);
			$data['hidden_kolom']=array('opsi_id','induk_opsi','petunjuk_pertanyaan','opsi_jawaban','opsi_wajib','jenis_opsi','kues_id','pertanyaan','group_id');
			$this->template->set_layout('starter_layout');
			$this->template->render('form_tabel_opsi',$data);
		}else if ($data) {
			$this->buat_pertanyaan($data['kues_id']);
		}else{
			$this->halaman_tidak_ditemukan();
		}
	}

	public function simpan_opsi($opsi_id='')
	{
		if ($this->form_validation->run('set_opsi')) {
			$this->load->model('opsi_kuesioner');
			$data 	 			= $this->input->post(NULL,true);
			$data['induk_opsi'] = $opsi_id;
			if (!is_null($this->kues)) {
				$data['kues_id'] 	= $this->kues->kues_id;
				if ($this->opsi_kuesioner->get($opsi_id)) {
					if (!$this->opsi_kuesioner->insert($data)) {
						$this->quis->set_pesan('danger','gagal menyimpan opsi pertanyaan :(');
					}
				}else{
					$this->quis->set_pesan('danger','opsi tidak sesuai dengan pertanyaan');
				}
			}
		}else{
			$this->quis->set_pesan('warning',validation_errors());
		}
		$this->quis->kembali_ke('buat_opsi/'.$opsi_id);
	}

	public function konfirmasi_kuesioner()
	{
		$this->template->set_layout('starter_layout');
		$this->template->render('konfirmasi_kuesioner',$this->kues);
	}

	public function akhiri_kuesioner()
	{
		if (!is_null($this->session->userdata('kues'))) {
			$this->session->unset_userdata('kues');
			$this->kues = NULL;
		}
		redirect('admin','refresh');
	}

	public function di_terbitkan()
	{
		if (!is_null($this->kues)) {
			$kuesioner  = $this->kues;
		}else{
			$this->quis->set_pesan('danger','tidak ada sesi kuesioner');
		}
		if (!is_null($kuesioner->kues_id)) {
			$this->load->model(array('kuesioner','opsi_kuesioner'));
			$tautan_unik 			  = encrypt_url($kuesioner->kues_id.'-'.time());

			$data['status_kuesioner'] = 'terbit';
			$data['tautan_kuesioner'] = site_url('formulir/index/'.$tautan_unik);
			$data['terbit_pada']	  = time();
			if ($this->opsi_kuesioner->get_by_kues($kuesioner->kues_id)) {
				if ($this->kuesioner->update($kuesioner->kues_id,$data)) {
					$this->quis->set_pesan('success','kuesioner berhasil terbit dengan tautan '.anchor($data['tautan_kuesioner'],$data['tautan_kuesioner'],array('target'=>'_blank')));
					$this->akhiri_kuesioner();
					redirect('admin','refresh');
				}else{
					$this->quis->set_pesan('warning','gagal menerbitkan kuesioner '.$kuesioner->judul_kuesioner);
				}
			}else{
				$this->quis->set_pesan('danger','kuesioner '.$kuesioner->judul_kuesioner.' belum memiliki pertanyaan !');
			}
		}
		$this->index();
	}

	public function edit_pertanyaan($opsi_id)
	{
		$this->load->model(array('opsi_kuesioner','users'));
		$page = '404';
		if (!is_null($this->kues)) {
			if (empty($kues_id)) {
				$kues_id 		= $this->kues->kues_id;
			}
			$page 				= 'form_tabel_edit_pertanyaan';
			$data 				= (array) $this->kues;
			$data['pertanyaan'] = $this->opsi_kuesioner->get_single_by($kues_id, $opsi_id);
			$data['jenis_opsi'] = $this->opsi_kuesioner->get_enum_values('jenis_opsi');
		}
		
		$this->template->set_layout('starter_layout');
		$this->template->render($page,$data);
	}
	public function update_pertanyaan($opsi_id)
	{
		
		if($this->form_validation->run('update_pertanyaan')){
			$this->load->model('opsi_kuesioner');
			$data = $this->input->post(NULL,true);
		
		if ($this->opsi_kuesioner->update($opsi_id, $data)) {
				$this->quis->set_pesan('success','pertanyaan berhasil di update');
				redirect('pertanyaan','refresh');				
			}
		}else{
			$this->quis->set_pesan('warning',validation_errors());
		}

		$this->quis->kembali_ke('edit_pertanyaan/'.$opsi_id);	
		
	}
	public function hapus_pertanyaan($opsi_id)
	{
		$this->load->model('opsi_kuesioner');
		if ($this->opsi_kuesioner->delete($opsi_id)) {
			$this->quis->set_pesan('success','pertanyaan berhasil di hapus');
			redirect('pertanyaan','refresh');				
		}else{
			$this->quis->set_pesan('warning','pertanyaan gagal di hapus');
			redirect('pertanyaan','refresh');
		}		
	}

	public function edit_opsi($opsi_id='')
	{
		$this->load->model('opsi_kuesioner');
		if ($opsi = $this->opsi_kuesioner->get($opsi_id)) {
			$data['opsi'] = $opsi;
			$this->template->render('form_edit_opsi_pertanyaan',$data);
		}else{
			$this->quis->set_pesan('warning','opsi tidak sah');
			$this->index();
		}
	}
	
	public function update_opsi($opsi_id=''){
		
	}

}