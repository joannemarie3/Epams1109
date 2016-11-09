<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('client_model','client');
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->view('content/setup/client_setup');
    }

    public function ajax_list()
    {
        $list = $this->client->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $client) {
            $no++;
            $row = array();
            $row[] = $client->client_name;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_client('."'".$client->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_client('."'".$client->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->client->count_all(),
                        "recordsFiltered" => $this->client->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
  	{
  		$data = $this->client->get_by_id($id);
  		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
  		echo json_encode($data);
  	}


    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'client_name' => $this->input->post('client_name')

            );
        $insert = $this->client->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'client_name' => $this->input->post('client_name')

            );
        $this->client->update(array('client_id' => $this->input->post('client_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->client->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('client_name') == '')
        {
            $data['inputerror'][] = 'client_name';
            $data['error_string'][] = 'Client is required';
            $data['status'] = FALSE;
        }



        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
