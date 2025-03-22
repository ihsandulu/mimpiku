<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tanya extends CI_Controller {


	public function index()
	{
		$this->load->model('tanya_m');
		$data=$this->tanya_m->data();
		$this->parser->parse('tanya_v',$data);
		
	}
}
