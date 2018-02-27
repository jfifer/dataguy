<?php
require_once('php/pages_php/index/session.php');
include('php/dbconn.php');

  $sp = $_SERVER['QUERY_STRING'];
  $clean = urldecode($sp);
  $resellerId = substr($clean, -1);

?>


<?php

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$sql1='call getTop5();';


if ( $result=mysqli_query($conn,$sql1) ) {

  while ($row=mysqli_fetch_array($result)) {

         $arrayData[] = array(
                  "companyName" => $row[0],
                  "didCount" => $row[2],
                  "userCount" => $row[3],
                  "extCount" => $row[4],
                  "mailCount" => $row[5],
                  "aaCount" => $row[6],
                  "confCount" => $row[7]
                );
  }

  $jsonEncodedData = json_encode($arrayData);
}
 // echo $jsonEncodedData;

?>

<!DOCTYPE html>
<html>

  <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="../testStuff/dataTables_ASC_DESC/css.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">


  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

  <script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script>
  <script type="text/javascript" src="http://www.amcharts.com/lib/3/serial.js"></script>
  <script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/none.js"></script>

  <script type="text/javascript" src="js/custom_js/main.js"></script>
  <script type="text/javascript" src="../testStuff/dataTables_ASC_DESC/jquery-1.11.js"></script>
  <script type="text/javascript" src="../testStuff/dataTables_ASC_DESC/dataTable.js"></script>

<script type="text/javascript">

var cleanData = <?php echo $jsonEncodedData; ?>;

var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
  "theme": "light",

    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
    "useGraphSettings": true,
    "markerSize": 10
    },
    "dataProvider": cleanData,
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "DID Count",
        "type": "column",
        "color": "#000000",
        "valueField": "didCount"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "User Count",
        "type": "column",
        "color": "#000000",
        "valueField": "userCount"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Extensions",
        "type": "column",
        "color": "#000000",
        "valueField": "extCount"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Mailboxes",
        "type": "column",
        "color": "#000000",
        "valueField": "mailCount"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Auto Att",
        "type": "column",
        "color": "#000000",
        "valueField": "aaCount"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Conference Bridges",
        "type": "column",
    "color": "#000000",
        "valueField": "confCount"
    }],
    "categoryField": "companyName",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
      "enabled": true
     }

});



</script>


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


<body>

<!-- Navigation -->


<div class="col-xs-12 col-sm-6 col-lg-8">
<img class="logo" src="img/site_logo2.png" height="95px;" width="475px;">
</div>
<br><br><br><br><br><br><br>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li><a class="active" href="index.php">Home</a></li>
        <li><a class="navvy"  href="reports/reports_index.php">Reports</a></li>
        <li><a class="navvy"  href="dashboards/dashboards_index.php">Dashboards</a></li>
        <li><a class="navvy"  href="request_data.php">Request Data</a></li>
        <?php
          echo "<li><a id='back' href='reports/resellers/sp_overview.php?v_resellerId=".$resellerId."'>BACK</a></li>";
        ?>

      </ul>
    </div>
  </div>
</nav>

<!-- END NAV -->


<?php

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$query='select r.companyName from reseller r where r.resellerId='.$resellerId;

if ( $result=mysqli_query($conn,$query) ) {

  $row=mysqli_fetch_array($result);
  $resellerName = $row[0];

  }

?>

<h4 style="margin-left:40%;">Top 5 Customers For <?php echo $resellerName; ?></h4>
<div id="chartdiv"></div>

<div class="container">

<!-- Page Heading -->
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><?php echo $resellerName;?> Customer Services Overview
      <br><small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
    </h1>
  </div>
</div>
<!-- /.row -->

<table id="table1">
    <thead>
        <tr>
          <th>Customer</th>
          <th>Customer Id</th>
          <th>DID Count</th>
          <th>User Count</th>
          <th>Extensions</th>
          <th>Mailboxes</th>
          <th>Auto Attendants</th>
          <th>Conference Bridges</th>
        </tr>
    </thead>
    <tbody>

<?php

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
$sql1='call getDidReport();';


if ( $result=mysqli_query($conn,$sql1) ) {
  while ($row=mysqli_fetch_row($result)) {

   echo "
         <tr>
             <th><a href='spdrillin_action.php?v_customerId=".$row[1]."'>".$row[0]."</a></th>".
            "<td>".$row[1]."</td>".
            "<td>".$row[2]."</td>".
            "<td>".$row[3]."</td>".
            "<td>".$row[4]."</td>".
            "<td>".$row[5]."</td>".
            "<td>".$row[6]."</td>".
            "<td>".$row[7]."</td>".
         "</tr>";

 }
}

mysqli_close($conn);

?>

</tbody>
</table>

</div>


</body>

</html>
