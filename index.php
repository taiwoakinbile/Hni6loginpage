<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";

    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";





        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) ){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

        }

        // Close statement
        mysqli_stmt_close($stmt);
      }



    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<script src="main.js"></script>
	<title>Login Page</title>
</head>
<body>
	<div class="container">

			<div class="row no-gutters text-center py-5">
				<div class="col-lg-6 col-md-6 col-sm-12 mx-auto py-sm-3 ">
					<div class="side-box py-5  m-0 mx-sm-0">
						<h1 class="text-center pb-5 p-sm-0 header">Welcome to DevPro</h1>
						<p class="px-3">



								<div class="container">
										<div class="row">
											 <div  class="col-md-8 mx-auto">
												 <div id="">

												 <div class="signup form ">
														  <div class="logo mb-3">
															 <div class="col-md-12">
																<h2 class="header">Signup</h2>
															 </div>
														  </div>
                              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                              <input type="text" name="username" placeholder="Username or email" id="newUsername" class="form-control" value="<?php echo $username; ?>">
                              <span class="help-block"><?php echo $username_err; ?></span>
                              </div>

                              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

                              <input type="password" name="password"  placeholder="Password" class="form-control" id="newUsername" value="<?php echo $password; ?>">
                              <span class="help-block"><?php echo $password_err; ?></span>
                              </div>
                              <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">

                              <input type="password" name="confirm_password" placeholder="Confirm Password" id="newUsername" class="form-control" value="<?php echo $confirm_password; ?>">
                              <span class="help-block"><?php echo $confirm_password_err; ?></span>
                              </div>
                               <div class="col-md-12 text-center mb-3">
                              <button type="submit" class=" btn btn-block mybtn"value="Submit">Sign Up</button>
                               </div>
                               <div class="col-md-12 ">
                                <div class="form-group">
                                   <p class="text-center">Already a member?<a href="login.php" id="" class="login-link">Login</a></p>
                                </div>
                                <div id="msg" style="color:green"></div>

                               </div>
                              </form>
												 </div>

												 </div>

											 </div>
										</div>

									 </div>










						</p>
					</div>
				</div>




	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
