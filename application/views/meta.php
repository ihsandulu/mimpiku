<?php 
	date_default_timezone_set("Asia/Bangkok");
	$identity=$this->db->get("identity")->row();
	$bulanlist=array(0=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","Sepetember","Oktober","November","Desember");
	//cek user
	if(isset($_GET['register'])&&current_url()==site_url("user"))
	{
	
	}else{
		$userd["user_id"]=$this->session->userdata("user_id");
		if(current_url()!=site_url("login")){
			$us=$this->db
			->join("position","position.position_id=user.position_id","left")
			->get_where('user',$userd);	
			//echo $this->db->last_query();die;	
			if($us->num_rows()>0)
			{
				foreach($us->result() as $user){		
					foreach($this->db->list_fields('user') as $field)
					{
						$data[$field]=$user->$field;
					}	
					foreach($this->db->list_fields('position') as $field)
					{
						$data[$field]=$user->$field;
					}		
				}
			}else{	
				 $this->session->sess_destroy();
				redirect(site_url("login"));		
			}
		}
	}
	
	
?>

<script data-ad-client="ca-pub-6192668857872931" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<?php
//assign adsense code to a variable
$googleadsensecode = '
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-6192668857872931",
          enable_page_level_ads: true
     });
</script>
<script async custom-element="amp-auto-ads"
        src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">
</script>';
//now outputting this to HTML
//echo $googleadsensecode;
?>



<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title><?=$identity->identity_name;?></title>
<meta name="description" content="overview &amp; stats" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


<link rel="icon" type="image/png" href="<?=base_url("assets/images/identity_picture/".$identity->identity_picture);?>">	
<link href="<?=base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
<link href="<?=base_url('assets/css/datepicker3.css');?>" rel="stylesheet">
<link href="<?=base_url('assets/assets/css/animate.css');?>" rel="stylesheet">  

<link rel="stylesheet" href="<?=base_url("assets/css/font-awesome.min.css");?>">
 
<link rel="stylesheet" href="<?=base_url('assets/css/fonts.googleapis.com.css');?>" />
<link rel="stylesheet" href="<?=base_url('assets/css/jquery-ui.css');?>">

<script src="<?=base_url("assets/js/jquery-1.11.1.min.js");?>"></script>
<script src="<?=base_url("assets/js/bootstrap.min.js");?>"></script>
<script type="text/javascript" src="<?=base_url('ckeditor/ckeditor.js');?>"></script>
<script src="<?=base_url('assets/js/jquery.js');?>"></script>
<script src="<?=base_url('assets/js/jquery.validate.js');?>"></script>

<script src="<?=base_url('assets/js/bootstrap-datepicker.js');?>"></script>
<script src="<?=base_url('assets/js/jquery-ui.js');?>"></script>	
<link href="<?=base_url('assets/css/jquery.dataTables.min.css');?>" rel="stylesheet">
<script src="<?=base_url("assets/js/jquery.dataTables.min.js");?>"></script>

<!-- ace styles -->
<link rel="stylesheet" href="<?=base_url("assets/css/ace.min.css");?>" class="ace-main-stylesheet" id="main-ace-style" />

<!--[if lte IE 9]>
    <link rel="stylesheet" href="<?=base_url("assets/css/ace-part2.min.css");?>" class="ace-main-stylesheet" />
<![endif]
<link rel="stylesheet" href="<?=base_url("assets/css/ace-skins.min.css");?>" />
<link rel="stylesheet" href="<?=base_url("assets/css/ace-rtl.min.css");?>" />-->

<!--[if lte IE 9]>
  <link rel="stylesheet" href="<?=base_url("assets/css/ace-ie.min.css");?>" />
<![endif]-->

<!-- inline styles related to this page -->

<!-- ace settings handler -->
<script src="<?=base_url("assets/js/ace-extra.min.js");?>"></script>

<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

<!--[if lte IE 8]>
<script src="<?=base_url("assets/js/html5shiv.min.js");?>"></script>
<script src="<?=base_url("assets/js/respond.min.js");?>"></script>
<![endif]-->
<?php $akt=$this->db->get("activate");
if($akt->num_rows()==0&&current_url()!=site_url("login")){
?>
	<script>
	setTimeout(function(){
		window.location.href="<?=site_url("logout");?>";
	},1000*60*5);
	</script>
	<script>
		$(document).ready(function(){
		$(".modal-title").text("AKTIVASI");
		$(".modal-body").html('<h3><strong>Silahkan Aktivasi Aplikasi Anda</strong></h3>	  <form class="form">	  <div class="form-group">		<label for="aktivasi">Nomor Aktivasi :</label>		<input autofocus class="form-control" id="aktivasi" name="aktivasi" />	  </div>	   <div class="form-group">		<button type="button" onclick="aktivas()" id="submitaktivasi" name="submitaktivasi" class="btn btn-primary btn-block">Submit</button>	   </div>	  </form>');
		$("#myModal").modal();
		});
	</script>
<?php
}
?>	
<style>
.breadcrumbs{position:relative;z-index:auto;border-bottom:1px solid #E5E5E5;background: linear-gradient(to bottom right, #9E9E9E, #B0B0B0);min-height:41px;line-height:40px;padding:0 12px 0 0}
.limenu{background: linear-gradient(to bottom right, #757575, #B0B0B0); color:white !important;}
.border{border:black solid 1px;}
.hitstat{
	border:#999999 solid 1px; 
	border-radius:5px; 
	background: linear-gradient(to bottom right, white, #B0B0B0);
	position:fixed; 
	bottom:10px; 
	left:10px;
	z-index:200;
	opacity:0.95;
	font-size:12px;
	color:#333333;
	text-shadow:#FFFFFF 1px 1px;
	padding:5px;
	padding-left:10px;
	padding-right:10px;
}
input, select, textarea{border:none !important; border-bottom:#F4ECEC solid 1px !important; background-color:none;}
input:hover, select:hover, textarea:hover{border:none !important; border-bottom:#E9D9D9 solid 1px !important; background-color:none;}
</style>

<script>
	$(document).ready( function () {
		 $('#dataTable').DataTable( {
			"order": [[ 0, "desc" ]],
			 "iDisplayLength": 25
		} );
		
		 $('#parameter').DataTable( {
			"order": [[ 3, "asc" ],[ 4, "desc" ],[ 2, "desc" ]],
			 "iDisplayLength": 25
		} );

	} );
</script>
<script>
$(document).ready( function () {
	$(".prevent").bind("keypress", function (e) {
		if (e.keyCode == 13) {
			return false;
		}
	});
});
</script>
<script>
	$(document).ready(function() {	
		$("form").validate();
	});
	
	function bounceIn(a){
		$(a).addClass('animated bounceIn').parent().parent().addClass('animated bounceIn');
		setTimeout(function(){
			$(a).removeClass('animated bounceIn').parent().parent().removeClass('animated bounceIn');
		},500);
	}
	
</script>

<script>
function numberWithCommas(x) {
    var parts = x.toString().split(",");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return parts.join(",");
}

function kosong(objek){
	if(objek.value==0){objek.value='';}
}

function pemisah(objek) {
   a = objek.value;
   b = a.replace(/[^\d]/g,"");
   c = "";
   panjang = b.length;
   j = 0;
   for (i = panjang; i > 0; i--) {
     j = j + 1;
     if (((j % 3) == 1) && (j != 1)) {
       c = b.substr(i-1,1) + "." + c;
     } else {
       c = b.substr(i-1,1) + c;
     }
   }
   objek.value = c;
}
</script>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#dataTableMulti tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#dataTableMulti').DataTable({
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
 
} );
</script>