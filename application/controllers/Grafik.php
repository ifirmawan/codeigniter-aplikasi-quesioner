<?php

/**
* 
*/
class Grafik extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	public function pie_pertanyaan($kues_id=''){
		$this->load->model(array('tanggapan_kuesioner','opsi_kuesioner'));
		$data  			= $this->tanggapan_kuesioner->persentase_dari_opsi($kues_id);
		if ($data) {
			$send = array();
			foreach ($data as $key => $rows) {
				
				$send[] = array(
					'name' => $this->opsi_kuesioner->get_multi_name($rows['isi_tanggapan']),
					'y'=> (double)$rows['persen']
				);
			}
			
			$json_format = json_encode($send);
			$this->output
                ->set_content_type('application/json')
                ->set_output($json_format);
		}
	}

	
}