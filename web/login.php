<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, permissions FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $permissions);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["permissions"] = $permissions;                       
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Le mot de passe est incorrect.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "Pas de compte existant avec ce nom.";
                }
            } else{
                echo "Le site est indisponible, veuillez réessayer plus tard.";
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
    <title>Login</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/all.css">
    <style type="text/css">
        body{ font: 14px sans-serif; background-image : url("assets/img/bg.jpg") }
        .wrapper{ width: 350px; padding: 20px; }
        .card-horizontal {
    display: flex;
    flex: 1 1 auto;
}
    </style>
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
        <img class="card-img-top" src="assets/img/logo.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title text-center">Connexion</h5>
            <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="form-label-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"">
              <label for="username">Nom de compte :</label>
                <input type="text" id="username" style="margin-bottom : 10px" class="form-control" name="username" placeholder="Nom" value="<?php echo $username; ?>" required autofocus>
                <span class="help-block" ><?php echo $username_err; ?></span>
              </div>

              <div class="form-label-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>"">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" style="margin-bottom : 20px" class="form-control" name="password" placeholder="Mot de passe" required>
                <span class="help-block"><?php echo $password_err; ?></span>
              </div>
              
              <button class="btn btn-lg btn-primary btn-block text-uppercase" style="margin-bottom : 25px" type="submit" value="Login">Connexion</button>
              <p>Vous n'avez pas de compte ? <a href="register.php">Inscription</a>.</p>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
   
</body>
</html>