<?php
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'db_canteen';

  @$db = new mysqli($servername, $username, $password, $database);

  if($db->connect_error){
    die("Database Connection Failed");
  }
  //echo 'Database Connected';
?>
