<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class search extends CI_Controller {


	public function index()
	{
		$this->load->model('search_m');
		$data=$this->search_m->data();
		$this->parser->parse('search_v',$data);
		
	}
}
