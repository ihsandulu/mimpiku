<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class paketku extends CI_Controller {


	public function index()
	{
		$this->load->model('paketku_m');
		$data=$this->paketku_m->data();
		$this->parser->parse('paketku_v',$data);
		
	}
}
