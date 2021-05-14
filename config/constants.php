<?php

session_start();
  define('SITEURL','http://localhost/web/');
  define('LOCALHOST','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');


  $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,"food-order") or die(mysqli_error());
  

?>