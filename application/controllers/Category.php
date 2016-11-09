<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model','category');
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->view('content/setup/category_setup');
    }

    public function ajax_list()
    {
        $list = $this->category->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $category) {
            $no++;
            $row = array();
            $row[] = $category->category_name;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_category('."'".$category->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_category('."'".$category->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->category->count_all(),
                        "recordsFiltered" => $this->category->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
  	{
  		$data = $this->category->get_by_id($id);
  		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
  		echo json_encode($data);
  	}

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'category_name' => $this->input->post('category_name')

            );
        $insert = $this->category->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'category_name' => $this->input->post('category_name')

            );
        $this->category->update(array('category_id' => $this->input->post('category_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->category->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('category_name') == '')
        {
            $data['inputerror'][] = 'category_name';
            $data['error_string'][] = 'Category is required';
            $data['status'] = FALSE;
        }



        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
