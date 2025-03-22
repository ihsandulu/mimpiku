<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class paket_M extends CI_Model {
	
	public function data()
	{	
		
		$data=array();	
		$data["message"]="";
		
		
		
		//cek paket
		if(isset($_POST['new'])||isset($_POST['edit'])){		
			$paketd["paket_id"]=$this->input->post("paket_id");
			$us=$this->db
			->get_where('paket',$paketd);	
			//echo $this->db->last_query();die;	
			if($us->num_rows()>0)
			{
				foreach($us->result() as $paket){		
					foreach($this->db->list_fields('paket') as $field)
					{
						$data[$field]=$paket->$field;
					}	
				}
			}else{	
				foreach($this->db->list_fields('paket') as $field)
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
		$data['uploadpaket_picture']="";
		if(isset($_FILES['paket_picture'])&&$_FILES['paket_picture']['name']!=""){
		$paket_picture=str_replace(' ', '_',$_FILES['paket_picture']['name']);
		$words=explode(".",$paket_picture);
		for ($i = 0; $i < count($words)-1; $i++)
		{
			$word.=$words[$i];
		}
		$paket_picture=str_replace('.', '_',$word).".".$words[count($words)-1];
		$paket_picture = date("H_i_s_").$paket_picture;
		if(file_exists ('assets/images/paket_picture/'.$paket_picture)){
		unlink('assets/images/paket_picture/'.$paket_picture);
		}
		$config['file_name'] = $paket_picture;
		$config['upload_path'] = 'assets/images/paket_picture/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '3000000000';
		$config['max_width']  = '5000000000';
		$config['max_height']  = '3000000000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('paket_picture'))
		{
			$data['uploadpaket_picture']="Upload Gagal !<br/>".$config['upload_path']. $this->upload->display_errors();
		}
		else
		{
			$data['uploadpaket_picture']="Upload Success !";
			
			$source=$config['upload_path'].$paket_picture;
			$destination=$config['upload_path']."a".$paket_picture;
			$quality=10;
			//compress($source, $destination, $quality);
			
		
			$d = compress($source, $destination, 90);
			$input['paket_picture']="a".$paket_picture;
			
		}
	
	}
	 
		//delete
		if($this->input->post("delete")=="OK"){
			$this->db->delete("paket",array("paket_id"=>$this->input->post("paket_id")));
			$data["message"]="Delete Success";
		}
		
		require_once("meta_m.php");
		
		//insert
		if($this->input->post("create")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='create'){$input[$e]=$this->input->post($e);}}
			$double=$this->db
			->where("paket_name",$input["paket_name"])
			->get("paket");
			if($double->num_rows()==0){
				$this->db->insert("paket",$input);		
				$data["message"]="Insert Data Success";
			}else{
				$data["message"]="User sudah ada!";			
			}
			if(isset($_GET['register'])){redirect(site_url("login?message=".$data["message"]));}
		}
		//echo $_POST["create"];die;
		//update
		if($this->input->post("change")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='change'&&$e!='paket_picture'){$input[$e]=$this->input->post($e);}}
			$input["paket_name"]=htmlentities($input["paket_name"], ENT_QUOTES);
			$input["paket_password"]=my_encrypt($this->input->post("paket_password"), $key);
			$this->db->update("paket",$input,array("paket_id"=>$this->input->post("paket_id")));
			$data["message"]="Update Success";
			//echo $this->db->last_query();die;
		}
		//update
		if($this->input->post("update")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='update'&&$e!='paket_picture'){$input[$e]=$this->input->post($e);}}
			$this->db->update("paket",$input,array("paket_id"=>$this->input->post("paket_id")));
			$data["message"]="Update Success";
			//echo $this->db->last_query();die;
		}
		
		
		//data paket
		if(!isset($_POST['new'])&&!isset($_POST['edit'])){		
			$paketd["paket_id"]=$this->session->userdata("paket_id");		
			$us=$this->db
			->get_where('paket',$paketd);	
			//echo $this->db->last_query();die;	
			if($us->num_rows()>0)
			{
				foreach($us->result() as $paket){		
					foreach($this->db->list_fields('paket') as $field)
					{
						$data[$field]=$paket->$field;
					}
				}
			}else{	
						
				foreach($this->db->list_fields('paket') as $field)
				{
					$data[$field]="";
				}
			}
		}
		
		return $data;
	}
	
}
