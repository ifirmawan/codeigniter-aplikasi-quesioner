<?php
/**
* 
*/
class Isi_tanggapan extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function has_been_answered($tanggapan_id,$opsi_id)
	{
		$where = array(
				'tanggapan_id' => $tanggapan_id,
				'opsi_id'=>$opsi_id
			);
		return $this->get_by($where);
	}
}