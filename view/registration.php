<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Home -- ACME Foods">
  <meta name="Chris Smith" content="CIT 336">
  <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <title>ACME</title>

</head>
<body>
<header>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
</header>


  <div class="all">
    <div>
      <h1>Acme Registration</h1>


    </div>
    <?php
if (isset($message)) {
 echo $message;
}
?>
    <form action="/acme/accounts/index.php" method="POST">
      <fieldset class="form">
        <legend>Personal Information</legend>
        <label>
          First Name: <input type="text" name="clientFirstname" id="clientFirstname" <?php
            if(isset($clientFirstname)){echo "value='$clientFirstname'" ;} ?>> <br>
        </label>
        <label>
          Last Name: <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo
            "value='$clientLastname'" ;} ?>> <br>
        </label>
        <label>
          eMail: <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo
            "value='$clientEmail'" ;} ?>><br>
        </label>
        <label for="clientPassword">Password:
          <input type="password" name="clientPassword" id="clientPassword"></label><br>
      </fieldset>

      <div>
        <input type="submit" name="submit" class="registerButton" value="Register">

        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="register">

      </div>
    </form>
  </div>
  <footer>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
</footer>
</body>


</html>