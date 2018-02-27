<?php

ini_set("log_errors", 1);
    ini_set("error_log", "/var/log/php_errors.log");

    $user = "SYSTEM.";
    $session = session_start();

    if ($session) {
      $session = "True.";
      $page = "HOME DASHBOARD";
      error_log( "Session Begun. >>> Success: ".$session." >>> User Is: ".$user." >>> Location: ".$page."  ");
    } else {
      $session = "False.";
      error_log( " WARNING! Session Begun. >>> Success: ".$session." >>> User Is: ".$user."  ");
    }

 ?>