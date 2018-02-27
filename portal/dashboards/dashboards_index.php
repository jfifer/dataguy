<?php require_once('../php/pages_php/index/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboards</title>
  <meta charset="utf-8">

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <!-- Bootstrap Core CSS -->
  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>    <!-- Color... -->
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

  </style>

</head>
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
        <li><a class="navvy" href="../index.php">Home</a></li>
        <li><a class="navvy" href="../reports/reports_index.php">Reports</a></li>
        <li><a class="active" href="dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="../request_data.php">Request Data</a></li>
      </ul>
    </div>
  </div>
</nav> 
  
            

<div class="container">
  <!-- <a href="../index.php"><button class="btn btn-primary"><h4>GO HOME</h4></button></a><br><br> -->
  <!-- Projects Row -->

          <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboards 
                    <small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

      <div class="row">
            <div class="col-md-4 portfolio-item">
                <a href="#">
                    <button class="col-md-12 btn btn-info"><h2><strike>Service Providers</strike></h2></button>
                </a>
            </div>
            <div class="col-md-4 portfolio-item">
                <a href="customers/customers_index.php">
                   <button class="col-md-12 btn btn-warning"><h2>Customers</h2></button>
                </a>
            </div>
             <div class="col-md-4 portfolio-item">
                <a href="#">
                    <button class="col-md-12 btn btn-secondary"><h2><strike>Users</strike></h2></button>
                </a>
            </div>


             <div class="col-md-4 portfolio-item">
                <a href="#">
                    <button class="col-md-12 btn btn-success"><strike><h2>Extensions</strike></h2></button>
                </a>
            </div>

            <div class="col-md-4 portfolio-item">
              <a href="infrastructure/infrastructure_index.php">
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
                <a href="#">
                    <button class="col-md-12 btn btn-secondary"><h2><strike>Sales</strike></h2></button>
                </a>
            </div>


        </div>






<!-- <a href="../../index.php">
<button class="col-md-12 btn btn-info"><h2></h2></button>
</a>
 -->
  </div>
</div>

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>


</body>
</html>
