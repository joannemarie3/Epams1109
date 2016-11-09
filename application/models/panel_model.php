<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel_model extends MY_Model {

	public function __construct() {
		parent::__construct();

	}

	public function count_user(){
		$fetch = $this->db->get("users");
		$row = $fetch->num_rows();
		return $row;
	}

	public function count_assets(){
		$fetch = $this->db->get("assets");
		$row = $fetch->num_rows();
		return $row;
	}

	public function count_borrowed(){
		//count borrowed items
	}

	public function select_inventory(){
		$query="SELECT
				a.`device_id`,
				a.`name`,
				a.`model`,
				a.`resolution`,
				a.`processor`,
				a.`ram`,
				a.`os`,
				a.`gpu`,
				a.`bit`,
				a.`simSupport`,
				cat.`category_name`,
				con.`condition_name`
			FROM
				`assets` a
			LEFT JOIN `category` cat
				ON cat.`category_id` = a.`category_id`
			LEFT JOIN `condition` con
				ON con.`condition_id` = a.`condition_id` ";
		$fetch=$this->db->query($query);
		$row = $fetch->result_array();
		return $row;
	}

	public function select_empRecords(){
		$query="SELECT
			e.`empId`,
			e.`firstName`,
			e.`lastName`,
			s.`shift_name`
		FROM
			`employees` AS e
		LEFT JOIN `shifts` s
			ON s.`shift_id` = e.`shift`";
		$fetch=$this->db->query($query);
		$row = $fetch->result_array();
		return $row;
	}

	public function selecet_history(){
		// $this->db->select('release.*');
		$fetch = $this->db->get('history');
		// $query="SELECT
		// 	h.*
		// FROM
		// 	`history` AS h";
		// $fetch=$this->db->query($query);
		$row = $fetch->result_array();
		return $row;
	}

	
}
?>
