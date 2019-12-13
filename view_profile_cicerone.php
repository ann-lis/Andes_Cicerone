<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();

  //acquisisce l'email del cicerone in sessione
  $emailC = $_SESSION['email'];

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
    <link rel="stylesheet" href="assets/css/stile.css">
  </head>

  <body>
   <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-trasparent" >
     <h2> <a href="index.html" class="logo-brand" style="margin-top:15px;margin-bottom:15px">
     <b>CICERONE</b> <img class="retina" src="assets/immagini/logoCicerone.jpg" alt="Cicerone"/> </a></h2>
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;

      <ul class="nav nav-tabs">
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"home_cicerone.php?email='$emailC'\"> 
                   <b> Home Cicerone <img src=\"assets/immagini/cicerone.png\" alt=\"Cicerone\" height=30px width=30px/></b></b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" href=\"/view_profile_cicerone.php?email='$emailC'\"> <b> Profilo </b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"/new_attivita.php?email='$emailC'\"> <b> Aggiungi Attività </b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"/list_attivita_cicerone.php?email='$emailC'\"> <b> Le mie Attività </b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo" <a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"/list_richieste_cicerone.php?email='$emailC'\"> <b> Richieste ricevute </b> </a>";?>
      </li>
      <li class="nav-item">
       <a class="nav-link active" href="/logout.php?logout">Logout</a>
      </li>
     </ul>
    </nav>
   </header>
   <br>

   <div style="text-align:center;">
    <?php
      //Comando SQL
      $strSQL = "SELECT * 
                 FROM Cicerone 
                 WHERE Email='$emailC'";

      $risultato = mysqli_query($conn,$strSQL);
      $riga = mysqli_fetch_assoc($risultato);

       $nome=$riga["Nome"];
       $cognome=$riga["Cognome"];
       $telefono=$riga["Telefono"];
       $email=$riga["Email"];
       $password=$riga["Password"];

      //Close the connection
      mysqli_close($conn);
    ?>

    <div class="row register-form" style = "background-color:#ffffff;">
      <div class="col-md-6 offset-md-3 " >
        <form class="custom-form" name="form" method="post" style="background-color:#eef4f7;font-family:colibri;font-size:14pt;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
          <div class="illustration" style="text-align:center;">
           <i class="icon ion-person" style="color:#5547f4;font-size:100px;"></i>
          </div>
          <br>
          <div class="form-row form-group" style="height:40px;text-align:left;">
            <div class="form-group col-md-12 " style="margin-left:100px;">
              <label class="col-form-label" for="name-input-field"><b>Cognome:</b>&nbsp;&nbsp;&nbsp;<?php echo $cognome;?></label>
            </div>
          </div>

          <div class="form-row form-group" style="height:40px;text-align:left;">
            <div class="form-group col-md-12"style="margin-left:100px;">
              <label class="col-form-label" for="name-input-field"><b>Nome:</b>&nbsp;&nbsp;&nbsp;<?php echo $nome;?></label>
            </div>
          </div>

          <div class="form-row form-group " style="height:40px;text-align:left;">
            <div class="form-group col-md-12 "style="margin-left:100px;">
              <label class="col-form-label" for="name-input-field"><b>Telefono:</b>&nbsp;&nbsp;&nbsp;<?php echo $telefono;?></label>
            </div>
          </div>

          <div class="form-row form-group " style="height:40px;text-align:left;">
            <div class="form-group col-md-12 "style="margin-left:100px;">
              <label class="col-form-label" for="name-input-field"><b>Email:</b>&nbsp;&nbsp;&nbsp;<?php echo $email;?></label>
            </div>
          </div>

          <div class="form-row form-group " style="height:40px;text-align:left;">
            <div class="form-group col-md-12 "style="margin-left:100px;">
              <label class="col-form-label" for="name-input-field"><b>Password:</b>&nbsp;&nbsp;&nbsp;
                <input class="col-form-input" type="password" name="password" readonly="readonly"
                       style="background-color:#eef4f7;border-style:none" value="<?php echo substr($password,0,8); ?>">
              </label>
            </div>
          </div>

          <br> 
          <div class="form-row form-group" style="height:40px;">
            <div class="form-group col-md-6 offset-md-1">
              <?php echo "<button class=\"btn btn-primary btn-sm\" type=\"button\" 
                                  style=\"font-size:13pt;font-weight:bold;font-family:lucida fax;\"
                                  onclick=\"location.href='edit_profile_cicerone.php?email=".$emailC."'\">
                                  <b> AGGIORNA </b></button>";?>
            </div>

            <div class="form-group col-md-5" style="text-align:left;">
              <button class="btn btn-primary btn-sm" type="button" 
                      style="font-size:13pt;font-weight:bold;font-family:lucida fax;"
                      onclick="confirm_delete()"> <b> ELIMINA </b> </button>
            </div>
          </div>
        </form>
      </div>
    </div>

   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery.min.js"></script>

   <script type="text/javascript">
     function confirm_delete() {
       if(confirm("Sei sicuro di voler cancellare il tuo account?") == true) {
         location.href='delete_profile_cicerone.php';
       }else{
         alert('Operazione annullata');
       }
     }
   </script>
  </body>
 </html>