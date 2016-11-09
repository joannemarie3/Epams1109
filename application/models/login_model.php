<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		//$this->main_table = "`hr_employee`";
	}
	public function login_validation($user,$pass){

		//selecting all data
		$this->db->where('username',$user);
		$this->db->where('password',md5($pass));
		// $this->db->join('usertypes ut', 'u.usertype_id = ut.id', 'LEFT');

		$fetch = $this->db->get("users");

		//print_r($this->db->last_query());
		$row = $fetch->result_array();
		//print_r($row);
		return $row;
	}
}

?>
