<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Release_model extends CI_Model {

	var $table = 'release_logs';
	var $column_order = array('release_id', 'name', 'status', 'release_date', 'return_date'); //set column field database for datatable orderable
	var $column_search = array('release_id', 'name', 'status', 'release_date', 'return_date'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('release_id' => 'desc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$this->db->from($this->table)->join('employees', 'release_logs.emp_id = employees.empId','inner')->join('assets', 'release_logs.dev_id = assets.device_id','inner');

        // $this->db->select('employees.*, users.id AS users_id, usertypes.*, usertypes.id AS usertypes_id');
        // $this->db->select('assets.*, users.id AS users_id, usertypes.*, usertypes.id AS usertypes_id');
        // $this->db->select('release_log.*, users.id AS users_id, usertypes.*, usertypes.id AS usertypes_id');

		$i = 0;

		foreach ($this->column_search as $item)


		 // loop column
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{

				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{

		$this->db->from($this->table)->join('employees', 'release_logs.emp_id = employees.empId','inner')->join('assets', 'release_logs.dev_id = assets.device_id','inner')->where('release_id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->replace($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
    {
        $this->db->where('release_id', $id);
        $this->db->delete($this->table);
    }

}
