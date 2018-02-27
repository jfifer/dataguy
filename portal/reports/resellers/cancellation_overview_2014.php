<?php
require_once("../../php/dbconn.php");

$resellerId = $_GET['resellerId'];

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$getResellerName ='SELECT companyName from reseller where resellerId ='.$resellerId;

if ( $result=mysqli_query($conn,$getResellerName) ) {

     $row=mysqli_fetch_array($result);
     $r_companyName = $row[0];
}
?>
<!DOCTYPE html>
<html>
<head>
  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>

 <!-- Bootstrap Core CSS -->
 <link href="../../css/bootstrap.min.css" rel="stylesheet">

 <!-- Custom CSS -->

 <link rel="stylesheet" type="text/css" href="../../../testStuff/dataTables_ASC_DESC/css.css">

 <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/jquery-1.11.js"></script>
 <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/dataTable.js"></script>


<script>
    $(document).ready(function() {
        $('#table1').DataTable( {
            "order": [[ 3, "desc" ]]
        } );
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

  </style>
</head>
<body>
<!-- Navigation -->
<div class="col-xs-12 col-sm-6 col-lg-8">
<img class="logo" src="../../img/site_logo2.png" height="95px;" width="475px;">
</div>
<br><br><br><br><br><br><br>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a class="active" href="../../index.php">Home</a></li>
        <li><a class="navvy" href="../../reports/reports_index.php">Reports</a></li>
        <li><a class="navvy" href="../../dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="../../request_data.php">Request Data</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navigation -->
<div class="container">
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $r_companyName; ?> <small>2014 Cancellation Overview </small>
            <!-- <small><?php echo date('l jS \of F Y h:i:s A'); ?></small> -->
        </h1>
    </div>
</div>
<!-- /.row -->
<table id="table1" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th><small>Reseller Id</small></th>
        <th><small>Customer Name</small></th>
        <th><small>Account Id</small></th>
        <th><small>Activation Date</small></th>
        <th><small>Cancellation Date</small></th>
      </tr>
    </thead>
    <tbody>

<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$sql="SELECT c.resellerId,
             r.companyName,
             c.companyName,
             c.accountId,
             CAST(co.contractStartDate AS DATE) contractStartDate,
             c.cancellationDate
        FROM reseller r
        JOIN customer c ON (r.resellerId=c.resellerId)
        JOIN contract co ON (c.customerId=co.customerId)
       WHERE c.cancellationDate BETWEEN '2014-12-31' AND '2016-01-01'
         AND c.companyName NOT LIKE '%demo%'
         AND c.companyName NOT LIKE '%test%'
         AND r.companyName NOT LIKE '%demo%'
         AND r.companyName NOT LIKE '%test%'
         AND r.resellerId =".$resellerId;

if ( $result=mysqli_query($conn,$sql) ) {

  while ($row=mysqli_fetch_assoc($result)) {

    //TODO: Clean / Trim / Set
    $resellerId = $row['resellerId'];
    $r_companyName = $row['companyName'];
    $companyName = $row['companyName'];
    $accountId = $row['accountId'];
    $contractStartDate = $row['contractStartDate'];
    $cancellationDate = $row['cancellationDate'];

   echo "<tr>".
           "<td>".$resellerId."</td>".
           "<td>".$r_companyName."</td>".
           "<td>".$accountId."</td>".
           "<td>".$contractStartDate."</td>".
           "<td>".$cancellationDate."</td>"."
         </tr>";
  }
}
mysqli_close($conn);
?>
</tbody>
</div>
</body>
</html>
