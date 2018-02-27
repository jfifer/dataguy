<?php

$request = $_SERVER['QUERY_STRING'];
$clean = urldecode($request);
require_once("../php/dbconn.php");

// Build header info
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$pass = 'jeopardy.php';

if (!empty($uri)) {
  $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
  $sql="CALL delete_jeopardy('$clean')";
  $result=mysqli_query($conn,$sql);
  header("Location: http://$host$uri/$pass");
  exit;
}



