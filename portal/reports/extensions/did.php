<?php require_once("../../php/dbconn.php"); ?>
<?php require_once('../../php/pages_php/index/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DID</title>
  <meta charset="utf-8">

  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>    <!-- Color... -->
  <link rel="stylesheet" type="text/css" href="../../../testStuff/dataTables_ASC_DESC/css.css">

  <!-- Bootstrap Core CSS -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="../../js/jquery.js"></script>
  <script type="text/javascript" src="../../js/bootstrap.js"></script>

  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/jquery-1.11.js"></script>
  <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/dataTable.js"></script>

  <script>

    $(document).ready(function() {
        $('#table1').DataTable( [
            "order": [[ 3, "desc" ]]
        ] );
    } );

</script>





<style type="text/css">

     .logo {
       margin-top: 10px;
       margin-left: 20px;
       float: left;
     }

     .container-fluid {
       background-color: #0076a3;
     }

     .navvy {
       color: #FFF !important;
     }

     .active {
       background-color: #FFF !important;
     }

     /*.page-header {
       font-family: 'Play', sans-serif;
     }*/

     body {
       font-family: 'Play', sans-serif;
     }

     .portfolio-item {
        margin-bottom: 3px;
     }

     body {
       font-family: 'Play', sans-serif;
     }
     #back {
      background-color: grey;
      color: #FFF;
    }

  </style>



</head>


<div class="col-xs-12 col-sm-6 col-lg-8">
<img class="logo" src="../../img/site_logo2.png" height="95px;" width="475px;">
</div>
<br><br><br><br><br><br>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a class="navvy" href="../../home.php">Home</a></li>
        <li><a class="active" href="../../reports_index.php">Reports</a></li>
        <li><a class="navvy" href="../../dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="../../request_data.php">Request Data</a></li>
        <li ><a id="back"  href="extensions_index.php">BACK</a></li>
        <li><a href="../../index.php"></a>Logout</li>

      </ul>
    </div>
  </div>
</nav>

<body>



<div class="container">



<?php

$count="SELECT COUNT(*)
    FROM reseller r,
       customer c,
       inventory i
  LEFT JOIN item it ON (i.itemId=it.itemId)
  JOIN itemType t ON (it.itemTypeId=t.id)
  LEFT JOIN supplier s ON (s.supplierId = i.supplierId),
  branch b
 WHERE i.statusId NOT IN (7, 8)
   AND t.systemId=6
   AND (i.resellerId = r.resellerId)
   AND (i.assignedTo = c.customerId)
   AND s.isActive =1
   AND (b.resellerId = r.resellerId)
   ";


if ( $result=mysqli_query($conn,$count) ) {

  $row_cnt = mysqli_fetch_array($result);
  $row_cnt = $row_cnt[0];
}
?>

  <h2>DID <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <p>*A full list of DID's</p><small>Row Count: <?php echo $row_cnt; ?></small>
  <div style="overflow: auto;">
  <table id="table1" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Service Provider Id</th>
        <th>SP Name</th>
        <th>Customer Id</th>
        <th>Customer Name</th>
        <th>Identifier</th>
        <th>Status</th>
        <th>Supplier</th>
        <th>PBX Context</th>
      </tr>
    </thead>
    <tbody>


<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);


$sql="SELECT r.resellerId Reseller_ID,
       r.companyName Company_Name,
       c.customerId Customer_Id,
       c.companyName Customer_Name,
       i.identifier,
       i.supplierId,
       CASE i.statusId
         WHEN 1 THEN 'AVAILABLE'
         WHEN 2 THEN 'ASSIGNED'
         WHEN 3 THEN 'ON HOLD'
         WHEN 4 THEN 'RETURNED'
         WHEN 5 THEN 'DAMAGED'
         WHEN 6 THEN 'MISSING'
         WHEN 9 THEN 'PENDING LNP OUT'
       END as statusId,
       s.name as supplier,
       b.description
  FROM reseller r,
       customer c,
       inventory i
  LEFT JOIN item it ON (i.itemId=it.itemId)
  JOIN itemType t ON (it.itemTypeId=t.id)
  LEFT JOIN supplier s ON (s.supplierId = i.supplierId),
  branch b
 WHERE i.statusId NOT IN (7, 8)
   AND t.systemId=6
   AND (i.resellerId = r.resellerId)
   AND (i.assignedTo = c.customerId)
   AND s.isActive =1
   AND (b.resellerId = r.resellerId)

UNION ALL

SELECT i.resellerId Reseller_ID,
       r.companyName Company_Name,
       i.assignedTo Customer_Id,
       'No Company Assigned' as Customer_Name,
       i.identifier,
       i.supplierId,
       CASE i.statusId
         WHEN 1 THEN 'AVAILABLE'
         WHEN 2 THEN 'ASSIGNED'
         WHEN 3 THEN 'ON HOLD'
         WHEN 4 THEN 'RETURNED'
         WHEN 5 THEN 'DAMAGED'
         WHEN 6 THEN 'MISSING'
         WHEN 9 THEN 'PENDING LNP OUT'
       END,
       s.name as supplier,
       b.description
  FROM reseller r
  JOIN inventory i ON (i.resellerId = r.resellerId)
  LEFT JOIN item it ON (i.itemId = it.itemId)
  JOIN itemType t ON (it.itemTypeId=t.id)
  LEFT JOIN supplier s ON (s.supplierId = i.supplierId),
  branch b
  WHERE i.assignedTo IS NULL
    AND t.systemId = 6
    AND i.statusId NOT IN (7, 8)
    AND s.isActive =1
    AND (b.resellerId = r.resellerId)
    LIMIT 50;
";

if ( $result=mysqli_query($conn,$sql) ) {

  while ($row=mysqli_fetch_array($result)) {

  echo "<tr>".
        "<td>".$row['Reseller_ID']."</td>".
        "<td>".$row['Company_Name']."</td>".
        "<td>".$row['Customer_Id']."</td>".
        "<td>".$row['Customer_Name']."</td>".
        "<td>".$row['statusId']."</td>".
        "<td>".$row['identifier']."</td>".
        "<td>".$row['supplier']."</td>".
        "<td>".$row['description']."</td>"."
      </tr>";

  }
}



?>
  </tbody>
  </table>

</div> <!-- overflow div -->

</div> <!-- CONTAINER END -->

</body>


</html>
