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
            <h1>Acme Login</h1>


        </div>

        <?php
if (isset($message)) {
 echo $message;
}
?>
        <form action="/acme/accounts/index.php" method="POST">
            <fieldset class="form">
                <label>
                    Email Address <input type="email" name="clientEmail" id="clientEmail" <?php
                        if(isset($clientEmail)){echo "value='$clientEmail'" ;} ?>> <br>
                </label>
                <label>
                    Password<input type="password" name="clientPassword" id="clientPassword"> <br>
                </label>

            </fieldset>

            <div>
                <input type="submit" name="Login" class="registerButton" id="Login" value="Login">
                <input type="hidden" name="action" value="Login">
            </div>
        </form>
        <div>
            <h1>Not a Member?</h1>
        </div>
        <div>
            <form action="/acme/accounts/index.php" method="POST">
                <input type="submit" name="submit" class="registerButton" value="Create an Account">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="registration">
            </form>
        </div>


    </div>
    <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
</footer>
</body>


</html>