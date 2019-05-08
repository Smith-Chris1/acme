<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Home -- ACME Foods">
	<meta name="Chris Smith" content="CIT 336">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="/acme/css/style.css">
	<title><?php echo $categoryName; ?> Products | Acme, Inc.</title>
        	
</head>
<body>
<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?> 
	</header>

<div class="all">
    <div>
	
	<h1><?php echo $categoryName; ?> Products</h1>
</div>
<?php if(isset($message)){
 echo $message; } 
 ?>
 <?php if(isset($prodDisplay)){ 
 echo $prodDisplay; 
} ?>
  </div>
	
  <footer>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?> 		
	</footer>
</body>

</html>