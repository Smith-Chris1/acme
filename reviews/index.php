<?php
/* Reviews Controller */
	require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/library/connections.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/acme-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/accounts-model.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/library/functions.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/reviews-model.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/product-model.php';

// Create or access a Session
session_start();

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}


	$categories = getCategories();
	//var_dump($categories);
	//exit;



	$navList = buildNav($categories);

	//echo $navList;
	//exit;

	$action = filter_input(INPUT_POST, 'action');
	if ($action == NULL){
	 $action = filter_input(INPUT_GET, 'action');
	}



	switch ($action){

// Code to deliver the views will probably be here

case 'add':
// Filter and store the data

  $prodId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
  $reviewDescription = filter_input(INPUT_POST, 'reviewDescription', FILTER_SANITIZE_STRING);
  $productDetails = getProductDetails($prodId);
  $productName = $productDetails['invName'];
  $detailDisplay = buildDetailDisplay($productDetails);
  $productImages = getProductImages($prodId);
  $imageDisplay = buildProductImageDisplay($productImages);
	//var_dump($clientFirstname);
	//echo $clientFirstname;
	//exit;

// Check for missing data
if(empty($prodId) || empty($clientId) || empty($reviewDescription)){

	if(!is_null($reviewDescription)){
  			$message = '<p>Please provide information for all empty form fields.</p>';
  }
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-detail.php';
  exit;
}
 //var_dump($reviewDescription);
 //exit;
// Send the data to the model
$regAdd= addReview($reviewDescription, $prodId, $clientId);
//------------ hasta ahi prontin l cu
$reviews = getProductReviews($prodId);
$rvs = buildProductsReviews($reviews);
// Check and report the result
if($regAdd === 1){
	//setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');	
  $message = "<p>Thanks for review of $productName</p>";
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-detail.php';
  // exit;
} else {
  $message = "<p>Sorry but the registration failed. Please try again.</p>";
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-detail.php';
  //header??
  exit;
}
break;

case 'mod':
 $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
 $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
 //$invNameReview = filter_input(INPUT_GET, 'invName', FILTER_SANITIZE_STRING);
//	var_dump($invNameReview );
//	exit;
 $reviewInfo = getReview($reviewId);
 if(count($reviewInfo)<1){
  $message = 'Sorry, no information could be found.';
 }
 include $_SERVER['DOCUMENT_ROOT'] .'/acme/view/update-review.php';
 exit;
break;

case 'update':
// Filter and store the data
  $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
  $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
  $invNameReview = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);

//$clientEmail = checkExistingEmail($clientEmail);
//si es la misma direccion puede fallar tenes que chequearlo contra el de la session
/*check email */
/*$infoClient = ($_SESSION['clientData']);
if($clientEmail != $infoClient['clientEmail']){

  $existingEmail = checkExistingEmail($clientEmail);
if($existingEmail){
    $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
    exit;
    }
}
  //var_dump($clientFirstname);
  //echo $clientFirstname;
  //exit;
*/
// Check for missing data
if(empty($reviewId) || empty($reviewText)){

  if(!is_null($reviewText)){
        $message = '<p>Please provide information for all empty form fields.</p>';
  }
  $reviewInfo=getReview($reviewId);

  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/update-review.php';
  exit;
}

// Send the data to the model
$regUpdateReview = updateReview($reviewId, $reviewText);
//$regUpdateClient = updateClient("Antonio Marcelossss", "Lefinua", "alefinir@theelectricfactory.com", "6");

//  echo $regUpdateClient;
//  exit;

// Check and report the result

if($regUpdateReview){  
  $message = "<p>Thanks for update the review.</p>";


  // ask for data of new client
  //update date of the sessions
//-----------------------------------------
 //
 // $_SESSION['loggedin'] = TRUE;
// Remove the password from the array
// the array_pop function removes the last
// element from an array
//array_pop($clientData);
// Store the array into the session
//$_SESSION['clientData'] = $clientData;
// Send them to the admin view
  //$clientFirstname=$clientData['clientFirstname'];
  //setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');  

//-----------------------------------------
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/accounts/index.php';
  //header("Location: http://localhost/acme/view/client-update.php" );

  exit;
} else {
  $message = "<p>Sorry but the update failed. Please try again.</p>";
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/accounts/index.php';
  exit;
}

break;





case 'delete':

  $rId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

// Send the data to the model
  $deleteResult = deleteReview($rId);
  //var_dump($rId);
  //exit;

// Check and report the result
if ($deleteResult) {
 $message = "<p>Congratulations, the review was successfully deleted.</p>";
 $_SESSION['message'] = $message;
 //header('Location: http://localhost/acme/accounts/');
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/accounts/index.php';
 exit;
}else {
  $message = "<p>Error: the review was not deleted.</p>";
  //header('Location: http://localhost/acme/accounts/');
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/accounts/index.php';
  exit;
}

 break; 

default:

  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
  unset($message);
}

?>
