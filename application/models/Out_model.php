<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Out_model extends CI_Model {

    var $table = 'out';
    var $column_order = array('out_id',null); //set column field database for datatable orderable
    var $column_search = array('out_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        # select assets
        # select employees
        # select status
        $this->db->select('
        out.out_id as id,
        a.device_id,
        a.name as device_name,
        e.empId,
        e.firstName as employee_name,
        s.status_id,
        s.status_name');
        # join
        $this->db->join('assets a', 'a.id = out.item_id', 'left');
    		$this->db->join('employees e', 'e.id = out.employee_id', 'left');
    		$this->db->join('status s', 's.status_id = out.status_id', 'left');
        $this->db->from($this->table);
        //$row = $fetch->result_array();
        //print_r($this->db->last_query());

        $i = 0;

        foreach ($this->column_search as $item) // loop column
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
        $this->db->from($this->table);
        $this->db->where('out_id',$id);
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
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function select_employee($id){
  			$this->db->like('firstName',$id);
        // $this->db->or_like('empId',$id);
  			$fetch = $this->db->get("employees");
  			$row = $fetch->result_array();
  			//print_r($this->db->last_query());
  			return $row;
  	}

  	public function select_device($id){
        $this->db->like('name',$id);
  			// $this->db->or_like('device_id',$id);
  			$fetch = $this->db->get("assets");
  			$row = $fetch->result_array();
  			//print_r($this->db->last_query());
  			return $row;
  	}

}
