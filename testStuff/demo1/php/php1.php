<?php
$servername = "localhost"; $username = "root"; $password = "d8agod"; $dbname = "portal";

$selectedName = $_GET['q'];

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT 1,2,3,4,5,6,7";

$result = mysqli_query($conn, $sql);

$rows = array();
if($result) {
    while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
    }
}else {
    echo 'MySQL Error: ' . mysqli_error();
}

$json = json_encode($rows);

echo $json;

mysqli_close($conn);
?>