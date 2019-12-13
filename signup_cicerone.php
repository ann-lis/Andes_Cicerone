<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();

  $email = $password =$nome=$cognome=$telefono=$conferma_password=$hashedpass="";
  $email_err = $password_err =$nome_err=$cognome_err=$conferma_password_err=$error="";

  if($_SERVER["REQUEST_METHOD"]=="POST"){

    //Check if email cicerone is empty
		if(empty(trim($_POST["email"]))){
			$email_err = 'Inserire una email.';
		}else{
		  $email = trim($_POST["email"]);
    }
    //Check if nome cicerone is empty
    if(empty(trim($_POST["nome"]))){
			$nome_err = 'Inserire il nome.';
		}else{
			$nome = trim($_POST["nome"]);
    }
    //Check if cognome cicerone is empty
    if(empty(trim($_POST["cognome"]))){
			$cognome_err = 'Inserire il cognome.';
		}else{
			$cognome = trim($_POST["cognome"]);
    }
    //Check if telefono cicerone is empty
    if(empty(trim($_POST["telefono"]))){
			$telefono = "";
		}else{
			$telefono = trim($_POST["telefono"]);
    }
    //Check if conferma password is empty
    if(empty(trim($_POST['conferma_password']))){
			$conferma_password_err = 'Inserire nuovamente la password.';
		}else{
			$conferma_password = trim($_POST['conferma_password']);
		}
		//Check if password is empty
		if(empty(trim($_POST['password']))){
			$password_err = 'Inserire la password.';
		}elseif(strlen(trim($_POST['password']))<8) {
			$password_err = "La password deve contenere almeno 8 caratteri";
      }else{
        $password=trim($_POST['password']);
        $hashedpass=md5($password);
      }
    //Check if password is equals conferma password
    if(strcmp($password,$conferma_password)!=0){
      $conferma_password_err="Le password non coincidono";
    }

		//Validate credentials
		if(empty($email_err) && empty($password_err) && empty($nome_err) && empty($cognome_err) && empty($conferma_password_err)){

      $query="SELECT Email 
              FROM Cicerone 
              WHERE Email='$email' ";

      $result=mysqli_query($conn,$query);

      if(mysqli_num_rows($result) == 0) {
        $sql ="INSERT INTO Cicerone (Email, Password, Nome, Cognome, Telefono)
               VALUES ('$email','$hashedpass','$nome','$cognome','$telefono')";

        $insert=mysqli_query($conn,$sql);

        if(!$insert){
          $error="Errore nella registrazione";
          die('Query fallita'.mysqli_error($conn));
        }else{
          header("location:login_cicerone.php");
        }
      }else{
			  $error="Email già registrata";
      }
    }
	}
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

   <div class="row register-form" style = "background-color:#ffffff;">
    <div class="col-md-6 offset-md-3 " >
     <form class="custom-form" method="post" style="background-color:#eef4f7;" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <span class="help-block" ><?php echo $error; ?><br><br></span>
      <p class="title">Crea il tuo account</p><br>
      <i class="icon ion-android-person-add" style="color:#5547f4;font-size:100px;"></i><br>
      <p class="title">Cicerone</p><br><br><br>

       <div class="form-row form-group " style="height:85px;" >
        <div class="form-group col-md-6 <?php echo (!empty($nome_err)) ? 'has-error' : '';?>">
         <label class="col-form-label" for="name-input-field">Nome</label>
         <input class="form-control" type="text" name="nome" value="<?php echo $nome;?>">
         <span class="help-block" ><?php echo $nome_err; ?></span>
        </div>
        <div class="form-group col-md-6 <?php echo (!empty($cognome_err)) ? 'has-error' : '';?>" >
         <label class="col-form-label" for="name-input-field">Cognome</label>
          <input class="form-control" type="text" name="cognome" value="<?php echo $cognome;?>">
          <span class="help-block" ><?php echo $cognome_err;?></span>
        </div>
       </div>

       <div class="form-row form-group <?php echo (!empty($email_err)) ? 'has-error' : '';?>" style="height:85px;">
        <div class="form-group col-md-12">
         <label class="col-form-label" for="name-input-field">Email</label>
         <input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
         <span class="help-block" ><?php echo $email_err; ?></span>
        </div>
       </div>

       <div class="form-row form-group " style="height:85px;" >
        <div class="form-group col-md-6">
         <label class="col-form-label" for="name-input-field">Telefono</label>
         <input class="form-control" type="text" name="telefono" value="<?php echo $telefono; ?>">
        </div>
        <div class="form-group col-md-6">
         <label class="col-form-label" for="name-input-field">Tipo Utente</label>
         <input class="form-control" type="text" name="tipoUtente" value="Cicerone" disabled >
        </div>
       </div>

       <div class="form-row form-group" style="height:85px;"  >
        <div class="form-group col-md-6 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
         <label class="col-form-label" for="pawssword-input-field">Password</label>
         <input class="form-control" type="password" name="password" value="">
         <span class="help-block" ><?php echo $password_err; ?></span>
        </div>
        <div class="form-group col-md-6 <?php echo (!empty($conferma_password_err)) ? 'has-error' : '';?>">
         <label class="col-form-label" for="repeat-pawssword-input-field">Conferma Password</label>
         <input class="form-control" type="password" name="conferma_password" value="">
         <span class="help-block" ><?php echo $conferma_password_err; ?></span>
        </div>
       </div>

       <input class="btn btn-light submit-button" type="submit" style="background-color:#5547f4;" 
                           value="Registrati">
       <p> Hai già un account? <a href="login_cicerone.php"><b>Fai il login qui</b></a>.</p>

      </form>
    </div>
   </div>

   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery.min.js"></script>

  </body>
 </html>