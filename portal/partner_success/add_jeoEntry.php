<?php
require_once("../php/dbconn.php");

$resellerName = $_POST['resellerName'];
$contract_level = $_POST['cert'];
$psa = $_POST['psa'];
$phase_two_begin = $_POST['phase2'];
$ninety_day_review = $_POST['ninetyDay'];
$onetwenty_day_review = $_POST['oneTwenty'];
$gap_cat = $_POST['gapCat'];
$rem_cat = $_POST['remCat'];
$notes = $_POST['notes'];
$next_action = $_POST['nextAction'];
$next_call = $_POST['nextCall'];

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$pass = 'jeopardy.php';

if (!empty($uri)) {
  $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

  $insertSql = 'CALL add_jeopardy ("'
  	            .$resellerName.'",'.
  	            '"'.$contract_level.'",'.
  	            '"'.$psa.'",'.
  	            '"'.$phase_two_begin.'",'.
                '"'.$ninety_day_review.'",'.
                '"'.$onetwenty_day_review.'",'.
                '"'.$gap_cat.'",'.
                '"'.$rem_cat.'",'.
                '"'.$notes.'",'.
                '"'.$next_action.'",'.
                '"'.$next_call.'")';

  $result=mysqli_query($conn,$insertSql);
  header("Location: http://$host$uri/$pass");
  exit;
}

