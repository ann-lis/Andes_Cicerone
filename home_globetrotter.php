<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();
  $login = "";

  //acquisisce l'email del globetrotter in sessione
  $emailG = $_SESSION['email'];

  //If session variable is not set it will redirect to home page
  if(isset($_SESSION['email'])){
    $login='Benvenuto '.strtolower($_SESSION['email']).'<br/>';
  }else{
    header("location:index.html");
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
     &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;

     <ul class="nav nav-tabs">
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" href=\"home_globetrotter.php?email='.$emailG.'\"> 
                    <b>Home Globetrotter</b> <img src=\"assets/immagini/globetrotter.jpg\" alt=\"Globetrotter\" height=30px width=40px/> </b> </h5> </a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"view_profile_globetrotter.php?email='.$emailG.'\"> <b> Profilo </b></a>";?>
      </li>
      <li class="nav-item">
       <?php echo "<a class=\"nav-link active\" style=\"color:#a9a9a9;\" href=\"search_attivita_globetrotter.php?email='.$emailG.'\"> <b> Ricerca Attività </b></a>";?>
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

   <p style="font-size:13pt;font-weight:bold;font-family:courier new,sans-serif;">
    <?php echo $login ?>
    <img src="assets/immagini/sfondoG.jpg" width=1450px height=550px /> 
   </p>

   <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery.min.js"></script>

  </body>
 </html>