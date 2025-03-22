<?php
$identity=$this->db->get("identity")->row();

					
//update session paket
$paketku=$this->db
->join("mpaket","mpaket.mpaket_code=paket.mpaket_code","left")
->where("customer_id",$this->session->userdata("customer_id"))
->where("paket_awal <=",date("Y-m-d"))
->where("paket_akhir >=",date("Y-m-d"))
->get("paket");
if($paketku->num_rows()>0){
	$this->session->set_userdata("paket",$paketku->row()->mpaket_type);
}else{
	$this->session->set_userdata("paket","-1");
}	
//echo $this->db->last_query();
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
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tafsir Mimpi Sesuai Sunnah</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta id="description" name="description" content="Tafsir mimpi sesuai sunnah. Diambil dari Qoomuusu Tafsiirul Ahlaam karya Asy-Syaikh Kholid Al Anbari. Rosulullah bersabda: "Apabila zaman mulai berdekatan (waktu terasa singkat), hampir-hampir mimpi seorang mu'min itu tidak berdusta. Dan mimpi seorang mu'min adalah sebagaian dari 76 cabang Nubuwwah. Dan apa saja yang berasal dari Nubuwwah maka tidak akan pernah dusta." (HR Al-Bukhori:7017 dan Muslim: 22)" />
	<meta name="keywords" content="tafsir mimpi, ahlussunnah, salafy, salafy, quran" />
	<meta name="author" content="qithy.com" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="icon" type="image/png" href="<?=base_url("assets/images/identity_picture/".$identity->identity_picture);?>">	
	<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<!-- <link href="https://fonts.googleapis.com/css?family=Bungee+Shade" rel="stylesheet"> -->
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?=base_url("assets/css/animate.css");?>">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?=base_url("assets/css/icomoon.css");?>">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?=base_url("assets/css/bootstrap.css");?>">
	<!-- Theme style  -->
	<link rel="stylesheet" href="<?=base_url("assets/css/style.css");?>">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="<?=base_url("assets/css/magnific-popup.css");?>">
	
	
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	
	<!-- Modernizr JS -->
	<script src="<?=base_url("assets/js/modernizr-2.6.2.min.js");?>"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
<style>
body, html{
	background: linear-gradient(to bottom right, #B23C71, #7A30AD);
	background-image: url("<?=base_url("assets/images/global/bawahkiri.jpg");?>");
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100%;
	font-size:14px;
	
}
@font-face {
    font-family: "Beyond";
    src: url(<?=base_url("assets/fonts/Beyond Wonderland.ttf");?>) format("truetype");
}
.beyond{font-family: 'Beyond', serif  !important;}
.tengah{position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center;}
.back{color:#FFFFFF; text-shadow:#CC0099 0px 0px 5px; font-weight:bold; font-size:18px; padding:10px 0 0px 0;}
.back > a{ color:#FFFFFF; text-shadow:#CC0099 0px 0px 5px; text-decoration:none;}
.back > a:hover{color:#CC0099; text-shadow:#FFFFFF 0px 0px 5px;}
.aside-toggle1{
	position:fixed;
	top:30px;
	left:30px;
}
#fh5co-aside1{
	display:none;
	background-color:#000000;
	height:100%;
	position:fixed;
	top:0px;
	left:0px;
	z-index:10000000;
	color:white;
	padding:50px;
	font-size:18px;
	overflow-y:scroll;
}
#fh5co-bio1{
	padding-bottom:300px;
}
.fontstandard{ font-size:24px; color:#9900CC;}
.inputstandard{  font-size:18px; height:inherit!important; padding:5px;}
.red{color:red;}
.lock{position:absolute; top:10px; left:10px; color:#FF0000;}
</style>
<script>
function bukaprolog(){
	$("#fh5co-aside1").fadeToggle();
}
setTimeout(function(){
	$("svg").css({"opacity":"0"});
},2000);
</script>
<script>
function klik(){
	$( "#target" ).click(function() {
	  alert( "Handler for .click() called." );
	});
}
$("document").ready(function(){

<?php
if(!empty($this->session->flashdata("message"))){?>
$("#infoModal").modal("show");
<?php }?>
});
</script>