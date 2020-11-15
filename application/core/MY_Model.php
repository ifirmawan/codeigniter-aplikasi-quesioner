<?php

/**
* 
*/
require 'Jamie_Model.php';
class MY_Model extends Jamie_Model
{
	/**
	 * [$list_join larik pernyataan perintah join sql]
	 * @var array
	 */
	public $list_join;
	/**
	 * [$column larik daftar kolom dari table yang sedang digunakan]
	 * @var [array]
	 */
	public $column;
	/**
	 * [$condition larik pernyataan kondisi perintah join sql]
	 * @var array
	 */
	public $condition = array();
	/**
	 * [$select_join pernyataan perintah sql untuk meyeleksi kolom yang akan digunakan]
	 * @var [type]
	 */
	protected $select_join;
	/**
	 * [$from_join pernyataan perintah ]
	 * @var [string]
	 */
	protected $from_join;
	
	function __construct()	
	{
		parent::__construct();
		/**
		 * [$this->column mengisikan default column dari fields table yang sedang digunakan]
		 * @var [type]
		 */
		$this->column = $this->db->list_fields($this->_table);
	}
	/**
	 * [check_query_statement memeriksa isi pernyataan query terakhir yang dijalankan]
	 * @return [string] [pernyataan sql]
	 */
	public function check_query_statement()
	{
		return $this->db->last_query();
	}
	/**
	 * [set_query_like membuat pernyataan perintah like dalam pencarian data pada tabel]
	 */
	public function set_query_like()
	{
		$find		='';//default empty 
		$this->_database->query(" SET collation_connection = 'utf8_general_ci'"); //mengurangi resiko gagal pada perintah like
		if (isset($_REQUEST['searchPhrase'])) {//jika menggunakan request jquerybootgrid
			$find 	= $_REQUEST['searchPhrase'];//ambil data keyword dari pengguna
		}
		if (isset($_POST['search'])) { //jika menggunakan request datatables
			$query 	= $_POST['search'];
			$find 	= $query['value'];//ambil data keyword dari pengguna
		}
		$find		= trim($find); //menghilangkan spasi kosong dengan trim
		if (isset($find) && !empty($find)) {//
			foreach ($this->column as $key => $item) {
				if ($item !='id') { //selain column id
					//memisahkan kolom pertama yang menggunakan syntax like dengan syntax selanjutnya menggunakan or like.
					($key == 1 )? $this->_database->like($item, $find) : $this->_database->or_like($item, $find); 
				}
			}
		}
	}
	/**
	 * [set_query_limit membuat query untuk membuat halaman pada tampilan tabel]
	 */
	public function set_query_limit()
	{
		$page 			= 1;
		if (isset($_POST['length']) && isset($_POST['start'])) {
			if($_POST['length'] != -1)
				$this->_database->limit($_POST['length'], $_POST['start']);
		}elseif (isset($_REQUEST['current']) && isset($_REQUEST['rowCount']))  {
			$limit 		= $_REQUEST['rowCount'];
			$page 		= $_REQUEST['current'];
			$start_from = ($page-1) * $limit;
			if($limit != -1)
				$this->_database->limit($limit,$start_from);
		}
	}
	/**
	 * [show_all query select yang dapat digunakan sebagai resource datatables atau jquerybootgrid.]
	 * @return [array] [larik semua data]
	 */
	public function show_all()
	{
		$this->set_query_like();
		$this->set_query_limit();
		return $this->as_array()->get_all();
	}
	/**
	 * [get_join description]
	 * @param  string $output [description]
	 * @return [type]         [description]
	 */
	public function get_join($output = 'result_array')
	{

		$join_table = $this->config->item('table')['join'];
		$select 	= (is_null($this->select_join))? '*' 		: $this->select_join;
		$from 		= (is_null($this->from_join))? $this->_table 	: $this->from_join;
		$this->db->select($select);
		$this->db->from($from);
		if ($this->condition) {
			$this->db->where($this->condition); //
		}
		if ($this->list_join) {
			foreach ($this->list_join as $key => $value) {
				if (in_array($key, $join_table)) {
					$this->db->join($key,$value);
				}
			}
		}
		return $this->db->get()->$output();
	}

	/**
	 * [get_enum_values ambil isi data pada kolom yang bertype ENUM]
	 * @param  [string] $field [nama kolom yang bertype ENUM]
	 * @return [array] [data]
	 */
	public function get_enum_values($field)
	{
		$enum = array();
		$result = $this->db
			->query( "SHOW COLUMNS FROM ".$this->db->dbprefix."{$this->_table} WHERE Field = '{$field}'" )
			->row(0);
		if (!is_null($result)) {
			$type = $result->Type;
			preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches); //mengekstraksi data enum dari kolom
			$enum = explode("','", $matches[1]);
		}
		return $enum;
	}
	/**
	 * [get_from_requester ambil data dari akun yang melakukan permintaan kepada akun lain]
	 * @param  [integer] $id [id data primary key]
	 * @return [array]     [detail data sesuai dengan tabel dan id yang sedang digunakan]
	 */
	public function get_from_requester($id)
	{
		return $this->get_many_by('id_permintaan_dari',$id);
	}
	/**
	 * [get_from_creator ambil data dari akun yang menanggapi permintaan dari akun lain ]
	 * @param  [integer] $id [description]
	 * @return [array]     [detail data sesuai dengan tabel dan id yang sedang digunakan]
	 */
	public function get_from_creator($id)
	{
		return $this->get_many_by('id_tanggapi_oleh',$id);
	}
	/**
	 * [get_requester_username mengambil username yang melakukan permintaan dari tabel yang sedang aktif]
	 * @param  [integer] $id_user [id akun dari tabel users]
	 * @return [string]          [username]
	 */
	public function get_requester_username($id_user)
	{
		$query = $this->db->get_where('users',array('id' => $id_user));
		if ($query->num_rows() > 0) {
			$data = $query->row();
			return $data->username; //ambil username
		}
	}

}