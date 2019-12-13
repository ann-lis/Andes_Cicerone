<?php

  $host="localhost";
  $port=3306;
  $socket="Mysql";
  $user="root";
  $password="password";
  $dbname="myglobecicerone";

  $conn = mysqli_connect($host, $user, $password, $dbname, $port, $socket);

  //Check fann_get_total_connections
  if(!$conn){
    die("ERROR: Could not connect." .mysqli_connect_error());
  }
  require_once 'functions.php';
?>
