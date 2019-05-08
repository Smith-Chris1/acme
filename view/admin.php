<?php
if (!$_SESSION['loggedin']) {
    	header("Location: /acme/" );
     }else{
	$infoClient=($_SESSION['clientData']);
	$clientInformation='<h1>'.$infoClient['clientFirstname'].' '.$infoClient['clientLastname'].'</h1>';
//display message of the session
    if (isset($message)) {
     $clientInformation.= $message;
	}

    $clientInformation.='<h2>You are logged in</h2>';
    $clientInformation.='<ul>';
    $clientInformation.= '<li> First Name: '.$infoClient['clientFirstname'].'</li>';
    $clientInformation.= '<li> Last Name: '.$infoClient['clientLastname'].'</li>';
    $clientInformation.= '<li> Email: '.$infoClient['clientEmail'].'</li>';
    $clientInformation.= '</ul>';
    $clientInformation.="<a href=\"/acme/accounts/index.php?action=modifyAccount\">Update account information</a>";
    if ((int)$infoClient['clientLevel']>=2) {
	$clientInformation.='<h2>Use the link to administer products</h2>';	
 	$clientInformation.="<a href=\"/acme/products/index.php\">Product</a>";
    }

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
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title>ACME</title>

</head>
<body>
<header>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
</header>


	<div class="all">
		<div>  
			<?php 
			echo $clientInformation;
			if (isset($reviewList)) {
			echo "<h2>Manage your Product Review</h2>";
			echo $reviewList; 
			}
			?>
		</div>
	</div>
	<footer>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
</footer>
</body>


</html>