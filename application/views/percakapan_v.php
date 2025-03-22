<!doctype html>
<html>

<head>
    <?php 
	require_once("meta.php");
	?>
	<style>	
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
</head>

<body class="no-skin">
<?php require_once("header.php");?>
	<div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="<?=site_url();?>">Home</a>
                    </li>
                    <li class="active">Percakapan</li>
                </ul><!-- /.breadcrumb -->

                
            </div>
            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Percakapan
                    </h1>
                    
					
					<form action="<?=site_url("tanyajawab");?>" method="get" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
                        <button class="btn btn-warning btn-block btn-sm" value="OK" style="">Back</button>		
                       
                    </form>
                  
                   
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                               
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
							
							<div class="" style="margin-top:20px;">
								<!--<form method="get" class="col-md-6" style="text-align:center;">
									<button class="btn btn-warning btn-block" value="OK"><span class="fa fa-comment-dots" style="color:white;"></span> </button>
								</form>-->
							
								<form method="post" class="col-md-6" style="text-align:center;">
									<button class="btn btn-danger btn-block" name="delete" value="OK"><span class="fa fa-times" style="color:white;"></span> </button>
									<input type="hidden" name="tanyad_id" value="<?=$tanyad->tanyad_id;?>"/>
								</form>	
								<div style="clear:both;"></div>
							</div>
							
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
					
				  <div class="well penanya">
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
					  <div class="form-group">
						<label class="control-label col-sm-2" for="tanyad_content">Jawab:</label>
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
							<button type="submit" id="submit" class="btn btn-primary col-md-5" name="create" value="OK" style="height:50px;">Submit</button>
							<button class="btn btn-warning col-md-offset-1 col-md-5" type="reset" style="height:50px;8yk">Clear</button>
						</div>
					  </div>
					</form>
				  </div>
                                    
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
	<!-- /#wrap -->
	<?php require_once("footer.php");?>
</body>

</html>
