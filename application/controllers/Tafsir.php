<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tafsir extends CI_Controller {


	public function index()
	{
		$this->load->model('tafsir_m');
		$data=$this->tafsir_m->data();
		$this->parser->parse('tafsir_v',$data);
		
	}
}
