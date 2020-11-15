<?php
/**
* 
*/
class Kuesioner extends MY_Model
{
	public $primary_key = 'kues_id';
	function __construct()
	{
		parent::__construct();
	}
	public function telah_terbit()
	{
		return $this->get_many_by('status_kuesioner','terbit');
	}

	
}