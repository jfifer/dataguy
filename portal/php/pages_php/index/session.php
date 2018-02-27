<?php
  session_start();
  if(isset($_SESSION['uuid'])) {
    //You may pass
  } else {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $failed = 'userLoginFailed.php';
    session_destroy();
    header("Location: http://$host/dataservice/portal");
  }
