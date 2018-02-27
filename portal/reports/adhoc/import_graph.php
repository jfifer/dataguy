<?php require_once('../../php/pages_php/index/session.php'); ?>
<!DOCTYPE html>
<html>
<head>
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

     <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="../../css/custom_style.css">
  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.bootstrap.min.css">
  <!-- jquery -->
  <script type="text/javascript" src="../../js/jquery.js"></script>

  <script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.bootstrap.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/buttons/1.1.2/js/buttons.colVis.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#table1').DataTable( {
        lengthChange: true,
        iDisplayLength: 100,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
      } );

      table.buttons().container()
        .appendTo( '#table1_wrapper .col-sm-6:eq(0)' );
    } );
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

     .portfolio-item {
        margin-bottom: 3px;
     }

     #back {
      background-color: grey;
      color: #FFF;
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
        <li><a id="back"  href="import_display.php">BACK</a></li>
        <li><a class="navvy" href="../../index.php">Logout</a></li>
     </ul>
    </div>
  </div>
</nav>
<div class="container">
<?php
require_once("../../php/dbconn.php");

$title = $_SERVER['QUERY_STRING'];
$v_title = urldecode($title);

$conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
  // $sql="SELECT * FROM import_test WHERE metric_title='$v_title'";
  $sql="call get_import_graph_data('$v_title')";
    if ( $result=mysqli_query($conn,$sql) ) {
        while ( $row=mysqli_fetch_array($result) ) {

       	     $data[] = array(
                  "date"   => $row["date"],
                  "value" => $row["value"]
                );
             $cleanData = json_encode($data);

        }

     }
?>

 <script>
 var clean = <?php echo $cleanData; ?>;
 console.log(clean);


            var graphData = clean;
            var chart;

            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = graphData;
                chart.categoryField = "date";
                chart.startDuration = 1;
                chart.plotAreaBorderColor = "#DADADA";
                chart.plotAreaBorderAlpha = 1;
                // this single line makes the chart a bar chart
                chart.rotate = false;

                // AXES
                // Category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.axisAlpha = 0;

                // Value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.minimum=0;

                valueAxis.autoGridCount = false;
                valueAxis.gridCount = 50;
                valueAxis.labelFrequency = 5;

                valueAxis.axisAlpha = 0;
                valueAxis.gridAlpha = 0;

                valueAxis.position = "top";
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // first graph
                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "Overview";
                graph1.valueField = "value";
                graph1.balloonText = "Date: [[date]] Metric: [[value]]";
                graph1.lineAlpha = 0;
                graph1.fillColors = "blue"; //"#ADD981";
                graph1.fillAlphas = 1;
                chart.addGraph(graph1);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                chart.addLegend(legend);

                chart.creditsPosition = "top-right";

                // WRITE
                chart.write("tester");
            });
        </script>


  <div class="row">
  	  <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $v_title; ?> Overview
                    <small><?php echo date('l jS \of F Y h:i:s A'); ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
</div>
<?php
  $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
  $minsql="SELECT LEAST(f1,f2,f3,f4,f5,f6,f7,f8,f9,f10,f11,f12,f13) FROM import_test where metric_title='".$v_title."'";
  $runmin=mysqli_query($conn,$minsql);
  $min=mysqli_fetch_array($runmin);
  $mincount = $min[0];
  mysqli_close($conn);
?>
 <div class='row'>
      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-primary'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-comments fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'><?php echo $mincount; ?></div>
                          <div>Annual Min</div>
                      </div>
                  </div>
              </div>
             <a href='#'>
             <div class='panel-footer'>
                      <span class='pull-left'></span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>

       </div>
      </div>
 <?php
  $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
  $maxsql="SELECT GREATEST(f1,f2,f3,f4,f5,f6,f7,f8,f9,f10,f11,f12,f13) FROM import_test where metric_title='".$v_title."'";
  $runmax=mysqli_query($conn,$maxsql);
  $max=mysqli_fetch_array($runmax);
  $maxcount = $max[0];
  mysqli_close($conn);
?>
      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-green'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-tasks fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'><?php echo $maxcount; ?></div>
                          <div>Annual Max</div>
                      </div>
                  </div>
              </div>
              <a href='#'>
                  <div class='panel-footer'>
                      <span class='pull-left'></span>
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
                          <div class='huge'></div>
                          <div>Annual Churn</div>
                      </div>
                  </div>
              </div>
              <a href='#'>
                  <div class='panel-footer'>
                      <span class='pull-left'></span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>

 <?php
  $conn = new mysqli($HOST,$DBUSER,$DBPWD,$DBNAME);
  $avgsql="SELECT ((f1+f2+f3+f4+f5+f6+f7+f8+f9+f10+f11+f12+f13)/13) FROM import_test where metric_title='".$v_title."'";
  $runavg=mysqli_query($conn,$avgsql);
  $avg=mysqli_fetch_array($runavg);
  $avg = $avg[0];
  mysqli_close($conn);
?>
      <div class='col-lg-3 col-md-6'>
          <div class='panel panel-red'>
              <div class='panel-heading'>
                  <div class='row'>
                      <div class='col-xs-3'>
                          <i class='fa fa-support fa-5x'></i>
                      </div>
                      <div class='col-xs-9 text-right'>
                          <div class='huge'><?php echo $avg; ?></div>
                          <div>Annual Avg</div>
                      </div>
                  </div>
              </div>
              <a href='#'>
                  <div class='panel-footer'>
                      <span class='pull-left'></span>
                      <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                      <div class='clearfix'></div>
                  </div>
              </a>
          </div>
      </div>
  </div>


    <div id="tester" style="width:100%; height:600px;"></div>
  </div>
</div>
</body>
</html>
