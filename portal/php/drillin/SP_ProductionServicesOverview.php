<?php require_once("../../php/dbconn.php"); ?>

 <?php 
     session_start(); 
     $_SESSION["DBCONN"] = "PORTAL";
     
     $sp = $_SERVER['QUERY_STRING'];
     $clean = urldecode($sp);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Services Overview</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../css/4-col-portfolio.css" rel="stylesheet">

    <!-- MAIN CHARTS TAG -->
    <script src="../../../testStuff/AMcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <!-- CHARTS INCLUDE(s) -->
    <script src="../../../testStuff/AMcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="../../../testStuff/AMcharts/amcharts/serial.js" type="text/javascript"></script>

</head>

<body>

<div class="container">

  <!-- Navigation -->
  <?php include('../../php/ReportsNav.php'); ?>
  <!-- End Navigation -->

  <!-- PAGE CONTENT STARTS -->
  <br><br><br>
  <!-- Page Content -->
<div class="container">

<div class="row" style="overflow: auto;">
 <table id="table1" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>SP Id</th>
        <th>SP Name</th>
        <th>Tier</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Extensions</th>
        <th>Customers</th>        
      </tr>
    </thead>
    <tbody>

<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

//$sql='CALL getServiceProviders();';

$sql1='SELECT * FROM tmp_sp WHERE '.$clean;

if ( $result=mysqli_query($conn,$sql1) ) {

  while ($row=mysqli_fetch_assoc($result)) {
    
    $resellerId = $row['v_resellerId'];
    $companyName = $row['v_companyName'];
    $tier = $row['v_tier'];
    $phoneNum = $row['v_phoneNum'];
    $address = $row['v_address'];
    $extCount = $row['v_extCount'];
    $customerCount = $row['v_customerCount'];

   echo "<tr>".
           "<td>".
             "<a href='sp_overview.php?v_resellerId=".$resellerId."' >".$resellerId."</a>".
           "</td>".
           "<td>".$companyName."</td>".
           "<td>".$tier."</td>".
           "<td>".$phoneNum."</td>".
           "<td>".$address."</td>".
           "<td>".$extCount."</td>".
           "<td>".$customerCount."</td>"."     
         </tr>";
  }
}

mysqli_close($conn);
    
?> 
</tbody>
</table>

</div>

</div> <!-- END CONTAINER1 -->
        
<div class="container">       
        
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $companyName;?> Production Services Overview 
                    <small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

              <!-- Row 1 -->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <a href="#" data-toggle="tooltip" title="Click On Me!">
                    <label>Production Services<small> By Customer</small></label>
                    <?php include('../../php/sp_overview/sp_overview_ProdServicesPie.php'); ?>
                </a>
            </div>



        </div>
        <!-- End Row 1 -->


</div> <!-- END CONTAINER2 -->
    
    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

</body>
</html>
