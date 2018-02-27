<?php require_once("../../php/dbconn1.php"); ?>
<?php require_once("../../php/pages_php/index/session.php"); ?>
<?php session_start(); $_SESSION["DBCONN"] = "iTop";?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Incidents</title>
  <meta charset="utf-8">
  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../../testStuff/dataTables_ASC_DESC/css.css">

  <script type="text/javascript" src="../../js/jquery.js"></script>
  <script type="text/javascript" src="../../js/bootstrap.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script src="../../../testStuff/AMcharts/amcharts/amcharts.js" type="text/javascript"></script>
  <script src="../../../testStuff/AMcharts/amcharts/serial.js" type="text/javascript"></script>

    <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/jquery-1.11.js"></script>
    <script type="text/javascript" src="../../../testStuff/dataTables_ASC_DESC/dataTable.js"></script>
    <script>

        $(document).ready(function() {
            $('#table1').DataTable( {
                "order": [[ 3, "desc" ]]
            } );
        } );

    </script>




  <!-- // <script type="text/javascript" src="../../js/custom_js/incidentsAnnualLine.js"></script> -->

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
        <li><a class="navvy" href="../../home.php">Home</a></li>
        <li><a class="active" href="../reports_index.php">Reports</a></li>
        <li><a class="navvy" href="../../dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy" href="../../request_data.php">Request Data</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">

<?php
$count="SELECT COUNT(*) FROM _itopview_Incident;";


if ( $result=mysqli_query($conn,$count) ) {

  $row_cnt = mysqli_fetch_array($result);
  $row_cnt = $row_cnt[0];
}
?>

  <h2>Incidents <small><?php echo date('l jS \of F Y h:i:s A'); ?></small></h2>
  <?php echo "<br><br><label>UpTime</label>"; //require_once('../../chart_repo/upTime.php'); ?>

  <label>All Incidents Report </label>
  <br>
  <small>Row Count: <?php echo $row_cnt; ?></small>
  <br>
  <br>
  <div style="overflow: auto;">
  <table id="table1" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Reference ID</th>
        <th>Service Name</th>
        <th>Start Date</th>
        <th>Last Update</th>
        <th>Close Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>


<?php
$conn = new mysqli($iHOST,$iDBUSER,$iDBPWD,$iDBNAME);

$sql="SELECT ref,
             service_name,
             start_date,
             last_update,
             close_date,
             status
FROM _itopview_Incident;";

if ( $result=mysqli_query($conn,$sql) ) {

  while ($row=mysqli_fetch_array($result)) {

  echo "<tr>".
        "<td>"."<a href='https://itop.coredial.com/pages/UI.php?c%5Borg_id%5D=1&c%5Bmenu%5D=SearchIncidents?reference_id='".$row['ref'].">".$row['ref']."</a>"."</td>".
        "<td>".$row['service_name']."</td>".
        "<td>".$row['start_date']."</td>".
        "<td>".$row['last_update']."</td>".
        "<td>".$row['close_date']."</td>".
        "<td>".$row['status']."</td>"."
        </tr>";

  }
}



?>
  </tbody>
  </table>

</div> <!-- overflow div -->

<Br>
    <div class="row">
        <label>Incidents This Year</label>
        <?php include('../../chart_repo/incidentsYear.php'); ?>

    </div>


</div> <!-- CONTAINER END -->





    <!-- jQuery -->
    <!-- // <script src="js/jquery.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <!-- // <script src="js/bootstrap.min.js"></script> -->
</body>


</html>


<!-- Begin Navbar -->
<!-- <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".upper-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" href="#">Filter By:</a>

        <form class="navbar-form pull-left" role="search" method="get" id="searchform" action="incidents_search.php">
        <div class="input-group">
          <div class="input-group-btn">
                  <p class="btn">
                    <select  id="selector" name="customField">
                      <option value=""></option>
                      <option value="ref">Reference ID</option>
                      <option value="servicename">Service Name</option>
                      <option value="start">Start Date</option>
                      <option value="update">Last Updated</option>
                      <option value="closed">Close Date</option>
                      <option value="status">Status</option>
                      <option value="all">All</option>
                    </select>
                  </p>

          </div>
          <input type="text" class="form-control" value="" placeholder="Search..." name="filter" id="filter">
          <div class="input-group-btn">
            <button type="submit" id="searchsubmit" value="Search" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
          </div>
        </div>
        </form>
    </div>
      <div class="collapse navbar-collapse upper-navbar">
          <ul id="menu-topmenu" class="nav navbar-nav navbar-right">
            <li id="menu-item-1"><a href="https://itop.coredial.com">Go To iTop</a></li>
            <li id="menu-item-1"><a href="../../index.php">Home</a></li>
            <li id="menu-item-2"><a href="infra_index.php">Back</a></li>
          </ul>
      </div>
  </div>
</nav> -->
<!-- /.navbar -->
