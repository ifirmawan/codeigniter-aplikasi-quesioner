<?php
/**
* 
*/
class Opsi_kuesioner extends MY_Model
{
	
	public $primary_key ='opsi_id';
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_by_kues($id,$induk_opsi=NULL)
	{
		$where = array(
			'kues_id' => $id,
			'induk_opsi'=> $induk_opsi
		);
		return $this->get_many_by($where);
	}

	public function get_by_pengguna($id,$induk_opsi=NULL)
	{
		$where = array(
			'kues_id' => $id,
			'induk_opsi'=> $induk_opsi,
			'group_id'=>5
		);
		return $this->get_many_by($where);
	}

	public function get_by_pakar($id,$induk_opsi=NULL)
	{
		$where = array(
			'kues_id' => $id,
			'induk_opsi'=> $induk_opsi,
			'group_id'=>4
		);
		return $this->get_many_by($where);
	}


	public function get_single_by($kues_id,$opsi_id)
	{
		$where = array(
			'kues_id' => $kues_id,
			'opsi_id'=> $opsi_id
		);
		return $this->get_by($where);
	}

	public function get_opsi_by($opsi_id)
	{
		$this->_database->select(array('opsi_id','kalimat_opsi','opsi_jawaban'));
		return $this->get_many_by('induk_opsi',$opsi_id);
	}
	public function has_been_answer($data,$type)
	{
		$answers = array();
		if (!is_null($data)) {
			foreach ($data as $key => $value) {
				if ($type == 'radio') {
					$answers[] = $value->opsi_jawaban;
				}
			}
		}
		return (in_array('1', $answers))? true : false;
	}

	public function get_questions_by($kues_id,$return_type='result')
	{
		$this->db->from('kuesioner');
		$this->db->join('opsi_kuesioner','qs_kuesioner.kues_id = qs_opsi_kuesioner.kues_id');
		$this->db->where('qs_opsi_kuesioner.induk_opsi IS NULL', null, false);
		$this->db->where('qs_opsi_kuesioner.kues_id',$kues_id);
		return $this->db->get()->$return_type();
	}

	public function get_multi_name($multi_opsi_id){
		if (strpos($multi_opsi_id,';')) {
			$explode 	= explode(';', $multi_opsi_id);
			$send 		= array();
			foreach ($explode as $key => $value) {
				$opsi 	= $this->get($value);
				if ($opsi) {
					$send[] = $opsi->kalimat_opsi;
				}
 			}
 			if ($send) {
 				return implode(' & ', $send);
 			}
		}else{
			$opsi = $this->get($multi_opsi_id);
			if ($opsi) {
				return $opsi->kalimat_opsi;
			}elseif (is_numeric($multi_opsi_id)) {
				$keterangan = '';
				if ($multi_opsi_id > 5) {
					$keterangan .='sangat setuju ';
				}elseif ($multi_opsi_id > 3 && $multi_opsi_id < 6) {
					$keterangan .= 'setuju ';
				}else{
					$keterangan .='tidak setuju ';
				}
				return $keterangan.$multi_opsi_id;
			}else{
				return $multi_opsi_id;
			}
		}
	}
}