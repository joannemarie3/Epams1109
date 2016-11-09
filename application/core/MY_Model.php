<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_data($table, $where=array(), $order=array(), $limit=0, $offset=0){
		foreach($where as $dtl){
			$this->db->where($dtl['field'],$dtl['value'],$dtl['escape']);
		}
		
		foreach($order as $dtl){
			$this->db->order_by($dtl['field'],$dtl['order']);
		}
		
		if($limit !== 0){
			$this->db->limit($limit, $offset);
		}
		
		
		$resource = $this->db->get($table);
		
		return $resource;
	}
	
	public function last_query() {
		return $this->db->last_query();
	}
}