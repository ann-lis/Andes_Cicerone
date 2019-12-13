<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();

  //acquisisce l'email del globetrotter in sessione
  $emailG=$_SESSION['email'];

  $localita=$localita_err=$data="";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    //acquisisce la localita' e/o la data dal form HTML
    if(empty($_POST['localita'])){
      $localita_err="Seleziona la città";
    }else{
      $localita = $_POST["localita"];
    }

    $data = $_POST["data"];
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
     &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; 
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
   <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div style="margin-left:250px;font-weight:bold;">
     <span class="help-block" style="color:#8B0000;font-size:12pt;"> <?php echo $localita_err;?></span>
    </div>
    &nbsp; &nbsp;

    Scegli la citt&agrave; dall'elenco: &nbsp; &nbsp;
    <select name="localita">
     <?php
      //Comando SQL
      $strSQL = "SELECT DISTINCT Localita 
                 FROM Attivita
                 ORDER BY Localita";

      $risultato = mysqli_query($conn,$strSQL);

      echo "<option value=\"" . $riga["Localita"] . "\">" . $localita . "</option> \n";

      while($riga = mysqli_fetch_array($risultato)){
           echo "<option value=\"" . $riga["Localita"] . "\">" . $riga["Localita"] . "</option> \n";
      }
     ?>
    </select>
    &nbsp; &nbsp;

    Inserisci la data (AAAA-MM-GG): 
    <input type='text' id="data" name="data" data-position="right top" style="height:35px;widht:40px;" value="<?php echo $data;?>">&nbsp; &nbsp;

    <input type="submit" name="cerca" value="Cerca">
   </form>

   <div style="text-align:center;">
   <?php
    if(isset($_POST['cerca'])) {

      if(empty($localita_err)){

        if(!empty($data)){
          //Comando SQL
          $strSQL = "SELECT * 
                     FROM Attivita 
                     WHERE (Localita ='$localita') AND (Data =' $data')";

          $risultato = mysqli_query($conn,$strSQL);
          $valori = mysqli_num_rows($risultato);
          //se la query produce righe, costruisco la tabella
          if($valori>0) {
            echo "<br> <h2>La ricerca ha prodotto i seguenti risultati: </h2><br><br>";
            //stampa la tabella
            echo "<div class=\"table-responsive\" style = \"text-align:center;\">";
              echo "<table class=\"table table-hover\">";
                echo "<thead>";
                  echo "<tr";
                    echo "<th>Nome attivit&agrave</th>";
                    echo "<th>Itinerario</th>";
                    echo "<th>Data</th>";
                    echo "<th>Ora Inizio</th>";
                    echo "<th>Lingue</th>";
                    echo "<th> </th>";
                  echo "</tr>";
                echo "</thead>";

                echo "<tbody style = \"text-align:center;\">";
                while($riga = mysqli_fetch_assoc($risultato)) {
                    //stampa delle righe della tabella con i risultati della query
                    echo "<tr>";
                      echo "<td>".$riga['NomeAttivita']."</td>";
                      echo "<td>".$riga['Itinerario']."</td>";
                      echo "<td>".$riga['Data']."</td>";
                      echo "<td>".$riga['OraInizio']."</td>";
                      echo "<td>".$riga['Lingue']."</td>";
                      $idAttivita = $riga['Id'];
                      echo "<td><input type=\"button\" value=\"Dettagli\" class=\"btn btn-primary btn-sm\" 
                                        style=\font-size:12pt;font-weight:bold;font-family:lucida fax;\"
                                        onclick=\"location.href='view_attivita_globetrotter.php?id=".$idAttivita."'\"></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
              echo "</table>";
            echo "</div>";
          }else{
            echo "<br><br><p style=\"color:#00008b;font-size:14pt;font-family:lucida fax;font-weight:bold;text-align:center;\">
                   Non sono disponibili attività che rispondono ai criteri scelti.</p>";
          }
        }else{
            $SQL = "SELECT * 
                    FROM Attivita 
                    WHERE (Localita ='$localita')";

            $risultato = mysqli_query($conn,$SQL);
            $valori = mysqli_num_rows($risultato);

            //se la query produce righe, costruisco la tabella
            if($valori>0) {
              echo "<br> <h2>La ricerca ha prodotto i seguenti risultati: </h2><br> <br>";
              //stampa la tabella
              echo "<div class=\"table-responsive\" style = \"text-align:center;\">";
                echo "<table class=\"table table-hover \">";
                  echo "<thead>";
                    echo "<tr>";
                      echo "<th>Nome attivit&agrave</th>";
                      echo "<th>Itinerario</th>";
                      echo "<th>Data</th>";
                      echo "<th>Ora Inizio</th>";
                      echo "<th>Lingue</th>";
                      echo "<th> </th>";
                    echo "</tr>";
                  echo "</thead>";

                  echo "<tbody style = \"text-align:center;\">";
                  while($riga = mysqli_fetch_assoc($risultato)) {
                      //stampa delle righe della tabella con i risultati della query
                      echo "<tr>";
                        echo "<td>".$riga['NomeAttivita']."</td>";
                        echo "<td>".$riga['Itinerario']."</td>";
                        echo "<td>".$riga['Data']."</td>";
                        echo "<td>".$riga['OraInizio']."</td>";
                        echo "<td>".$riga['Lingue']."</td>";
                        $idAttivita = $riga['Id'];
                        echo "<td><input type=\"button\" value=\"Dettagli\" class=\"btn btn-primary btn-sm\" 
                                        style=\"font-size:12pt;font-weight:bold;font-family:lucida fax;\"
                                         onclick=\"location.href='view_attivita_globetrotter.php?id=".$idAttivita."'\"></td>";
                      echo "</tr>";
                  }
                  echo "</tbody>";
                echo "</table>";
              echo "</div>";
            }else{
              echo "<br><br><p style=\"color:#00008B;font-size:16pt;font-family:lucida fax;font-weight:bold;text-align:center;\">
                    Non sono disponibili attività che rispondono ai criteri scelti.</p>";
            }
        }
      }
    }
    //Close connection
    mysqli_close($conn);
?>
    <br>
   </div>
   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery.min.js"></script>

   <script type="text/javascript">
      $("#data").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: new Date(),
        monthNames: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno', 'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
        dayNamesMin: ['Do','Lu','Ma','Me','Gio','Ve','Sa'],
        prevText: 'Prev',
        nextText: 'Succ',
        currentText: 'Oggi',
        isRTL: false,
      });
   </script>

  </body>
 </html>