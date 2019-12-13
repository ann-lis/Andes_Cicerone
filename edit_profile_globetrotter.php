<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();

  //acquisisce l'email del globetrotter in sessione
  $emailG=$_SESSION['email'];

  $email = $password =$nome=$cognome=$telefono=$conferma_password=$msg=$hashedpass="";
  $email_err = $password_err =$nome_err=$cognome_err=$conferma_password_err=$error=$err="";

  if($_SERVER["REQUEST_METHOD"] == "GET"){
      $email = $_GET['email'];

      //Comando SQL
      $strSQL = "SELECT * 
                FROM globetrotter 
                WHERE Email='$email'";
      $risultato = mysqli_query($conn,$strSQL);

      $riga = mysqli_fetch_assoc($risultato);

        $nome=$riga["Nome"];
        $cognome=$riga["Cognome"];
        $email=$riga["Email"];
        $password=$riga["Password"];
        $telefono=$riga["Telefono"];
}

  if($_SERVER["REQUEST_METHOD"]=="POST"){

    //Check if email globetrotter is empty
		if(empty(trim($_POST["email"]))){
			$email_err = 'Inserire una email.';
		}else{
		  $email = trim($_POST["email"]);
    }
    //Check if nome globetrotter is empty
    if(empty(trim($_POST["nome"]))){
			$nome_err = 'Inserire il nome.';
		}else{
			$nome = trim($_POST["nome"]);
    }
    //Check if cognome globetrotter is empty
    if(empty(trim($_POST["cognome"]))){
			$cognome_err = 'Inserire il cognome.';
		}else{
			$cognome = trim($_POST["cognome"]);
    }
    //Check if telefono globetrotter is empty
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
      if($email==$_SESSION['email']){
        $sql ="UPDATE globetrotter 
               SET Password='$hashedpass', Nome='$nome',Cognome='$cognome',Telefono='$telefono'
               WHERE Email ='$email'";

        $edit=mysqli_query($conn,$sql);
        if(!$edit){
          $error="Errore nella modifica";
          die('Query fallita'.mysqli_error($conn));
        }else{
          $msg="I dati del tuo account sono stati aggiornati correttamente";
        }
      }else{
        $query="SELECT Email 
                FROM globetrotter 
                WHERE Email='$email' ";

        $result=mysqli_query($conn,$query);

        if(mysqli_num_rows($result) == 0) {

          $sql1 ="UPDATE globetrotter 
                  SET Email='$email',Password='$hashedpass',Nome='$nome',Cognome='$cognome',Telefono='$telefono'
                  WHERE Email ='".$_SESSION['email']."'";
          $edit1=mysqli_query($conn,$sql1);

          if(!$edit1){
            $error="Errore nella modifica";
            die('Query fallita'.mysqli_error($conn));
          }else{
            $msg="I dati del tuo account sono stati aggiornati correttamente. <br> 
                  Sarai reindirizzato al login per riaccedere al tuo profilo.";
            header("Refresh:7; URL=login_globetrotter.php");
            echo "<div class=\"table-responsive\" style=\"float:left; margin-left:400px;\"><br><br><br>";
            echo "<table class=\"table table-hover \" 
                         style=\"background-color:#ffffff;font-family:lucida fax;font-weight:bold;font-size:15pt;color=#00008B;\">";
            echo "<tr>";
            echo "<td>".$msg."</td>";
            echo "</tr>";
            echo "</div>";
            exit();
          }
        }else{
          $err= "Email già registrata";
        } 
			}
    }
  }
?>

<!DOCTYPE html>
 <html lang="en">
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>globetrotter</title>
    <link rel="icon" href="assets/immagini/logoglobetrotterIco.ico" />
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
     <b>CICERONE</b> <img class="retina" src="assets/immagini/logocicerone.jpg" alt="cicerone"/> </a></h2>
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 
     &nbsp;&nbsp; &nbsp;&nbsp; 
  

     <ul class="nav nav-tabs">
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"home_globetrotter.php?email='$emailG'\"> 
                   <b> Home Globetrotter <img src=\"assets/immagini/globetrotter.jpg\" alt=\"globetrotter\" height=30px width=30px/></b></b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" href=\"/view_profile_globetrotter.php?email='$emailG'\"> <b> Profilo </b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"/new_attivita.php?email='$emailG'\"> <b> Aggiungi Attività </b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"/list_attivita_globetrotter.php?email='$emailG'\"> <b> Le mie Attività </b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo" <a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"/list_richieste_globetrotter.php?email='$emailG'\"> <b> Richieste ricevute </b> </a>";?>
      </li>
      <li class="nav-item">
       <a class="nav-link active" href="/logout.php?logout">Logout</a>
      </li>
     </ul>
    </nav>
   </header>

   <br> <br>
    <div class="row register-form" style = "background-color:#ffffff;">
     <div class="col-md-6 offset-md-3">
      <form class="custom-form" method="post" style="background-color:#eef4f7;" action="<?php echo $_SERVER['PHP_SELF'];?>">
       <span class="help-block" ><?php echo $error; ?><br><br></span>
       <span class="help-block" ><?php echo $msg; ?><br><br></span>
       <p class="title">Modifica il tuo account</p><br><br>

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
         <span class="help-block" ><?php echo $err; ?><br><br></span>
        </div>
       </div>

       <div class="form-row form-group " style="height:85px;" >
        <div class="form-group col-md-6">
         <label class="col-form-label" for="name-input-field">Telefono</label>
         <input class="form-control" type="text" name="telefono" value="<?php echo $telefono; ?>">
        </div>
        <div class="form-group col-md-6">
         <label class="col-form-label" for="name-input-field">Tipo Utente</label>
         <input class="form-control" type="text" name="tipoUtente" value="Globetrotter" disabled >
        </div>
       </div>

       <div class="form-row form-group" style="height:85px;"  >
        <div class="form-group col-md-6 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>" >
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

       <div class="form-row form-group" style="height:50px;">
        <div class="form-group col-md-12" style="margin-top:10px;text-align:center;">
         <button class="btn btn-primary btn-sm" type="submit" >Aggiorna</button>
        </div>
       </div>

       <div class="back" style="margin-top:20px;">
        <?php echo "<a href=\"view_profile_globetrotter.php?email='.$email.'\" >Indietro</a>";?>
       </div>
      </form>
     </div>
    </div>

   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  </body>
 </html>