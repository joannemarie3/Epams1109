<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Release extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('release_model','release');
		$this->load->model('asset_model','asset');
		$this->load->model('employee_model','employee');
		$this->load->model('user_model','user');
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
		$this->load->view('content/release');
	}

	public function ajax_list_asset()
	{
		$list = $this->asset->get_vanilla_datatables();
		$assets = array();
		foreach ($list as $asset) {
      			$assets[] =  array('device_id' => ($asset->device_id), 'device_name' => ($asset->name));
		}

		// log_message('error', json_encode($assets));
		echo json_encode($assets);
	}

	public function ajax_list_user()
	{
		$list = $this->employee->get_vanilla_datatables();
		$users = array();
		foreach ($list as $employee) {
      			$employees[] =  array('user_id' => ($employee->empId), 'user_name' => ($employee->lastName) . ", " . ($employee->firstName));
		}

		// log_message('error', json_encode($users));
		echo json_encode($employees);
	}

	public function ajax_save_potchi()
	{

		$data = array(
	      	'dev_id' => $this->input->post('select-item'),
	      	'emp_id' => $this->input->post('select-user'),
	      	'release_date' => $this->input->post('release-date'),
	      	'status' => 'Borrowed'
		);

		// log_message('error', json_encode($data));

		$insert = $this->release->save($data);
		// $history = $this->panel_model->save($data);
		echo json_encode("Success");
	}

	public function ajax_populate()
	{
		$list = $this->release->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $release) {
			$no++;
			$row = array();
		      $row[] = $release->dev_id;
		      $row[] = $release->name;
		      $row[] = $release->release_date;

		      if($release->return_date == NULL) {
		      	$row[] = "PENDING";
		      } else {
		      	$row[] = $release->return_date;
		      };

		      $row[] = $release->status;
		      $row[] = $release->lastName . ", " . $release->firstName;

			// add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Return" onclick="edit_asset('."'".$release->release_id."'".')"><i class="glyphicon glyphicon-arrow-up"></i> Return</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_asset('."'".$release->release_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->release->count_all(),
						"recordsFiltered" => $this->release->count_filtered(),
						"data" => $data,
				);
		//output to json format
		// log_message('error', json_encode($data));
		echo json_encode($output);
	}
	public function ajax_edit($id)
	{
		$data = $this->release->get_by_id($id);
		// log_message('error', json_encode($data));
		echo json_encode($data);
	}

	public function ajax_update()
	{

		$data = array(
	      	'dev_id' => $this->input->post('modal-select-item'),
	      	'emp_id' => $this->input->post('modal-select-user'),
	      	'release_date' => $this->input->post('modal-release-date'),
	      	'return_date' => $this->input->post('modal-return-date'),
	      	'status' => $this->input->post('modal-select-status'),
	      	'release_id' => $this->input->post('id')

		);

		log_message('error', json_encode($data));

		$this->release->update($data['release_id'], $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->release->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}
