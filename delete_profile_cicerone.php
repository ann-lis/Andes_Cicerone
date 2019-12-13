<?php

  //Include config file
  include 'config.php';

  //Initialize the session
  session_start();

  //acquisisce l'email del cicerone in sessione
  $emailC=$_SESSION ['email'];

  $sql ="DELETE 
         FROM Cicerone 
         WHERE Email='$emailC'";

  $result=mysqli_query($conn,$sql);

  if(!$result){

	$error="Eliminazione non avvenuta. <br>".mysqli_error($conn);
	header("Refresh:3; URL=view_profile_cicerone.php?error");
	echo "<div class=\"table-responsive\" style=\"float:left; margin-left:500px;\><br><br><br>";
	echo "<table class=\"table table-hover\"
	             style=\"background-color:#ffffff;text-align:center;font-family:lucida fax;font-weight:bold;font-size:15pt;color:#8B0000;\">";
	echo "<tr>";
	echo "<td>".$error."</td>";
	echo "</tr>";
	echo "</div>";
	exit();

  }else{
	$msg= "Il tuo account è stato rimosso correttamente!";
	header("Refresh:3; URL=index.html?result");
	echo "<div class=\"table-responsive\" style=\"float:left; margin-left:500px;\"><br><br><br>";
	echo "<table class=\"table table-hover\"
	             style=\"background-color:#ffffff;text-align:center;font-family:lucida fax;font-weight:bold;font-size:15pt;color:#00008B;\">";
	echo "<tr>";
	echo "<td>".$msg."</td>";
	echo "</tr>";
	echo "</div>";
	exit();
  }
?>