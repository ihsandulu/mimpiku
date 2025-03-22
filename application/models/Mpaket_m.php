<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class mpaket_M extends CI_Model {
	
	public function data()
	{	
		
		$data=array();	
		$data["message"]="";
		
		
		
		//cek mpaket
		if(isset($_POST['new'])||isset($_POST['edit'])){		
			$mpaketd["mpaket_id"]=$this->input->post("mpaket_id");
			$us=$this->db
			->get_where('mpaket',$mpaketd);	
			//echo $this->db->last_query();die;	
			if($us->num_rows()>0)
			{
				foreach($us->result() as $mpaket){		
					foreach($this->db->list_fields('mpaket') as $field)
					{
						$data[$field]=$mpaket->$field;
					}	
				}
			}else{	
				foreach($this->db->list_fields('mpaket') as $field)
				{
					$data[$field]="";
				}
			}
		}
		
		//compress image 
		function compress($source, $destination, $quality) {
	
			$info = getimagesize($source);
	
			if ($info['mime'] == 'image/jpeg') 
				$image = imagecreatefromjpeg($source);
	
			elseif ($info['mime'] == 'image/gif') 
				$image = imagecreatefromgif($source);
	
			elseif ($info['mime'] == 'image/png') 
				$image = imagecreatefrompng($source);
	
			imagejpeg($image, $destination, $quality);
	
			return $destination;
		}

		//upload image
		$word="";
		$data['uploadmpaket_picture']="";
		if(isset($_FILES['mpaket_picture'])&&$_FILES['mpaket_picture']['name']!=""){
		$mpaket_picture=str_replace(' ', '_',$_FILES['mpaket_picture']['name']);
		$words=explode(".",$mpaket_picture);
		for ($i = 0; $i < count($words)-1; $i++)
		{
			$word.=$words[$i];
		}
		$mpaket_picture=str_replace('.', '_',$word).".".$words[count($words)-1];
		$mpaket_picture = date("H_i_s_").$mpaket_picture;
		if(file_exists ('assets/images/mpaket_picture/'.$mpaket_picture)){
		unlink('assets/images/mpaket_picture/'.$mpaket_picture);
		}
		$config['file_name'] = $mpaket_picture;
		$config['upload_path'] = 'assets/images/mpaket_picture/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '3000000000';
		$config['max_width']  = '5000000000';
		$config['max_height']  = '3000000000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('mpaket_picture'))
		{
			$data['uploadmpaket_picture']="Upload Gagal !<br/>".$config['upload_path']. $this->upload->display_errors();
		}
		else
		{
			$data['uploadmpaket_picture']="Upload Success !";
			
			$source=$config['upload_path'].$mpaket_picture;
			$destination=$config['upload_path']."a".$mpaket_picture;
			$quality=10;
			//compress($source, $destination, $quality);
			
		
			$d = compress($source, $destination, 90);
			$input['mpaket_picture']="a".$mpaket_picture;
			
		}
	
	}
	 
		//delete
		if($this->input->post("delete")=="OK"){
			$this->db->delete("mpaket",array("mpaket_id"=>$this->input->post("mpaket_id")));
			$data["message"]="Delete Success";
		}
		
		require_once("meta_m.php");
		
		//insert
		if($this->input->post("create")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='create'){$input[$e]=$this->input->post($e);}}
			$double=$this->db
			->where("mpaket_name",$input["mpaket_name"])
			->get("mpaket");
			if($double->num_rows()==0){
				$this->db->insert("mpaket",$input);		
				$data["message"]="Insert Data Success";
			}else{
				$data["message"]="User sudah ada!";			
			}
			if(isset($_GET['register'])){redirect(site_url("login?message=".$data["message"]));}
		}
		//echo $_POST["create"];die;
		//update
		if($this->input->post("change")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='change'&&$e!='mpaket_picture'){$input[$e]=$this->input->post($e);}}
			$this->db->update("mpaket",$input,array("mpaket_id"=>$this->input->post("mpaket_id")));
			$data["message"]="Update Success";
			//echo $this->db->last_query();die;
		}
		//update
		if($this->input->post("update")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='update'&&$e!='mpaket_picture'){$input[$e]=$this->input->post($e);}}
			$this->db->update("mpaket",$input,array("mpaket_id"=>$this->input->post("mpaket_id")));
			$data["message"]="Update Success";
			//echo $this->db->last_query();die;
		}
		
		
		//data mpaket
		if(!isset($_POST['new'])&&!isset($_POST['edit'])){		
			$mpaketd["mpaket_id"]=$this->session->userdata("mpaket_id");		
			$us=$this->db
			->get_where('mpaket',$mpaketd);	
			//echo $this->db->last_query();die;	
			if($us->num_rows()>0)
			{
				foreach($us->result() as $mpaket){		
					foreach($this->db->list_fields('mpaket') as $field)
					{
						$data[$field]=$mpaket->$field;
					}
				}
			}else{	
						
				foreach($this->db->list_fields('mpaket') as $field)
				{
					$data[$field]="";
				}
			}
		}
		
		return $data;
	}
	
}
