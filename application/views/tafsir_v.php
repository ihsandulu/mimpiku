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
			
	
			
			  <?php 
	
			 
			  $kata=$this->db
			  ->where("mimpi_juduli",urldecode($this->uri->segment(3)))
			  ->get("mimpi");
			  //echo $this->db->last_query();
			  foreach($kata->result() as $kata){
			  ?>
			  
			  <div class="text-center" style="z-index:100 !important; text-align:center;">
				<span class="beyond" style="font-size:28px; font-weight:bold; color:black; text-shadow:#FFFFFF 1px 1px 1px;  text-align:center;"><?=$kata->mimpi_juduli;?></span>
				<span style="font-size:20px; font-weight:bold; color:#1F1F1F; margin-left:20px; text-shadow:#FFFFFF 1px 1px 1px;">(<?=$kata->mimpi_judula;?>)</span>
				<div style="font-size:14px;">Refresh Halaman jika tafsir tidak muncul &nbsp; &nbsp;<button class="fas fa-sync btn btn-success" onClick="location.reload()"></button></div>
				<div id="content" class="text-left" style="background-color:#FFFFFF; color:#000000; padding:20px; border-radius:5px; margin-top:20px; border:#AB0C8F dashed 1px; border-radius:5px; position:relative;">
					<div id="konten" style="margin:0px; font-size:19px; padding:20px;"><?=$kata->mimpi_content;?></div>				
				</div>
				<div>
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<ins class="adsbygoogle"
						 style="display:block; text-align:center;"
						 data-ad-layout="in-article"
						 data-ad-format="fluid"
						 data-ad-client="ca-pub-6192668857872931"
						 data-ad-slot="9471132312"></ins>
					<script>
						 (adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>
			  </div>
			
			  <?php }?>
			
	
			
		</div>

	</div>
	<div id="tv" style="height:110px;">&nbsp;
<!--<iframe src="http://www.tvindo.stream/p/rcti.html" allowfullscreen="allowfullscreen" allowtransparency="true" frameborder="0" height="100%" scrolling="no" width="100%" ></iframe>-->
</div>
	<?php require_once("footer_v.php"); ?>	
	
	<script>
	setTimeout(function(){
		$('title').html('Mimpi <?=$kata->mimpi_juduli;?>');
		$('meta[name=description]').attr('content', 'Mimpi <?=$kata->mimpi_juduli;?>');
		$('meta[name=keywords]').attr('content', 'Mimpi <?=$kata->mimpi_juduli;?>, Tafsir');
	},1000);
	</script>

	</body>
</html>

