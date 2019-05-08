<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Home -- ACME Foods">
    <meta name="Chris Smith" content="CIT 336">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/acme/css/style.css">
    <title>
        <?php echo $productDetails['invName']; ?> Products | Acme, Inc.</title>

</head>
<body>
<header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
</header>


    <div>
    <h1 class='productTitle'><?php echo $productName; ?></h1>
    <div class="productDetails">
        
        
        <?php if(isset($detailDisplay)){ echo $detailDisplay; } ?>
        
    </div>
</div>
<div class="imageDetails">
<h1 class='productTitle'>Images</h1>
<?php if(isset($imageDisplay)){ echo $imageDisplay; } ?>
</div>
<?php
echo "<div class='reviewBox'><h1 class='productTitle'>Customer Reviews</h1>";  
if(isset($_SESSION['loggedin'] )){

if (!$_SESSION['loggedin']) {
	echo "<br>";
	echo "<a href=\"/acme/accounts/?action=Login\">Login for reviewing an article</a>";
	echo "<br>";
	}
else{
$reviewForm = '<form  method="post" action="/acme/reviews/index.php">';
$reviewForm .= '<fieldset class="tight">';
$reviewForm .= '<legend>Review The '.$productName.'</legend>';
$reviewForm .= '<label>';
$reviewForm .= 'Screen Name: <input type="text" name="clientName" id="clientName" ';
$cName=substr($_SESSION['clientData']['clientFirstname'],0,1).$_SESSION['clientData']['clientLastname'];

 if(isset($cName))
	{$reviewForm .= "value= $cName";}
$reviewForm .= ' required disabled autofocus><br>';
$reviewForm .= '</label>';
$reviewForm .= '<label>';
$reviewForm .= 'Review:<br><textarea name="reviewDescription"  rows="4" cols="20" required>';
if(isset($reviewDescription)){
	$reviewForm .= $reviewDescription;}
$reviewForm.= '</textarea><br>';
$reviewForm .= '</label>';
$reviewForm .= '</fieldset>';  
$reviewForm .= '<div>';
if(isset($message)){ echo $message; };
$reviewForm .= '<input class="registerButton" type="submit" name="submit" id="addreviewbtn" value="Submit Review">';
$reviewForm .= '<input type="hidden" name="invId" value='.$prodId.'>';
$reviewForm .= '<input type="hidden" name="clientId" value='.$_SESSION['clientData']['clientId'].'>';
$reviewForm .= '<input type="hidden" name="action" value="add">';
$reviewForm .= '</div>';
$reviewForm .= '</form></div>';
//var_dump($reviewForm);
//exit;
echo $reviewForm;
};
};

if(isset($rvs)) {
    echo $rvs;
}
?>
<footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
</footer>
</body>


</html>