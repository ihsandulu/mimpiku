<!doctype html>
<html>

<head>
    <?php 
	require_once("meta.php");
	require_once("meta_m.php");
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
                    <li class="active">Generate Paket</li>
                </ul><!-- /.breadcrumb -->

                
            </div>
            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Generate Paket
                    </h1>
					<?php if((!isset($_POST['new'])&&!isset($_POST['edit'])&&$this->session->userdata("position_id")==1&&!isset($_GET['id']))||isset($_GET['register'])){?>
                    
                    <form method="post" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
                        <button name="new" class="btn btn-info btn-block btn-sm" value="OK" style="">
						<?=(isset($_GET['register']))?"Daftar Baru":"New";?>
						</button>
                        <input type="hidden" name="mpaket_id"/>
                       
                    </form>
                  
                    <?php }
					
					if(isset($_POST['new'])||isset($_POST['edit'])){?>
					<form action="<?=site_url("mpaket");?>" method="get" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
                        <button class="btn btn-warning btn-block btn-sm" value="OK" style="">Back</button>		
                       
                    </form>
					<?php }?>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <?php if(isset($_POST['new'])||isset($_POST['edit'])||isset($_GET['register'])){?>
                                <div class="">
                                    <?php if(isset($_POST['edit'])){$namabutton='name="change"';$judul="Update Generate Paket";}else{$namabutton='name="create"';$judul="New Generate Paket";}?>	
                                    <div class="lead"><h3><?=$judul;?></h3></div>
                                    <form method="post">
										<label class="label label-danger col-md-12" style="padding:15px;"><?=$message;?></label>
										<div class="form-group">
											<label for="mpaket_name"><span class="red">*</span> Nama Paket:</label>
											<input class="form-control inputstandard" type="text" id="mpaket_name" name="mpaket_name" placeholder="Nama Paket" required="required" value="<?=$mpaket_name;?>" />
										</div>
										<div class="form-group">
											<label for="mpaket_code"><span class="red">*</span> Kode:</label>
											<?php
											function random_strings($length_of_string)
											{
											  
												// String of all alphanumeric character
												$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
											  
												// Shufle the $str_result and returns substring
												// of specified length
												return substr(str_shuffle($str_result), 
																   0, $length_of_string);
											}
											?>
											<input class="form-control inputstandard" type="text" id="mpaket_code" name="mpaket_code" placeholder="Kode Paket" required="required" value="<?=strtoupper(random_strings(10));?>" />
										</div>
										<div class="form-group">
											<label for="mpaket_days"><span class="red">*</span> Hari:</label>
											<input class="form-control inputstandard" type="number" id="mpaket_days" name="mpaket_days" placeholder="Jumlah Hari" required="required" value="<?=$mpaket_days;?>" />
										</div>
										<div class="form-group">
											<label for="mpaket_days"><span class="red">*</span> Type:</label>
											<select class="form-control inputstandard" id="mpaket_type" name="mpaket_type" required="required" >
												<option value="0" <?=($mpaket_type=="0")?"selected":"";?>>Tanya</option>
												<option value="1" <?=($mpaket_type=="1")?"selected":"";?>>Baca</option>
												<option value="2" <?=($mpaket_type=="2")?"selected":"";?>>Tanya & Baca</option>
											</select>
										</div>
                                      <input type="hidden" name="mpaket_id" value="<?=$mpaket_id;?>"/>					  					  
                                      <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" id="submit" class="btn btn-primary col-md-5" <?=$namabutton;?> value="OK">Submit</button>
                                            <button class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href=<?=site_url("mpaket");?>">Back</button>
                                        </div>
                                      </div>
									</form>	
                                </div>
                                <?php }else{?>	
                                    <?php if($message!=""){?>
                                    <div class="alert alert-info alert-dismissable">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong><?=$message;?></strong><br/><?=$uploadmpaket_picture;?>
                                    </div>
									
                                    <?php }?>
									

                                    <div class="box">
                                      <div id="collapse4" class="body table-responsive">
										<?php if(!isset($_GET['id'])){$idtable="dataTable";}else{$idtable="";}	?>			
                                        <table id="<?=$idtable;?>" class="table table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                  <th>Nama Paket</th>
                                                    <th>Code</th>
                                                    <th>Jumlah Hari</th>
                                                    <th>Type</th>
													<?php
													if($this->session->userdata("position_id")==1){
													?>
                                                    <th class="col-md-1">&nbsp;</th>
													<?php }?>
                                                    <th class="col-md-1">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php 
												if($this->input->get("id")>0){
													$this->db->where("mpaket.mpaket_id",$this->input->get("id"));
												}
												if(isset($_GET['register'])){
													$this->db->where("mpaket.mpaket_id",-3);
												}
												if($this->session->userdata("position_id")!=1){
													$this->db->where("mpaket.mpaket_id",$this->session->userdata("mpaket_id"));
												}
												$usr=$this->db
                                                ->get("mpaket");
												$type=array("Tanya","Baca","Tanya & Baca");
												//echo $this->db->last_query();
                                                foreach($usr->result() as $mpaket){?>
                                                <tr>
                                                  <td><?=$mpaket->mpaket_name;?></td>											
                                                    <td><?=$mpaket->mpaket_code;?></td>								
                                                    <td><?=$mpaket->mpaket_days;?></td>								
                                                    <td><?=$type[$mpaket->mpaket_type];?></td>			
                                                    <td style="padding-left:0px; padding-right:0px; text-align:center;">
                                                        <form method="post" class="col-md-6 col-sm-6 col-xs-6" style="padding:0px;">
                                                            <button class="btn btn-warning btn-block" name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                            <input type="hidden" name="mpaket_id" value="<?=$mpaket->mpaket_id;?>"/>
                                                        </form>
                                                   		<?php if($this->session->userdata("position_id")==1){?>		 
                                                        <form method="post" class="col-md-6 col-sm-6 col-xs-6" style="padding:0px;">
                                                            <button class="btn btn-danger btn-block delete" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                            <input type="hidden" name="mpaket_id" value="<?=$mpaket->mpaket_id;?>"/>
                                                        </form>	
														<?php }?>										
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
