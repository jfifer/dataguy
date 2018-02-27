<?php require_once("php/dbconn.php"); ?>
<?php 
     session_start(); 
     $_SESSION["DBCONN"] = "PORTAL";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CoreDial, LLC. Data Intel</title>

    <!-- Color... -->
    <link href="js/bowerComponents/sb-admin-2.css" rel="stylesheet">
    <!-- ..Blocks -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/4-col-portfolio.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="../testStuff/AMcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="../testStuff/AMcharts/amcharts/serial.js" type="text/javascript"></script>
    

     <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });
    </script>

    <style>

    .navbar {
      box-shadow: 8px 8px 5px #888888;
    }

    .panel {
      box-shadow: 8px 8px 5px #888888;
    }
  
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
                    <!-- <ul class="nav nav-tabs"> -->
                    <li >
                        <a href="dashconcept/dashboard0/admin-LIVE/index.php">Dash Concept</a>
                    </li>
                    <li >
                        <a href="request_data.php">Request Data</a>
                    </li>
                    <li >
                        <a href="#" data-toggle="modal" data-target="#myModal">Recent App Changes</a>
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
    <li><a href="js/query_builder/index.php">Report Builder</a></li> 

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

<br><br>

<!-- Page Content -->
<div class="container">
 
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Home 
                    <small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->


<div class="row" style="overflow: auto;">
<?php
$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);

$getCounts='call getOverAllCustomerGrowthREPORT();';

if ( $result=mysqli_query($conn,$getCounts) ) {

  while ($row=mysqli_fetch_array($result)) {

    $v1 = $row[0];
    $v2 = $row[1];
    $v3 = $row[2];
    $v4 = $row[3];
    
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
                          <div class='huge'>".$v1."</div>
                          <div>2014 Customer Base</div>
                      </div>
                  </div>
              </div>";
            

       echo "<a href='customer_base_overview_2014.php'>".
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
                          <div class='huge'>".$v2."</div>".
                          "<div>2015 Customer Base</div>
                      </div>
                  </div>
              </div>
              <a href='customer_base_overview_2015.php'>".
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
                          <div class='huge'>".$v3."</div>
                          <div>2014 Cancellations</div>
                      </div>
                  </div>
              </div>
              <a href='#'>".
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
                          <div class='huge'>".$v4."</div>
                          <div>2015 Cancellations</div>
                      </div>
                  </div>
              </div>
              <a href='customer_cancellation_overview_2015.php'>".
                  "<div class='panel-footer'>
                      <span class='pull-left'>View Details</span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>
  </div>";

?> 
<hr>  
</div>  <!-- END METRICS ROW -->    

</div> <!-- /.container -->


<div class="container">
        
        <!-- Projects Row -->
        <!-- WILL TACKLE WHEN MERGED CDR NON SENSE IS TAKING CARE OF. -->
        
        <!-- <div class="row"> -->
            <!-- <div class="col-md-12 portfolio-item"> -->
                <!-- <a href="#" data-toggle="tooltip" title="Click On Me!"> -->
                    <!-- <label>Call Activity<small> </small></label> -->
                    <?php //include('call_activity.php'); ?>
                    

                <!-- </a> -->
            <!-- </div> -->
            
        <!-- </div> -->
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            
            <div class="col-md-6 portfolio-item">
                <!-- <a href="chart_repo/upTime.php" data-toggle="tooltip" title="Click On Me!"> -->
                    <label>UpTime<small></small></label>
                    <?php require_once('chart_repo/upTime.php'); ?>
                    
                <!-- </a> -->
            </div>

            <div class="col-md-6 portfolio-item">
                <!-- <a href="chart_repo/Top10SPByCustomer.php" data-toggle="tooltip" title="Click On Me!"> -->
                    <label>Top 10 Service Providers<small> By Customer</small></label>
                    <?php require_once('chart_repo/Top10SPByCustomer.php'); ?>


                <!-- </a> -->
            </div>
           

        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <!-- <a href="#" data-toggle="tooltip" title="Click On Me!"> -->  
                  <label>Annual Revenue<small> </small></label>
                  <?php require_once('chart_repo/totalRevenue.php'); ?>
                <!-- </a> -->
            </div>
            <div class="col-md-6 portfolio-item">
                <!-- <a href="#" data-toggle="tooltip" title="Click On Me!"> -->

                  <label>Standard, Cloud & Sip Extensions<small> Overall</small></label>

                  <?php require_once('chart_repo/sipProxyCloudStandardOverview.php'); ?>

                   
                  </div>
                <!-- </a> -->
            </div>
           

        </div>
        <!-- /.row -->

</div> <!-- END CONTAINER -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" >
    
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
         
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Recent Addition(s):</h4>
         </div>
        
         <div class="modal-body">
        <div class="row">
          <ul>
          <li><strong>Form:</strong><a href="request_data.php"> Data Request Form</a></li>
          <li><strong>Report:</strong><a href="reports/extensions/extensions_index.php"> Extensions</a></li>
          <li><strong>Report:</strong> <a href="reports/resellers/resellers_index.php">Service Providers</a></li>
          <li><strong>Report:</strong> <a href="reports/customers/customers_index.php">Active Customers</a></li>
          <li><strong>Report:</strong> <a href="reports/users/users_index.php">Active Portal Users</a></li>
          <li><strong>Report:</strong> <a href="reports/infrastructure/infra_index.php">Server List</a></li>
          <li><strong>Report:</strong> <a href="reports/infrastructure/incidents.php">Incident List / Annual Overview Graph ToDo: Drill In</a></li>
          <li><strong>Utility:</strong> <a href="js/query_builder/index.php">Report Builder</a></li>
          <li><strong>Dash Object:</strong> <a href="dashboards/customers/customers_main.php">Customer Services Pie</a></li>
          <li><strong>Report / Dash:</strong> <a href="reports/resellers/all_service_provider.php">SP Drill In</a></li>
          <li><strong>Widgets / Report:</strong> <a href="reports/resellers/all_service_provider.php">Cancellations / Customer Drill In</a></li>
          <li><strong>Styling:</strong> <a href="reports/resellers/all_service_provider.php">Service Provider Styling</a></li>
          <li><strong>Chart:</strong> <a href="index.php">UpTime</a></li>
          <li><strong>Chart:</strong> <a href="reports/resellers/all_service_provider.php">This Year Revenue By SP (will need to drill in)</a></li>
          <li><strong>Chart:</strong> <a href="index.php">(2015-10-28) Extensions Overview (Sip/Std/Cloud) On Index & SP Drill In</a></li>
          <li><strong>Note:</strong> (2015-10-28) Refactored cancellation query. You have had to been active for at least 1 week in order to be considered.</li>
          <li><strong>Note:</strong> (2015-10-28) Refactored revenue charts, now bucketed by month.</li>
          <li><strong>Pie:</strong> <a href="reports/resellers/all_service_provider.php">(2015-10-28) Peers Overview By Reseller (will need to drill in)</a></li>
          <li><strong>Drillin / Pyramid:</strong> <a href="reports/resellers/all_service_provider.php">(2015-10-29) Production Services (will need to drill in)</a></li>



          </ul>
        </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
       </div>
     </div>
    </div>
  </div>
  <!-- END MODAL -->



    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>


</html>
