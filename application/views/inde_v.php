<!DOCTYPE HTML>
<!--
	Aesthetic by gettemplates.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://gettemplates.co
-->
<html>
	<head>
	<?php require_once("meta_v.php"); ?>	
	</head>
	<body>
	<div id="fh5co-page">
	
	<?php require_once("header_v.php"); ?>	
	
	<div class="container-fluid" id="fh5co-image-grid">
		

		<div class="grid">
		  <div class="grid-sizer"></div>
		  <?php 
		  $letter='a';
		  for($x=1;$x<=26;$x++){
		  $kata=$this->db
		  ->where("SUBSTR(mimpi_juduli,1,1)",$letter)
		  ->get("mimpi");
		  ?>
		  <div class="grid-item item " data-animate-effect="fadeIn">
		    <a href="<?=site_url("detail/".$letter);?>">
				<div class="img-wrap">
					<img src="<?=base_url("assets/images/abjad/".$letter.".jpg");?>" alt="" class="img-responsive" >
				</div>
				<div class="text-wrap">
					<div class="text-inner">
						<div>
							<div style="color:white; text-shadow:black 1px 1px 1px; font-size:20px;"><?=strtoupper($letter);?></div>
							<div style="text-shadow:black 1px 1px 1px; color:#F3F5A9"><?=$kata->num_rows();?> kata</div>
						</div>
					</div>
				</div>
			</a>
		  </div>
		  <?php $letter++;}?>
		</div>

		
	</div>

	</div>
	<div style="height:110px;">&nbsp;</div>
	<?php require_once("footer_v.php"); ?>	
	
	

	</body>
</html>

