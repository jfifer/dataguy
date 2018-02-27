<?php require_once("pages_php/index/session.php"); ?>
<?php require_once("MAIN_CONFIG.php"); ?>

<?php

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

if ($conn->connect_errno) {

    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}
?>
