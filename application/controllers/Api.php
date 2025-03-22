<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
/*
* sebelum update script mohon synch code dulu
*/
class api extends CI_Controller {
	
    function __construct() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS, DELETE");
        parent::__construct();
    }

    function index() {
        $this->djson(array("connect"=>"ok"));
    }
	
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
	
	public function randomlock(){
		$random=$this->db
		->order_by("RAND()")
		->limit(300)
		->get("mimpi");	
		foreach($random->result() as $random){
			$input["mimpi_lock"]="1";
			$where["mimpi_id"]=$random->mimpi_id;
			$this->db->update("mimpi",$input,$where);
		}	
	}
	
	public function about(){
		echo $this->db->get("identity")->row()->identity_about;		
	}
	
	public function search(){
		$kata=$this->db
		->like("mimpi_juduli",$this->input->get("search"))
		->or_like("mimpi_judula",$this->input->get("search"))
		->order_by("mimpi_juduli","asc")
		->order_by("mimpi_judula","asc")
		->get("mimpi");
		foreach($kata->result() as $kata){
		?>
		<div class="grid-item item " data-animate-effect="fadeIn">
		<?php
		$hasil="tafsir.html?id=".substr($kata->mimpi_juduli,0,1)."&ur=".$kata->mimpi_id;		 
		?>
		<a class="detailjudul" href="<?=$hasil;?>">
			<div class="col-md-3 col-sm-4 col-xs-6 item " style="border:#AB0C8F dashed 1px; border-radius:5px; padding:0px; min-height:100px;">
				<img src="<?=site_url("img/abjad/search.jpg");?>" alt="" class="img-responsive" style="opacity:0.1;">
				<div>
					<div>
						<div class="tengah">
							<div style="color:black; text-shadow:white 1px 1px 1px; font-size:12px; padding:0px;"><?=$kata->mimpi_juduli;?></div>
							<div style="text-shadow:white 1px 1px 1px; color:black">(<?=$kata->mimpi_judula;?>)</div>						
						</div>
						<div class="fa fa-lock lock" style="position: absolute; color: red; left:10px; bottom: 10px; text-shadow:white 0 0 5px;"></div>
					</div>
				</div>
			</div>
		</a>
		</div>
		<?php }	
	}
	
	public function tafsir(){			 
		$kata=$this->db
		->where("mimpi_id",$this->input->get("ur"))
		->get("mimpi");
		//echo $this->db->last_query();
		foreach($kata->result() as $kata){
		?>
		
		<div class="text-center" style="z-index:100 !important;">
		<span class="beyond" style="font-size:28px; font-weight:bold; color:black; text-shadow:#FFFFFF 1px 1px 1px;"><?=$kata->mimpi_juduli;?></span>
		<span style="font-size:20px; font-weight:bold; color:#1F1F1F; margin-left:20px; text-shadow:#FFFFFF 1px 1px 1px;">(<?=$kata->mimpi_judula;?>)</span>
		<div id="content" class="text-left" style="background-color:#FFFFFF; color:#000000; padding:20px; border-radius:5px; margin-top:20px; border:#AB0C8F dashed 1px; border-radius:5px; position:relative;"><?=$kata->mimpi_content;?></div>
		</div>			
		<?php }
	}
	
	public function detail(){
		$kata=$this->db
		->where("SUBSTR(mimpi_juduli,1,1)",$this->input->get("id"))
		->order_by("mimpi_juduli","asc")
		->get("mimpi");
		foreach($kata->result() as $kata){
		?>
		<div class="grid-item item " data-animate-effect="fadeIn">
		<?php
		$hasil="tafsir.html?id=".$this->input->get("id")."&ur=".$kata->mimpi_id;		 
		?>
		<a class="detailjudul" href="<?=$hasil;?>">
			<div class="col-md-3 col-sm-4 col-xs-6 item " style="border:#AB0C8F dashed 1px; border-radius:5px; padding:0px;  min-height:100px;">
				<img src="<?=base_url("assets/images/abjad/".$this->input->get("id").".jpg");?>" alt="" class="img-responsive" style="opacity:0.1;">
				<div>
					<div>
						<div class="tengah">
							<div style="color:black; text-shadow:white 1px 1px 1px; font-size:12px; padding:0px;"><?=$kata->mimpi_juduli;?></div>
							<div style="text-shadow:white 1px 1px 1px; color:black">(<?=$kata->mimpi_judula;?>)</div>						
						</div>
						<div class="fa fa-lock lock" style="position: absolute; color: red; left:10px; bottom: 10px; text-shadow:white 0 0 5px;"></div>
					</div>
				</div>
			</div>
		</a>
		</div>
		<?php }	
	}
	
	public function uploadGambar(){
		header('Access-Control-Allow-Origin: *');
		$data=array();
		$data["message"]="";
		$value1=$this->input->post("value1");
		$value2=$this->input->post("value2");
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
	
		//upload photo
		$data['uploadphoto']="";
		if(isset($_FILES[$value1])&&$_FILES[$value1]['name']!=""){
		
			//$temporary = explode("?", $_FILES["plant_picture1"]["name"]);
			//$plant_picture1 = $temporary[0];
			
			
			$plant_picture=$_FILES[$value1]['name'];			
			
			if(isset($_FILES[$value1])&&$_FILES[$value1]['name']!=""){
				if(file_exists ('assets/images/'.$value2.'/'.$plant_picture)){
				unlink('assets/images/'.$value2.'/'.$plant_picture);
				}
			}	
			
			//$config['file_name'] = $plant_picture;
			$config['upload_path'] = 'assets/images/'.$value2.'/';
			$config['allowed_types'] = 'gif|jpg|png|xls|xlsx|pdf|doc|docx';
			$config['max_size']	= '3000000000';
			$config['max_width']  = '5000000000';
			$config['max_height']  = '3000000000';
	
			$this->load->library('upload', $config);
	
			
			if(isset($_FILES[$value1])&&$_FILES[$value1]['name']!=""){
				if ($this->upload->do_upload($value1)){
					//photo
					$sourcephoto=$config['upload_path'].$plant_picture;
					$destinationphoto=$config['upload_path']."a".$plant_picture;
					$quality=10;				
				
					$d = compress($sourcephoto, $destinationphoto, 90);
					unlink($sourcephoto);
					$data['uploadphoto']="Upload Berhasil";
					
				}else{
					$data['uploadphoto']="Upload Foto Gagal!<br/>".$config['upload_path']. $this->upload->display_errors();					
				}
			}
		}
			
		$this->djson($data);
	}
	
	
	
	public function kirimemail()
	{
	
			
		$emailtujuan=$this->input->get("emailtujuan");	
		$pertanyaan=$this->input->get("message_content");
		$pesan=$this->input->get("pesan");
		$message_id=$this->input->get("message_id");
		//send email		
		
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
		$domainName = $_SERVER['HTTP_HOST'] . '/';
		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('admin@aketajawe.com');
		$list = array($emailtujuan);
		$this->email->to($list);
		$this->email->subject('Balasan Pesan Aketajawe.com');
		$this->email->message($pesan);
		if($this->email->send())
		{
		$data['emailsend']="Email sent";
		}
		else
		{
		$data['emailsend']=$this->email->print_debugger();
		}
		
		//email ke admin
		$jawabpesan="
		Pertanyaan/Pesan : ".$pertanyaan."<br/><br/>
		Jawaban : ".$pesan;
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('admin@aketajawe.com');
		$list = array('admin@aketajawe.com');
		$this->email->to($list);
		$this->email->subject('Balasan Aketajawe.com untuk '.$emailtujuan);
		$this->email->message($jawabpesan);
		if($this->email->send())
		{
			$data['emailsend']="Email sent";
			$input["message_reply"]="1";
			$input["message_replycontent"]=$pesan;
			$where["message_id"]=$message_id;
			$this->db->update("message",$input,$where);
		}
		else
		{
		$data['emailsend']=$this->email->print_debugger();
		}
		echo $data['emailsend'];
	}
	
	
	
	public function upload_photo(){
		header('Access-Control-Allow-Origin: *');
		$data=array();
		$data["message"]="";
		
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
	
		//upload photo
		$data['uploadphoto']="";
		if(isset($_FILES['user_picture'])&&$_FILES['user_picture']['name']!=""){
		
			//$temporary = explode("?", $_FILES["user_picture"]["name"]);
			//$user_picture = $temporary[0];
			
			
			$user_picture=$_FILES['user_picture']['name'];			
			
			if(isset($_FILES['user_picture'])&&$_FILES['user_picture']['name']!=""){
				if(file_exists ('assets/images/user_picture/'.$user_picture)){
				unlink('assets/images/user_picture/'.$user_picture);
				}
			}	
			
			//$config['file_name'] = $user_picture;
			$config['upload_path'] = 'assets/images/user_picture/';
			$config['allowed_types'] = 'gif|jpg|png|xls|xlsx|pdf|doc|docx';
			$config['max_size']	= '3000000000';
			$config['max_width']  = '5000000000';
			$config['max_height']  = '3000000000';
	
			$this->load->library('upload', $config);
	
			
			if(isset($_FILES['user_picture'])&&$_FILES['user_picture']['name']!=""){
				if ($this->upload->do_upload('user_picture')){
					//photo
					$sourcephoto=$config['upload_path'].$user_picture;
					
					$user_picture=str_replace("%","",$user_picture);
					$user_picture=str_replace(' ', '_',$user_picture);
					$user_picture = date("H_i_s_").$user_picture;
					$destinationphoto=$config['upload_path']."a".$user_picture;
					$quality=10;				
				
					$d = compress($sourcephoto, $destinationphoto, 90);
					unlink($sourcephoto);
					$input['user_picture']="a".$user_picture;
					$where["user_id"]=$this->input->post("value1");
					$this->db->update("user",$input,$where);
					if($this->db->affected_rows()>0){
						$data['uploadphoto']="Upload Berhasil";
					}else{
						$data['uploadphoto']=$this->db->last_query();
					}
				}else{
					$data['uploadphoto']="Upload Foto Gagal!<br/>".$config['upload_path']. $this->upload->display_errors();
					
					$input['user_picture']="a".$user_picture;
					$where["user_id"]=$this->input->post("value1");
					$this->db->update("user",$input,$where);
				}
			}
		}
			
		$this->djson($data);
	}
	
	public function input_user()
	{
		$insert_id =  0;	
		foreach($this->input->get() as $e=>$f){if($e!='user_id'){$input[$e]=$this->input->get($e);}}
		//cek double
		$dup["user_name"]=$input["user_name"];
		$dup["user_password"]=$input["user_password"];
		$duplikat=$this->db->get_where("user",$dup);
		if($duplikat->num_rows()==0){
			$lis=$this->db->insert("user",$input);
			$insert_id = $this->db->insert_id();
		}
		if($insert_id>0){			
			$data["insert_id"]=$insert_id;
			$data["success"]="OK";			
		}else{
			$data["success"]="No Result".$this->db->last_query();
		}
		$this->djson($data);	
	}
	
	public function login(){
		$input["user_name"]=$this->input->get("user_name");
		$input["user_password"]=$this->input->get("user_password");		
		$lis=$this->db->get_where("user",$input);
		if($lis->num_rows()>0){
			foreach($lis->result() as $list){
				foreach($this->db->list_fields('user') as $field){
					$data[$field]=$list->$field;
				}
			}
			if($data["position_id"]!="3"){$data["success"]="OK";}else{$data["success"]="No Result";}
		}else{
			$data["success"]="No Result";			
		}
		$this->djson($data);
	}
	
	
	public function deleteitem(){
		$table=$this->input->get("table");
		$input[$table."_id"]=$this->input->get("id");
		$this->db->delete($table,$input);
		if($this->db->affected_rows()>0){
			echo "Sukses menghapus data";
		}else{
			echo "Gagal menghapus data";
		}
	}
	   
		
	function inputaktivasi(){
		$this->db->query("DELETE FROM `activate` WHERE 1");
		
		$input["activate_no"]=$this->input->get("activate_no");
		$input["activate_max"]=$this->input->get("activate_max");
		
		$this->db->insert("activate",$input);
	}
	
		
	public function cekaktivasi(){
		$ak=$this->db
		->where("accessproduct_sn",$this->input->get("aktivasi"))
		->get("accessproduct");
		
		if($ak->num_rows()>0){$max=$ak->row()->accessproduct_maxuser;}else{$max=-1;}
		echo $max;
	}
	

	
	
	
	private function djson($value=array()) {
		$json = json_encode($value);
		$this->output->set_header("Access-Control-Allow-Origin: *");
		$this->output->set_header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
		$this->output->set_status_header(200);
		$this->output->set_content_type('application/json');
		$this->output->set_output($json);
	}
	
	public function detekhacker(){
		
		$input["iphack"]=$this->input->post("iphack");
		$input["iphack_page"]=$this->input->post("iphack_page");
		$this->db->insert("iphack",$input);
		//$id= $this->db->insert_id();
		//if($id>0){echo $id;}else{echo $this->db->last_query();}
	}
	
	/*
	function send_gcm_notify($reg_id, $title, $message, $img_url, $tag) {
		define("GOOGLE_API_KEY", "AIzaSyDbabv_NlcyoxwaOedLjlimcZS9drjA5uE");
		define("GOOGLE_GCM_URL", "https://fcm.googleapis.com/fcm/send");
	
        $fields = array(
			'to'  						=> $reg_id ,
			'priority'					=> "high",
            'notification'              => array( "title" => $title, "body" => $message, "tag" => $tag ),
			'data'						=> array("message" =>$message, "image"=> $img_url),
        );
		
        $headers = array(
			GOOGLE_GCM_URL,
			'Content-Type: application/json',
            'Authorization: key=' . GOOGLE_API_KEY 
        );
		
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, GOOGLE_GCM_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Problem occurred: ' . curl_error($ch));
        }
		
        curl_close($ch);
        echo $result;
    }	
	
	public function sendMessage($data,$target){
		//FCM api URL
		$url = 'https://fcm.googleapis.com/fcm/send';
		//api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
		$server_key = 'AIzaSyANqvKPEr9XQ5-bXTS9m93DYMLwBCY5_Yc';
					
		$fields = array();
		$fields['data'] = $data;
		if(is_array($target)){
			$fields['registration_ids'] = $target;
		}else{
			$fields['to'] = $target;
		}
		//header with content_type api key
		$headers = array(
			'Content-Type:application/json',
		  'Authorization:key='.$server_key
		);
					
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}
	
	function send_android_notification($registration_ids, $message) {
		$fields = array(
		'registration_ids' => array($registration_ids),
		'data'=> $message,
		);
		$headers = array(
		'Authorization: key=AIzaSyANqvKPEr9XQ5-bXTS9m93DYMLwBCY5_Yc', // FIREBASE_API_KEY_FOR_ANDROID_NOTIFICATION
		'Content-Type: application/json'
		);
		// Open connection
		$ch = curl_init();
		 
		// Set the url, number of POST vars, POST data
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		 
		// Disabling SSL Certificate support temporarly
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		 
		// Execute post
		$result = curl_exec($ch );
		if($result === false){
		die('Curl failed:' .curl_errno($ch));
		}
		 
		// Close connection
		curl_close( $ch );
		return $result;
		}
	*/	
		
	

	
	
}