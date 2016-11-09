<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emprecords extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('employee_model','employee');
		$this->load->model('panel_model');
		$this->load->model('login_model');
		$user_id=$this->session->userdata("id");
		if(empty($user_id)){
			 redirect(base_url(),'refresh');
		 }
	}
	public function logout(){
				$this->session->userdata = array();
				$this->session->sess_destroy();
				redirect('', 'refresh');
	}

	public function index()
	{
		$user_id=$this->session->userdata("id");
		$this->load->helper('url');
		$this->load->view('content/employee_records');
	}

	public function ajax_list()
	{
		$list = $this->employee->get_datatables();
		// $fKey = $this->employee->get_relatedvalues();

		$data = array();
		$no = $_POST['start'];

		foreach ($list as $employee) {
			$no++;
			$row = array();

      $row[] = $employee->empId;
			$row[] = $employee->firstName;
			$row[] = $employee->lastName;
			$row[] = $employee->shift_name;
			$data[] = $row;

		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->employee->count_all(),
						"recordsFiltered" => $this->employee->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
}
