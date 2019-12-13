<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();

  //acquisisce l'email del cicerone in sessione
  $emailC=$_SESSION['email'];

  $nome_attivita=$ora_inizio=$localita=$indirizzo=$data=$num_max=$result="";
  $itinerario= "";
  $ora_fine=null;
  $compenso='0.0';
  $lingue =null;
  $indirizzo_err =$nome_attivita_err=$data_err=$localita_err=$ora_inizio_err=$num_max_err=$error="";

  if($_SERVER["REQUEST_METHOD"]=="POST"){
      //Check if nome attività is empty
      if(empty(trim($_POST['nome_attivita']))){
        $nome_attivita_err = "Inserire il nome dell'attività.";
      } else {
        $nome_attivita =  addslashes(trim($_POST['nome_attivita']));
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
      if(empty(trim($_POST['ora_inizio']))){
        $ora_inizio_err = "Inserire l'orario di inizio attività";
      } else {
        $ora_inizio = trim($_POST['ora_inizio']);
      }
      //Check if ora fine is empty
      if(empty(trim($_POST['ora_fine']))){
        $ora_fine;
      } else {
        $ora_fine = trim($_POST['ora_fine']);
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
      if(empty(trim($_POST['num_max']))){
        $num_max_err = 'Inserire il numero massimo di partecipanti.';
      } else {
        $num_max = trim($_POST['num_max']);
      }
  
      //Check if compenso is empty
      if(empty($_POST['compenso'])){
        $compenso='0.0';
      }else{
       $compenso= ($_POST['compenso']);
      }

      if(isset($_SESSION['email'])){
        $emailCicerone=$_SESSION ['email'];
      }else{
        header("location:home_cicerone.php");
      }
      
    

      if(empty($nome_attivita_err) && empty($localita_err) && empty($indirizzo_err) && empty($ora_inizio_err) && empty($data_err) && empty($num_max_err)){
        $sql ="INSERT INTO attivita (NomeAttivita, Itinerario, Localita, Indirizzo, Data, OraInizio, OraFine, Compenso, Lingue, NumMaxPrenotati, CiceroneEmail)
               VALUES ('$nome_attivita', '$itinerario' ,'$localita','$indirizzo', '$data', '$ora_inizio','$ora_fine','$compenso','$lingue','$num_max','$emailCicerone')";

        $inserisci=mysqli_query($conn,$sql);
        if(!$inserisci){
          $error="Errore nell'inserimento dell'attività <br>".mysqli_error($conn);
        }else{
          $result= "L'attività è stata inserita.";
          header("Refresh:5; URL=new_attivita.php?result");
		      echo "<div class=\"table-responsive\" style=\"float:left; margin-left:500px;\"><br><br><br>";
		        echo "<table class=\"table table-hover \" style=\"text-align:center;font-family:lucida fax;font-weight:bold;font-size:15pt;color:#00008b\">";
		          echo "<tr>";
		            echo "<td>".$result."</td>";
              echo "</tr>";
            echo "</table>";
		      echo "</div>";
		      exit();
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
       <?php echo "<a class=\"nav-link active\" href=\"/new_attivita.php?email='$emailC'\"> <b> Aggiungi Attività </b></a>";?>
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

  <div class="row register-form" style = "background-color:#ffffff;">
   <div class="col-md-6 offset-md-3 " >
    <form class="custom-form" name="form" method="post" style="background-color:#eef4f7;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
     <span class="help-block" ><?php echo $error;?></span><br>
     <p class="title">Aggiungi una nuova attività</p><br>

     <div class="form-row form-group " style="height:85px;" >
      <div class="form-group col-md-12 <?php echo (!empty($nome_attivita_err)) ? 'has-error' : '';?>">
        <label class="col-form-label" for="name-input-field">Nome attività</label>
        <input class="form-control" type="text" name="nome_attivita" value="">
        <span class="help-block" ><?php echo $nome_attivita_err;?></span>
      </div>
     </div>

     <div class="form-row form-group"  style="height:95px;" >
      <div class="form-group col-md-12">
       <label class="col-form-label">Itinerario</label>
       <textarea class="form-control" name="itinerario" type="text" rows="2" placeholder="Descrizione facoltativa" onkeyup="ContaCaratteri()" ></textarea>
       <input type="hidden" name="conta" value="0" readonly>
      </div>
     </div>

     <div class="form-row form-group " style="height:85px;" >
      <div class="form-group col-md-6 <?php echo (!empty($localita_err)) ? 'has-error' : '';?>">
       <label class="col-form-label" for="name-input-field">Località</label>
       <input class="form-control" type="text" name="localita" value="">
       <span class="help-block" ><?php echo $localita_err;?></span>
      </div>
      <div class="form-group col-md-6 <?php echo (!empty($data_err)) ? 'has-error' : '';?>">
        <label class="col-form-label" for="name-input-field">Data </label>
        <input type='text' id="data" name="data"  data-position="right top" style="height:35px;widht:40px;">
        <span class="help-block" ><?php echo $data_err; ?></span>
      </div>
     </div>

     <div class="form-row form-group" style="height:85px;" >
      <div class="form-group col-md-6 <?php echo (!empty($indirizzo_err)) ? 'has-error' : '';?>">
       <label class="col-form-label" for="name-input-field">Indirizzo</label>
       <input class="form-control" type="text" name="indirizzo" value="">
       <span class="help-block" ><?php echo $indirizzo_err; ?></span>
      </div>
      <div class="form-group col-md-6 <?php echo (!empty($ora_inizio_err)) ? 'has-error' : ''; ?>">
        <label class="col-form-label" for="name-input-field">Ora inizio (hh:mm)</label>
        <input class="form-control" type="text" name="ora_inizio" value="">
        <span class="help-block" ><?php echo $ora_inizio_err; ?></span>
      </div>
     </div>

     <div class="form-row form-group " style="height:85px;" >
      <div class="form-group col-md-6 <?php echo (!empty($num_max_err)) ? 'has-error' : ''; ?>" >
        <label class="col-form-label" for="name-input-field">Massimo partecipanti</label>
        <input class="form-control" type="text" name="num_max" value="">
        <span class="help-block" ><?php echo $num_max_err; ?></span>
      </div>
      <div class="form-group col-md-6">
        <label class="col-form-label" for="name-input-field">Ora fine (hh:mm)</label>
        <input class="form-control" type="text" name="ora_fine" value="">
      </div>
     </div>

     <div class="form-row form-group " style="height:85px;"  >
      <div class="form-group col-md-6 " >
        <label class="col-form-label" for="pawssword-input-field">Compenso</label>
        <input class="form-control" type="text" name="compenso" value="">
      </div>
      <div class="form-group col-md-6 ">
        <label class="col-form-label" for="repeat-pawssword-input-field">Lingue</label>
        <input class="form-control" type="text" name="lingue" value="">
      </div>
     </div>

     <input class="btn btn-primary btn-sm" type="submit" value="Inserisci">
    </form>
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

  </body>
 </html>