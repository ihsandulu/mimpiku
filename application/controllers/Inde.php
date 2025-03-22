<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class inde extends CI_Controller {


	public function index()
	{
		$this->load->model('inde_m');
		$data=$this->inde_m->data();
		$this->parser->parse('inde_v',$data);
		
	}
}
