<!DOCTYPE HTML>

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
	.penanya{
		background-color:#FDECFC;
		color:#680966;
		border-radius:5px;
	}
	.penjawab{
		background-color:#F9FFF9;
		color:#106714;
		border-radius:5px;
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
	</script>
	</head>
	<body>
	<div id="fh5co-page">
		<?php require_once("header_v.php"); ?>	
		
		<div class="container" style="margin-top:60px;">
	
			
			 
			  <div class="text-center" style="z-index:100 !important; text-align:center;">
				<span class="beyond" style="font-size:28px; font-weight:bold; color:black; text-shadow:#FFFFFF 1px 1px 1px;  text-align:center;">Tanya Tafsir Mimpi</span>
				<span style="font-size:20px; font-weight:bold; color:#1F1F1F; margin-left:20px; text-shadow:#FFFFFF 1px 1px 1px;">(<?=$tanya_title;?>)</span>
			
				<form action="<?=site_url("tanya");?>" method="get" class="" style="">							
				   
					<button class="btn btn-warning btn-block btn-lg" value="OK" style="height:50px!important;">Back</button>		
				   
				</form>
				
				<div id="content" class="text-left" style="background-color:#FFFFFF; color:#000000; padding:20px; border-radius:5px; margin-top:20px; border:#AB0C8F dashed 1px; border-radius:5px; position:relative; ">
					<?php if($message!=""){?>
					<div class="alert alert-info alert-dismissable">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong><?=$message;?></strong>
					</div>
					
					<?php }?>
					
					<?php 
					$tanyad=$this->db
					->where("tanya_id",$this->input->get("tanya_id"))
					->get("tanyad");
					foreach($tanyad->result() as $tanyad){
					if($tanyad->tanyad_person==0){
						$person="penanya";
						$tipe="Tanya";
					}else{
						$person="penjawab";
						$tipe="Jawab";
					}
					?>
					  <div class="well <?=$person;?>">
						  <div class="col-md-2">							  
							<div style="font-weight:bold;"><?=$tipe;?>:</div>
							<div><?=date("d M Y H:i:s",strtotime($tanyad->tanyad_datetime));?></div>
							<!--
							<div class="" style="margin-top:20px;">
								<form method="get" class="col-md-6" style="text-align:center;">
									<button class="btn btn-warning btn-block" value="OK"><span class="fa fa-comment-dots" style="color:white;"></span> </button>
								</form>
							
								<form method="post" class="col-md-6" style="text-align:center;">
									<button class="btn btn-danger btn-block" name="delete" value="OK"><span class="fa fa-times" style="color:white;"></span> </button>
									<input type="hidden" name="tanyad_id" value="<?=$tanyad->tanyad_id;?>"/>
								</form>	
								<div style="clear:both;"></div>
							</div>
							-->
						  </div>
						  <div class="col-md-10" style="border-left:#999999 dashed 1px;">
							<?=$tanyad->tanyad_content;?>
							<!--
							<form class="form-horizontal" method="post" enctype="multipart/form-data">
							  <div class="form-group">
								  <textarea readonly="readonly" class="form-control" id="tanyad_content" name="tanyad_content"><?=$tanyad->tanyad_content;?></textarea>
								  <script>
									var roxyFileman = '<?=site_url("fileman/index.html");?>'; 
									  CKEDITOR.replace(
										'tanyad_content',{filebrowserBrowseUrl:roxyFileman,
																	filebrowserImageBrowseUrl:roxyFileman+'?type=image',
																	removeDialogTabs: 'link:upload;image:upload',
																	height: '100px',
																	stylesSet: 'my_custom_style'}
										);
										CKEDITOR.on('instanceReady', function (ev) {
											ev.editor.dataProcessor.htmlFilter.addRules( {
												elements : {
													img: function( el ) {
														// Add bootstrap "img-responsive" class to each inserted image
														el.addClass('img-responsive');
												
														// Remove inline "height" and "width" styles and
														// replace them with their attribute counterparts.
														// This ensures that the 'img-responsive' class works
														var style = el.attributes.style;
												
														if (style) {
															// Get the width from the style.
															var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
																width = match && match[1];
												
															// Get the height from the style.
															match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
															var height = match && match[1];
												
															// Replace the width
															if (width) {
																el.attributes.style = el.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
																el.attributes.width = width;
																//el.attributes.width = "100%";
															}
												
															// Replace the height
															if (height) {
																el.attributes.style = el.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
																el.attributes.height = "auto";
																//el.attributes.height = "auto";
															}
														}
												
														// Remove the style tag if it is empty
														if (!el.attributes.style)
															delete el.attributes.style;
													}
												}
											});
										}); 
									</script>
							  </div>
							  <input type="hidden" name="tanyad_id" value="<?=$tanyad_id;?>"/>					  					  
							  <div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" id="submit" class="btn btn-primary col-md-5" name="create" value="OK" style="height:50px;8yk">Submit</button>
									<button class="btn btn-warning col-md-offset-1 col-md-5" type="reset" style="height:50px;8yk">Clear</button>
								</div>
							  </div>
							</form>
							-->
							</div>
							<div style="clear:both;"></div>
					  </div>
					<?php }?>
					
					<?php
						if($this->session->userdata("paket")==0||$this->session->userdata("paket")==2){
					?>			
				  <div class="well penanya">
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
					  <div class="form-group">
						<label class="control-label col-sm-2" for="tanyad_content">Tanya:</label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="10" id="tanyad_content" name="tanyad_content"></textarea>
						  <script>
							var roxyFileman = '<?=site_url("fileman/index.html");?>'; 
							  CKEDITOR.replace(
								'tanyad_content',{filebrowserBrowseUrl:roxyFileman,
															filebrowserImageBrowseUrl:roxyFileman+'?type=image',
															removeDialogTabs: 'link:upload;image:upload',
															height: '100px',
															stylesSet: 'my_custom_style'}
								);
								CKEDITOR.on('instanceReady', function (ev) {
									ev.editor.dataProcessor.htmlFilter.addRules( {
										elements : {
											img: function( el ) {
												// Add bootstrap "img-responsive" class to each inserted image
												el.addClass('img-responsive');
										
												// Remove inline "height" and "width" styles and
												// replace them with their attribute counterparts.
												// This ensures that the 'img-responsive' class works
												var style = el.attributes.style;
										
												if (style) {
													// Get the width from the style.
													var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
														width = match && match[1];
										
													// Get the height from the style.
													match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
													var height = match && match[1];
										
													// Replace the width
													if (width) {
														el.attributes.style = el.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
														el.attributes.width = width;
														//el.attributes.width = "100%";
													}
										
													// Replace the height
													if (height) {
														el.attributes.style = el.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
														el.attributes.height = "auto";
														//el.attributes.height = "auto";
													}
												}
										
												// Remove the style tag if it is empty
												if (!el.attributes.style)
													delete el.attributes.style;
											}
										}
									});
								}); 
							</script>
						</div>
					  </div>
					  <input type="hidden" name="tanyad_id" value="<?=$tanyad_id;?>"/>					  					  
					  <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" id="submit" class="btn btn-primary col-md-5" name="create" value="OK" style="height:50px;8yk">Submit</button>
							<button class="btn btn-warning col-md-offset-1 col-md-5" type="reset" style="height:50px;">Clear</button>
						</div>
					  </div>
					</form>
				  </div>	
				  <?php }?>
				</div>
			  </div>
			
			
			
	
			
		</div>

	</div>
	<?php require_once("footer_v.php"); ?>	
	
	

	</body>
</html>

