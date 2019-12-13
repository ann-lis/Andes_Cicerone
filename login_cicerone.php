<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();

  $email = $password = $hashedpass="";
  $email_err = $password_err = $error = "";

  if(isset($_POST['Login'])){

		//Check if email is empty
		if(empty(trim($_POST["email"]))){
			 $email_err = 'Inserire una email.';
		}else{
			 $email = strtolower(trim($_POST["email"]));
		}
		//Check if password is empty
		if(empty(trim($_POST['password']))){
			 $password_err = 'Inserire la password.';
		}else{
       //Si applica un meccanismo di crittografia alla password
       $password = trim($_POST['password']);
       $hashedpass=md5($password);
    }

		//Validate credentials
		if(empty($email_err) && empty($password_err)){
      //Prepare a select statement
			$sql = "SELECT Email, Password
              FROM Cicerone 
              WHERE Email = '$email' AND binary password='$hashedpass'";

      $result=mysqli_query($conn,$sql);

			if(mysqli_fetch_assoc($result)){
				$_SESSION['email'] = $_POST['email'];
				header("location:home_cicerone.php");
			}else{
				$error = "Email o password errate";
			}
		}
  }
//Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
 <html lang="en">
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CICERONE</title>
    <link rel="icon" href="assets/immagini/logoCiceroneIco.ico" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="assets/css/stile.css?ts=<?=time()?>&quot">
  </head>

  <body>
   <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-trasparent" >
     <h2> <a href="index.html" class="logo-brand" style="margin-top:15px;margin-bottom:15px">
     <b>CICERONE</b> <img class="retina" src="assets/immagini/logoCicerone.jpg" alt="Cicerone"/> </a></h2>
     &nbsp;&nbsp;

     <ul class="nav nav-tabs">
      <li class="nav-item">
       <a class="nav-link active" href="index.html"><b>Home</b></a>
      </li>
      <li class="w3-dropdown-hover">
       <a class="nav-link dropdown" style="color:#a9a9a9;">Accedi</a>
        <div class="w3-dropdown-content">
         <a class="dropdown-item" href="login_cicerone.php">come Cicerone</a>
          <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="login_globetrotter.php">come Globetrotter</a>
        </div>
      </li>
     </ul>
    </nav>
   </header>

   <div class="login-clean"  style = "background-color:#ffffff;">
    <form method="post" style="background-color:#eef4f7;" action="<?php echo $_SERVER['PHP_SELF'];?>">
     <h2 class="sr-only">Login Form</h2>
		 <span class="help-block" style="color:#8B0000;font-size:14pt;"><?php echo $error; ?></span>
     <div class="illustration" style="text-align:center;">
      <i class="icon ion-person" style="color:#5547f4;"></i>
     </div>

     <div class="title">Cicerone</div>
     <br>
     <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
      <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
      <span class="help-block" ><?php echo $email_err; ?></span>
     </div>

     <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
      <input class="form-control" type="password" name="password" placeholder="Password">
      <span class="help-block" ><?php echo $password_err; ?></span>
     </div>

     <div class="form-group">
     <button class="btn btn-primary btn-block" type="submit" name="Login">Accedi</button>
     </div>
     <p>Non sei ancora iscritto? <a href="signup_cicerone.php">Registrati qui</a>.</p>
    </form>
   </div>

   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery.min.js"></script>

  </body>
 </html>