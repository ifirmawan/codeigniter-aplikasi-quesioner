<?php
/**
* 
*/
class Users extends MY_Model
{
	public $after_get 	= array('forbidden_to_shown');

	function __construct()
	{
		parent::__construct();
	}

	public function forbidden_to_shown($users){
		$users = (array) $users;
		$data = array('password','ip_address','forgotten_password_code','remember_code');
		foreach ($data as $key => $value) {
			
			if (isset($users[$value]) && !is_object($users)) {
				
				unset($users[$value]);
			}
			
		}
		return $users;
	}

	public function get_by_group($group_id)
	{
		//$this->column = array('id','username','email','last_login','active');
		//$this->db->select(array('a.id','a.username','a.email','a.last_login','a.active'));
		$this->db->from('users a');
		$this->db->join('users_groups b', 'b.`user_id` = a.`id`', 'left');
		$this->db->where('b.group_id',$group_id);
		return $this->db->get()->result_array();
	}

	public function get_usability_group()
	{
		$this->db->from('groups');
		$this->db->where_in('id',array('4','5'));
		return $this->db->get()->result_array();
	}

	public function get_group_name($group_id){
		$query = $this->db->get_where('groups',array('id'=>$group_id));
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result->name;
		}else{
			return 'tidak dikenali';
		}
	}
}