<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class identity_M extends CI_Model {
	
	public function data()
	{	
		$data=array();	
		$data["message"]="";
		
				
		//cek identity
		if(isset($_POST['new'])||isset($_POST['edit'])){		
			$identityd["identity_id"]=$this->input->post("identity_id");
			$us=$this->db
			->get_where('identity',$identityd);	
			//echo $this->db->last_query();die;	
			if($us->num_rows()>0)
			{
				foreach($us->result() as $identity){		
					foreach($this->db->list_fields('identity') as $field)
					{
						$data[$field]=$identity->$field;
					}		
				}
			}else{	
						
				foreach($this->db->list_fields('identity') as $field)
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
		$data['uploadidentity_picture']="";
		if(isset($_FILES['identity_picture'])&&$_FILES['identity_picture']['name']!=""){
		$identity_picture=str_replace(' ', '_',$_FILES['identity_picture']['name']);
		$words=explode(".",$identity_picture);
		for ($i = 0; $i < count($words)-1; $i++)
		{
			$word.=$words[$i];
		}
		$identity_picture=str_replace('.', '_',$word).".".$words[count($words)-1];
		$identity_picture = date("H_i_s_").$identity_picture;
		if(file_exists ('assets/images/identity_picture/'.$identity_picture)){
		unlink('assets/images/identity_picture/'.$identity_picture);
		}
		$config['file_name'] = $identity_picture;
		$config['upload_path'] = 'assets/images/identity_picture/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '3000000000';
		$config['max_width']  = '5000000000';
		$config['max_height']  = '3000000000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('identity_picture'))
		{
			$data['uploadidentity_picture']="Upload Gagal !<br/>".$config['upload_path']. $this->upload->display_errors();
		}
		else
		{
			$data['uploadidentity_picture']="Upload Success !";
			
			$source=$config['upload_path'].$identity_picture;
			$destination=$config['upload_path']."a".$identity_picture;
			$quality=10;
			//compress($source, $destination, $quality);
			
		
			$d = compress($source, $destination, 90);
			//$input['identity_picture']="a".$identity_picture;
			$input['identity_picture']=$identity_picture;
			
		}
	
	}
	 
		//delete
		if($this->input->post("delete")=="OK"){
			$pic=$this->db->get_where("identity",array("identity_id"=>$this->input->post("identity_id")));
			foreach($pic->result() as $picture){
				if($picture->identity_picture!=""){
					unlink('assets/images/identity_picture/'.$picture->identity_picture);
				}
			}
			$this->db->delete("identity",array("identity_id"=>$this->input->post("identity_id")));
			$data["message"]="Delete Success";
		}
		
		//insert
		if($this->input->post("create")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='create'){$input[$e]=$this->input->post($e);}}
			$double=$this->db
			->where("identity_name",$input["identity_name"])
			->get("identity");
			if($double->num_rows()==0){
				$this->db->insert("identity",$input);
				$data["message"]="Insert Data Success";
			}else{
				$data["message"]="Identity sudah ada!";			
			}
		}
		//echo $_POST["create"];die;
		//update
		if($this->input->post("update")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='update'&&$e!='identity_picture'){$input[$e]=$this->input->post($e);}}
			$this->db->update("identity",$input,array("identity_id"=>$this->input->post("identity_id")));
			$data["message"]="Update Success";
			//echo $this->db->last_query();die;
		}
		return $data;
	}
	
}
