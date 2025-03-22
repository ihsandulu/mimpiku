<?php
require "vendor/autoload.php";
$Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
$code = $Bar->getBarcode($_GET['text'], $Bar::TYPE_CODE_128);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Bar Codes</title>
  
    <script src="assets/js/jquery-1.11.1.min.js"></script>
   
  
   
</head>
<body>
   <?php echo $code ?>
                
</body>
</html>