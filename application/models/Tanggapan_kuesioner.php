<?php
/**
* 
*/
class Tanggapan_kuesioner extends MY_Model
{
	public $primary_key = 'tanggapan_id';
	function __construct()
	{
		parent::__construct();
	}

	public function telah_disubmit($peserta_id,$kues_id)
	{
		$where = array(
				'peserta_id' => $peserta_id,
				'kues_id'=>$kues_id
			);
		return $this->get_by($where);
	}

	public function persentase_dari_opsi($opsi_id=''){
		if (!empty($opsi_id) && is_numeric($opsi_id)) {
			$query = "SELECT isi_tanggapan,COUNT(isi_tanggapan) jumlah,((COUNT(isi_tanggapan) / (SELECT COUNT(tanggapan_id)  FROM qs_tanggapan_kuesioner))*100) AS `persen` FROM `qs_isi_tanggapan` WHERE opsi_id = $opsi_id GROUP BY isi_tanggapan";
			return $this->db->query($query)->result_array();
		}
	}

	public function jumlah_setiap_kuesioner()
	{
		//$this->_database->select(array('kues_id','count(tanggapan_id) total'));
		//$this->_database->group_by('kues_id');
		//return $this->get_all();
		$query = "SELECT qs_kuesioner.kues_id,qs_kuesioner.judul_kuesioner, 
		COUNT(qs_tanggapan_kuesioner.tanggapan_id) jumlah FROM qs_kuesioner
		INNER JOIN qs_tanggapan_kuesioner ON 
		qs_kuesioner.kues_id = qs_tanggapan_kuesioner.kues_id 
		GROUP BY qs_tanggapan_kuesioner.kues_id";
		return $this->_database->query($query)->result_array();
		
	}
}