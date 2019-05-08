<?php
 if (!$_SESSION['loggedin']) {
 header("Location: http://localhost/acme/");
 exit;
} 
//   var_dump($reviewInfo);
//     exit;
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
  <title><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo "Modify $invName "; }?> | Acme, Inc</title>

</head>
<body>
<header>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
</header>

	<div class="all">

<div class="ablock">

<?php
    if (isset($message)) {
     echo $message;
}
// $invNameReview=$reviewInfo[invName];
// print_r($reviewInfo);
echo "<h1>$reviewInfo[invName] Review</h1>";
$d=date_format(date_create($reviewInfo['reviewDate']), 'jS F \, Y');
echo "<p>Reviewed on $d</p>";
?>  
  <form  method="post" action="/acme/reviews/">
    <fieldset class="tight">
      <legend>Review Text</legend>
      <label>
       <br><textarea name="reviewText"  rows="4" cols="30" required><?php if(isset($reviewInfo['reviewText'])) {echo "$reviewInfo[reviewText]"; } ?></textarea><br>
      </label>

    </fieldset>  

    <div>
        <input class="registerButton" type="submit" name="submit" id="updatereview" value="Update">
        <input type="hidden" name="reviewId" value="<?php if(isset($reviewId)){ echo $reviewId; } ?> ">
        <input type="hidden" name="invName" value="<?php if(isset($invNameReview)){ echo $invNameReview; } ?> ">
        <input type="hidden" name="action" value="update">        
    </div>
  </form>
</div>
	</div>
  <footer>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
</footer>
</body>


</html>