<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->config->item('maintenance_mode') == TRUE) {
			//echo site_url().'maintenance';
			 redirect(site_url().'maintenance');
		}
	}
	
}