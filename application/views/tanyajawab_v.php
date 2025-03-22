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
                    <li class="active">Layanan Tanya Jawab</li>
                </ul><!-- /.breadcrumb -->

                
            </div>
            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Layanan Tanya Jawab
                    </h1>
					<?php if(!isset($_POST['new'])&&!isset($_POST['edit'])){?>
                    
                    <form method="post" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
                        <button name="new" class="btn btn-info btn-block btn-sm" value="OK" style="">New</button>
                        <input type="hidden" name="tanya_id"/>
                       
                    </form>
                  
                    <?php }else{?>
					<form action="<?=site_url("tanya");?>" method="get" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
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
                                    <?php if(isset($_POST['edit'])){$namabutton='name="change"';$judul="Update Layanan Tanya Jawab";}else{$namabutton='name="create"';$judul="New Layanan Tanya Jawab";}?>	
                                    <div class="lead"><h3><?=$judul;?></h3></div>
                                    <form method="post" enctype="multipart/form-data">
									
									  
									  
									   <div class="form-group">
										<label for="tanya_title">Judul:</label>
										<input type="text" class="form-control" id="tanya_title" name="tanya_title" value="<?=$tanya_title;?>">
									  </div>
									  
									  
									 <div class="form-group">
										<label for="percakapan_content">Pertanyaan:</label>
										<textarea name="percakapan_content" id="percakapan_content"></textarea>
										<script>
											CKEDITOR.replace('percakapan_content');
										</script>
									  </div>
									   
									   
									  <input type="hidden" name="tanya_id" value="<?=$tanya_id;?>">
									  <input type="hidden" name="tanya_user" value="<?=$this->session->userdata("user_id");?>">
									  <input type="hidden" name="percakapan_user" value="<?=$this->session->userdata("user_id");?>">
									 <?php if(isset($_POST['new'])){$name="name='insert'";}elseif(isset($_POST['edit'])){$name="name='update'";}?>
									  <button type="submit" <?=$name;?> class="btn btn-primary col-md-5" value="OK">Submit</button>
									  <button class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href=<?=site_url("tanya");?>">Back</button>
									</form>
                                </div>
                                <?php }else{?>	
                                    <?php if($message!=""){?>
                                    <div class="alert alert-info alert-dismissable">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong><?=$message;?></strong><br/><?=$uploadtanya_picture;?>
                                    </div>
									
                                    <?php }?>
									

                                    <div class="box">
                                        <div id="collapse4" class="body table-responsive">				
                                        <table  id="dataTable" class="table">
										<thead>
											<tr>
											  <th>Tanggal</th>
											  <th>Tentang</th>
											  <th>Penanya</th>
											  <th>Status</th>
											  <th>Action</th>
											</tr>
										</thead>
										<tbody>						
											<?php 
											$tanya=$this->db
											->join("customer","customer.customer_id=tanya.customer_id","left")
											->get("tanya");
											//echo $this->db->last_query();
											$status1=array("Open","Terjawab","Closed");
											foreach($tanya->result() as $tanya){	
												if($tanya->tanya_status<2){$status=2;$lock="lock";}else{$status=0;$lock="unlock-alt";}									
											?>
											<tr style="">
											 
											  <td><?=$tanya->tanya_date;?></td>
												
												<td><?=$tanya->tanya_title;?></td>
												<td><?=$tanya->customer_name;?></td>
												<td><?=$status1[$tanya->tanya_status];?></td>
												<td class="col-md-1" style="padding:0px;">
												   <form action="<?=site_url("percakapan?tanya_id=".$tanya->tanya_id);?>" method="get" class="col-md-6" style="padding:0px;">
													   <button title="Percakapan" data-toggle="tooltip" class="btn btn-info col-md-12" value="OK"><span class="fa fa-bars" style="color:white;"></span> </button>
													   <input type="hidden" name="tanya_id" value="<?=$tanya->tanya_id;?>"/>
												   </form>
												
												   <form method="post" class="col-md-6" style="padding:0px;">
													   <button title="Delete" data-toggle="tooltip" class="btn btn-danger col-md-12" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
													   <input type="hidden" name="tanya_id" value="<?=$tanya->tanya_id;?>"/>
												   </form> 			
												   
												   <form method="post" class="col-md-6" style="padding:0px;">
													   <button title="Terjawab" data-toggle="tooltip" class="btn btn-primary col-md-12" name="closed" value="1"><span class="fa fa-share" style="color:white;"></span> </button>
													   <input type="hidden" name="tanya_id" value="<?=$tanya->tanya_id;?>"/>
												   </form>
												   
												   <form method="post" class="col-md-6" style="padding:0px;">
													   <button title="Closed" data-toggle="tooltip" class="btn btn-warning col-md-12" name="closed" value="<?=$status;?>"><span class="fa fa-<?=$lock;?>" style="color:white;"></span> </button>
													   <input type="hidden" name="tanya_id" value="<?=$tanya->tanya_id;?>"/>
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
