<!doctype html>
<html>

<head>
    <?php 
	require_once("meta.php");
	?>
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
                    <li class="active">Identity</li>
                </ul><!-- /.breadcrumb -->

                
            </div>
            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Identity
                    </h1>
					<?php if(!isset($_POST['new'])&&!isset($_POST['edit'])&&$this->session->userdata("position_id")==1){?>
                    
                    <!--<form method="post" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
                        <button name="new" class="btn btn-info btn-block btn-sm" value="OK" style="">New</button>
                        <input type="hidden" name="user_id"/>
                       
                    </form>-->
                  
                    <?php }else{?>
					<form action="<?=site_url("identity");?>" method="get" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
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
                                    <?php if(isset($_POST['edit'])){$namabutton='name="change"';$judul="Update Identity";}else{$namabutton='name="create"';$judul="New Identity";}?>	
                                    <div class="lead"><h3><?=$judul;?></h3></div>
                                    <form method="post" enctype="multipart/form-data">
									  <div class="form-group">
										<label for="identity_name">Title:</label>
										<input type="text" class="form-control" id="identity_name" name="identity_name" value="<?=$identity_name;?>">
									  </div>
									  <div class="form-group">
										<label for="identity_company">Company:</label>
										<input type="text" class="form-control" id="identity_company" name="identity_company" value="<?=$identity_company;?>">
									  </div>
									   <div class="form-group">
										<label for="identity_address">Address:</label>
										<input type="text" class="form-control" id="identity_address" name="identity_address" value="<?=$identity_address;?>">
									  </div>
									   <div class="form-group">
										<label for="identity_phone">Phone:</label>
										<input type="text" class="form-control" id="identity_phone" name="identity_phone" value="<?=$identity_phone;?>">
									  </div>
									   <div class="form-group">
										<label for="identity_email">Email:</label>
										<input type="text" class="form-control" id="identity_email" name="identity_email" value="<?=$identity_email;?>">
									  </div>
									   <div class="form-group">
										<label for="identity_about">About:</label>
										<textarea class="form-control" id="identity_about" name="identity_about"><?=$identity_about;?></textarea>
										<script>
										var roxyFileman = '<?=site_url("fileman/index.html");?>'; 
										  CKEDITOR.replace(
											'identity_about',{filebrowserBrowseUrl:roxyFileman,
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
									   
									  <!--<div class="form-group">
										<label for="identity_keyword">Keyword:</label>
										<input type="text" class="form-control" id="identity_keyword" name="identity_keyword" value="<?=$identity_keyword;?>">
									  </div>
									   <div class="form-group">
										<label for="identity_keyword">Base Color:</label>
										<input type="color" style="width:20px; height:20px; cursor:pointer;" id="identity_color" name="identity_color" value="<?=$identity_color;?>">
									  </div>
									  
									  <div class="form-group">
										<label for="pwd">Description:</label>
										<textarea name="identity_description" id="identity_description"><?=$identity_description;?></textarea>
										<script>
											CKEDITOR.replace('identity_description');
										</script>
									  </div>
									  -->
									  <div class="form-group">
										<label for="identity_title">Picture:</label>
										<input type="file" class="" id="identity_picture" name="identity_picture">
										<div>
										<?php
										if($identity_picture!=""){
												$user_image="assets/images/identity_picture/".$identity_picture;
											}else{
												$user_image="assets/images/global/noimage.jpg";
											}
										?>
										<img id="identity_picture_image" width="100" height="100" src="<?=base_url($user_image);?>"/>	
										<script>
										function readURL(input) {
											if (input.files && input.files[0]) {
												var reader = new FileReader();
									
												reader.onload = function (e) {
													$('#'+input.id+'_image').attr('src', e.target.result);
												}
									
												reader.readAsDataURL(input.files[0]);
											}
										}
									
										$("#identity_picture").change(function () {
											readURL(this);
										});
									  </script> 
										</div>
									  </div>
									  <input type="hidden" name="identity_id" value="<?=$identity_id;?>">
									 <?php if(isset($_POST['new'])){$name="name='insert'";}elseif(isset($_POST['edit'])){$name="name='update'";}?>
									  <button type="submit" <?=$name;?> class="btn btn-primary col-md-5" value="OK">Submit</button>
									  <button class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href=<?=site_url("identity");?>">Back</button>
									</form>
                                </div>
                                <?php }else{?>	
                                    <?php if($message!=""){?>
                                    <div class="alert alert-info alert-dismissable">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong><?=$message;?></strong><br/><?=$uploadidentity_picture;?>
                                    </div>
									
                                    <?php }?>
									

                                    <div class="box">
                                        <div id="collapse4" class="body table-responsive">				
                                        <table id="listidentity" class="table">
										<thead>
											<tr>
											  <th>Action</th>
											  <th>Place</th>
											  <th>Company</th>
											  <th>Address</th>
										    </tr>
										</thead>
										<tbody>
						
										<?php 
										$berit=$this->db
										->get("identity");
										//echo $this->db->last_query();
										foreach($berit->result() as $identity){
										?>
										<tr>
										  <td class="col-md-1">
											<form style="float:left; margin-right:5px;" method="post">
											  <input type="hidden" name="identity_id" value="<?=$identity->identity_id;?>">
											  <button name="edit" value="ok" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></button>
											</form>											</td>
										  <td><?=$identity->identity_name;?></td>
										  <td><?=$identity->identity_company;?></td>
											
											<td><?=$identity->identity_address;?></td>
										  </tr>
										<?php }?>
										<script>
											function alasan(a){$("#alasan").text(a);}
										</script>
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
