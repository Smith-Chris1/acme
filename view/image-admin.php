<?php
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Home -- ACME Foods">
  <meta name="Chris Smith" content="CIT 336">
  <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/acme/css/style.css">
  <title>ACME</title>

</head>
<body>
<header>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
</header>


<div class="all">
<div class="ablock">	
	<h1>Image Management</h1>		   
	<p>Welcome to the image management page and you have to choose one of the options presented below</p>

	<h2>Add New Product Image</h2>
	<?php
	if (isset($message)) {
	echo $message;
	}
	?>
	<form action="/acme/uploads/" method="post" enctype="multipart/form-data">
	 <label>Product</label><br>
	 <?php echo $prodSelect; ?><br><br>
	 <label>Upload Image:</label><br>
	 <input type="file" name="file1"><br>
	 <input type="submit" class="registerButton" value="Upload">
	 <input type="hidden" name="action" value="upload">
	</form>	

	<hr>

	<h2>Existing Images</h2>
	<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
	<?php
		if (isset($imageDisplay)) {
		 echo $imageDisplay;
	}
	?>	

</div>
</div>
<footer>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?> 		
	</footer>
</body>			


</html>
<?php unset($_SESSION['message']); ?> 