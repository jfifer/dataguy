<?php
require_once("php/dbconn.php");
require_once('php/pages_php/index/session.php');

$username = $_POST['user'];
$pwd = $_POST['pwd'];
$adminPin = $_POST['admin_pin'];

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$failed = 'userNewAccountFailed.php';
$pass = 'home.php';


if ($adminPin=='7984824') {


	$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

    $sql='SELECT username FROM bi_users WHERE username="'.$username.'"';
    //$sql='CALL propogate_biuser("$username","$pwd","$adminPin")';
    //echo $sql;
    //$userCheck=mysqli_query($conn,$sql);

    if ( $result=mysqli_query($conn,$sql) ) {

        $rowcnt = mysqli_num_rows($result);
        if ($rowcnt >=1) {
        	header("Location: http://$host$uri/$failed");
        } else {

        	$sql_insert='INSERT INTO bi_users VALUES (DEFAULT,"'.$username.'"'.",".'"'.$pwd.'"'.",".$adminPin.")";
            //echo $sql_insert;
        	mysqli_query($conn,$sql_insert);
        	header("Location: http://$host$uri/$pass");



        }

        mysqli_free_result($result);

    }
    //echo "INSERT INTO bi_users VALUES (DEFAULT,'$username','$pwd','$adminPin)";
    //


} else {

    header("Location: http://$host$uri/$failed");
    exit;
}

mysqli_close($conn);
?>


<!-- DROP PROCEDURE IF EXISTS propogate_biuser;
CREATE PROCEDURE propogate_biuser(in_username VARCHAR(255),in_pwd VARCHAR(255),in_adminPin INT(11))
BEGIN

SELECT username
  FROM bi_users
 WHERE username
 -->
<!-- CREATE TABLE bi_users (
  bi_users_id SERIAL,
  username VARCHAR(255),
  password VARCHAR(255),
  admin_pin INT(11)
) ENGINE=Innodb; -->
