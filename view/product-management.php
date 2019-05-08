<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
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
		<div>
			<h1>Product Management</h1>
		</div>
		<h2>Welcome to the product management page. Please choose an option below</h2>
		<a href="/acme/products/index.php?action=newcat">Add a New Category</a><br>
		<a href="/acme/products/index.php?action=newprod">Add a New Product</a><br>
		<?php
				if (isset($message)) {
 					echo $message;
				} 
				if (isset($prodList)) {
 					echo $prodList;
				}
			?>
	</div>
	<footer>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
</footer>
</body>


</html>
<?php unset($_SESSION['message']); ?> 