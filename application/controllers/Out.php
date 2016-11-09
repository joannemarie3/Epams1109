<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Out extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('out_model','out');
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->view('content/out');
    }

    public function ajax_list()
    {
        $list = $this->out->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $out) {
            $no++;
            $row = array();
            $row[] = $out->id;
            $row[] = $out->device_name;
            $row[] = $out->employee_name;
            $row[] = $out->status_name;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Borrow" onclick="borrow_asset('."'".$out->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Borrow</a>
                  <a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Return" onclick="return_asset('."'".$out->id."'".')"><i class="glyphicon glyphicon-trash"></i> Return</a>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->out->count_all(),
                        "recordsFiltered" => $this->out->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
  	{
  		$data = $this->out->get_by_id($id);
  		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
  		echo json_encode($data);
  	}

    //borrow
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'out_name' => $this->input->post('out_name')

            );
        $insert = $this->out->save($data);
        echo json_encode(array("status" => TRUE));
    }
    //return
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'out_name' => $this->input->post('out_name')

            );
        $this->out->update(array('out_id' => $this->input->post('out_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('out_name') == '')
        {
            $data['inputerror'][] = 'out_name';
            $data['error_string'][] = 'Condition is required';
            $data['status'] = FALSE;
        }



        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function select_employee(){
  		$id = $this->input->get('name',true);
  		$result = $this->out->select_employee($id);
  		$got_result='';
  		if(!empty($result)){
  			foreach ($result as $key) {
  				$got_result[]=array("id"=>$key['id'],"text"=>$key['firstName']);
  			}
  		}
  		//print_r($got_result);
  		echo json_encode($got_result);
  	}

  	public function select_device(){
  		$id = $this->input->get('name',true);
  		$result = $this->out->select_device($id);
  		$got_result='';
  		if(!empty($result)){
  			foreach ($result as $key) {
  				$got_result[]=array("id"=>$key['id'],"text"=>$key['name']);
  			}
  		}
  		//print_r($got_result);
  		echo json_encode($got_result);
  	}

}
