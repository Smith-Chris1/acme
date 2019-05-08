<?php
// Create or access a Session
 session_start();
/* 
 * Products Controller
 */
// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the products model for use as needed
require_once '../model/product-model.php';
// Get the accounts model for use as needed
require_once '../model/accounts-model.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';

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


switch ($action) {
    
case 'prodman':
include '../view/product-management.php';
break;    

case 'newprod':
include $_SERVER['DOCUMENT_ROOT'] .'/acme/view/add-product.php';
break;

case 'newcat':
include $_SERVER['DOCUMENT_ROOT'] .'/acme/view/add-category.php';
break;

case 'addprod':
$invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
$invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
$invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
$invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);        
$invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
$invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_STRING);
$invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_STRING);
$invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
$categoryId = filter_input(INPUT_POST, 'catId', FILTER_SANITIZE_STRING);
$invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
$invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

// Check for missing data
if (empty($invName) || empty($invDescription) || empty($invImage) ||
   empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) ||
   empty($invWeight) || empty($invLocation) || empty($categoryId) || ($categoryId == "Choose a Category") || empty($invVendor) ||                   
    empty($invStyle)) {
    $message = '<p>Please provide information for all empty form fields.</p>';
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/add-product.php';
    exit;
}
// Send the data to the model
$addOutcome = newProduct($invName, $invDescription, $invImage, $invThumbnail, 
$invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);
// Check and report the result
if ($addOutcome === 1) {
    $message = "<p>Thanks for adding a product to the inventory.</p>";
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-management.php';
    exit;
    } else {
    $message = "<p>Sorry, but the creation of a new product failed. Please try again.</p>";
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-management.php';
    exit;
}
break;

case 'addcat':
//echo 'You are in the add category case statement.';
//Filter and store the data

$categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
 
// Check for missing data
if (empty($categoryName)) {
    $message = '<p>Please provide information for all empty form fields.</p>';
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/add-category.php';
    exit;
}

// Send the data to the model
$addOutcome = newCategory($categoryName);

// Check and report the result
if ($addOutcome === 1) {
    $message = "<p>Thanks for adding a category to the database.</p>";
    header("Refresh:0");
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-management.php';
    exit;
} else {
    $message = "<p>Sorry, but the creation of a new category failed. Please try again.</p>";

//            include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/prod-mgmt.php';
exit;
}

break;

case 'mod':
 $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
 $prodInfo = getProductInfo($invId);
 if(count($prodInfo)<1){
  $message = 'Sorry, no product information could be found.';
 }
 include '../view/update-product.php';
 exit;
break;

case 'updateProd':
 $categoryId = filter_input(INPUT_POST, 'catType', FILTER_SANITIZE_NUMBER_INT);
 $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
 $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
 $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
 $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
 $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
 $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
 $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
 $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
 $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
 $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
 $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
 $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
 if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
  $message = "<p>Please complete all information for the updated item! Double check the category of the item, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle, $invId</p>";
  
 include '../view/update-product.php';
 exit;
}  
$updateResult = updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId);
// $updateResult = updateProduct($catType, $invName, $invDescription, $invImg, $invThumb, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId);
if ($updateResult) {
    $message = "<p class='notify'>Congratulations, $invName was successfully updated.</p>";
    $_SESSION['message'] = $message;
    header('location: /acme/products/');
    exit;
   } else {
  $message = "<p>Error. The product was not updated.</p>";
 include '../view/update-product.php';
 exit;
}
 break;

 case 'del':
 $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
 $prodInfo = getProductInfo($prodId);
     if (count($prodInfo) < 1){
         $message = 'Sorry, no product information could be found.';
     }
     include '../view/delete-product.php';
     exit;        
break;

case 'deleteProd':
$invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
$invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
$deleteResult = deleteProduct($invId);
if ($deleteResult) {
$message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
$_SESSION['message'] = $message;
header('location: /acme/products/');
exit;
} else {
$message = "<p class='notice'>Error. $invName was not deleted.</p>";
header('location: /acme/products/');
exit;
}
break;

case 'category':

 $categoryName = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
 $products = getProductsByCategory($categoryName);
 if(!count($products)){
  $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
 } else {
  $prodDisplay = buildProductsDisplay($products);
 }
 include '../view/category.php';
 break;

 case 'prodDetail':
    $prodId = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_NUMBER_INT);
    $productDetails = getProductDetails($prodId);
    $productImages = getProductImages($prodId);
    $reviews = getProductReviews($prodId);
    $productName = $productDetails['invName'];
            // $detailDisplay = buildDetailDisplay($productDetails);
    if (!count($productDetails)){
            $message = "<p class='notice'>Sorry, no products could be found.</p>";
        }else {
            $productName = $productDetails['invName'];
            $detailDisplay = buildDetailDisplay($productDetails);
    }
    if (!count($productImages)){
        $message = "<p class='notice'>Sorry, no images could be found.</p>";
    }else {
        $imageDisplay = buildProductImageDisplay($productImages);
    }
    $rvs = buildProductsReviews($reviews);
    include '../view/product-detail.php';
break; 

default:
// if (isset($productDetails)){
//     $detailDisplay = buildDetailDisplay($productDetails);
// }
 $products = getProductBasics();
 if(count($products) > 0){
  $prodList = '<table>';
  $prodList .= '<thead>';
  $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
  $prodList .= '</thead>';
  $prodList .= '<tbody>';
  foreach ($products as $product) {
   $prodList .= "<tr><td>$product[invName]</td>";
   $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
   $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
  }
   $prodList .= '</tbody></table>';
  } else {
   $message = '<p class="notify">Sorry, no products were returned.</p>';
}
 include '../view/product-management.php';
break; 
}