<?php 
require_once('php/pages_php/index/session.php');
require_once("php/charts_php/graph0.php"); ?>
<?php require_once("php/charts_php/upTime.php"); ?>
<?php 
     session_start(); 
     $_SESSION["DBCONN"] = "PORTAL";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CoreDial, LLC. Data Intel</title>



    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/4-col-portfolio.css" rel="stylesheet">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="../chartdisplay/js/highcharts.js"></script>
    <script type="text/javascript" src="../chartdisplay/js/modules/exporting.js"></script>
    
    <!-- MAP JS -->
    <!-- <script src="http://code.highcharts.com/maps/highmaps.js"></script> -->
    <!-- // <script src="http://code.highcharts.com/maps/modules/data.js"></script> -->
    <!-- // <script src="http://code.highcharts.com/maps/modules/drilldown.js"></script> -->
    <!-- // <script src="http://code.highcharts.com/mapdata/countries/us/us-all.js"></script> -->
    <!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> -->
    <!-- END MAP JS -->
    
    <script type="text/javascript" src="js/custom_js/bar.js"></script>
    <script type="text/javascript" src="js/custom_js/annual_revenueBar.js"></script>  
    <script type="text/javascript" src="js/custom_js/graph.js"></script>
    <script type="text/javascript" src="js/custom_js/support_ticketsArea.js"></script>
    <!-- // <script type="text/javascript" src="js/custom_js/usaInvoiceDrillDown.js"></script> -->


    <!-- -->
    <script type="text/javascript">
      var data = <?php echo $stuff;?>;
    </script>

    <!-- upTime.php -->
    <script type="text/javascript">
      var upTimeX = <?php echo $upTimeX;?>;
      var upTimeY = <?php echo $upTimeY;?>;
    </script>

    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });
    </script>

    <style type="text/css">
    
/*    a:hover {
        background-color:green;
        color:white;
    }*/

/*    #graph0, #bar0, #bar1, #support_tickets {
        box-shadow: 5px 5px 5px 3px #888888;
    }*/

    </style>

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
                <a class="navbar-brand" href="index.php">CoreDial, LLC. Data Intelligence</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">                
                    <li>
                        <a href="dashconcept/dashboard0/admin-LIVE/index.php">Dash Concept</a>
                    </li>
                    <li>
                        <a href="request_data.php">Request Data</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
 <!-- Split button -->
<div class="btn-group">
  <button type="button" class="btn btn-primary"><a href="reports/reports_index.php" style="color:#FFF;">Reports</a></button>
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
     <li class="disabled"><a disabled href="#"><strong>Choose A Category</strong></a></li>
    <li><a href="#"></a></li>
    <li><a href="reports/resellers/resellers_index.php">Service Provider</a></li>
    <li><a href="reports/customers/customers_index.php">Customer</a></li>
    <li><a href="reports/users/users_index.php">User</a></li>
    <li><a href="reports/sales/sales_index.php">Sales</a></li>
    <li><a href="reports/marketing/marketing_index.php">Marketing</a></li>
    <li><a href="reports/support/support_index.php">Support</a></li>
    <li><a href="reports/extensions/extensions_index.php">Extensions</a></li>
    <li><a href="reports/infrastructure/infra_index.php">Infrastructure</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="request_data.php">Request A Report...</a></li> 
    <li><a href="report_builder.php">Report Builder</a></li> 

  </ul>
</div>

<div class="btn-group">
  <button type="button" class="btn btn-warning"><a href="dashboards/dashboards_index.php" style="color:#FFF;">Dashboards</a></button>
  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
     <li class="disabled"><a disabled href="#"><strong>Choose A Category</strong></a></li>
    <li><a href="dashboards/"></a></li>
    <li><a href="dashboards/resellers/resellers_index.php">Service Provider</a></li>
    <li><a href="dashboards/customers/customers_index.php">Customer</a></li>
    <li><a href="dashboards/users/users_index.php">User</a></li>
    <li><a href="dashboards/sales/sales_index.php">Sales</a></li>
    <li><a href="dashboards/marketing/marketing_index.php">Marketing</a></li>
    <li><a href="dashboards/support/support_index.php">Support</a></li>
    <li><a href="dashboards/extensions/extensions_index.php">Extensions</a></li>
    <li><a href="dashboards/infrastructure/infrastructure_index.php">Infrastructure</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="request_data.php">Request A Dashboard...</a></li>
  </ul>
</div>

<br><br>

    </div>
  <!-- /.container -->
</nav> <!-- END NAV -->

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

<br><br><br>
    <!-- Page Content -->
    <div class="container">

      <div class="row">
        <h4 style="color:red; margin-left: 15%;">THIS APPLICATION IS UNDER CONSTRUCTION, NOT ALL FUNCTIONALITY WILL BE AVAILABLE.</h4>
        <ol>
        <label>Recent Addition(s):</label>
        <a href="request_data.php"><li><strong>Data Request Form</strong></li></a><br>
        <li><strong>Report:</strong><a href="reports/extensions/extensions_index.php"> Extensions</a></li>
        <li><strong>Report:</strong> <a href="reports/resellers/resellers_index.php">Service Providers</a></li>
        <li><strong>Report:</strong> <a href="reports/customers/customers_index.php">Active Customers</a></li>
        <li><strong>Report:</strong> <a href="reports/users/users_index.php">Active Portal Users</a></li>
        <li><strong>Report:</strong> <a href="reports/infrastructure/infra_index.php">Server List</a></li>
        <li><strong>Report:</strong> <a href="reports/infrastructure/incidents.php">Incident List / Annual Overview Graph ToDo: Drill In</a></li>


        </ol>
      </div>
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Home 
                    <small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
<!--         <div class="row">
            <div class="col-md-12 portfolio-item">
                <a href="chart_repo/" data-toggle="tooltip" title="Click On Me!">
                    <label>Map<small> By Customer</small></label>
                    <div id="usa_invoices" style="height: 500px; min-width: 310px; max-width: 800px; margin: 0 auto"></div>
                </a>
            </div>
           
        </div> -->
        <!-- /.row -->

          <!-- Projects Row -->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <a href="#" data-toggle="tooltip" title="Click On Me!">
                    <label>Call Activity<small> By</small></label>
                    <?php include('call_activity.php'); ?>

                </a>
            </div>
            
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <a href="chart_repo/top10spbycustomer.php" data-toggle="tooltip" title="Click On Me!">
                    <label>Top 10 Service Providers<small> By Customer</small></label>
                    <div id="graph0" style="min-width: 250px; max-width: 100%; height: 450px; margin: 0 auto"></div>

                </a>
            </div>
            <div class="col-md-6 portfolio-item">
                <a href="chart_repo/upTime.php" data-toggle="tooltip" title="Click On Me!">
                    <label>UpTime<small></small></label>
                    <div id="bar0" style="min-width: 250px; max-width: 100%; height: 450px; margin: 0 auto"></div>
                </a>
            </div>
           

        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <a href="chart_repo/annualRevenueByYear.php" data-toggle="tooltip" title="Click On Me!">
                  <label>Annual Revenue<small> By Year</small></label>
                  <div id="bar1" style="min-width: 250px; max-width: 100%; height: 450px; margin: 0 auto"></div>

                </a>
            </div>
            <div class="col-md-6 portfolio-item">
                <a href="chart_repo/supportTicketsAnnualArea.php" data-toggle="tooltip" title="Click On Me!">

                  <label>Support Tickets<small></small></label>

                  <div id="support_tickets" style="min-width: 250px; height: 450px; margin: 0 auto">

                   <!-- <img src="https://s-media-cache-ak0.pinimg.com/736x/f6/dc/1d/f6dc1dbc2d048ada731cfcbb477c9d43.jpg" alt="Smiley face" height="450" width="100%">-->
                  </div>
                </a>
            </div>
           

        </div>
        <!-- /.row -->

        <hr>

        <!-- Pagination -->
       <!--  <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div> -->
        <!-- /.row -->

        <hr>
    </div>
    <!-- /.container -->

    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>


</html>
