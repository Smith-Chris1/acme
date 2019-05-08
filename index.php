<?php

// Create or access a Session
 session_start();
// Get the database connection file
 require_once 'library/connections.php';
 // Get the acme model for use as needed
 require_once 'model/acme-model.php';
 require_once 'library/functions.php';

 // Get the array of categories
	$categories = getCategories();
 
// Build a navigation bar using the $categories array        
$navList = buildNav($categories);
        


$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
//  if(isset($_COOKIE['firstname'])){
//  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
// }
 switch ($action){
 case 'something':
  
  break;

 case 'home':
		include $_SERVER['DOCUMENT_ROOT'] .'/acme/view/home.php';
	 break;
 
 default:
  include 'view/home.php';
}