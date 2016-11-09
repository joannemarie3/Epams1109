<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('asset_model','asset');
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
		$this->load->view('content/inventory');
	}

	public function ajax_list()
	{
		$list = $this->asset->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $asset) {
			$no++;
			$row = array();
      $row[] = $asset->device_id;
      $row[] = $asset->name;
      $row[] = $asset->model;
      $row[] = $asset->resolution;
      $row[] = $asset->processor;
      $row[] = $asset->ram;
      $row[] = $asset->os;
      $row[] = $asset->gpu;
      $row[] = $asset->bit;
      $row[] = $asset->simSupport;
      $row[] = $asset->category_id;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->asset->count_all(),
						"recordsFiltered" => $this->asset->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

}
