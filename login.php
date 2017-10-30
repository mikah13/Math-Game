<?php
session_start();
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple Math Game">
    <meta name="author" content="Jeff Wasty, Mike Hoang">
    <link rel="icon" href="images/icon.png">

    <title>Math Game</title>

    <!-- Bootstrap core CSS -->
    <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v4-alpha.getbootstrap.com/examples/signin/signin.css" rel="stylesheet">

    <!-- Custom stylesheet-->
    <link href="css/main.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
</head>

<body>
<h1 id="title">The Math Game</h1>
';
echo '<div class="container">
    <form class="form-signin" action="authenticate.php" method="post" autocomplete="off">
    <h3 class="form-signin-heading">Please Login</h3>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input  id="inputEmail" class="form-control" placeholder="Email address"  name="email">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password"  name="password">
    <div class="checkbox">
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="error-message">';
echo $_GET["msg"];
echo '</p>
      </form>
      </div>';
echo '
    </body>
</html>
';
?>
