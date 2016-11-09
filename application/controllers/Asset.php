<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset extends CI_Controller {

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
		$this->load->view('content/setup/asset_setup');
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
			$row[] = $asset->barcode;
			$row[] = $asset->name;
			$row[] = $asset->brand;
			$row[] = $asset->model;
			$row[] = $asset->resolution;
			$row[] = $asset->processor;
			$row[] = $asset->ram;
			$row[] = $asset->os;
			$row[] = $asset->chipset;
			$row[] = $asset->gpu;
			$row[] = $asset->bit;
			$row[] = $asset->screenSize;
			$row[] = $asset->graphics;
			$row[] = $asset->internalStorage;
			$row[] = $asset->simSupport;
			$row[] = $asset->arrivalDate;
			$row[] = $asset->arrivalNotes;
			$row[] = $asset->serial;
			$row[] = $asset->assetType;
			$row[] = $asset->subAsset;
			$row[] = $asset->imei;
			$row[] = $asset->storageAllocation;
			$row[] = $asset->category_name;
			$row[] = $asset->condition_name;
			$row[] = $asset->status_name;


			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_asset('."'".$asset->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_asset('."'".$asset->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

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

	public function ajax_edit($id)
	{
		$data = $this->asset->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
			'device_id' => $this->input->post('device_id'),
			'barcode' => $this->input->post('barcode'),
			'name' => $this->input->post('name'),
			'brand' => $this->input->post('brand'),
			'model' => $this->input->post('model'),
			'resolution' => $this->input->post('resolution'),
			'processor' => $this->input->post('processor'),
			'ram' => $this->input->post('ram'),
			'os' => $this->input->post('os'),
			'chipset' => $this->input->post('chipset'),
			'gpu' => $this->input->post('gpu'),
			'bit' => $this->input->post('bit'),
			'screenSize' => $this->input->post('screenSize'),
			'graphics' => $this->input->post('graphics'),
			'internalStorage' => $this->input->post('internalStorage'),
			'simSupport' => $this->input->post('simSupport'),
			'arrivalDate' => $this->input->post('arrivalDate'),
			'arrivalNotes' => $this->input->post('arrivalNotes'),
			'serial' => $this->input->post('serial'),
			'assetType' => $this->input->post('assetType'),
			'subAsset' => $this->input->post('subAsset'),
			'imei' => $this->input->post('imei'),
			'storageAllocation' => $this->input->post('storageAllocation'),
			'category_id' => $this->input->post('category_id'),
			'condition_id' => $this->input->post('condition_id'),
			'status_id' => $this->input->post('status_id'),
			);
		$insert = $this->asset->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'device_id' => $this->input->post('device_id'),
			'barcode' => $this->input->post('barcode'),
			'name' => $this->input->post('name'),
			'brand' => $this->input->post('brand'),
			'model' => $this->input->post('model'),
			'resolution' => $this->input->post('resolution'),
			'processor' => $this->input->post('processor'),
			'ram' => $this->input->post('ram'),
			'os' => $this->input->post('os'),
			'chipset' => $this->input->post('chipset'),
			'gpu' => $this->input->post('gpu'),
			'bit' => $this->input->post('bit'),
			'screenSize' => $this->input->post('screenSize'),
			'graphics' => $this->input->post('graphics'),
			'internalStorage' => $this->input->post('internalStorage'),
			'simSupport' => $this->input->post('simSupport'),
			'arrivalDate' => $this->input->post('arrivalDate'),
			'arrivalNotes' => $this->input->post('arrivalNotes'),
			'serial' => $this->input->post('serial'),
			'assetType' => $this->input->post('assetType'),
			'subAsset' => $this->input->post('subAsset'),
			'imei' => $this->input->post('imei'),
			'storageAllocation' => $this->input->post('storageAllocation'),
			'category_id' => $this->input->post('category_id'),
			'condition_id' => $this->input->post('condition_id'),
			'status_id' => $this->input->post('status_id'),
			'id' => $this->input->post('main_id')
			);
		$this->asset->update($data['id'], $data);

		log_message('error', "DATA ID: " . ($data['id']));

		echo json_encode(array("status" => TRUE));

	}

	public function ajax_delete($id)
	{
		$this->asset->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('device_id') == '')
		{
			$data['inputerror'][] = 'device_id';
			$data['error_string'][] = 'Device Id is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('barcode') == '')
		{
			$data['inputerror'][] = 'barcode';
			$data['error_string'][] = 'Barcode is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('name') == '')
		{
			$data['inputerror'][] = 'name';
			$data['error_string'][] = 'Name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('brand') == '')
		{
			$data['inputerror'][] = 'brand';
			$data['error_string'][] = 'Brand is required';
			$data['status'] = FALSE;
		}


		if($this->input->post('model') == '')
		{
			$data['inputerror'][] = 'model';
			$data['error_string'][] = 'Model is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('resolution') == '')
		{
			$data['inputerror'][] = 'resolution';
			$data['error_string'][] = 'Resolution is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('processor') == '')
		{
			$data['inputerror'][] = 'processor';
			$data['error_string'][] = 'Processor is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('ram') == '')
		{
			$data['inputerror'][] = 'ram';
			$data['error_string'][] = 'Ram is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('os') == '')
		{
			$data['inputerror'][] = 'os';
			$data['error_string'][] = 'OS is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('chipset') == '')
		{
			$data['inputerror'][] = 'chipset';
			$data['error_string'][] = 'EmployeeID is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('gpu') == '')
		{
			$data['inputerror'][] = 'gpu';
			$data['error_string'][] = 'Gpu is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('bit') == '')
		{
			$data['inputerror'][] = 'bit';
			$data['error_string'][] = 'Bit is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('screenSize') == '')
		{
			$data['inputerror'][] = 'screenSize';
			$data['error_string'][] = 'Screen Size is required';
			$data['status'] = FALSE;
		}


		if($this->input->post('graphics') == '')
		{
			$data['inputerror'][] = 'graphics';
			$data['error_string'][] = 'Graphics is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('internalStorage') == '')
		{
			$data['inputerror'][] = 'internalStorage';
			$data['error_string'][] = 'Internal Storage is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('simSupport') == '')
		{
			$data['inputerror'][] = 'simSupport';
			$data['error_string'][] = 'Sim Support is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('arrivalDate') == '')
		{
			$data['inputerror'][] = 'arrivalDate';
			$data['error_string'][] = 'Arrival Date is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('arrivalNotes') == '')
		{
			$data['inputerror'][] = 'arrivalNotes';
			$data['error_string'][] = 'Arrival Notes is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('serial') == '')
		{
			$data['inputerror'][] = 'serial';
			$data['error_string'][] = 'Serial is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('assetType') == '')
		{
			$data['inputerror'][] = 'assetType';
			$data['error_string'][] = 'Set Type is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('subAsset') == '')
		{
			$data['inputerror'][] = 'subAsset';
			$data['error_string'][] = 'Sub Asset is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('imei') == '')
		{
			$data['inputerror'][] = 'imei';
			$data['error_string'][] = 'IMEI is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('storageAllocation') == '')
		{
			$data['inputerror'][] = 'storageAllocation';
			$data['error_string'][] = 'Storage Allocation is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('category_id') == '')
		{
			$data['inputerror'][] = 'category_id';
			$data['error_string'][] = 'Category is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('condition_id') == '')
		{
			$data['inputerror'][] = 'condition_id';
			$data['error_string'][] = 'Condition is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('status_id') == '')
		{
			$data['inputerror'][] = 'status_id';
			$data['error_string'][] = 'Status is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	public function select_category(){
		$id = $this->input->get('name',true);
		$result = $this->asset->select_category($id);
		$got_result='';
		if(!empty($result)){
			foreach ($result as $key) {
				$got_result[]=array("id"=>$key['category_id'],"text"=>$key['category_name']);
			}
		}
		//print_r($got_result);
		echo json_encode($got_result);
	}

	public function select_condition(){
		$id = $this->input->get('name',true);
		$result = $this->asset->select_condition($id);
		$got_result='';
		if(!empty($result)){
			foreach ($result as $key) {
				$got_result[]=array("id"=>$key['condition_id'],"text"=>$key['condition_name']);
			}
		}
		//print_r($got_result);
		echo json_encode($got_result);
	}

	public function select_status(){
		$id = $this->input->get('name',true);
		$result = $this->asset->select_status($id);
		$got_result='';
		if(!empty($result)){
			foreach ($result as $key) {
				$got_result[]=array("id"=>$key['status_id'],"text"=>$key['status_name']);
			}
		}
		//print_r($got_result);
		echo json_encode($got_result);
	}
}
