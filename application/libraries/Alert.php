<?php
/**
* 
*/
class Alert
{
	private $ci;
	public $message;
	protected $template;
	public $data = array();

	function __construct()
	{
		$this->ci =& get_instance();		
		$this->set_template('bootstrap_alert');

	}
	public function set_template($tpl)
	{
		$this->template = $tpl;
	}

	public function show($status,$message,$bold='')
	{
		$this->data['status'] 	= $status;
		$this->data['bold']		= $bold;
		$this->data['message']  = $message;
		$this->ci->load->view($this->template,$this->data);
	}

	public function render($status,$message,$bold='')
	{
		$this->data['status'] 	= $status;
		$this->data['bold']		= $bold;
		if ($message) {
			$this->data['message'] = $message;
			return $this->ci->load->view($this->template,$this->data,true);
		}
	}
}