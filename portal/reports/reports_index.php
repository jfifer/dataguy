<?php
require_once("../php/pages_php/index/session.php");
ini_set("log_errors", 1);
ini_set("error_log", "/var/log/php_errors.log");

$user = "SYSTEM.";
$session = session_start();

if ($session) {
    $session = "True.";
    $page = "REPORTS INDEX";
    error_log( "Session Begun. >>> Success: ".$session." >>> User Is: ".$user." >>> Location: ".$page."  ");
} else {
    $session = "False.";
    error_log( " WARNING! Session Begun. >>> Success: ".$session." >>> User Is: ".$user."  ");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reports</title>
  <meta charset="utf-8">

  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>    <!-- Color... -->
  <!-- Bootstrap Core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <!-- <link href="../css/4-col-portfolio.css" rel="stylesheet"> -->

<style type="text/css">

.col-md-12 {
  height: 200px;
}

</style>


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

    #bread {
      top:0;
      width: 100%;
      height: 40px;
      background-color: #C0C0C0;

    }


  </style>

</head>

<!-- <div id="bread">

     <ul class="breadcrumb">
        <li class="breadcrumb"><a href="#">Home</a></li>
        <li class="active"><a href="#">Reports</a></li>

    </ul>

</div> -->


<body>

<div class="col-xs-12 col-sm-6 col-lg-8">
<img class="logo" src="../img/site_logo2.png" height="95px;" width="475px;">
</div>
<br><br><br><br><br><br>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a class="navvy" href="../home.php">Home</a></li>
        <li><a class="active" href="reports_index.php">Reports</a></li>
        <li><a class="navvy" href="../dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="../request_data.php">Request Data</a></li>
        <li><a href="../../index.php">Logout</a></li>

      </ul>
    </div>
  </div>
</nav>



<div class="container">
  <!-- <a href="../index.php"><button class="btn-xs btn-primary" style="margin-left:15px;"><h4>GO HOME</h4></button></a><br><br> -->
  <!-- Projects Row -->

            <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Reports
                    <small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-4 portfolio-item">
                <a href="resellers/resellers_index.php">
                    <button class="col-md-12 btn btn-info"><h2>Service Providers</h2></button>
                </a>
            </div>
            <div class="col-md-4 portfolio-item">
                <a href="customers/customers_index.php">
                   <button class="col-md-12 btn btn-warning"><h2>Customers</h2></button>
                </a>
            </div>
             <div class="col-md-4 portfolio-item">
                <a href="users/users_index.php">
                    <button class="col-md-12 btn btn-secondary"><h2>Users</h2></button>
                </a>
            </div>


             <div class="col-md-4 portfolio-item">
                <a href="extensions/extensions_index.php">
                    <button class="col-md-12 btn btn-success"><h2>Extensions</h2></button>
                </a>
            </div>

            <div class="col-md-4 portfolio-item">
              <!-- <a href="infrastructure/infra_index.php"> -->
                <a href="infrastructure/infra_index.php">
                <button class="col-md-12 btn btn-info"><h2>Infrastructure</h2></button>
              </a>
            </div>

             <div class="col-md-4 portfolio-item">
                <!-- marketing/marketing_index.php -->
                <a href="#">
                    <button class="col-md-12 btn btn-primary"><h2><strike>Marketing</strike></h2></button>
                </a>
            </div>

            <div class="col-md-4 portfolio-item">
              <!-- support/support_index.php -->
                <a href="#">
                    <button class="col-md-12 btn btn-danger"><h2><strike>Support</strike></h2></button>
                </a>
            </div>

            <div class="col-md-4 portfolio-item">
                <!-- sales/sales_index.php -->
                <a href="sales/sales_index.php">
                    <button class="col-md-12 btn btn-secondary"><h2>Sales</h2></button>
                </a>
            </div>

            <div class="col-md-4 portfolio-item">
             
                <a href="#">
                    <button class="col-md-12 btn btn-warning"><strike><h2>Ad Hoc</h2></strike></button>
                </a>
            </div>


        </div>
        <!-- /.row -->

  </div>
</div>

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>
