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
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SP OverView</title>

    <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
    <!-- Color Blocks -->
    <link href="../../js/bowerComponents/sb-admin-2.css" rel="stylesheet">


    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- MAIN CHARTS TAG -->
    <script src="../../../testStuff/AMcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <!-- CHARTS INCLUDE(s) -->
    <script src="../../../testStuff/AMcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="../../../testStuff/AMcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="../../../testStuff/AMcharts/amcharts/funnel.js" type="text/javascript"></script>


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
        <li><a class="active" href="../../home.php">Home</a></li>
        <li><a class="navvy" href="../../reports/reports_index.php">Reports</a></li>
        <li><a class="navvy" href="../../dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="../../request_data.php">Request Data</a></li>
        <li ><a id="back"  href="all_service_provider.php">BACK</a></li>
        <li><a class="navvy" href="../../index.php">Logout</a></li>


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

$sql1='SELECT * FROM tmp_sp WHERE '.$clean;

if ( $result=mysqli_query($conn,$sql1) ) {

  while ($row=mysqli_fetch_assoc($result)) {

    //TODO: Clean / Trim / Set
    $resellerId = $row['v_resellerId'];
    $companyName = $row['v_companyName'];
    $phoneNum = $row['v_phoneNum'];
    $address = $row['v_address'];
    $extCount = $row['v_extCount'];

   echo "<tr>".
           "<td>".
             "<a href='sp_overview.php?v_resellerId=".$resellerId."' >".$resellerId."</a>".
           "</td>".
           "<td>".$phoneNum."</td>".
           "<td>".$address."</td>".
           "<td>".$extCount."</td>"."
         </tr>";

  }
}


?>
</tbody>
</table>
</div>

</div>

<div class="row" style="overflow: auto;">

<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);


$sql2='call getCustomerGrowthREPORT('.$resellerId.');';

if ( $result=mysqli_query($conn,$sql2) ) {

  while ($row=mysqli_fetch_array($result)) {

    $v1 = $row[0];
    $v2 = $row[1];
    $v3 = $row[2];
    $v4 = $row[3];
    $v5 = $row[4];
    $v6 = $row[5];

  }
}

echo "
</div>
 <div class='row'>
      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-primary'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-comments fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'>".$v2."</div>
                          <div>2017 Customer Base</div>
                      </div>
                  </div>
              </div>";


       echo "<a href='customer_base_overview_2014.php?resellerId=".$resellerId."'>".
             "<div class='panel-footer'>".
                      "<span class='pull-left'>View Details</span>".
                      "<span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>".
                      "<div class='clearfix'></div>".
                  "</div>".
              "</a>".

       "</div>
      </div>
      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-green'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-tasks fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'>".$v3."</div>".
                          "<div>2018 Customer Base</div>
                      </div>
                  </div>
              </div>
              <a href='customer_base_overview_2015.php?resellerId=".$resellerId."'>".
                  "<div class='panel-footer'>
                      <span class='pull-left'>View Details</span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>


      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-yellow'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-shopping-cart fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'>".$v5."</div>
                          <div>2017 Cancellations</div>
                      </div>
                  </div>
              </div>
              <a href='cancellation_overview_2014.php?resellerId=".$resellerId."'>".
                  "<div class='panel-footer'>
                      <span class='pull-left'>View Details</span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>



      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-red'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-support fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'>".$v6."</div>
                          <div>2018 Cancellations</div>
                      </div>
                  </div>
              </div>
              <a href='cancellation_overview_2015.php?resellerId=".$resellerId."'>".
                  "<div class='panel-footer'>
                      <span class='pull-left'>View Details</span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>
  </div>";

mysqli_close($conn);

?>




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
                <!-- <a href="#" data-toggle="tooltip" title="Click On Me!"> -->
                    <label>2017 Customer Growth<small> </small></label>
                    <?php  include('../../php/sp_overview/sp_overview_SPCustomerCount-3DStacked.php'); ?>
                <!-- </a> -->
            </div>

        </div>
        <!-- End Row 1 -->

        <!-- Row 2 -->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <?php echo "<a href='../../spdrillin.php?c.resellerId=".$resellerId."'>"; ?>


                    <label>Production Services<small> </small></label></a>
                    <?php include('../../php/sp_overview/sp_overview_ProdServicesPyramid.php'); ?>

            </div>


            <div class="col-md-6 portfolio-item">
                <!-- <a href="#" data-toggle="tooltip" title="Click On Me!"> -->
                    <label>End User Billing<small> </small></label>
                    <?php include('../../php/sp_overview/getAnnualRevenue.php'); ?>


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
                    <?php include('../../php/sp_overview/sp_overview_extOverview.php'); ?>


                <!-- </a> -->
            </div>


            <div class="col-md-6 portfolio-item">
                <!-- <a href="#" data-toggle="tooltip" title="Click On Me!"> -->
                    <label>Peers<small> Overall</small></label>
                    <?php include('../../php/sp_overview/sp_overview_SPPeers.php'); ?>
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
<?php

     $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

     $sql='call didDrillin('.$resellerId.');';

     if ( $populate=mysqli_query($conn,$sql) ) {

      sleep(.2);
     }


mysqli_close($conn);
?>

<?php

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$sql1='call getTop5CustomersSpDrillIn('.$resellerId.');';


if ( $result=mysqli_query($conn,$sql1) ) {

    sleep(.1);
  }

mysqli_close($conn);
?>
