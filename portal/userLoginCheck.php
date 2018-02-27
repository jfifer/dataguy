<?php

require_once("php/dbconn.php");
//Check Posts
$username = $_POST['user'];
$pwd = $_POST['pwd'];
// Build header info
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$failed = 'userLoginFailed.php';
$pass = 'home.php';


if (empty($username)) {

  header("Location: http://$host$uri/$failed");
  exit;

} elseif ($username) {

    $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
    $sql='SELECT username FROM user WHERE username="'.$username.'" AND password=SHA("'.$pwd.'")';
    echo $sql;

    if ( $result=mysqli_query($conn,$sql) ) {

      $rowcnt = mysqli_num_rows($result);
        if ($rowcnt >= 1) {
          session_start();
          $_SESSION['uuid'] = uniqid();
          header("Location: http://$host$uri/$pass");
        } else {
          session_destroy();
          header("Location: http://$host$uri/$fail");
        }
     }
}

?>
