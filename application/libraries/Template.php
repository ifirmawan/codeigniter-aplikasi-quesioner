<?php
/**
* 
*/

require_once 'Instance_ci.php';

class Template extends Instance_ci
{

	protected $layout;

	function __construct()
	{
		parent::__construct();
		$this->layout = $this->config->item('default_template');
	}

	public function set_layout($view)
	{
		$this->layout = $view;
	}

	public function render($halaman,$data=array())
	{
		if (is_object($data)) {
			$data = (array) $data;
		}
		$data['my']			= $this->logged_in;	
		$data['pesan'] 	= $this->session->flashdata('pesan');
		$data['halaman'] 	= $this->load->view('pages/'.$halaman,$data,true); 
		$data['judul']		= $this->config->item('judul');
		
		$this->load->view($this->layout,$data);
	}
}