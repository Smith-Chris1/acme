<?php 
if (empty ($_SESSION['clientData']['clientLevel'])){
header("Location: http://localhost/ACME");
} else { $infoClient=($_SESSION['clientData']);}
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
    <title>ACME</title>

</head>
<body>
<header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
</header>

        <div class="all">
                <h1>Update Account</h1>
                <section>
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>
                    <form method="post" action="/acme/accounts/index.php">
                        <fieldset>
                            <legend>Use this form to update your account information.</legend>
                            <label >First Name</label>
                            <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo
                                "value='$clientFirstname'" ;} elseif(isset($infoClient['clientFirstname'])) {echo
                                "value='$infoClient[clientFirstname]'" ; }?> required><br>
                            <label >Last Name</label>
                            <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo
                                "value='$clientLastname'" ;} elseif(isset($infoClient['clientLastname'])) {echo
                                "value='$infoClient[clientLastname]'" ; }?> required><br>
                            <label >Email</label>
                            <input type="email" name="clientEmail" id="clientEmail" placeholder="Email" <?php
                                if(isset($clientEmail)){echo "value='$clientEmail'" ;} elseif(isset($infoClient['clientEmail']))
                                {echo "value='$infoClient[clientEmail]'" ; }?> required><br>
                            <button type="submit" name="accupdate" id="accUpdate" class="registerButton">Update Account</button>
                            <input type="hidden" name="action" value="accUpdate">
                            <input type="hidden" name="clientId" value="<?php 
                                if(isset($infoClient['clientId'])){ echo $infoClient['clientId'];} 
                                    elseif(isset($clientId)){ echo $clientId; } ?>">
                        </fieldset>
                    </form>
                    <h2>Update Password</h2>
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>
                    <form method="post" action="/acme/accounts/index.php">
                        <fieldset>
                            <legend>Use this form to update your password.</legend>
                            <label for="password">Password</label>
                            <span class="reduced">Passwords must be at least 8 characters and contain at least 1
                                number,
                                1 capital letter and 1 special character</span>
                            <input type="password" name="password" id="password" placeholder="Password" required
                                pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                            <button type="submit" name="passupdate" id="passupdate" class="registerButton">Update Password</button>
                            <input type="hidden" name="action" value="passUpdate">
                            <input type="hidden" name="clientId" value="<?php 
                                if(isset($infoClient['clientId'])){ echo $infoClient['clientId'];} 
                                    elseif(isset($clientId)){ echo $clientId; } ?>">
                        </fieldset>
                    </form>
                </section>
        </div>
        <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
    </footer>
    </body>


</html>