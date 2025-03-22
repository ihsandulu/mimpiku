<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class tanya_M extends CI_Model {
	
	public function data()
	{	
		$data=array();	
		$data["message"]="";
		//cek tanya
		$tanyad["tanya_id"]=$this->input->post("tanya_id");
		$us=$this->db
		->get_where('tanya',$tanyad);	
		//echo $this->db->last_query();die;	
		if($us->num_rows()>0)
		{
			foreach($us->result() as $tanya){		
				foreach($this->db->list_fields('tanya') as $field)
				{
					$data[$field]=$tanya->$field;
				}		
			}
		}else{				
			foreach($this->db->list_fields('tanya') as $field)
			{
				$data[$field]="";
			}	
		}
		
		//upload image
		$data['uploadtanya_picture']="";
		if(isset($_FILES['tanya_picture'])&&$_FILES['tanya_picture']['name']!=""){
		$tanya_picture=str_replace(' ', '_',$_FILES['tanya_picture']['name']);
		$tanya_picture = date("H_i_s_").$tanya_picture;
		if(file_exists ('assets/images/tanya_picture/'.$tanya_picture)){
		unlink('assets/images/tanya_picture/'.$tanya_picture);
		}
		$config['file_name'] = $tanya_picture;
		$config['upload_path'] = 'assets/images/tanya_picture/';
		$config['allowed_types'] = 'gif|jpg|png|xls|xlsx|pdf|doc|docx';
		$config['max_size']	= '3000000000';
		$config['max_width']  = '5000000000';
		$config['max_height']  = '3000000000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('tanya_picture'))
		{
			$data['uploadtanya_picture']="Upload Gagal !<br/>".$config['upload_path']. $this->upload->display_errors();
		}
		else
		{
			$data['uploadtanya_picture']="Upload Success !";
			$input['tanya_picture']=$tanya_picture;
		}
	
	}
	 
		//delete
		if($this->input->post("delete")=="OK"){
			$this->db->delete("tanya",array("tanya_id"=>$this->input->post("tanya_id")));
			$data["message"]="Delete Success";
		}
		
		//insert
		if($this->input->post("create")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='create'){$input[$e]=$this->input->post($e);}}
			$input["tanya_date"]=date("Y-m-d");
			$input["customer_id"]=$this->session->userdata("customer_id");
			$input["tanya_status"]="0";
			$this->db->insert("tanya",$input);
			$data["message"]="Insert Data Success";
			//echo $this->db->last_query();
		}
		//echo $_POST["create"];die;
		
		return $data;
	}
	
}
