<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class logoutcustomer extends CI_Controller {


	public function index()
	{
		$this->session->sess_destroy();
		redirect(base_url());			
	}
}
