<?php require_once("../../php/backupdbconn.php"); ?>
<?php require_once('../../php/pages_php/index/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Device Counts</title>
  <meta charset="utf-8">

  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="../../css/custom_style.css">
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.bootstrap.min.css">
  <!-- jquery -->
  <script type="text/javascript" src="../../js/jquery.js"></script>

  <script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.bootstrap.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.colVis.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#table1').DataTable( {
        lengthChange: true,
        iDisplayLength: 100,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
      } );

      table.buttons().container()
        .appendTo( '#table1_wrapper .col-sm-6:eq(0)' );
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

     #back {
      background-color: grey;
      color: #FFF;
     }

  </style>

</head>

<body>

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
        <li><a class="active" href="../reports_index.php">Reports</a></li>
        <li><a class="navvy" href="../../dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="../../request_data.php">Request Data</a></li>
        <li><a id="back"  href="resellers_index.php">BACK</a></li>
        <li><a class="navvy" href="../../index.php">Logout</a></li>
     </ul>
    </div>
  </div>
</nav>

<div class="container">
    <h2>Device Counts <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2><br>

<div class="row">

<div class="container">
 <div style="overflow: auto;">
    <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Service Provider</th>
          <th>Manufacturer</th>
          <th>Customer</th>
          <th>Device Model</th>
          <th>Count</th>
        </tr>
      </thead>
    <tbody>

<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

//$sql='CALL getServiceProviders();';

$sql1='SELECT  r.companyName ServiceProvider,
        dman.name Manufacturer,
        c.companyName,
        dmod.name DeviceModel,
        COUNT(d.deviceId) Count
   FROM device d
   JOIN branch b ON (d.branchId = b.branchId)
   JOIN deviceModel dmod ON (d.deviceModelId = dmod.deviceModelId)
   JOIN deviceManufacturer dman ON (dmod.deviceManufacturerId = dman.deviceManufacturerId)
   JOIN customer c ON (c.customerId=b.customerId)
   JOIN reseller r ON (r.resellerId = c.resellerId)
   WHERE c.statusId NOT IN (2,3)
   GROUP BY r.companyName, dmod.name';

if ( $result=mysqli_query($conn,$sql1) ) {

  while ( $row=mysqli_fetch_assoc($result) ) {

    $sp = $row['ServiceProvider'];
    $companyName = $row['Manufacturer'];
    $customer = $row['companyName'];
    $device = $row['DeviceModel'];
    $count = $row['Count'];

    echo "<tr>".
             "<td>".$sp."</td>".
             "<td>".$companyName."</td>".
             "<td>".$customer."</td>".
             "<td>".$device."</td>".
             "<td>".$count."</td>".
             "</tr>";
  }
}

?>
    </tbody>
  </table>

</div>
<!-- overflow div -->
</div>
<hr>



<br><br><br><br><br><br><br><br>


</div>
</body>
</html>



