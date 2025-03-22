<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class logincustomer extends CI_Controller {


	public function index()
	{
		$this->load->model('logincustomer_m');
		$data=$this->logincustomer_m->data();
		$this->parser->parse('logincustomer_v',$data);
		
	}
}
