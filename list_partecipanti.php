﻿<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();

  //acquisisce l'email del cicerone e l'id dell'attività selezionata
  $emailC = $_SESSION['email'];
  $idAttivita = $_GET['id'];
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
      &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 

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

   <br><br>
   <div class="features-boxed">
    <div class="container">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="intro">
          <h2 class="text-center">Partecipanti all'attività <?php echo $idAttivita;?></h2>
        </div>

        <div class="container">
          <?php
            //Comando SQL
            $strSQL = "SELECT *
                       FROM Globetrotter INNER JOIN Prenotazione 
                       ON Globetrotter.Email = Prenotazione.GlobetrotterEmail
                       WHERE AttivitaID = $idAttivita";

            $risultato = mysqli_query($conn,$strSQL);
            $valori = mysqli_num_rows($risultato);

            //se la query produce righe, costruisco la tabella
            if($valori>0){
              //stampa la tabella
              echo "<div class=\"table-responsive\" style = \"text-align:center;\">";
                echo "<table class=\"table table-hover \">";
                  echo "<thead>";
                    echo "<tr>";
                      echo "<th>Nome</th>";
                      echo "<th>Cognome</th>";
                      echo "<th>Email</th>";
                      echo "<th >Telefono</th>";
                    echo "</tr>";
                  echo "</thead>";

                  echo "<tbody style = \"text-align:center;\">";
                  while($riga = mysqli_fetch_assoc($risultato)){
                      //stampa delle righe della tabella con i risultati della query
                      echo "<tr>";
                        echo "<td>".$riga['Nome']."</td>";
                        echo "<td>".$riga['Cognome']."</td>";
                        echo "<td>".$riga['Email']."</td>";
                        echo "<td>".$riga['Telefono']."</td>";
                      echo "</tr>";
                  }
                  echo "</tbody>";
                echo "</table>";
              echo "</div>";
            }else{
              echo "<div style = \"text-align:center;margin-top:100px;font-weight:bold;font-family:Lucida Fax;font-size:15px;color:#00008B;\">
              Non ci sono ancora prenotazioni per questa attività.</div>";
            }
            //Close the connection
            mysqli_close($conn);
          ?>
        <br>
        <div style="text-align:center;margin-top:20px;font-family:lucida fax;">
          <?php echo "<button class=\"btn btn-primary btn-sm\" type=\"button\" 
                        style=\"font-size:12pt;font-weight:bold;font-family:lucida fax;\"
                        onclick=\"location.href='view_attivita_cicerone.php?id=".$idAttivita."'\"> Indietro </button>";?>
        </div>
      </div>
     </form>
    </div>
   </div>

   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  </body>
 </html>