<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Home -- ACME Foods">
  <meta name="Chris Smith" content="CIT 336">
  <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/acme/css/style.css">
  <title>ACME</title>

</head>
<body>
<header>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
</header>


  <div class="all">
    <div>
      <h1>Add Category</h1>


    </div>
    <h2>Add a new category of products below</h2>

    <?php
    if (isset($message)) {
     echo $message;
}
?>
    <form method="post" action="/acme/products/index.php">
      <fieldset class="tight">
        <legend>New Category Name</legend>
        <label>
          <input type="text" name="categoryName" id="categoryName" required pattern="[a-zA-Z0-9]{3,99}" autofocus><br>
        </label>

      </fieldset>

      <div>
        <input type="submit" name="submit" class="registerButton" id="addcatbtn" value="Add Category">
        <input type="hidden" name="action" value="addcat">
      </div>
    </form>
  </div>
  <footer>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
</footer>
</body>


</html>