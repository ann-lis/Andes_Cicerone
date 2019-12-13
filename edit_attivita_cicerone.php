<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();

  //acquisisce l'email del cicerone in sessione
  $emailC=$_SESSION['email'];

  $nomeAttivita=$itinerario=$localita=$indirizzo=$data=$oraInizio=$orafine=$compenso=$msg=$numMax=$idAttivita="";
  $indirizzo_err =$nomeAttivita_err=$data_err=$localita_err=$oraInizio_err=$numMax_err=$error="";

  if($_SERVER["REQUEST_METHOD"] == "GET"){
    $idAttivita = $_GET['id'];

    //Comando SQL
    $strSQL = "SELECT * 
               FROM Attivita 
               WHERE Id=$idAttivita";

    $risultato = mysqli_query($conn,$strSQL);

    $riga = mysqli_fetch_assoc($risultato);

    $nomeAttivita=$riga["NomeAttivita"];
    $itinerario=$riga["Itinerario"];
    $localita=$riga["Localita"];
    $indirizzo=$riga["Indirizzo"];
    $data=$riga["Data"];
    $oraInizio=$riga["OraInizio"];
    $oraFine=$riga["OraFine"];
    $compenso=$riga["Compenso"]; 
    $lingue=$riga["Lingue"];
    $numMax=$riga['NumMaxPrenotati'];
  }

  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $idAttivita = $_POST['id'];

    //Check if nome attività is empty
    if(empty(trim($_POST['nomeAttivita']))){
      $nomeAttivita_err = "Inserire il nome dell'attività.";
    }else{
      $nomeAttivita = addslashes(trim($_POST['nomeAttivita']));
    }
    //Check if località is empty
    if(empty(trim($_POST['localita']))){
      $localita_err = 'Inserire il luogo.';
    }else{
      $localita =  addslashes(trim($_POST['localita']));
    }
    //Check if indirizzo is empty
    if(empty(trim($_POST['indirizzo']))){
      $indirizzo_err = "Inserire l'indirizzo.";
    }else{
      $indirizzo = addslashes(trim($_POST['indirizzo']));
    }
    //Check if data is empty
    if(empty(trim($_POST['data']))){
      $data_err = 'Inserire la data.';
    } else{
      $data = trim($_POST['data']);
    }
    //Check if ora inizio is empty
    if(empty(trim($_POST['oraInizio']))){
      $oraInizio_err = "Inserire l'orario di inizio attività";
    }else{
      $oraInizio = trim($_POST['oraInizio']);
    }
    //Check if ora fine is empty
    if(empty(trim($_POST['oraFine']))){
      $oraFine='';
    }else{
      $oraFine = trim($_POST['oraFine']);
    }
    //Check if itinerario is empty
    if(empty(trim($_POST["itinerario"]))){
      $itinerario = '';
    }else{
      $itinerario = addslashes(trim($_POST["itinerario"]));
    }
    //Check if lingue is empty
    if(empty(trim($_POST['lingue']))){
      $lingue='';
    }else{
      $lingue = trim($_POST['lingue']);
    }
    //Check if numero massimo partecipanti is empty
    if(empty(trim($_POST['numMax']))){
      $numMax_err = 'Inserire il numero massimo di partecipanti.';
    } else {
      $numMax = trim($_POST['numMax']);
    }
    //Check if compenso is empty
    if(empty($_POST['compenso'])){
      $compenso='0.0';
    }else{
     $compenso= ($_POST['compenso']);
    }

    if(empty($nomeAttivita_err) && empty($localita_err) && empty($indirizzo_err) && empty($oraInizio_err) && empty($data_err) && empty($numMax_err)){
       $sql = "UPDATE attivita 
               SET NomeAttivita='$nomeAttivita', Itinerario='$itinerario', Localita='$localita', Indirizzo='$indirizzo',
               Data='$data', OraInizio='$oraInizio', OraFine='$oraFine', Compenso='$compenso', Lingue='$lingue', NumMaxPrenotati='$numMax' 
               WHERE Id = '$idAttivita'";
       $result = mysqli_query($conn, $sql);
       if($result) {
         $msg="La tua attività è stata modificata correttamente";
       }else{
        $error= "Errore nella modifica ".mysqli_error($conn);
       }
    }
  }
  //Chiusura della connessione
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
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 

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

   <div style="text-align:center;">
    <div class="row register-form" style = "background-color:#ffffff;">
     <div class="col-md-6 offset-md-3 " >
      <form class="custom-form" name="form" method="post" style="background-color:#eef4f7;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
       <span class="help-block" ><?php echo $error; ?></span><br>
       <span class="help-block" ><?php echo $msg; ?></span><br>
       <p class="title">Modifica attività -
        <label class="col-form-label" for="name-input-field"><?php echo $idAttivita; ?></label>
       </p><br>
       <input type="hidden" name="id" value="<?php echo $idAttivita; ?>">

       <div class="form-row form-group " style="height:85px;">
        <div class="form-group col-md-12 <?php echo (!empty($nomeAttivita_err)) ? 'has-error' : '';?>">
         <label class="col-form-label" for="name-input-field">Nome attività</label>
         <input class="form-control" type="text" name="nomeAttivita" value="<?php echo htmlspecialchars($nomeAttivita);?>">
         <span class="help-block" ><?php echo $nomeAttivita_err; ?></span>
        </div>
       </div>

       <div class="form-row form-group"  style="height:95px;" >
        <div class="form-group col-md-12">
         <label class="col-form-label">Itinerario</label>
         <textarea class="form-control" name="itinerario" type="text" rows="2" placeholder="Descrizione facoltativa" onkeyup="ContaCaratteri()">
          <?php echo htmlspecialchars($itinerario);?>
         </textarea>
         <input type="hidden" name="conta" value="0" readonly>
        </div>
       </div>

       <div class="form-row form-group " style="height:85px;" >
        <div class="form-group col-md-6 <?php echo (!empty($localita_err)) ? 'has-error' : ''; ?>">
         <label class="col-form-label" for="name-input-field">Località</label>
         <input class="form-control" type="text" name="localita" value="<?php echo $localita;?>">
         <span class="help-block" ><?php echo $localita_err;?></span>
        </div>
        <div class="form-group col-md-6 <?php echo (!empty($data_err)) ? 'has-error' : '';?>">
         <label class="col-form-label" for="name-input-field">Data (AAAA-MM-GG)</label>
         <input type='text' id="data" name="data"  data-position="right top" style="height:35px;widht:40px;" value="<?php echo $data;?>">
         <span class="help-block" ><?php echo $data_err;?></span>
        </div>
       </div>

       <div class="form-row form-group " style="height:85px;" >
        <div class="form-group col-md-6 <?php echo (!empty($indirizzo_err)) ? 'has-error' : '';?>">
         <label class="col-form-label" for="name-input-field">Indirizzo</label>
         <input class="form-control" type="text" name="indirizzo" value="<?php echo $indirizzo;?>">
         <span class="help-block" ><?php echo $indirizzo_err;?></span>
        </div>
        <div class="form-group col-md-6 <?php echo (!empty($oraInizio_err)) ? 'has-error' : '';?>">
         <label class="col-form-label" for="name-input-field">Ora inizio (hh:mm)</label>
         <input class="form-control" type="text" name="oraInizio" value="<?php echo $oraInizio;?>">
         <span class="help-block" ><?php echo $oraInizio_err;?></span>
        </div>
       </div>

       <div class="form-row form-group " style="height:85px;" >
        <div class="form-group col-md-6 <?php echo (!empty($numMax_err)) ? 'has-error' : '';?>">
         <label class="col-form-label" for="name-input-field">Massimo partecipanti</label>
         <input class="form-control" type="text" name="numMax" value="<?php echo $numMax;?>">
         <span class="help-block" ><?php echo $numMax_err;?></span>
        </div>
        <div class="form-group col-md-6" >
         <label class="col-form-label" for="name-input-field">Ora fine (hh:mm)</label>
         <input class="form-control" type="text" name="oraFine" value="<?php echo $oraFine;?>">
        </div>
       </div>

       <div class="form-row form-group " style="height:85px;"  >
        <div class="form-group col-md-6 " >
         <label class="col-form-label" for="pawssword-input-field">Compenso</label>
         <input class="form-control" type="text" name="compenso" value="<?php echo $compenso;?>">
        </div>
        <div class="form-group col-md-6 ">
         <label class="col-form-label" for="repeat-pawssword-input-field">Lingue</label>
         <input class="form-control" type="text" name="lingue" value="<?php echo $lingue;?>">
        </div>
       </div>

       <div class="form-row form-group " style="height:50px;">
        <div class="form-group col-md-12 " style="margin-top:10px;text-align:center;">
         <button class="btn btn-primary btn-sm" type="submit">Aggiorna</button>
        </div>
       </div>

       <div class="back" style="margin-top:20px;">
        <?php echo "<a href=\"view_attivita_cicerone.php?id=$idAttivita\" >Indietro</a>";?>
       </div>
      </form>
     </div>
    </div>
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

   <script type="text/javascript">
     function ContaCaratteri(){
        document.form.conta.value = document.form.itinerario.value.length;
        var massimo = 600;
        if(document.form.itinerario.value.length > massimo){
          document.form.itinerario.value = document.form.itinerario.value.substr(0, massimo);
          document.form.conta.value = massimo;
          alert("Massimo " + massimo + " caratteri!");
        }
     }
   </script>
  </body>
 </html>