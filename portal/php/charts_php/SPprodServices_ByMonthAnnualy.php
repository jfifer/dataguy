<?php
require_once("../../php/dbconn.php");
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$jan='call getJanuaryDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$jan) ) {

    $row=mysqli_fetch_row($result);
      
     $janDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$feb='call getFebDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$feb) ) {

    $row=mysqli_fetch_row($result);
      
     $febDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$march='call getMarchDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$march) ) {

    $row=mysqli_fetch_row($result);
      
     $marchDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$april='call getAprilDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$april) ) {

    $row=mysqli_fetch_row($result);
      
     $aprilDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$may='call getMayDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$may) ) {

    $row=mysqli_fetch_row($result);
      
     $mayDID = json_encode($row[0]);
}

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$june='call getJuneDID('.$resellerId.');';

if ( $result=mysqli_query($conn,$june) ) {

    $row=mysqli_fetch_row($result);
      
     $juneDID = json_encode($row[0]);
}


mysqli_close($conn);
?>