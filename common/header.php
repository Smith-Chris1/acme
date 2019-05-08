<div class="header">
    <div class="logo">
        <a href="/acme"><img class="logo" src="/acme/images/site/logo.gif" alt="Logo ACME Foods"></a>
    </div>
    <div class="account">
        <!-- <?php if(isset($cookieFirstname)){
            echo "<span>Welcome $cookieFirstname</span>";
            };?> -->
            <?php if(isset($_SESSION['loggedin'])){
                echo '<a href="/acme/accounts/index.php">Welcome '.$_SESSION['clientData']['clientFirstname'].' </a>';
            } ?>
        <img class="img-acc" src="/acme/images/site/account.gif" alt="Logo ACME Foods">


        <?php
            if(isset($_SESSION['loggedin'])){
                echo '<a href="/acme/accounts/index.php?action=logout">Logout</a>';
            } else {
                echo '<a href="/acme/accounts/index.php?action=Login">My Account</a>';    
            }
        ?>

    </div>
</div>
<nav class="navigation">
    <?php echo $navList; ?>
</nav>