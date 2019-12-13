<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();

  //acquisisce l'email del globetrotter in sessione
  $emailG = $_SESSION['email'];

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
    &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;  

    <ul class="nav nav-tabs">
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"home_globetrotter.php?email='.$emailG.'\">
                    <b>Home Globetrotter</b> <img src=\"assets/immagini/globetrotter.jpg\" alt=\"Globetrotter\" height=30px width=40px/> </b> </h5> </a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"view_profile_globetrotter.php?email='.$emailG.'\"> <b> Profilo </b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" href=\"search_attivita_globetrotter.php?email='.$emailG.'\"> <b> Ricerca Attività </b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"list_prenotazioni_globetrotter.php?email='.$emailG.'\"> <b> Le mie Prenotazioni </b></a>";?>
      </li>
      <li class="nav-item">
       <a class="nav-link active" href="/logout.php?logout" >Logout</a>
      </li>
     </ul>
    </nav>
   </header>

   <br> 
   <div style="text-align:center;">
    <?php
     $idAttivita = $_GET['id'];
     //Comando SQL
     $strSQL = "SELECT * 
                FROM Attivita 
                WHERE Id='$idAttivita'";

     $risultato = mysqli_query($conn,$strSQL);
     $riga = mysqli_fetch_assoc($risultato);

      $nomeAttivita=$riga["NomeAttivita"];
      $Itinerario=$riga["Itinerario"];
      $localita=$riga["Localita"];
      $indirizzo=$riga["Indirizzo"];
      $data=$riga["Data"];
      $orainizio=$riga["OraInizio"];
      $orafine=$riga["OraFine"];
      $compenso=$riga["Compenso"]; 
      $lingue=$riga["Lingue"];

      //Close the connection
      mysqli_close($conn);
    ?>

    <div class="row view-form" style = "background-color:#ffffff;" >
     <div class="col-md-8 offset-md-2">
      <form class="custom-form" name="form" method="post" style="background-color:#eef4f7;" ><br>
       <p style="color:#000000;font-size:18pt;font-family:lucida fax;font-weight:bold;text-align:center;"><?php echo $nomeAttivita;?></p>
       <div class="form-row form-group" style="height:85px;" >
        <div class="form-group col-md-5" style="margin-right:30px;margin-left:30px;text-align:giustify;"><?php echo $Itinerario; ?>"<br></div>
        <div class="form-group col-md-6" style="text-align:left;">
          <label class="col-form-label" for="name-input-field"><b>Località:</b> </label>
            <?php echo $localita ?> <br>
          <label class="col-form-label" for="name-input-field"><b>Indirizzo:</b> </label>
            <?php echo $indirizzo ?><br>
          <label class="col-form-label" for="name-input-field"><b>Data:</b> </label>
            <?php echo $data; ?><br>
          <label class="col-form-label" for="name-input-field"><b>Ora inizio:</b> </label>
            <?php echo $orainizio ?> <br>
          <label class="col-form-label" for="name-input-field"><b>Ora fine:</b> </label>
            <?php echo $orafine ?><br>
          <label class="col-form-label" for="name-input-field"><b>Lingue:</b> </label>
            <?php echo $lingue ?> <br>
          <label class="col-form-label" for="name-input-field"><b>Compenso:</b> </label>
            <?php echo $compenso ?>
        </div>
       </div>
       <br> <br> <br> <br>
       <div class="form-row form-group " style="height:40px;margin-top:150px;" >
        <div class="form-group col-md-12" style="text-align:center;">
          <?php echo "<button class=\"btn btn-primary btn-sm\" type=\"button\" 
                              style=\"font-size:12pt;font-weight:bold;font-family:lucida fax;\"
                              onclick=\"location.href='prenotazione.php?id=".$idAttivita."'\">
                              <b> PRENOTA </b></button>";?>
        </div>
       </div>

       <div class="back" style="text-align:right;margin-right:20px;" >
        <a  href="search_attivita_globetrotter.php?email">Indietro</a>
       </div>
      </form>
     </div>
    </div>

   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery.min.js"></script>

  </body>
 </html>