<?php

	function get_induk_opsi($opsi_id)
	{
		$ci =&get_instance();
		$ci->load->model('opsi_kuesioner');
		return $ci->opsi_kuesioner->get_opsi_by($opsi_id);
	}

	function get_judul_kuesioner($kues_id)
	{
		$ci =&get_instance();
		$ci->load->model('kuesioner');
		if ($kuesioner = $ci->kuesioner->get($kues_id)) {
			return $kuesioner->judul_kuesioner;
		}
		return false;
	}

	function get_nama_peserta($peserta_id)
	{
		$ci =&get_instance();
		$ci->load->model('peserta');
		if ($peserta = $ci->peserta->get($peserta_id)) {
			return $peserta->nama_peserta;
		}
		return false;
	}

	function render_opsi_radio_check_html($data,$jenis_opsi,$induk_opsi)
	{
		if ($data) {
			$input_answer 	   ='';
			$input['check']    ='<input type="checkbox" name="isi_tanggapan['.$induk_opsi.'][]" ';
			$input['radio']    ='<input type="radio" name="isi_tanggapan['.$induk_opsi.']" ';
			foreach ($data as $key => $value) { 
				$input_answer .=$input[$jenis_opsi];
				$input_answer .='value="'.$value->opsi_id.'" />&nbsp;';
				$input_answer .=$value->kalimat_opsi.'<br/>';
			}                                	
			echo $input_answer;
		}
	}


	function render_opsi_dropdown_html($data,$induk_opsi)
	{
		if ($data) {
			$element ='<select name="isi_tanggapan['.$induk_opsi.']" class="form-control">';
			$element .='<option value="0">Pilih salah satu</option>';
			foreach ($data as $key => $value) { 
				$element .='<option value="'.$value->opsi_id.'" >';
				$element .=$value->kalimat_opsi.'</option>';
			}
			$element .='</select>';
			echo $element;
		}
	}

	function render_opsi_level_html($induk_opsi)
	{
		$level = '<strong>sangat tidak setuju</strong>';
		for ($x=1; $x <=8 ; $x++) { 
			if ($x == 8) {
				$level .='<input type="radio" value="0" name="isi_tanggapan['.$induk_opsi.']" style="margin-left:25px;">';
				$level .='<strong> N/A </strong>';
			}else if ($x == 7) {
				$level .='&nbsp;<input type="radio" value="'.$x.'" name="isi_tanggapan['.$induk_opsi.']">&nbsp;'.$x;
				$level .='&nbsp;<strong>sangat setuju</strong>';
			}else{
				$level .='&nbsp;<input type="radio" value="'.$x.'" name="isi_tanggapan['.$induk_opsi.']">&nbsp;'.$x;
			}
		}
		echo $level;
	}

	function get_group_name($group_id=''){
		$ci =&get_instance();
		$ci->load->model('users');
		return $ci->users->get_group_name($group_id);
	}

	