<?php 
require_once("php/dbconn.php"); 
require_once('php/pages_php/index/session.php');
?>
 <?php

     session_start();
     $_SESSION["DBCONN"] = "PORTAL";

     $sp = $_SERVER['QUERY_STRING'];
     $clean = urldecode($sp);

     // $companyName = 'TEST';
     $customerId = $_GET['v_customerId'];
     $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

     $custId='SELECT r.resellerId,
                     c.companyName
                FROM reseller r
                JOIN customer c USING (resellerId)
               WHERE c.customerId ='.$customerId;

     if ($result=mysqli_query($conn,$custId)) {
      $row=mysqli_fetch_assoc($result);
       $resellerId = $row['resellerId'];
       $companyName = $row['companyName'];
   }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SP OverView</title>

    <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
    <!-- Color Blocks -->
    <link href="js/bowerComponents/sb-admin-2.css" rel="stylesheet">


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MAIN CHARTS TAG -->
    <script src="../testStuff/AMcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <!-- CHARTS INCLUDE(s) -->
    <script src="../testStuff/AMcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="../testStuff/AMcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="../testStuff/AMcharts/amcharts/funnel.js" type="text/javascript"></script>


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

  #back {
    background-color: grey;
    color: #FFF;
  }

  </style>

</head>

<body>

<!-- Navigation -->
<div class="col-xs-12 col-sm-6 col-lg-8">
<img class="logo" src="img/site_logo2.png" height="95px;" width="475px;">
</div>
<br><br><br><br><br><br>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a class="active" href="index.php">Home</a></li>
        <li><a class="navvy" href="reports/reports_index.php">Reports</a></li>
        <li><a class="navvy" href="dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="request_data.php">Request Data</a></li>
        <li><?php echo "<a id='back' href='spdrillin.php?c.resellerId=".$resellerId."'>BACK</a>";?></li>


      </ul>
    </div>
  </div>
</nav>
<!-- End Navigation -->

<!-- PAGE CONTENT STARTS -->
<div class="container">

<div class="row" style="overflow: auto;">

<div class="well">
 <table id="table1" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th><small>Reseller Id</small></th>
        <th><small>Phone</small></th>
        <th><small>Address</small></th>
        <th><small>Extensions</small></th>
      </tr>
    </thead>
    <tbody>

<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

//$sql='CALL getServiceProviders();';

// $info='SELECT a.phone,
//               concat(a.street1," ",a.city," ",a.state," ",a.zipCode) address,
//               count(e.extensionId) count
//          FROM reseller r
//          JOIN customer c USING (resellerId)
//          JOIN branch b ON (c.customerId = b.branchId)
//          JOIN extension e ON (b.branchId = e.branchId)
//          JOIN address a ON (c.billingAddressId = a.addressId)
//         WHERE c.companyName NOT LIKE "%test%"
//           AND c.companyName NOT LIKE "%demo%"
//           AND c.customerId ='.$customerId;


$info='SELECT a.phone,
concat(a.street1," ",a.city," ",a.state," ",a.zipCode) address,
count(e.extensionId) count
  FROM extension e
  LEFT JOIN branch b ON (e.branchId=b.branchId)
  LEFT JOIN customer c ON (b.customerId=c.customerId)
  LEFT JOIN reseller r ON (r.resellerId = c.resellerId)
  JOIN address a ON (c.billingAddressId = a.addressId)

 WHERE c.statusId=1
   AND e.extensionTypeId=1
   AND e.isFreeExtension=0
   AND c.companyName NOT LIKE "%test%"
   AND c.companyName NOT LIKE "%demo%"
   AND r.companyName NOT LIKE "%test%"
   AND r.companyName NOT LIKE "%demo%"
   AND c.customerId ='.$customerId;

if ( $result=mysqli_query($conn,$info) ) {

  $row=mysqli_fetch_assoc($result);
    $phone=$row['phone'];
    $address=$row['address'];
    $count=$row['count'];

   echo "<tr>".
           "<td>".
             "<a href='reports/resellers/sp_overview.php?v_resellerId=".$resellerId."' >".$resellerId."</a>".
           "</td>".
           "<td>".$phone."</td>".
           "<td>".$address."</td>".
           "<td>".$count."</td>"."
         </tr>";
}


?>
</tbody>
</table>
</div>

</div>

<div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $companyName;?> Overview
                    <small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Row 1 -->
        <div class="row">

            <div class="col-md-12 portfolio-item">

            </div>

        </div>
        <!-- End Row 1 -->

        <!-- Row 2 -->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <?php //echo "<a href='../../spdrillin.php?c.resellerId=".$resellerId."'>"; ?>

                   <label>Production Services<small> </small></label></a>
                   <?php include('php/pages_php/sp_drillin_action/cust_overview_ProdServicesPyramid.php'); ?>
            </div>


            <div class="col-md-6 portfolio-item">
                <!-- <a href="#" data-toggle="tooltip" title="Click On Me!"> -->
                    <label>End User Billing<small> </small></label>
                    <?php include('php/pages_php/sp_drillin_action/cust_overview_getEndUserBilling.php'); ?>


                <!-- </a> -->
            </div>

        </div>
        <!-- End Row 2 -->

        <!-- Row 3-->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <!-- <a href="#" data-toggle="tooltip" title="Click On Me!"> -->
                    <!-- <label>Call Activity<small> </small></label> -->
                    <?php //include('../../php/sp_overview/sp_overview_SPCallActivity.php'); ?>
                    <label>Overall Extensions<small> </small></label>
                    <?php include('php/pages_php/sp_drillin_action/cust_overview_extOverview.php'); ?>


                <!-- </a> -->
            </div>


            <div class="col-md-6 portfolio-item">
                <!-- <a href="#" data-toggle="tooltip" title="Click On Me!"> -->
                    <label>Peers<small> Overall</small></label>
                    <?php include('php/pages_php/sp_drillin_action/cust_overview_SPPeers.php'); ?>
                <!-- </a> -->
            </div>

        </div>
        <!-- End Row 3 -->

</div> <!-- END CONTAINER2 -->

    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

</body>
</html>

