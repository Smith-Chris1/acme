<?php

/* 
acme model
 */

function getCategories(){
 // Create a connection object from the acme connection function
 $db = acmeConnect(); 
 // The SQL statement to be used with the database 
 $sql = 'SELECT categoryName, categoryId FROM categories ORDER BY categoryName ASC'; 
 
 // The next line creates the prepared statement using the acme connection      
 $stmt = $db->prepare($sql);
 // The next line runs the prepared statement 
 $stmt->execute(); 
 // The next line gets the data from the database and 
 // stores it as an array in the $categories variable 
 $categories = $stmt->fetchAll(); 
 // The next line closes the interaction with the database 
 $stmt->closeCursor(); 
 // The next line sends the array of data back to where the function 
 // was called (this should be the controller) 
 return $categories;
}

function getNavList(){
    $categories = getCategories();
     $navList = '<ul>';
 $navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
 foreach ($categories as $category) {
  $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
 }
 $navList .= '</ul>';
 return $navList;
}