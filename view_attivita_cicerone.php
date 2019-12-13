<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();

  //acquisisce l'email del cicerone in sessione
  $emailC=$_SESSION['email'];
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
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 

      <ul class="nav nav-tabs">
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"home_cicerone.php?email='$emailC'\"> 
                   <b> Home Cicerone <img src=\"assets/immagini/cicerone.png\" alt=\"Cicerone\" height=30px width=30px/></b></b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"/view_profile_cicerone.php?email='$emailC'\"> <b> Profilo </b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"/new_attivita.php?email='$emailC'\"> <b> Aggiungi Attività </b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" href=\"/list_attivita_cicerone.php?email='$emailC'\"> <b> Le mie Attività </b></a>";?>
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
      if($_SERVER["REQUEST_METHOD"] == "GET"){
        $idAttivita = $_GET['id'];
        $_SESSION['id']=$idAttivita;

        //Comando SQL
        $strSQL = "SELECT * 
                   FROM Attivita 
                   WHERE Id='$idAttivita'";

        $risultato = mysqli_query($conn,$strSQL);
        $riga = mysqli_fetch_array($risultato);

        $nomeAttivita=$riga["NomeAttivita"];
        $Itinerario=$riga["Itinerario"];
        $localita=$riga["Localita"];
        $indirizzo=$riga["Indirizzo"];
        $data=$riga["Data"];
        $orainizio=$riga["OraInizio"];
        $orafine=$riga["OraFine"];
        $compenso=$riga["Compenso"]; 
        $lingue=$riga["Lingue"];
        $numMax=$riga['NumMaxPrenotati'];

      }
      //Close the connection
      mysqli_close($conn);
    ?>

    <div class="row view-form" style = "background-color:#ffffff;" >
      <div class="col-md-8 offset-md-2 ">
        <form class="custom-form" name="form" method="post" style="background-color:#eef4f7;" ><br>
          <p class="title"><?php echo $idAttivita. " - " .$nomeAttivita;?></p><br>
          <div class="form-row form-group" style="height:85px;">
            <div class="form-group col-md-5" style="margin-right:30px;margin-left:30px;text-align:giustify;">
              <br><?php echo $Itinerario;?>
            </div>
            <div class="form-group col-md-6 " style="text-align:left;">
              <label class="col-form-label" for="name-input-field"><b>Località:</b> </label>
                <?php echo $localita ?> <br>
              <label class="col-form-label" for="name-input-field"><b>Indirizzo:</b> </label>
                <?php echo $indirizzo ?><br>
              <label class="col-form-label" for="name-input-field"><b>Data:</b> </label>
                <?php echo $data ?> <br>
              <label class="col-form-label" for="name-input-field"><b>Ora inizio:</b> </label>
                <?php echo $orainizio ?> <br>
              <label class="col-form-label" for="name-input-field"><b>Ora fine:</b> </label>
                <?php echo $orafine ?><br>
              <label class="col-form-label" for="name-input-field"><b>Lingue:</b> </label>
                <?php echo $lingue ?> <br>
              <label class="col-form-label" for="name-input-field"><b>Compenso: </b></label>
                <?php echo $compenso ?><br>
              <label class="col-form-label" for="name-input-field"><b>Numero massimo di partecipanti:</b> </label>
                <?php echo $numMax ?>
            </div>
          </div>
          <br> <br> <br> <br>

          <div class="form-row form-group" style="height:40px;margin-top:150px;" >
            <div class="form-group col-md-4 offset-md-1" style="text-align:right;">
              <?php echo "<button class=\"btn btn-primary btn-sm\" type=\"button\" 
                                  style=\"font-size:12pt;font-weight:bold;font-family:lucida fax;\"
                                  onclick=\"location.href='list_partecipanti.php?id=".$idAttivita."'\"> 
                                  <b> PARTECIPANTI </b></button>";?>
            </div>
            <div class="form-group col-md-3">
              <?php echo "<button class=\"btn btn-primary btn-sm\" type=\"button\" 
                                  style=\"font-size:12pt;font-weight:bold;font-family:lucida fax;\"
                                  onclick=\"location.href='edit_attivita_cicerone.php?id=".$idAttivita."'\">
                                  <b> MODIFICA </b></button>";?>
            </div>
            <div class="form-group col-md-3" style="text-align:left;">
              <button class="btn btn-primary btn-sm" type="button" name="delete" onclick="confirm_delete()"> <b> ELIMINA </b></button>
            </div>
          </div>

          <div class="back" style="margin-right:20px;text-align:right;">
            <a href="list_attivita_cicerone.php?email" >Indietro</a>
          </div>
        </form>
      </div>
    </div>

   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery.min.js"></script>

   <script type="text/javascript">
     function confirm_delete() {
        var domanda = confirm("Sei sicuro di voler eliminare l'attivita?");
        if(domanda == true) {
          location.href='delete_attivita_cicerone.php';
        }else{
          alert('Operazione annullata');
        }
     }
   </script>

  </body>
 </html>