<?php
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $path = explode("/", $_SERVER['REQUEST_URI']);
  $dest = $path[3];
  session_start();
  if(isset($_SESSION['uuid'])) {
    if($dest === "" || $dest === NULL) {
      header("Location: http://$host/dataservice/portal/home.php");
    }
  } else {
      session_destroy();
      if($dest === "" || $dest === NULL) {
        //Do Nothing
      } else {
        header("Location: http://$host/dataservice/portal");
      }
  }
