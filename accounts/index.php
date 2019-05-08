<?php

// Create or access a Session
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
// Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 
 // Get the accounts model
 require_once '../model/accounts-model.php';
 require_once '../library/functions.php';
 require_once '../model/reviews-model.php';

 // Get the array of categories
	$categories = getCategories();
 // Build a navigation bar using the $categories array
        $navList = buildNav($categories);
        
        $action = filter_input(INPUT_POST, 'action');
        if ($action == NULL) {
            $action = filter_input(INPUT_GET, 'action');
            if ($action == NULL) {
                 $action = 'default';
            }
        }

 switch ($action){

case 'registration':
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/registration.php';
break;

case 'logout':
    // var_dump($_SESSION);
    header('Location: /acme/');
        session_destroy();
        
//        header("Location: http://localhost/acme/" );
//        include '/acme';
        // exit;
        // include '/acme/view/home.php';
break;

case 'register':
// echo 'You are in the register case statement.';
     // Filter and store the data
$clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
$clientLastname = filter_input(INPUT_POST, 'clientLastname');
$clientEmail = filter_input(INPUT_POST, 'clientEmail');
$clientPassword = filter_input(INPUT_POST, 'clientPassword');
$existingEmail = checkExistingEmail($clientEmail);

// Check for existing email address in the table
if($existingEmail){
$message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
include '../view/login.php';
exit;
}

// Check for missing data
if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
 $message = '<p>Please provide information for all empty form fields.</p>';
 include '../view/registration.php';
 exit; 
} 
$passwordCheck = checkPassword($clientPassword);
if (empty($passwordCheck)) {
    $message = '<p class="notice">Please provide a valid password.</p>';
    include '../view/registration.php';
    exit;
}
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT); 
$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

// Check and report the result
if($regOutcome === 1){
    setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
 $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
 include '../view/login.php';
 exit;
} else {
 $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
 include '../view/registration.php';
 exit;
}

break;
 
case 'Login':
$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

  $clientEmail = checkEmail($clientEmail);
  $checkPassword = checkPassword($clientPassword);

// Check for missing data
if(empty($clientEmail) || empty($checkPassword)){
$message = '<p>Please provide information for all empty form fields.</p>';
include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
exit;
}
// $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
// $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
// $passwordCheck = checkPassword($clientPassword);

// // Run basic checks, return if errors
// if (empty($clientEmail) || empty($passwordCheck)) {
//  $message = '<p class="notice">Please provide a valid email address and password.</p>';
//  include '../view/registration.php';
//  exit;
// }
  
// A valid password exists, proceed with the login process
// Query the client data based on the email address
$clientData = getClient($clientEmail);
// Compare the password just submitted against
// the hashed password for the matching client
$hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
// If the hashes don't match create an error
// and return to the login view
if(!$hashCheck) {
  $message = '<p class="notice">Please check your password and try again.</p>';
  include '../view/login.php';
  exit;
}
// A valid user exists, log them in
$_SESSION['loggedin'] = TRUE;
// Remove the password from the array
// the array_pop function removes the last
// element from an array
array_pop($clientData);
// Store the array into the session

// if (isset($_COOKIE['firstname'])) {
    unset($_COOKIE['firstname']);
    setcookie('firstname', null, -1, '/');
//     return true;
// } else {
//     return false;
// }


$_SESSION['clientData'] = $clientData;
// Send them to the admin view

$clientFirstname=$clientData['clientFirstname'];
//var_dump($clientFirstname);
//echo $cookieFirstname;
//exit;

// setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/'); //falta ver si el cliente existe

include '../view/admin.php';

exit;
break;
     
case 'modifyAccount':
$clientId = $_SESSION['clientData']['clientId'];
$clientInfo = getClient($clientId);
if (count($clientInfo) < 1){
    $message = 'Sorry, no client information could be found.';
}
include '../view/client-update.php';
break;

case 'accUpdate':

$clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
$clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
$clientEmail = filter_input(INPUT_POST, 'clientEmail');
$clientEmail = checkEmail($clientEmail);
$sessionEmail = $_SESSION['clientData']['clientEmail'];
$clientId = $_SESSION['clientData']['clientId'];
$existingEmail = checkExistingEmail($clientEmail);
if (($sessionEmail != $clientEmail) && ($existingEmail = 0) ){
$message = '<p class = "notice">That email already exists. Please enter another email address.</p>';
$_SESSION['message'] = $message;
include '../view/client-update.php';
exit;
}
if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
$message = "<p class='notice'>Please provide information for all empty form fields.</p>";
$_SESSION['message'] = $message;
include '../view/client-update.php';
exit;
}
$clientUpResult = updateClient($clientId, $clientFirstname, $clientLastname, $clientEmail); 
$clientData = getClient($clientEmail);
$_SESSION['loggedin'] = TRUE;
array_pop($clientData);
$_SESSION['clientData'] = $clientData;
if ($clientUpResult) {
$message = "<p class='notice'>Congratulations, ". $_SESSION['clientData']['clientFirstname']. " your account was successfully updated.</p>";
$_SESSION['message'] = $message;
// include '../view/admin.php';
}
include '../view/admin.php';
exit;
break;

case 'passUpdate':
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$clientid = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);
$checkPassword = checkPassword($password);
if (empty($checkPassword)) {
$message = '<p>Please provide information for all empty form fields.</p>';
include '../view/client-update.php';
exit;
}
$password = password_hash($password, PASSWORD_DEFAULT);
$clientUpResult = updatePassword($password, $clientid); 
$clientData = getClientbyId($clientid);
$_SESSION['loggedin'] = TRUE;
array_pop($clientData);
$_SESSION['clientData'] = $clientData;
if ($clientUpResult) {
$message = "<p class='notice'>Congratulations, ". $_SESSION['clientData']['clientFirstname']. " your password was successfully updated.</p>";
$_SESSION['message'] = $message;
include '../view/admin.php';
}
exit;

default:

$infoClient = ($_SESSION['clientData']);

$clientReviews = getClientReviews($infoClient['clientId']);

if(count($clientReviews) > 0){

    $reviewList = buildClientsReviews($clientReviews);
} else {
    $message = '<p class="notify">Sorry, no reviews were returned.</p>';
 }

include '../view/admin.php';

}