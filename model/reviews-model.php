<?php 
/*
That this is the review model for comments.
*/

//The new function will add reviews to the products


	function addReview($reviewText, $invId, $clientId){
		$reviewDate = date('Y-m-d H:i:s');
		$db = acmeConnect();
		$sql = 'INSERT INTO reviews (reviewText, reviewDate, invId, clientId) VALUES (:reviewText, :reviewDate, :invId, :clientId)';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
		$stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
		$stmt->bindParam(':invId', $invId, PDO::PARAM_INT);
		$stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
		$stmt->execute();
		$rowsChanged = $stmt->rowCount();
		$stmt->closeCursor();
		return $rowsChanged;
	}
//----------------------------------------------------
/*
this function retrieve all reviews of a client.
*/

function getClientReviews($clientId){
  $db = acmeConnect();
//   $sql = 'SELECT reviewId, reviewText, reviewDate, inventory.invName FROM reviews JOIN inventory ON inventory.invId = reviews.invId WHERE clientId = :clientId ORDER BY reviews.reviewDate DESC';
  $sql = "SELECT reviews.reviewId, reviews.reviewText, reviews.reviewDate, reviews.clientId, reviews.invId,invName FROM inventory INNER JOIN reviews ON reviews.clientId = :clientId AND reviews.invId = inventory.invId ORDER BY reviews.reviewDate DESC";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $clientData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}



//----------------------------------------------------
/*
this function retrieve all reviews of a product.
*/
function getProductReviews($prodId){
  $db = acmeConnect();
  $sql = 'SELECT reviewId, reviewText, reviewDate, clients.clientFirstname FROM reviews JOIN clients ON clients.clientId = reviews.clientId WHERE invId = :prodId ORDER BY reviews.reviewDate DESC';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':prodId', $prodId, PDO::PARAM_INT);
  $stmt->execute();
  $clientData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}


//------------------------------------------------------------------------------



// Get a specific review
function getReview($reviewId){
  $db = acmeConnect();
  $sql = 'SELECT reviewText, reviewDate, reviews.invId, invName FROM reviews JOIN inventory ON inventory.invId = reviews.invId WHERE reviewId = :reviewId';
//   $sql = "SELECT reviewText, reviewDate, invId, clientId FROM reviews  WHERE reviewId = :reviewId ";
$stmt = $db->prepare($sql);
  $stmt->bindParam(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}


// update a review
function updateReview($reviewId, $reviewText){
		$reviewDate = date('Y-m-d H:i:s');
		$db = acmeConnect();
		$sql = 'UPDATE reviews SET reviewText = :reviewText, reviewDate = :reviewDate WHERE reviewId = :reviewId';
		$stmt = $db->prepare($sql);

		$stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
		$stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
		$stmt->bindParam(':reviewId', $reviewId, PDO::PARAM_INT);

		$stmt->execute();
		//$stmt->debugDumpParams();
		//exit;

		$rowsChanged = $stmt->rowCount();

		$stmt->closeCursor();

		return $rowsChanged;

}

//-----------------------------------------

//This function delete a review
	function deleteReview($reviewId){

		$db = acmeConnect();

		$sql = 'DELETE FROM reviews WHERE reviewId = :reviewId'; 


		$stmt = $db->prepare($sql);


		$stmt->bindParam(':reviewId', $reviewId, PDO::PARAM_INT);

		$stmt->execute();

		$rowsChanged = $stmt->rowCount();

		$stmt->closeCursor();

		return $rowsChanged;
	}

 ?>
