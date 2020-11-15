<?php
/**
* 
*/
//require 'Instance_ci.php';
require_once 'Instance_ci.php';

class Quis extends Instance_ci
{
	public $userdata;
	private $me;
	private $tables;
	
	function __construct()
	{
		parent::__construct();
		$this->set_tables();
	}

	public function set_me($is)
	{
		$this->me = $is;
	}

	public function mulai_sesi($data)
	{
		if (!is_null($this->userdata)) {
			$this->session->set_userdata($this->userdata,$data);
		}
	}
	public function akhiri_sesi()
	{
		if (!is_null($this->userdata)) {
			$this->session->unset_userdata($this->userdata);
		}
	}
	public function ambil_sesi()
	{
		if (!is_null($userdata  = $this->session->userdata($this->userdata))) {
			return $userdata;
		}
	}
	
	public function set_pesan($status,$pesan)
	{
		$data['status'] 	= $status;
		$data['pesan']	= $pesan;
		$pesan 			= $this->load->view('errors/alert_view',$data,true);
		$this->session->set_flashdata('pesan',$pesan);
	}

	protected function set_format_kolom(&$item, $key)
	{
		$item = str_replace(array('proyek_','_'), array('',' '), $item);
		$item = strtoupper($item);
	}

	public function set_kolom($model_name=false)
	{
		if ($model_name && in_array($model_name, $this->get_tables())) {
			$this->load->model($model_name);
			$list_fields 	= $this->$model_name->column;
			$kunci 			= $list_fields;
			if ($list_fields) {
				array_walk_recursive($list_fields, array($this,'set_format_kolom'));
				return array_combine($kunci, $list_fields);
			}
		}
	}

	private function set_tables()
	{
		$query 			= "show tables";
		$result 		= $this->db->query($query)->result_array();
		$dbname 		= $this->db->database;
		$dbprefix 		= $this->db->dbprefix;
		$length_dbprefix=strlen($dbprefix);
		$tables 		= array();	
		if ($result) {
			foreach ($result as $key => $value) {
				if (isset($value['Tables_in_'.$dbname])) {
					$tables[] = substr($value['Tables_in_'.$dbname], $length_dbprefix);
				}

			}
			$this->tables 	= $tables;
		}
	}

	public function get_tables()
	{
		return $this->tables;
	}

	public function kembali_ke($alamat='index')
	{
		if (!is_null($this->me)) {
			redirect($this->me.'/'.$alamat,'refresh');
		}
	}

	public function last_segment_uri()
	{
		$list_uri 		= $this->uri->segment_array();
		$last_uri 		= end($list_uri); // mengambil segment terakhir.
		$parts 			= explode('_', $last_uri); //memecah segment dengan underscore.
		return (isset($parts[1]))? $parts[1] : $last_uri; //jika index ke-1 ada maka kirim element index ke-1
	}
}