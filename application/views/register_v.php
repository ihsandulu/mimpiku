<!DOCTYPE HTML>
<!--
	Aesthetic by gettemplates.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://gettemplates.co
-->
<html>
	<head>
	<?php require_once("meta_v.php"); ?>	
	<style>
	#content{
		background-image: url("<?=base_url("assets/images/global/atas.png");?>");
		background-repeat: no-repeat;
		background-position: left top;
		background-attachment: fixed;
	}
	</style>
	<script>
		<?php
		$tambah=0;
		$sesi=$this->session->userdata("itung");
		$itung=(int)$sesi;
		$tambah=$itung+1;
		if($itung==3){
		$this->session->set_userdata("itung","0");
		?>
		//alert();
		setTimeout(function(){
			$("#konten").hide();
		},100);
		<?php }else{
		$this->session->set_userdata("itung",(string)$tambah);
		?>
		
		$("#konten").show();
		
		<?php }?>
		//alert("Untuk melihat tafsir silahkan menginstall app kami di playstore.");
		//window.location.href='https://play.google.com/store/apps/details?id=com.qithy.mimpiku';
	</script>
	</head>
	<body>
	<div id="fh5co-page">
		<?php require_once("header_v.php"); ?>	
		
		<!--<div class="back-to-home btn-circle" style="top:-20px; right:-10px;">
			<a href="<?=site_url("detail/".strtolower($this->uri->segment(2)));?>"><span></span><em>Back</em></a>
		</div>-->
		
		<div class="container" style="margin-top:60px;">	
			
			<div class="login col-md-12 col-sm-12 col-xs-12 " align="center">
				<div class="judul ">
					<div class="col-md-12 judul-picture" align="center">
					<img src="<?=base_url("assets/images/identity_picture/".$identity->identity_picture);?>" style="height:90px; width:auto;">
					</div>
					
				</div>
				<div class="form-login  fontstandard" style="padding-left:30px; padding-right:30px; margin-top:30px;" align="left">
					<form method="post">
						<label class="label label-danger col-md-12" style="padding:15px;"><?=$message;?></label>
						<div class="form-group">
							<label for="customer_email"><span class="red">*</span> Email:</label>
							<input class="form-control inputstandard" type="email" id="customer_email" name="customer_email" placeholder="Email" required="required" value="<?=$customer_email;?>" />
						</div>
						<div class="form-group">
							<label for="customer_password"><span class="red">*</span> Password:</label>
							<input class="form-control inputstandard" type="text" id="customer_password" name="customer_password" placeholder="Password" required="required" value="" />
						</div>
						<div class="form-group">
							<label for="customer_name"><span class="red">*</span> Name:</label>
							<input class="form-control inputstandard" type="text" id="customer_name" name="customer_name" placeholder="Nama Lengkap" required="required" value="<?=$customer_name;?>" />
						</div>
						<div class="form-group">
							<label for="customer_country"><span class="red">*</span> Country:</label>
							<input class="form-control inputstandard" type="text" id="customer_country" name="customer_country" placeholder="Negara" required="required" value="<?=$customer_country;?>" />
						</div>
						<div class="form-group">
							<label for="customer_wa"><span class="red">*</span> Whatsapp:</label>
							<input class="form-control inputstandard" type="text" id="customer_wa" name="customer_wa" placeholder="Whatsapp" required="required" value="<?=$customer_wa;?>" />
						</div>
						<div class="form-group">
							<label for="customer_fb">Facebook:</label>
							<input class="form-control inputstandard" type="text" id="customer_fb" name="customer_fb" placeholder="Nama Pengguna Facebook" value="<?=$customer_fb;?>" />
						</div>
						<button type="submit" class="btn btn-primary btn-block btn-large inputstandard">Let me in.</button>
					</form>	
					<br/>
					<div class="back">	
						<span class="fas fa-sign-in-alt"></span> <a href="<?=site_url("logincustomer");?>" type="submit" class="">Login</a>
					</div>
				</div>
			</div>
			
		</div>

	</div>
	<div id="tv" style="height:110px;">&nbsp;

</div>
	<?php require_once("footer_v.php"); ?>	
	
	<script>
	setTimeout(function(){
		$('title').html('Register Mimpiku.web.id');
		$('meta[name=description]').attr('content', 'Mau tanya lebih dalam? Yuk register sekarang!');
		$('meta[name=keywords]').attr('content', 'register, tanya mimpi');
	},1000);
	</script>

	</body>
</html>

