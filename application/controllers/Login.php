<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->load->view('login\header_vw');
		$this->load->view('login\login_vw');
		$this->load->view('login\footer_vw');
	}

	public function login_validation(){
		//
		$username = $this->input->post("uname",true);
		$password = $this->input->post("pname",true);
		$user=$this->login_model->login_validation($username,$password);

		//session

			if(count($user)==1){  //if there is user logged in
				$has_error = 1;

				$newdata = array(
					'id'=>$user[0]['user_id'],
					'utype'=>$user[0]['usertype_id'],
					'uname'=>$user[0]['username']
				);

				$this->load->library('session');
				$this->session->set_userdata($newdata);
			}
			else{
				$has_error = 2;
			}
		echo $has_error;
	}
}
