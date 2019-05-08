<?php
// Build the categories option list
$catList = '<select name="catType" id="catType">';
$catList .= "<option>Choose a Category</option>";
foreach ($categories as $category) {
 $catList .= "<option value='$category[categoryId]'";
  if(isset($categoryId)){
   if($category['categoryId'] === $categoryId){
   $catList .= ' selected ';
  }
 } elseif(isset($prodInfo['categoryId'])){
  if($category['categoryId'] === $prodInfo['categoryId']){
   $catList .= ' selected ';
  }
}
$catList .= ">$category[categoryName]</option>";
}
$catList .= '</select><br>';
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
    <div>
    <h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h1>
    </div>
    <h2>All fields are required.</h2>
    <?php
    if (isset($message)) {
     echo $message;
}
?>
    <form method="post" action="/acme/products/index.php">
      <fieldset class="tight">
        <label>Type:
          <?php echo $catList;?></label>

        <label>
          Product Name: <input type="text" name="invName" id="invName" required <?php if(isset($invName)){ echo "value='$invName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>><br>
        </label>

        <label>
          Product Description:<br><textarea name="invDescription" id="invDescription" required><?php if(isset($invDescription)){ echo $invDescription; }elseif(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; }?></textarea><br>
        </label>
        <label>
          Product Image: <input type="text" name="invImage" id="invImage" <?php if(isset($invImage)){echo
            "value='$invImage'" ;} ?> pattern="[a-z A-Z 0-9 \. \/ \-]{5,99}" required><br>
        </label>
        <label>
          Product Thumbnail (path): <input type="text" name="invThumbnail" id="invThumbnail" required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; }?>><br>
        </label>
        <label>
          Product Price: <input type="number" name="invPrice" id="invPrice" required <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; }?>><br>
        </label>
        <label>
          In Stock: <input type="number" name="invStock" id="invStock" required <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; }?>><br>
        </label>
        <label>
          Shipping Size (W x H x L inches): <input type="text" name="invSize" id="invSize" required <?php if(isset($invSize)){ echo "value='$invSize'"; } elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; }?>><br>
        </label>
        <label>
          Weight: <input type="number" name="invWeight" id="invWeight" required <?php if(isset($invWeight)){ echo "value='$invWeight'"; } elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; }?>><br>
        </label>
        <label>
          Location: <input type="text" name="invLocation" id="invLocation" required <?php if(isset($invLocation)){ echo "value='$invLocation'"; } elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; }?>><br>
        </label>
        <label>
          Vendor Name: <input type="text" name="invVendor" id="invVendor" required <?php if(isset($invVendor)){ echo "value='$invVendor'"; } elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; }?>><br>
        </label>
        <label>
          Primary Material: <input type="text" name="invStyle" id="invStyle" required <?php if(isset($invStyle)){ echo "value='$invStyle'"; } elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; }?>><br>
        </label>


      </fieldset>

      <div>
        <input type="submit" name="submit" class="registerButton" id="updateProd" value="Update Product">
        <input type="hidden" name="action" value="updateProd">
        <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>"> 
      </div>
    </form>
  </div>
  <footer>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
</footer>
</body>


</html>