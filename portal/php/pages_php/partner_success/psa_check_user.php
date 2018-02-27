<?php

//Check Posts
$username = $_POST['user'];
$pwd = $_POST['pwd'];
// Build header info
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$failed = 'psa_login_failed.php';
$pass = '../../../partner_success/index.php';


if (empty($username)) {

  header("Location: http://$host$uri/$failed");
  exit;

} elseif ($username=='admin') {

    header("Location: http://$host$uri/$pass");
    exit;

} else {

    header("Location: http://$host$uri/$failed");
    exit;
}
?>

