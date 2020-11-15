<?php
/**
* 
*/
class MY_Controller extends CI_Controller
{
	public $logged_in;

	function __construct()
	{
		parent::__construct();

		$this->load->library('quis');

		$this->quis->set_me(get_class($this));

		$this->lang->load(array('form_validation_lang','upload_lang'));

		$this->set_logged_in();

		$this->is_not_allowed();

		$this->set_email_config();

	}

	public function index()
	{
		//var_dump($this->logged_in);
		echo 'hello world';
	}

	protected function set_logged_in()
	{
		$this->config->load('ion_auth',TRUE);
		$this->load->model(array('ion_auth_model'));
		$cookie_name  = $this->config->item('identity_cookie_name','ion_auth');
		
		if (!is_null($this->session->userdata($cookie_name))) {
			
			$this->logged_in 		= $this->session->userdata($cookie_name);
			$user_id 				= $this->logged_in['user_id'];
			$group			  		= $this->ion_auth_model->get_users_groups($user_id)->row();
			$this->logged_in['is']		 = $group->name;
			$this->logged_in['group_id'] = $group->id;
		}
	}

	protected function is_not_allowed()
	{
		$this->db->select('name');
		$query 		 = $this->db->get('groups');
		$controller  = get_class($this);
		$controller  = strtolower($controller);
		if (is_null($this->logged_in) && !in_array($controller, array('auth','formulir','landing'))) {
			redirect('auth','refresh');
		}elseif ($query->num_rows() > 0) {
			$user_groups = $query->result_array();
			$groups 	 = array();
			foreach ($user_groups as $key => $value) {
				$groups[]=$value['name'];
			}
			if (in_array($controller,$groups)) {
				if ($this->logged_in['is'] != $controller) {
					redirect($this->logged_in['is'],'refresh');
				}
			}
		}
		
	}

	public function keluar()
	{
		$this->load->library('ion_auth');
		$redirect = 'auth/index';
		if (isset($this->logged_in['is']) && $this->logged_in['is'] == 'peserta') {
			$redirect = 'landing/index';
		}
		if ($this->ion_auth->logout()) {
			$this->logged_in = NULL;
			
		}
		redirect($redirect,'refresh');
	}
	public function halaman_tidak_ditemukan()
	{
		$this->template->set_layout('starter_layout');
		$this->template->render('404');
	}

	protected function set_email_config()
	{
		$config = Array(
    		'protocol' => 'smtp',
    		'smtp_host' => 'mail.smtp2go.com',
    		'smtp_port' => '2525',
    		'smtp_user' => 'firmawaneiwan@gmail.com',
    		'smtp_pass' => 'ROgOUySqbbrD',
    		'mailtype'  => 'html'
		);
		$this->load->library('email', $config);
	}

	public function tentang_saya(){
		$this->load->model('users');
		$user_id 		= $this->logged_in['user_id'];
		$data['detail'] = $this->users->get($user_id);
		$this->template->render('tentang_saya',$data);
	}

	public function pengaturan_akun(){
		$this->template->render('form_pengaturan_akun');
	}

	public function submit_pengaturan_akun()
	{
		
		if ($this->form_validation->run('reset_password')) {
			$this->load->library('ion_auth'); //memanggil libraray ion_auth /application/libraries/Ion_auth.php
			$this->load->model('ion_auth_model');//memangil model ion_auth_model
			$identity 	= $this->logged_in['email'];
			$password 	= $this->input->post('password');
			$change  	= $this->ion_auth->reset_password($identity, $password);
			if ($change) {
				$this->quis->set_pesan('info',$this->ion_auth->messages());
			}
			$this->keluar();
		}else{
			$this->quis->set_pesan('warning',validation_errors());
		}
		$redirect = $this->logged_in['is'].'/pengaturan_akun';
		redirect($redirect,'refresh');
	}
}