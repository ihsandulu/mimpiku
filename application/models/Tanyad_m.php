<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class tanyad_M extends CI_Model {
	
	function botpesan($chatid,$pesan) {			
		$TOKEN  = "";	
		$identity=$this->db->get("identity");
		foreach($identity->result() as $identity){
			$TOKEN  = $identity->identity_telegramtoken;
		}
		
		$method	= "sendMessage";
		$url    = "https://api.telegram.org/bot" . $TOKEN . "/". $method;
		$post = [
		 'chat_id' => $chatid,
		 // 'parse_mode' => 'HTML', // aktifkan ini jika ingin menggunakan format type HTML, bisa juga diganti menjadi Markdown
		 'text' => $pesan
		];
		
		$header = [
		 "X-Requested-With: XMLHttpRequest",
		 "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36" 
		];
		
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		//curl_setopt($ch, CURLOPT_REFERER, $refer);
		//curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post );   
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$datas = curl_exec($ch);
		$error = curl_error($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		$debug['text'] = $pesan;
		$debug['code'] = $status;
		$debug['status'] = $error;
		$debug['respon'] = json_decode($datas, true);
		
		//print_r($debug);
    }
	
	public function data()
	{	
		$data=array();	
		$data["message"]="";
		//cek tanya
		$tanyad["tanya_id"]=$this->input->get("tanya_id");
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
		
		//cek tanyad
		$tanyad["tanyad_id"]=$this->input->post("tanyad_id");
		$us=$this->db
		->get_where('tanyad',$tanyad);	
		//echo $this->db->last_query();die;	
		if($us->num_rows()>0)
		{
			foreach($us->result() as $tanyad){		
				foreach($this->db->list_fields('tanyad') as $field)
				{
					$data[$field]=$tanyad->$field;
				}		
			}
		}else{				
			foreach($this->db->list_fields('tanyad') as $field)
			{
				$data[$field]="";
			}	
		}
		
		//upload image
		$data['uploadtanyad_picture']="";
		if(isset($_FILES['tanyad_picture'])&&$_FILES['tanyad_picture']['name']!=""){
		$tanyad_picture=str_replace(' ', '_',$_FILES['tanyad_picture']['name']);
		$tanyad_picture = date("H_i_s_").$tanyad_picture;
		if(file_exists ('assets/images/tanyad_picture/'.$tanyad_picture)){
		unlink('assets/images/tanyad_picture/'.$tanyad_picture);
		}
		$config['file_name'] = $tanyad_picture;
		$config['upload_path'] = 'assets/images/tanyad_picture/';
		$config['allowed_types'] = 'gif|jpg|png|xls|xlsx|pdf|doc|docx';
		$config['max_size']	= '3000000000';
		$config['max_width']  = '5000000000';
		$config['max_height']  = '3000000000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('tanyad_picture'))
		{
			$data['uploadtanyad_picture']="Upload Gagal !<br/>".$config['upload_path']. $this->upload->display_errors();
		}
		else
		{
			$data['uploadtanyad_picture']="Upload Success !";
			$input['tanyad_picture']=$tanyad_picture;
		}
	
	}
	 
		//delete
		if($this->input->post("delete")=="OK"){
			$this->db->delete("tanyad",array("tanyad_id"=>$this->input->post("tanyad_id")));
			$data["message"]="Delete Success";
		}
		
		//insert
		if($this->input->post("create")=="OK"){
			foreach($this->input->post() as $e=>$f){if($e!='create'){$input[$e]=$this->input->post($e);}}
			$input["tanya_id"]=$this->input->get("tanya_id");
			$this->db->insert("tanyad",$input);
			$data["message"]="Insert Data Success";
			//echo $this->db->last_query();
			
			//notif telegram
			$telegram=$this->db
			->where("user_id","7")
			->get("telegram");
			$id=0;
			foreach($telegram->result() as $telegram){
				$id=$telegram->telegram_mid;
			}
			
			$tanya=$this->db
			->where("tanya_id",$input["tanya_id"])
			->get("tanya");
			foreach($tanya->result() as $tanya){
				$kirimpesan=$this->session->userdata("customer_name").' bertanya ('.date("d M Y H:i:s").') :
	Judul : '.$tanya->tanya_title.'
	Pertanyaan :
	'.$input["tanyad_content"];
				$this->botpesan($id,$kirimpesan);	
			}
		}
		//echo $_POST["create"];die;
		
		return $data;
	}
	
}
