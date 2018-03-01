<?php
    require_once("php/dbconn.php");
//    require_once('php/pages_php/index/session.php');
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CoreDial, LLC. Data Intel</title>
<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<link href="js/bowerComponents/sb-admin-2.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="amChartsLib/AMcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="amChartsLib/AMcharts/amcharts/serial.js" type="text/javascript"></script>
<link href="css/pages_css/index.css" rel="stylesheet">

<?php
$sql='SELECT CAST(MAX(clickTimeStamp) as date) refreshedOn FROM actionHistory';

if ( $result=mysqli_query($conn,$sql) ) {
       $row=mysqli_fetch_assoc($result);
       $refreshedOn = $row['refreshedOn'];
}
?>

<body>
<!-- Nav -->
<?php require_once('php/pages_php/index/nav.php');?>
<!-- Modal -->
<?php require_once('php/pages_php/index/modal.php');?>

<!-- Begin Container 1 -->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header tour_1">Data Intelligence
        <smalindex.phpl><?php echo "Data Refreshed On: ".$refreshedOn; ?></small>
      </h1>
    </div>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">Partner Summary</h4>
    </div>
    <div class="panel-body">
      <div class="row">
        <?php require_once('php/pages_php/index/spByMonth.php'); ?>
      </div>
    </div>
  </div>
</div>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <!-- <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> -->
          <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
          Customer Summary
        <!-- </a> -->
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse  " role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">

        <!-- Begin Metrics Row -->
        <div class="row" style="overflow: auto;">
          <?php require_once('php/pages_php/index/customerTotalOverview.php'); ?>

        </div>
        <!-- End Metrics Row -->

      </div>
    </div>
  </div>
</div>


<!-- END ACCORDIAN -->

</div>

<!-- metrics were here -->

</div>
<!-- End container 1 -->

<!-- Begin Container 2 -->
<div class="container">

  <div class="row">
    <!--<div class="col-md-6 portfolio-item">
      <label>UpTime<small> <a href="reports/infrastructure/incidents.php">See Incidents Here</a></small></label>
        <?php //require_once('php/pages_php/index/upTime.php'); ?>
    </div> -->
    <div class="col-md-6 portfolio-item">
        <label>Top 10 Service Providers<small> By Customer</small></label>
          <?php require_once('php/pages_php/index/Top10SPByCustomer.php'); ?>
    </div>
    <div class="col-md-6 portfolio-item">
      <!-- <a href="#" data-toggle="tooltip" title="Click On Me!"> -->
      <label>Standard, Cloud & Sip Extensions<small> Overall</small></label>
        <?php require_once('php/pages_php/index/sipProxyCloudStandardOverview.php'); ?>
    </div>
  </div>


  <div class="row">
    <div class="col-md-6 portfolio-item">
      <label>Annual End User Billing<small> </small></label>
        <?php require_once('php/pages_php/index/totalRevenue.php'); ?>
    </div>
    <div class="col-md-6 portfolio-item">
      <label>Standard, Cloud & Sip Extensions<small> Overall</small></label>
        <?php //require_once('php/pages_php/index/sipProxyCloudStandardOverview.php'); ?>
    </div>
  </div>

</div>
<!-- End Container 2 -->

  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
