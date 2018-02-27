<?php

$HOST='backup-db.webapp.coredial.com';
$DBUSER='bi_read';
$DBPWD='d8agod';
$DBNAME='portal';


$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

if ($conn->connect_errno) {

    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}
?>