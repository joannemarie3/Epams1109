<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model','user');
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->view('content/setup/user_setup');
    }

    public function ajax_list()
    {
        $list = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $user->username;
            $row[] = $user->usertype_name;
            // $row[] = $user->users_id;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$user->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_user('."'".$user->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->user->count_all(),
                        "recordsFiltered" => $this->user->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
  	{
  		$data = $this->user->get_by_id($id);
  		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
  		echo json_encode($data);
  	}

    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'usertype_id' => $this->input->post('usertype_id'),

            );
        $insert = $this->user->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'usertype_id' => $this->input->post('usertype_id')
            );
        $this->user->update(array('user_id' => $this->input->post('user_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->user->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('password') == '')
        {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('usertype_id') == '')
        {
            $data['inputerror'][] = 'usertype_id';
            $data['error_string'][] = 'Usertype is required';
            $data['status'] = FALSE;
        }


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }


    public function select_usertype(){
      $id = $this->input->get('name',true);
      $result = $this->user->select_usertype($id);
      $got_result='';
      if(!empty($result)){
        foreach ($result as $key) {
          $got_result[]=array("id"=>$key['usertype_id'],"text"=>$key['usertype_name']);
        }
      }
      //print_r($got_result);
      echo json_encode($got_result);
    }
}
