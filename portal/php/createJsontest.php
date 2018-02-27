<?php

$HOST   ='localhost';
$DBUSER ='root';
$DBNAME ='portal';
$DBPWD  ='d8agod';

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

if ($conn->connect_errno) {

    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

# $sql='call getOverallCustomerExtensionCounts(26);';

$sql='select companyName, customerId from customer where statusId not in (2,3) limit 5600';

if ( $result=mysqli_query($conn,$sql) ) {

   while ( $row=mysqli_fetch_array($result) ) {

     #$extData = $row;
     $extData[] = array(
                  "companyName" => $row["companyName"],
                  "customerId" => $row["customerId"]
                 );
    }

    $ext = json_encode($extData);
    print_r($ext);
}

mysqli_close($conn);
?>
