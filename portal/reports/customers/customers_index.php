<?php require_once('../../php/pages_php/index/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Customers Home</title>
  <meta charset="utf-8">


  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
  <!-- Bootstrap Core CSS -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">

<style type="text/css">

.col-md-12 {
  height: 200px;
}

body {
  /*background-color: #eee;*/
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



<div class="container">
  <!-- <a href="../../index.php"><button class="btn btn-primary"><h4>GO HOME</h4></button></a><a href="../reports_index.php"><button class="btn btn-primary"><h4>GO BACK</h4></button></a><br><br> -->
  <!-- Projects Row -->

          <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Customers Home
                    <small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-4 portfolio-item">
                <!-- <a href="all_customer.php"> -->
                <a href="Please_Wait_Thanks.php">
                    <button class="col-md-12 btn btn-warning"><h2>Active Customers</h2></button>
                </a>
            </div>
        </div>
        <!-- /.row -->


  </div>
</div>

  <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>


</body>

</html>

<!-- PRE LOAD... Not sure if  I want to use this, yet..



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url(images/loader-64x/Preloader_2.gif) center no-repeat #fff;
}

<script>
  // Wait for window load
  $(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
  });
  </script>

<div class="se-pre-con"></div>
-->
