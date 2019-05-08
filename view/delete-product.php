<?php
if($_SESSION['clientData']['clientLevel'] < 2){
 header('location: /acme/');
 exit;
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
  <link rel="stylesheet" type="text/css" href="/acme/css/style.css">
  <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?> | Acme, Inc.</title> 

</head>
<body>
<header>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
</header>


  <div class="all">
    <div>
    <h1><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?></h1>
    </div>
    <h2>Confirm Product Deletion. The delete is permanent.</h2>
    <?php
    if (isset($message)) {
     echo $message;
}
?>
    <form method="post" action="/acme/products/index.php">
      <fieldset class="tight">

        <label>
          Product Name: <input type="text" name="invName" id="invName" readonly required <?php if(isset($invName)){ echo "value='$invName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>><br>
        </label>

        <label>
          Product Description:<br><textarea name="invDescription" id="invDescription" readonly required><?php if(isset($invDescription)){ echo $invDescription; }elseif(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; }?></textarea><br>
        </label>
        
      </fieldset>

      <div>
        <input type="submit" name="submit" class="registerButton" id="updateProd" value="Delete Product">
        <input type="hidden" name="action" value="deleteProd">
        <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>"> 
      </div>
    </form>
  </div>
  <footer>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
</footer>
</body>


</html>