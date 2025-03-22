<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class detail extends CI_Controller {


	public function index()
	{
		$this->load->model('detail_m');
		$data=$this->detail_m->data();
		$this->parser->parse('detail_v',$data);
		
	}
}
