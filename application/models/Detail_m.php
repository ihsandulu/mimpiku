<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class detail_M extends CI_Model {
	
	public function data()
	{	
		$data=array();	
		$data["message"]="";
		//cek mimpi
		$mimpid["mimpi_id"]=$this->input->post("mimpi_id");
		$us=$this->db
		->get_where('mimpi',$mimpid);	
		//echo $this->db->last_query();die;	
		if($us->num_rows()>0)
		{
			foreach($us->result() as $mimpi){		
			foreach($this->db->list_fields('mimpi') as $field)
			{
				$data[$field]=$mimpi->$field;
			}		
		}
		}else{	
			 		
			
			foreach($this->db->list_fields('mimpi') as $field)
			{
				$data[$field]="";
			}		
			
		}
		
		//upload image
		$data['uploadmimpi_picture']="";
		if(isset($_FILES['mimpi_picture'])&&$_FILES['mimpi_picture']['name']!=""){
		$mimpi_picture=str_replace(' ', '_',$_FILES['mimpi_picture']['name']);
		$mimpi_picture = date("H_i_s_").$mimpi_picture;
		if(file_exists ('assets/images/mimpi_picture/'.$mimpi_picture)){
		unlink('assets/images/mimpi_picture/'.$mimpi_picture);
		}
		$config['file_name'] = $mimpi_picture;
		$config['upload_path'] = 'assets/images/mimpi_picture/';
		$config['allowed_types'] = 'gif|jpg|png|xls|xlsx|pdf|doc|docx';
		$config['max_size']	= '3000000000';
		$config['max_width']  = '5000000000';
		$config['max_height']  = '3000000000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('mimpi_picture'))
		{
			$data['uploadmimpi_picture']="Upload Gagal !<br/>".$config['upload_path']. $this->upload->display_errors();
		}
		else
		{
			$data['uploadmimpi_picture']="Upload Success !";
			$input['mimpi_picture']=$mimpi_picture;
		}
	
	}
	 
		//delete
		if($this->input->post("delete")=="OK"){
			$this->db->delete("mimpi",array("mimpi_id"=>$this->input->post("mimpi_id")));
			$data["message"]="Delete Success";
		}
		
		//insert
		if($this->input->post("create")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='create'){$input[$e]=$this->input->post($e);}}
			$this->db->insert("mimpi",$input);
			$data["message"]="Insert Data Success";
		}
		//echo $_POST["create"];die;
		//update
		if($this->input->post("change")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='change'&&$e!='mimpi_picture'){$input[$e]=$this->input->post($e);}}
			$input["mimpi_name"]=htmlentities($input["mimpi_name"], ENT_QUOTES);
			$this->db->update("mimpi",$input,array("mimpi_id"=>$this->input->post("mimpi_id")));
			$data["message"]="Update Success";
			//echo $this->db->last_query();die;
		}
		return $data;
	}
	
}
