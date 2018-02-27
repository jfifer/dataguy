<?php require_once("MAIN_CONFIG.php"); ?>

<?php

$conn = new mysqli($iHOST,$iDBUSER,$iDBPWD,$iDBNAME);

if ($conn->connect_errno) {
    
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

