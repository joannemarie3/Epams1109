<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

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
		$this->load->view('content/setup/employee_setup');
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

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_employee('."'".$employee->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_employee('."'".$employee->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

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

	public function ajax_edit($id)
	{
		$data = $this->employee->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
      'empId' => $this->input->post('empId'),
      'firstName' => $this->input->post('firstName'),
      'lastName' => $this->input->post('lastName'),
			'shift' => $this->input->post('shift_id'),
		);
		$insert = $this->employee->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
        'empId' => $this->input->post('empId'),
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName'),
				'shift' => $this->input->post('shift_id'),
			);
		$this->employee->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->employee->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

    if($this->input->post('empId') == '')
    {
      $data['inputerror'][] = 'empId';
      $data['error_string'][] = 'Employee ID is required';
      $data['status'] = FALSE;
    }

		if($this->input->post('firstName') == '')
		{
			$data['inputerror'][] = 'firstName';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('lastName') == '')
		{
			$data['inputerror'][] = 'lastName';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('shift_id') == '---- SELECT SHIFT ----')
		{
			$data['inputerror'][] = 'shidt_id';
			$data['error_string'][] = 'Shift is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function select_shift(){
		$id = $this->input->get('name',true);
		$result = $this->employee->select_shift($id);
		$got_result='';
		if(!empty($result)){
			foreach ($result as $key) {
				$got_result[]=array("id"=>$key['shift_id'],"text"=>$key['shift_name']);
			}
		}
		//print_r($got_result);
		echo json_encode($got_result);
	}

}
