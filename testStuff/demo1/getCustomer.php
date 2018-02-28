<?php

if($_GET['action'] == "getData") {

  $conn = new mysqli("localhost","root","d8agod","portal");

  if ($conn->connect_errno) {

      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  } else {

      $count='SELECT customerId as "F1",
                     companyName as "F2",
                     anniversaryDate as "F3"
                FROM customer
               WHERE statusId IN (2,3)
                 AND anniversaryDate IS NOT NULL
               LIMIT 50';

      if ($result=mysqli_query($conn,$count) ) {

      while ($row=mysqli_fetch_assoc($result)) {
              $arrayData[] = $row;
           }

        $cleanData = json_encode($arrayData); // ,JSON_NUMERIC_CHECK
        // $cleanData = $arrayData;
        echo $cleanData;
  }
 }
}

?>