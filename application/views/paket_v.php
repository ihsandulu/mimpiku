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
                    <li class="active">Akses Paket</li>
                </ul><!-- /.breadcrumb -->

                
            </div>
            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Akses Paket
                    </h1>
                  
                    <?php 					
					if(isset($_POST['new'])||isset($_POST['edit'])){?>
					<form action="<?=site_url("paket");?>" method="get" class="col-md-2" style="margin-top:-30px; float:right;">							
                       
                        <button class="btn btn-warning btn-block btn-sm" value="OK" style="">Back</button>		
                       
                    </form>
					<?php }?>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                           
                                    <?php if($message!=""){?>
                                    <div class="alert alert-info alert-dismissable">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <strong><?=$message;?></strong><br/><?=$uploadpaket_picture;?>
                                    </div>
									
                                    <?php }?>
									

                                    <div class="box">
                                      <div id="collapse4" class="body table-responsive">
										<?php if(!isset($_GET['id'])){$idtable="dataTable";}else{$idtable="";}	?>			
                                        <table id="dataTableMulti" class="table table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                  <th>Date</th>
                                                    <th>Customer</th>
                                                    <th>Code</th>
                                                    <th>Paket</th>
                                                    <th>Jenis</th>
                                                    <th class="col-md-1">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php 
												$type=array("Bertanya","Baca Premium","Bertanya & Baca");
												if($this->input->get("id")>0){
													$this->db->where("paket.paket_id",$this->input->get("id"));
												}
												if(isset($_GET['register'])){
													$this->db->where("paket.paket_id",-3);
												}
												if($this->session->userdata("position_id")!=1){
													$this->db->where("paket.paket_id",$this->session->userdata("paket_id"));
												}
												$usr=$this->db
												->join("customer","customer.customer_id=paket.customer_id","left")
												->join("mpaket","mpaket.mpaket_code=paket.mpaket_code","left")
                                                ->get("paket");
												//echo $this->db->last_query();
                                                foreach($usr->result() as $paket){?>
                                                <tr>
                                                  <td><?=$paket->paket_date;?></td>											
                                                    <td><?=$paket->customer_name;?></td>								
                                                    <td><?=$paket->mpaket_code;?></td>									
                                                    <td><?=$paket->mpaket_name;?></td>									
                                                    <td><?=$type[$paket->mpaket_type];?></td>			
                                                    <td style="padding-left:0px; padding-right:0px; text-align:center;">                                                        
                                                   		<?php if($this->session->userdata("position_id")==1){?>		 
                                                        <form method="post" class="col-md-6 col-sm-6 col-xs-6" style="padding:0px;">
                                                            <button class="btn btn-danger btn-block delete" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                            <input type="hidden" name="paket_id" value="<?=$paket->paket_id;?>"/>
                                                        </form>	
														<?php }?>										
													</td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
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
