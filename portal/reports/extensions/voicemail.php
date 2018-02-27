<?php require_once("../../php/dbconn.php"); ?>
<?php require_once('../../php/pages_php/index/session.php'); ?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(
<?php
$start = "2016-12-31";
$end = "2017-01-31";
$res = array();
$conn = new mysqli("$HOST","$DBUSER", "$DBPASS","$DBNAME");
array_push($res, array("count", "time"));

$sql = "SELECT 'vm', duration FROM vm_log_tmp WHERE origdate BETWEEN '$start' AND '$end'";
if($result = mysqli_query($conn, $sql)) {
   while($count = mysqli_fetch_assoc($result)) {
     array_push($res, array("", intval($count['duration'])));
   }
}

print_r(json_encode($res));
?>);

        var options = {
           title: 'Voicemail duration (sec)',
           legend: { position: 'none' },
           colors: ['#2368b3'],
           hAxis: {
             viewWindow: {
               max: 200
             }
           },
           chartArea: {width: 950},
           histogram: { 
             bucketSize: 5,
             maxNumBuckets: 100000,
           }
        };

        var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
<?php
$tot = 0;
$avg = 0;
foreach($res as $vm) {
   $tot += $vm[1];
}
$avg = $tot/sizeof($res);
?>
    <h3>Voicemail data for:</h3>
    <h4><?php echo $start." - ".$end; ?></h4>
    <p>Total (sec): <?php echo $tot; ?></p>
    <p>Average Duration(sec): <?php echo round($avg,2); ?></p>
    <div id="chart_div" style="width: 1100px; height: 500px;margin:0 auto;"></div>
  </body>
</html>
