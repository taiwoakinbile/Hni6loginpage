<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Welcome</title>

  <link href="css/creative.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Masthead -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end">
          <h1 class="text-uppercase text-white font-weight-bold">Congratulations! You have successfully logged in.  <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
          <!-- <hr class="divider my-4"> -->
        </div>
        <div class="col-lg-8 align-self-baseline">
          <p class="text-white-75 font-weight-light mb-5"></p>
          <a class="btn btn-secondary btn-xl js-scroll-trigger" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </header>


</body>

</html>
