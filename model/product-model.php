<?php 
/*
That this is the products model.


The new function will handle products

*/

function newCategory($categoryName){
$db = acmeConnect();
$sql = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
$stmt = $db->prepare($sql);
$stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}


function newProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle){
$db = acmeConnect();
$sql = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, categoryId, invVendor, invStyle) VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';
$stmt = $db->prepare($sql);
$stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
$stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
$stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
$stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
$stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
$stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
$stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
$stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
$stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
$stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
$stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
$stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}

function getProductBasics() {
$db = acmeConnect();
$sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
$stmt = $db->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $products;
}

function getProductInfo($invId){
$db = acmeConnect();
$sql = 'SELECT * FROM inventory WHERE invId = :invId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$stmt->execute();
$prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->closeCursor();
return $prodInfo;
}

function updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId){
	$db = acmeConnect();
	$sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryId = :categoryId, invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId'; 
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
	$stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
	$stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
	$stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
	$stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
	$stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
	$stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
	$stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
	$stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
	$stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
	$stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
	$stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
	$stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 	
	$stmt->execute();
	$rowsChanged = $stmt->rowCount();
	$stmt->closeCursor();
	return $rowsChanged;
	}

	function deleteProduct($invId) {
		$db = acmeConnect();
		$sql = 'DELETE FROM inventory WHERE invId = :invId';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
		$stmt->execute();
		$rowsChanged = $stmt->rowCount();
		$stmt->closeCursor();
		return $rowsChanged;
	   }

	   function getProductsByCategory($categoryName){
		$db = acmeConnect();
		$sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
		$stmt->execute();
		$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $products;
	   }

	   function getProductDetails($prodId){
		$db = acmeConnect();
		$sql = 'SELECT invName, invDescription, invImage, invPrice, invVendor, invStyle, invWeight, invSize, invLocation, invStock FROM inventory WHERE invId = :prodId';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':prodId', $prodId, PDO::PARAM_STR);
		$stmt->execute();
		//$productdetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$productdetails = $stmt->fetch(PDO::FETCH_NAMED);
		$stmt->closeCursor();
		return $productdetails;
	}

	function getProductImages($prodId){
		$db = acmeConnect();
		$sql = 'SELECT * FROM images WHERE invId = :prodId';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':prodId', $prodId, PDO::PARAM_STR);
		$stmt->execute();
		//$productdetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$productImages = $stmt->fetchAll(PDO::FETCH_NAMED);
		$stmt->closeCursor();
		return $productImages;
	}

 ?>