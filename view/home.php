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
      <h1>Welcome to Acme</h1>
    </div>
    <div class="featured">
      <div>
        <ul>
          <li>
            <h2>Acme Rocket</h2>
          </li>
          <li>Quick lighting fuse</li>
          <li>NHTSA approved seat belts</li>
          <li>Mobile launch stand included</li>
          <li><a href="/acme/cart/"><img id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif"></a></li>
        </ul>
      </div>
    </div>

    <div class="secondary">
      <div class="sec-one">
        <h1>Featured Recipies</h1>
        <ul>
          <li><a><img id="recipiebtn01" alt="pulled pork" src="/acme/images/recipes/bbqsand.jpg">Pulled
              Roadrunner BBQ</a></li>
          <li><a><img id="recipiebtn02" alt="road runner pot pie" src="/acme/images/recipes/potpie.jpg">Roadrunner
              Pot Pie</a></li>
          <li><a><img id="recipiebtn03" alt="road runner soup" src="/acme/images/recipes/soup.jpg">Roadrunner
              Soup</a></li>
          <li><a><img id="recipiebtn04" alt="road runner tacos" src="/acme/images/recipes/taco.jpg">Roadrunner
              Tacos</a></li>
        </ul>
      </div>
      <div class="sec-two">
        <h1>Acme Rocket Reviews</h1>
        <ul>
          <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
          <li>"That thing was fast!" (4/5)</li>
          <li>"Talk about fast delivery." (5/5)</li>
          <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
          <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
        </ul>
      </div>
    </div>

  </div>

<footer>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
</footer>
</body>


</html>