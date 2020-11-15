<?php

/**
* 
*/
class Pakar extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->template->set_layout('dashboard_peserta');
	}
	public function index()
	{
		$this->template->render('beranda_peserta');
	}
}