<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shift extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('shift_model','shift');
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->view('content/setup/shift_setup');
    }

    public function ajax_list()
    {
        $list = $this->shift->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $shift) {
            $no++;
            $row = array();
            $row[] = $shift->shift_name;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_shift('."'".$shift->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_shift('."'".$shift->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->shift->count_all(),
                        "recordsFiltered" => $this->shift->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
  	{
  		$data = $this->shift->get_by_id($id);
  		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
  		echo json_encode($data);
  	}

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'shift_name' => $this->input->post('shift_name')

            );
        $insert = $this->shift->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'shift_name' => $this->input->post('shift_name')

            );
        $this->shift->update(array('shift_id' => $this->input->post('shift_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->shift->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('shift_name') == '')
        {
            $data['inputerror'][] = 'shift_name';
            $data['error_string'][] = 'Shift is required';
            $data['status'] = FALSE;
        }



        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
