<!doctype html>
<html>

<head>
    <?php 	
	require_once("meta.php");?>
</head>

<body class="  " >
	<?php require_once("header.php");?>
	<div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="<?=site_url();?>">Home</a>
                    </li>
                    <li class="active">Mimpi</li>
                </ul><!-- /.breadcrumb -->

                
            </div>
            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Mimpi
                    </h1>
					<?php if(!isset($_POST['new'])&&!isset($_POST['edit'])&&$this->session->userdata("position_id")==1){?>
                    
                    <form method="post" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
                        <button name="new" class="btn btn-info btn-block btn-sm" value="OK" style="">New</button>
                        <input type="hidden" name="mimpi_id"/>
                       
                    </form>
                  
                    <?php }else{?>
					<form action="<?=site_url("mimpi");?>" method="get" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
                        <button class="btn btn-warning btn-block btn-sm" value="OK" style="">Back</button>		
                       
                    </form>
					<?php }?>
                </div>
                
                <div class="row">
					<div class="col-xs-12 col-md-12 col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
							<?php if(isset($_POST['new'])||isset($_POST['edit'])){?>
								<div class="">
									<?php if(isset($_POST['edit'])){$namabutton='name="change"';$judul="Update Mimpi";}else{$namabutton='name="create"';$judul="New Mimpi";}?>	
									<div class="lead"><h3><?=$judul;?></h3></div>
									<form class="form-horizontal" method="post" enctype="multipart/form-data">
									  <div class="form-group">
										<label class="control-label col-sm-2" for="mimpi_juduli">Judul Indonesia:</label>
										<div class="col-sm-10">
										  <input type="text" autofocus class="form-control" id="mimpi_juduli" name="mimpi_juduli" placeholder="Enter Indonesian Title" value="<?=$mimpi_juduli;?>">
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-2" for="mimpi_judula">Judul Arab:</label>
										<div class="col-sm-10">
										  <input type="text" class="form-control" id="mimpi_judula" name="mimpi_judula" placeholder="Enter Arabian Title" value="<?=$mimpi_judula;?>">
										</div>
									  </div>
									  <div class="form-group">
										<label class="control-label col-sm-2" for="mimpi_content">Konten:</label>
										<div class="col-sm-10">
										  <textarea class="form-control" id="mimpi_content" name="mimpi_content"><?=$mimpi_content;?></textarea>
										  <script>
											var roxyFileman = '<?=site_url("fileman/index.html");?>'; 
											  CKEDITOR.replace(
												'mimpi_content',{filebrowserBrowseUrl:roxyFileman,
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
									  <input type="hidden" name="mimpi_id" value="<?=$mimpi_id;?>"/>					  					  
									  <div class="form-group"> 
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" id="submit" class="btn btn-primary col-md-5" <?=$namabutton;?> value="OK">Submit</button>
											<button class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href=<?=site_url("mimpi");?>">Back</button>
										</div>
									  </div>
									</form>
								</div>
								<?php }else{?>	
									<?php if($message!=""){?>
									<div class="alert alert-info alert-dismissable">
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									  <strong><?=$message;?></strong><br/><?=$uploadmimpi_picture;?>
									</div>
									<?php }?>
									<div class="box">
										<div id="collapse4" class="body table-responsive">				
										<table id="dataTable" class="table table-condensed table-hover">
											<thead>
												<tr>
												  <th>Indonesia</th>
													<th>Arab</th>
													<th>Lock</th>
													<th class="col-md-1">Action</th>
												</tr>
											</thead>
											<tbody> 
												<?php $usr=$this->db
												->get("mimpi");
												$lock=array("Tidak","Ya");
												foreach($usr->result() as $mimpi){?>
												<tr>
												  <td><?=$mimpi->mimpi_juduli;?></td>											
													<td><?=$mimpi->mimpi_judula;?></td>										
													<td><?=$lock[$mimpi->mimpi_lock];?></td>
													<td style="padding-left:0px; padding-right:0px;">
														<form method="post" class="col-md-6" style="padding:0px;">
															<button class="btn btn-warning btn-block" name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
															<input type="hidden" name="mimpi_id" value="<?=$mimpi->mimpi_id;?>"/>
														</form>
													
														<form method="post" class="col-md-6" style="padding:0px;">
															<button class="btn btn-danger  btn-block" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
															<input type="hidden" name="mimpi_id" value="<?=$mimpi->mimpi_id;?>"/>
														</form>
													
														<form method="post" class="col-md-6" style="padding:0px;">
															<button class="btn btn-default  btn-block" name="mimpi_lock" value="1"><span class="fa fa-lock" style="color:white;"></span> </button>
															<input type="hidden" name="mimpi_id" value="<?=$mimpi->mimpi_id;?>"/>
														</form>	
													
														<form method="post" class="col-md-6" style="padding:0px;">
															<button class="btn btn-info  btn-block" name="mimpi_lock" value="0"><span class="fa fa-unlock-alt" style="color:white;"></span> </button>
															<input type="hidden" name="mimpi_id" value="<?=$mimpi->mimpi_id;?>"/>
														</form>										
													</td>
												</tr>
												<?php }?>
											</tbody>
										</table>
										</div>
									</div>
								<?php }?>
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
