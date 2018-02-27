<?php require_once('../../php/pages_php/index/session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Customers Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../css/4-col-portfolio.css" rel="stylesheet">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="../chartdisplay/js/highcharts.js"></script>
    <script type="text/javascript" src="../chartdisplay/js/modules/exporting.js"></script>

    <script type="text/javascript">

    </script>


    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });
    </script>



</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../index.php">CoreDial, LLC. Data Intelligence</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">                
                    <li>
                        <a href="../../dashconcept/dashboard0/admin-LIVE/index.php">Dash Concept</a>
                    </li>
                    <li>
                        <a href="../../request_data.php">Request Data</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
 <!-- Split button -->
<div class="btn-group">
  <button type="button" class="btn btn-primary"><a href="../../reports/reports_index.php" style="color:#FFF;">Reports</a></button>
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
     <li class="disabled"><a disabled href="#"><strong>Choose A Category</strong></a></li>
    <li><a href="#"></a></li>
    <li><a href="../../reports/resellers/resellers_index.php">Reseller</a></li>
    <li><a href="../../reports/customers/customers_index.php">Customer</a></li>
    <li><a href="../../reports/users/users_index.php">User</a></li>
    <li><a href="../../reports/sales/sales_index.php">Sales</a></li>
    <li><a href="../../reports/marketing/marketing_index.php">Marketing</a></li>
    <li><a href="../../reports/support/support_index.php">Support</a></li>
    <li><a href="../../reports/extensions/extensions_index.php">Extensions</a></li>
    <li><a href="../../reports/infrastructure/infra_index.php">Infrastructure</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="request_data.php">Request A Report...</a></li> 
  </ul>
</div>

<div class="btn-group">
  <button type="button" class="btn btn-warning"><a href="../../dashboards/dashboards_index.php" style="color:#FFF;">Dashboards</a></button>
  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
     <li class="disabled"><a disabled href="#"><strong>Choose A Category</strong></a></li>
    <li><a href="dashboards/"></a></li>
    <li><a href="../../dashboards/resellers/resellers_index.php">Reseller</a></li>
    <li><a href="../../dashboards/customers/customers_index.php">Customer</a></li>
    <li><a href="../../dashboards/users/users_index.php">User</a></li>
    <li><a href="../../dashboards/sales/sales_index.php">Sales</a></li>
    <li><a href="../../dashboards/marketing/marketing_index.php">Marketing</a></li>
    <li><a href="../../dashboards/support/support_index.php">Support</a></li>
    <li><a href="../../dashboards/extensions/extensions_index.php">Extensions</a></li>
    <li><a href="../../dashboards/infrastructure/infrastructure_index.php">Infrastructure</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="request_data.php">Request A Dashboard...</a></li>
  </ul>
  </div><br><br>
</div>
<!-- /.container -->
</nav>

<!-- PAGE CONTENT STARTS -->
<!-- PAGE CONTENT STARTS -->
<!-- PAGE CONTENT STARTS -->
<!-- PAGE CONTENT STARTS -->
<!-- PAGE CONTENT STARTS -->
<!-- PAGE CONTENT STARTS -->
<!-- PAGE CONTENT STARTS -->
<!-- PAGE CONTENT STARTS -->
<!-- PAGE CONTENT STARTS -->
<!-- PAGE CONTENT STARTS -->
<!-- PAGE CONTENT STARTS -->


    <!-- Page Content -->
    <div class="container">

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
                <a href="customers_main.php">
                    <button class="col-md-12 btn btn-warning"><h2>Main Dash</h2></button>
                </a>
            </div>
 <!--           <div class="col-md-4 portfolio-item">
                <a href=".php">
                   <button class="col-md-12 btn btn-info"><h2>Dash</h2></button>
                </a>
            </div>
             <div class="col-md-4 portfolio-item">
                <a href=".php">
                    <button class="col-md-12 btn btn-success"><h2>Dash</h2></button>
                </a>
            </div>
-->
        </div>
        <!-- /.row -->

    
       

   
    </div>
    <!-- /.container -->
    
    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

</body>

</html>
